<?php

namespace App\Http\Controllers;


use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return [
            'user' => auth()->user()
        ];
    }


    // public function viewRegister()
    // {
    //     $states = State::all();

    //     return view('register', compact('states'));
    // }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'remember' => ''
        ]);

        $user = User::where('email', $request->email)->first();

        if(Hash::check($request->password, $user->password)){
            return [
                'token' => $user->createToken(time())->plainTextToken
            ];
        }
    }


    public function loginWeb(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'remember' => ''
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            if(!empty(Cookie::get("mindspazeAuth"))){
                Cookie::queue(Cookie::forget('mindspazeAuth'));
            }

            if(!empty($request->remember)){
                print_r(Auth::user()->state);

                Cookie::queue('mindspazeAuth', $request->email, 10080);

            }
            return redirect()->route('home');
        }

        return redirect()->back()->with(['status' => 'fail', 'msg' => 'Incorrect Email/Password'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect(url("/"));
    }

}
