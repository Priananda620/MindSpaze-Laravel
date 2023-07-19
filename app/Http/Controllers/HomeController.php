<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check()) {
            return view('landingGuest');
            // $subjects = Subject::where('tutor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            // return view('mainPage', compact('subjects'));
        } else {


            $ip = $request->ip();
            if($ip !== "127.0.0.1"){
                $ip_details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
                $countryID = $ip_details->country;
            }else{
                // $countryID = "ID";

                $ip_details = json_decode(file_get_contents("http://ipinfo.io/115.58.192.43/json"));
                $countryID = $ip_details->country;
            }


            $result = DB::table('countries')
                ->select('phonecode')
                ->where('id', $countryID)
                ->limit(1)
                ->get();

            // Check if the query returned any results
            if ($result->isNotEmpty()) {
                $phonecode = $result[0]->phonecode;
            } else {
                $phonecode = "62";
            }


            return view('landingGuest', compact('phonecode'));
        }
    }

    public function admin(Request $request)
    {
        $answers = Answer::whereNull('moderated_as');

        $allAnswers = Answer::all()->count();

        $allQuestion = Question::all()->count();

        $allBasicUser = User::where('user_role', 0)->count();

        $allAdmin = User::where('user_role', 1)->count();



        $total_is_moderated = Answer::whereNotNull('moderated_as')->count();
        $total_not_moderated = $answers->count();

        $total_ai_true = Answer::whereNotNull('ai_classification_status')->where('ai_classification_status', 1)->count();
        $total_ai_false = Answer::whereNotNull('ai_classification_status')->where('ai_classification_status', 0)->count();

        $answers = $answers->get();

        $answers = $answers->map(function ($result) {
            $result->encrypted_question_id = Crypt::encryptString($result->question->id);
            $createdAt = Carbon::parse($result->created_at);
            $result->elapsed_time = $createdAt->diffForHumans();

            return $result;
        });

        return view('adminMain', compact('answers', 'total_not_moderated', 
        'total_is_moderated', 'allAnswers', 'allQuestion', 'allAdmin', 'allBasicUser', 'total_ai_false', 'total_ai_true'));
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

                $encrypted_userId = Crypt::encryptString($currentUser->id);

                $user_stats = [];

                $user_stats['total_question'] = Question::where('user_id', $currentUser->id)->count();
                $user_stats['total_answer'] = Answer::where('user_id', $currentUser->id)->count();
                $user_stats['total_answerModerated'] = Answer::where('user_id', $currentUser->id)->whereNotNull('moderated_as')->count();

                $user_stats['total_answerModeratedTrue'] = Answer::where('user_id', $currentUser->id)->where('moderated_as', 1)->count();
                $user_stats['total_answerModeratedFalse'] = Answer::where('user_id', $currentUser->id)->where('moderated_as', 0)->count();

                $user_stats['total_answerAiTrue'] = Answer::where('user_id', $currentUser->id)->where('ai_classification_status', 1)->count();
                $user_stats['total_answerAiFalse'] = Answer::where('user_id', $currentUser->id)->where('ai_classification_status', 0)->count();
                return view('profile', compact('country', 'currentUser', 'user_stats', 'encrypted_userId'));
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
