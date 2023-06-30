<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private static function guidv4($data = null)
    {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function getUser()
    {
        return [
            'user' => auth()->user()
        ];
    }

    public function updateRole(Request $request) {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|string',
                'user_role' => 'required|string|in:basic_user,admin_user',
            ]);


            $user = User::where('id', Crypt::decryptString($request->input('user_id')))->first();

            if($request->input('user_role') == 'basic_user'){
                $newRole = 0;
            }else if($request->input('user_role') == 'admin_user'){
                $newRole = 1;
            }else{
                return response()->json([
                    'message' => 'The given data was invalid.'
                ], 422);
            }

            $user->user_role = $newRole;
            $user->save();

            return response()->json([
                'message' => 'User Role Changed Successfully.',
                'success' => ['new role' => ['User Role Changed Successfully.']]
            ], 200);   
    
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function changePassword(Request $request){
        try {
            $validatedData = $request->validate([
                'current_password' => 'required|string|min:8|max:255',
                'new_password' => 'required|string|min:8|max:255',
                'new_password_2' => 'required|string|min:8|max:255|same:new_password'
            ]);


            $user = User::where('id', auth()->user()->id)->first();

            if (!Hash::check($request->input('current_password'), $user->password) && $request->input('current_password') != $request->input('current_password_2')) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['current_password' => ['Current password is incorrect']]
                ], 422);                
            }

            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return response()->json([
                'message' => 'Password Changed Successfully.',
                'success' => ['new password' => ['Password Changed Successfully.']]
            ], 200);   
    
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function updateDetails(Request $request) {
        $userIdToExclude = auth()->user()->id;

        // $rules = [
        //     'username' => 'sometimes|required|min:6|max:255|unique:users,username' . auth()->user()->id,
        //     'job' => 'string',
        //     'phone' => 'sometimes|required|integer|digits_between:1,15|unique:users,phone' . auth()->user()->id,
        //     'email' => 'sometimes|required|email:rfc,dns|unique:users,email' . auth()->user()->id,
        //     'instagram_username' => 'string',
        //     'twitter_username' => 'string',
        //     'facebook_username' => 'string',
        //     'linkedin_username' => 'string',
        //     'user_profile_img' => 'file|mimes:jpeg,png,gif',
        // ];

        $rules = [
            'username' => [
                'sometimes',
                'required',
                'min:6',
                'max:255',
                Rule::unique('users')->ignore($userIdToExclude),
            ],
            'job' => 'nullable|string',
            'phone' => [
                'sometimes',
                'required',
                'integer',
                'digits_between:1,15',
                Rule::unique('users')->ignore($userIdToExclude),
            ],
            'email' => [
                'sometimes',
                'required',
                'email:rfc,dns',
                Rule::unique('users')->ignore($userIdToExclude),
            ],
            'instagram_username' => 'nullable|string',
            'twitter_username' => 'nullable|string',
            'facebook_username' => 'nullable|string',
            'linkedin_username' => 'nullable|string',
            'user_profile_img' => 'file|mimes:jpeg,png,gif',
        ];
        
        $messages = [
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username has already been taken.',
            'username.min' => 'The username must be at least :min characters.',
            'username.max' => 'The username may not be greater than :max characters.',
            // 'job.required' => 'The job field is required.',
            'job.string' => 'The job field must be a string.',
            'phone.required' => 'The phone field is required.',
            'phone.integer' => 'The phone number must be an integer.',
            'phone.unique' => 'The phone has already been registered.',
            'phone.digits_between' => 'Please enter a phone number with 1 to 15 digits.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address has already been registered.',
            // 'instagram_username.required' => 'The Instagram username field is required.',
            'instagram_username.string' => 'The Instagram username field must be a string.',
            // 'twitter_username.required' => 'The Twitter username field is required.',
            'twitter_username.string' => 'The Twitter username field must be a string.',
            // 'facebook_username.required' => 'The Facebook username field is required.',
            'facebook_username.string' => 'The Facebook username field must be a string.',
            // 'linkedin_username.required' => 'The LinkedIn username field is required.',
            'linkedin_username.string' => 'The LinkedIn username field must be a string.',
            // 'user_profile_img.required' => 'The user profile image field is required.',
            'user_profile_img.file' => 'The user profile image must be a file.',
            'user_profile_img.mimes' => 'The user profile image must be in JPEG, PNG, or GIF format.',
        ];
        

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Validation failed
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('id', auth()->user()->id)->first();

//////////////
        if ($request->hasFile('user_profile_img')) {
            // Delete existing file from storage
            if ($user->user_profile_img && $user->user_profile_img != 'default.jpg' && Storage::disk('public')->exists("assets/user_images/{$user->user_profile_img}")) {
                Storage::disk('public')->delete("assets/user_images/{$user->user_profile_img}");
            }

            $file = $request->file('user_profile_img');
            $binaryData = file_get_contents($file->getRealPath());
            
            $extension = $file->getClientOriginalExtension();
            $uniqueString = self::guidv4();
            $fileName = $uniqueString . "_" . auth()->user()->username . "." . $extension;

            // Store the file in storage
            $filePath = 'assets/user_images/' . $fileName;
            Storage::disk('public')->put($filePath, $binaryData);

            // Update the user's profile image path
            $user->user_profile_img = $fileName;
        }

//////////////

        $ip = $request->ip();

        $user->last_ip = $ip;
        
        if($ip !== "127.0.0.1"){
            $ip_details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
            $country = $ip_details->country;
            $user->country_code = $country;
        }else{
            $user->country_code = 'id';
        }

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        
        
        $user->phone = $request->input('phone');

        
        if ($request->filled('job')) {
            $user->job = $request->input('job');
        } else {
            $user->job = null;
        }
        
        if ($request->filled('linkedin_username')) {
            $user->linkedin_username = $request->input('linkedin_username');
        } else {
            $user->linkedin_username = null;
        }
        
        if ($request->filled('facebook_username')) {
            $user->facebook_username = $request->input('facebook_username');
        } else {
            $user->facebook_username = null;
        }
        
        if ($request->filled('twitter_username')) {
            $user->twitter_username = $request->input('twitter_username');
        } else {
            $user->twitter_username = null;
        }
        
        if ($request->filled('instagram_username')) {
            $user->instagram_username = $request->input('instagram_username');
        } else {
            $user->instagram_username = null;
        }
        
                

        $user->save();

        return response()->json([
            'message' => 'success update data',
            'user' => [
                'email' => $user->email,
                'username' => $user->username,
                'phone' => $user->phone,
                'country_code' => $user->country_code,
                'user_profile_img' => $user->user_profile_img,
                'job' => $user->job,
                'instagram_username' => $user->instagram_username,
                'twitter_username' => $user->twitter_username,
                'facebook_username' => $user->facebook_username,
                'linkedin_username' => $user->linkedin_username,
            ]
        ]);
        
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
            $ip = $request->ip();
            

            $user = new User();

            $user->last_ip = $ip;
            
            if($ip !== "127.0.0.1"){
                $ip_details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
                $country = $ip_details->country;
                $user->country_code = $country;
            }else{
                $user->country_code = 'id';
            }

            $user->username = $request->input('username');
            $user->email = $request->input('email');
            
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
}
