<?php

namespace App\Http\Controllers;


use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

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

    public function test(Request $request)
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
