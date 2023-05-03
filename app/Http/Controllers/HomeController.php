<?php
namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->check()){
            $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            return view('mainPage', compact('subjects'));
        }else{
            return view('landingGuest');
        }
    }
}
