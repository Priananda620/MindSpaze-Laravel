<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function about(Request $request)
    {
        if(auth()->check()){
            return view('about');
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        }else{
            return view('about');
        }
    }

    public function addQuestion(Request $request)
    {
        if(auth()->check()){
            return view('addQuestion');
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        }else{
            return view('addQuestion');
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

    public function profile(Request $request, $param)
    {
        if(auth()->check()){
            

            $currentUser = User::where('username', $param)->first();

            if(!empty($currentUser)){
                $country = DB::table('countries')
                ->select(DB::raw('*'))
                ->where('id', $currentUser->country_code)
                ->get();

                $country = json_decode($country, true);

                return view('profile', compact('country', 'currentUser'));
            }else{
                return redirect('/profile/'.auth()->user()->username);
            }
            
        }else{
            return redirect('/');
        }
    }

    
}
