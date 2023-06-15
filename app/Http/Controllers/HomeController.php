<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\User;
use App\Models\Tag;
use App\Models\QuestionTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tags;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check()) {
            return view('landingGuest');
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        } else {
            return view('landingGuest');
        }
    }

    public function admin(Request $request)
    {
        $answers = Answer::all();

        $total_is_moderated = Answer::whereNotNull('moderated_as')->count();
        $total_not_moderated = Answer::whereNull('moderated_as')->count();

        return view('adminMain', compact('answers', 'total_not_moderated', 'total_is_moderated'));
    }


    public function about(Request $request)
    {
        if (auth()->check()) {
            return view('about');
        } else {
            return view('about');
        }
    }


    // public function test(Request $request)
    // {
    //     if(auth()->check()){
    //         return view('threadDetails');
    //         // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
    //         // return view('mainPage', compact('subjects'));
    //     }else{
    //         return view('threadDetails');
    //     }
    // }

    public function profile(Request $request, $param)
    {
        if (auth()->check()) {


            $currentUser = User::where('username', $param)->first();

            if (!empty($currentUser)) {
                $country = DB::table('countries')
                    ->select(DB::raw('*'))
                    ->where('id', $currentUser->country_code)
                    ->get();

                $country = json_decode($country, true);

                return view('profile', compact('country', 'currentUser'));
            } else {
                return redirect('/profile/' . auth()->user()->username);
            }
        } else {
            return redirect('/');
        }
    }

    public function addQuestion(Request $request)
    {
        if (auth()->check()) {

            // orderBy('created_at', 'DESC')->get()
            $tags = Tag::all();

            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    $encryptedId = Crypt::encryptString($tag->id);
                    $tag->encryptedId = $encryptedId;
                }
                return view('addQuestion', compact('tags'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function threads(Request $request)
    {
        if (auth()->check()) {
            // $tags = Tag::all();

            // $tags = Tag::withCount('questionTag')->get();

            $tags = Tag::withCount([
                'questionTag' => function ($query) {
                    $query->whereHas('question', function ($query) {
                        $query->whereNull('deleted_at');
                    });
                }
            ])->orderByDesc('question_tag_count')->get();
            
            

            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    $encryptedId = Crypt::encryptString($tag->id);
                    $tag->encryptedId = $encryptedId;
                }
                return view('threadList', compact('tags'));
            } else {
                return redirect('/');
            }
            
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        } else {
            return redirect('/');
        }
    }
}
