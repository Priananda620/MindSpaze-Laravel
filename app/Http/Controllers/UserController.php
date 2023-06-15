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

class UserController extends Controller
{
    public function getUser()
    {
        return [
            'user' => auth()->user()
        ];
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
