<?php

namespace App\Http\Controllers;


use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function getUserObj($plainToken)
    {
        $personalAccessToken = PersonalAccessToken::findToken($plainToken);
        $userrrr = $personalAccessToken->tokenable;

        if ($userrrr instanceof User) {
            return $userrrr;
        }
    }

    public function getUser()
    {
        return [
            'user' => auth()->user()
        ];
    }


    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'remember' => ''
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            $newTokenName = time();

            /** @var \App\Models\User $user **/
            $accessToken = $user->createToken($newTokenName);

            $cookie1 = cookie('api_token', $accessToken->plainTextToken, 1440);
            $cookie2 = cookie('token_name', $newTokenName, 1440);


            // $user2 = User::where('email', $request->email)->first();
            Session::put('user', $user);

            return response()->json([
                'token_object' => $accessToken->accessToken,
                'token' => $accessToken->plainTextToken,
            ])->withCookie($cookie1)->withCookie($cookie2);

            // return redirect('/')->withCookie($cookie);

        }
        return response()->json([
            'error' => 'Unauthorized',
        ], 401);
    }

    public function register(Request $request)
    {
        $rules = [
            'username' => 'required|min:6|max:255|unique:users',
            'password' => 'required|min:8|max:255',
            'phone' => 'required|integer|digits_between:1,15|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
        ];

        $messages = [
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username has already been taken.',
            'username.min' => 'The username must be at least :min characters.',
            'username.max' => 'The username may not be greater than :max characters.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
            'password.max' => 'The password may not be greater than :max characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address has already been registered.',
            'phone.required' => 'The phone field is required.',
            'phone.integer' => 'The phone number must be an integer.',
            'phone.unique' => 'The phone has already been registered.',
            'phone.digits_between' => 'Please enter a phone number with 1 to 15 digits.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Validation failed
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (empty(User::where('email', $request->input('email'))->first()) && empty(User::where('username', $request->input('username'))->first())) {
            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->country_code = 'id';
            $user->phone = $request->input('phone');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            $credentials = $request->only('email', 'password');

            Auth::attempt($credentials);

            $userObj = Auth::user();

            $newTokenName = time();

            /** @var \App\Models\User $userObj **/
            $accessToken = $userObj->createToken($newTokenName);

            $cookie1 = cookie('api_token', $accessToken->plainTextToken, 1440);
            $cookie2 = cookie('token_name', $newTokenName, 1440);

            Session::put('user', $user);

            return response()->json([
                'token_object' => $accessToken->accessToken,
                'token' => $accessToken->plainTextToken,
            ])->withCookie($cookie1)->withCookie($cookie2);
        } else {
            return response()->json([
                'message' => 'username or email is exist',
            ], 401);
        }
    }

    public function generateToken(Request $request)
    {
        $token = $request->user()->createToken('API Token')->accessToken;
        return response()->json(['token' => $token]);
    }



    public function loginWeb(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'remember' => ''
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->back();
        }

        return redirect()->back()->with(['status' => 'fail', 'msg' => 'Incorrect Email/Password'])->withInput();
    }


    // public function createTutor(Request $request)
    // {
    //     $validated = $request->validate([
    //         'fullName' => 'required|max:255',
    //         'email' => 'required|email:rfc,dns|unique:tutors',
    //         'phone' => 'required|digits_between:0,10|numeric',
    //         'address' => 'required',
    //         'state' => 'required|exists:states,id',
    //         'password' => 'required|min:8|alpha_num',
    //         'verPass' => 'required|same:password'
    //     ]);

    //     $tutor = new Tutor();

    //     $tutor->full_name = $request->fullName;
    //     $tutor->email = $request->email;
    //     $tutor->phone = $request->phone;
    //     $tutor->mailing_address = $request->address;
    //     $tutor->state_id = $request->state;

    //     $hashed_pass = Hash::make($request->password);
    //     $tutor->password = $hashed_pass;

    //     $tutor->save();

    //     return redirect()->back()->with(['status' => 'ok', 'msg' => 'Tutor '.$tutor->full_name.' has been created'])->withInput();
    // }



    public function logout(Request $request)
    {
        $user = Auth::user();

        $plainTextToken = request()->cookie('api_token');
        $tokenName = request()->cookie('token_name');
        $tokenParts = explode('|', $plainTextToken);
        $tokenWithoutPrefix = end($tokenParts);
        $tokenWithoutPrefixHashed = hash('sha256', $tokenWithoutPrefix);

        /** @var \App\Models\User $user **/
        $personalAccessToken = $user->tokens()->where('token', $tokenWithoutPrefixHashed)->first();

        print_r($tokenWithoutPrefixHashed);
        echo "<br>";
        print_r($tokenName);
        echo "<br>";
        print_r($personalAccessToken->token);
        echo "<br>";


        if ($personalAccessToken) {
            $personalAccessToken->delete();
            Cookie::queue(Cookie::forget('token_name'));
            Cookie::queue(Cookie::forget('api_token'));

            Auth::logout();
            Session::flush();

            return redirect('/');
        } else {
            // return redirect('/');
        }
    }

    public function test()
    {
        $imagePath = 'public/assets/question_images/4ea5523e-61f9-4e67-816b-46c01ba395bb_azhar620_12.png';
        $imageData = base64_encode(Storage::get($imagePath));
        $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $base64Image = 'data:image/' . $fileExtension . ';base64,' . $imageData;

        // Output the base64-encoded image with prefix
        echo $base64Image;
    }

    public function test2(Request $request)
    {
        $plainTextToken = Cookie::get('api_token');
        $tokenParts = explode('|', $plainTextToken);
        $tokenWithoutPrefix = end($tokenParts);

        echo $tokenWithoutPrefix;
        echo "<br>";
        echo hash('sha256', $tokenWithoutPrefix);
        echo "<br>";

        $personalAccessToken = PersonalAccessToken::where('token', hash('sha256', $tokenWithoutPrefix))->first();

        if ($personalAccessToken) {
            echo $personalAccessToken->token;
            echo "<br>";
            echo $plainTextToken;
        } else {
            echo "NOT FOUND";
        }
    }

    public function testtemp(Request $request)
    {
        $user = Auth::user();
        $plainTextToken = Cookie::get('api_token');

        /** @var \App\Models\User $user **/
        $hashedToken = $user->tokens()->where('name', '1685771191')->first();

        // $userr = User::where('token', Hash::make('1|PuhaaenURQ96gyT8HTbNtiVMj8tKJibeunmv53eV'))->first();


        print_r($hashedToken->token);
        print_r("<br><br><br>");

        print_r($user->username);
        print_r("<br>");
        print_r($this->getUserObj($plainTextToken)->username);
        print_r("<br><br><br>");
        print_r($plainTextToken);

        // Cookie::queue('api_token2', '1|PuhaaenURQ96gyT8HTbNtiVMj8tKJibeunmv53eV', 10080);
    }




    public function logoutApi(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
