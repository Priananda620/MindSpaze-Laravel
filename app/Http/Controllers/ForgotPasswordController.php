<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // $status = Password::sendResetLink($request->only('email'));

        // $status = Password::sendResetLink(
        //     $request->only('email'),
        //     function ($user, $token) use ($request) {
        //         Mail::send('emails.forgot-password', ['resetUrl' => $this->resetUrl($token)], function ($message) use ($request) {
        //             $message->to($request->email)->subject('Reset Your Password');
        //         });
        //     }
        // );

        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) use ($request) {
                $resetUrl = URL::signedRoute('password.reset', ['token' => $token, 'email' => $request->email]);
                $profileUrl = User::where('email', $request->email)->first();
                
                Mail::send('emails.forgot-password', ['resetUrl' => $resetUrl, 'profileUrl' => url('/profile').'/'.$profileUrl->username, 'avatarUrl' => asset('storage/assets/user_images/').'/'.$profileUrl->user_profile_img], function ($message) use ($request) {
                    $message->to($request->email)->subject('Reset Your Password');
                });
            }
        );
    
    

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
