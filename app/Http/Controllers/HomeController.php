<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->check()){
            return view('landingGuest');
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        }else{
            return view('landingGuest');
        }
    }

    public function test(Request $request)
    {
        if(auth()->check()){
            return view('threadDetails');
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        }else{
            return view('threadDetails');
        }
    }

    public function threads(Request $request)
    {
        if(auth()->check()){
            return view('threadList');
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        }else{
            return view('threadList');
        }
    }

    public function profile(Request $request)
    {
        if(auth()->check()){
            return view('profile');
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        }else{
            return view('profile');
        }
    }
}
