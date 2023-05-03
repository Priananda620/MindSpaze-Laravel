<?php

namespace App\Http\Controllers;


use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function viewLogin()
    {
        $cookieData = Cookie::get('tutor_login_email');
        return view('login', compact('cookieData'));
    }


    public function viewRegister()
    {
        $states = State::all();

        return view('register', compact('states'));
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'remember' => ''
        ]);


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(!empty(Cookie::get("tutor_login_email"))){
                Cookie::queue(Cookie::forget('tutor_login_email'));
            }

            if(!empty($request->remember)){
                print_r(Auth::user()->state);

                Cookie::queue('tutor_login_email', $request->email, 10080);

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
