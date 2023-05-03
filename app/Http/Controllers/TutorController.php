<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TutorController extends Controller
{

    public function createTutor(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|max:255',
            'email' => 'required|email:rfc,dns|unique:tutors',
            'phone' => 'required|digits_between:0,10|numeric',
            'address' => 'required',
            'state' => 'required|exists:states,id',
            'password' => 'required|min:8|alpha_num',
            'verPass' => 'required|same:password'
        ]);

        $tutor = new Tutor();

        $tutor->full_name = $request->fullName;
        $tutor->email = $request->email;
        $tutor->phone = $request->phone;
        $tutor->mailing_address = $request->address;
        $tutor->state_id = $request->state;

        $hashed_pass = Hash::make($request->password);
        $tutor->password = $hashed_pass;

        $tutor->save();

        return redirect()->back()->with(['status' => 'ok', 'msg' => 'Tutor '.$tutor->full_name.' has been created'])->withInput();
    }




}

