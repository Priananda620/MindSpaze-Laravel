<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkLoginSession');
    }

    public function viewAddCourse()
    {
        if(auth()->check()){
            $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            return view('addCourse', compact('subjects'));
        }else{
            return redirect(url("/"));
        }
    }

    public function doAddCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|digits_between:1,11|numeric',
            'learning_hours' => 'required|digits_between:1,11|numeric',
        ]);


        $subject = new Subject();
        $subject->tutor_id  = Auth::user()->id;
        $subject->title = $request->title;
        $subject->description = $request->description;
        $subject->price = $request->price;
        $subject->learning_hours = $request->learning_hours;

        $subject->save();

        return redirect(url("/"))->with(['status' => 'ok', 'msg' => 'Subject '.$subject->title.' has been created']);
    }
}
