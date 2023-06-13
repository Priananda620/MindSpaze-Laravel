<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Tag;
use App\Models\User;
use App\Models\UpVote;
use App\Models\DownVote;
use App\Models\Reaction;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;
use App\Models\QuestionTag;
use Ramsey\Uuid\Type\Integer;
// use Reactions;

class ThreadController extends Controller
{
    private static function guidv4($data = null)
    {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function getThreads(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'query' => 'nullable|string',
                'tags' => 'nullable|json',
                'limit' => 'nullable|integer'
            ]);

            $limit = $validatedData['limit'] ?? null;

            $decodedTags = [];
            if (!empty($request->input('tags'))) {
                $tagsArray = json_decode($request->input('tags'), true);

                foreach ($tagsArray as $tag) {
                    $tag_id = Tag::where('id', Crypt::decryptString($tag))->first()->id;
                    $decodedTags[] = $tag_id;
                }
            }
            // $tagIds = [1, 2, 3];


            if (!empty($request->input('query'))) {

                if (count($decodedTags) > 0) {
                    $results = Question::with('user', 'answer')
                        ->select('questions.*')
                        ->join('question_tags', 'questions.id', '=', 'question_tags.question_id')
                        ->join('tags', 'tags.id', '=', 'question_tags.tag_id')
                        ->whereIn('tags.id', $decodedTags)
                        ->where('title', 'LIKE', '%' . $request->input('query') . '%')
                        ->distinct();
                    // ->get();
                } else {
                    $results = Question::with('user', 'answer')->where('title', 'LIKE', '%' . $request->input('query') . '%');
                    // ->get();
                }
            } else {
                if (count($decodedTags) > 0) {
                    $results = Question::with('user', 'answer')
                        ->select('questions.*')
                        ->join('question_tags', 'questions.id', '=', 'question_tags.question_id')
                        ->join('tags', 'tags.id', '=', 'question_tags.tag_id')
                        ->whereIn('tags.id', $decodedTags)
                        ->distinct();
                    // ->get();
                } else {
                    $results = Question::with('user', 'answer');
                    // ->get();
                }
            }

            $results = $results->limit($limit);
            $results = $results->get();



            $results = $results->map(function ($result) {
                $result->encrypted_id = Crypt::encryptString($result->id);
                $createdAt = Carbon::parse($result->created_at);
                $result->elapsed_time = $createdAt->diffForHumans();

                $hasAnswerVerified = $result->answer->contains(function ($answer) {
                    $ai_classification_status = $answer->ai_classification_status;
                    $moderated_as = $answer->moderated_as;

                    $boolHasVerified = $ai_classification_status && $moderated_as;
                    // $boolHasVerified = strpos($ai_classification_status, 'fact') !== false || strpos($ai_classification_status, 'potential true') && $moderated_as == 'true';
                    return $boolHasVerified;
                });
                $result->hasAnswerVerified = $hasAnswerVerified;
                return $result;
            });

            return response()->json([
                'threads' => $results,
                'total' => $results->count(),
                'limit' => $limit ? (int)$limit : 0
            ]);
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function deleteAnswer(Request $request) {
        try {
            $validatedData = $request->validate([
                'answer_id' => 'required|string'
            ]);

            $answer = Answer::where('id', Crypt::decryptString($request->input('answer_id')))->first();

            if(auth()->user()->user_role === 1){ //admin
                if(!empty($answer)){
                    $answer->delete();

                    return response()->json([
                        'message' => 'success'
                    ]);
                }else{
                    return response()->json([
                        'message' => 'The given data was invalid.'
                    ], 422);
                }
            }else{

                if(!empty($answer) && $answer->user_id == auth()->user()->id){
                    $answer->delete();

                    return response()->json([
                        'message' => 'success'
                    ]);
                }else{
                    return response()->json([
                        'message' => 'The given data was invalid.'
                    ], 422);
                }
            }

        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function deleteQuestion(Request $request) {
        try {
            $validatedData = $request->validate([
                'question_id' => 'required|string'
            ]);

            $question = Question::where('id', Crypt::decryptString($request->input('question_id')))->first();

            if(auth()->user()->user_role === 1){ //admin
                if(!empty($question)){

                    $question->delete();

                    Answer::where('question_id', $question->id)->delete();

                    return response()->json([
                        'message' => 'success'
                    ]);
                }else{
                    return response()->json([
                        'message' => 'The given data was invalid.'
                    ], 422);
                }
            }else{
                if(!empty($question) && $question->user_id == auth()->user()->id){
                    $question->delete();
    
                    Answer::where('question_id', $question->id)->delete();
    
                    return response()->json([
                        'message' => 'success'
                    ]);
                }else{
                    return response()->json([
                        'message' => 'The given data was invalid.'
                    ], 422);
                }
            }

        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    private function encodeQuestionImageBase64($fileName)
    {
        $imagePath = 'public/assets/question_images/' . $fileName;
        $imageData = base64_encode(Storage::get($imagePath));
        $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $base64Image = 'data:image/' . $fileExtension . ';base64,' . $imageData;

        return $base64Image;
    }

    private function encodeAnswerImageBase64($fileName)
    {
        $imagePath = 'public/assets/answer_images/' . $fileName;
        $imageData = base64_encode(Storage::get($imagePath));
        $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $base64Image = 'data:image/' . $fileExtension . ';base64,' . $imageData;

        return $base64Image;
    }

    public function getAnswers(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'question_id' => 'required|string'
            ]);

            $answers = Answer::with('user', 'upvote', 'downvote', 'reaction')->where('question_id', Crypt::decryptString($request->input('question_id')))->get();


            $answers = $answers->map(function ($answer) {
                $createdAt = Carbon::parse($answer->created_at);
                $answer->elapsed_time = $createdAt->diffForHumans();
                $answer->encrypted_id = Crypt::encryptString($answer->id);


                $curr_upvote = $answer->upvote->contains(function ($upvote){
                    if($upvote->user_id == auth()->user()->id){
                        $upvote_user_bool = true;
                    }else{
                        $upvote_user_bool = false;
                    }

                    return $upvote_user_bool;
                });
                $curr_downvote = $answer->downvote->contains(function ($downvote){
                    if($downvote->user_id == auth()->user()->id){
                        $downvote_user_bool = true;
                    }else{
                        $downvote_user_bool = false;
                    }

                    return $downvote_user_bool;
                });

                $curr_user_owner = $answer->user->id == auth()->user()->id? true : false;

                if (!empty($answer->attached_img)) {
                    $base64encoded = self::encodeAnswerImageBase64($answer->attached_img);
    
                    $answer_synopsis = json_decode($answer->answer_synopsis, true);
    
                    if (isset($answer_synopsis['ops']) && is_array($answer_synopsis['ops'])) {
                        foreach ($answer_synopsis['ops'] as &$item) {
                            if (is_array($item) && isset($item['insert']) && is_array($item['insert']) && isset($item['insert']['image'])) {
                                $item['insert']['image'] = $base64encoded;
                            }
                        }
                    }
    
                    $answer->answer_synopsis = json_encode($answer_synopsis);
                }

                $answer->curr_upvote = $curr_upvote;
                $answer->curr_downvote = $curr_downvote;
                $answer->curr_user_owner = $curr_user_owner;

                $answer->curr_user_auth_is_admin = (bool)auth()->user()->user_role;



                return $answer;
            });

            

            return response()->json([
                'answers' => $answers,
                'question_id' => $request->input('question_id'),
                'total' => $answers->count()
            ]);
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function getThreadDetails(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'question_id' => 'required|string'
            ]);

            $questionIdEncrypted = $request->input('question_id');
            $questionThread = Question::with('user', 'answer')->where('questions.id', Crypt::decryptString($request->input('question_id')))->withCount('answer')->first();

            if (!empty($questionThread)) {


                // print_r($questionThread)
                // echo html_entity_decode($questionThread->question_synopsis);

                // echo $questionThread->first()->id;

                // echo "<br>";
                // echo $questionThread->first()->user->username;

                // echo "<br>";
                // echo $questionThread->first()->answer;

                // echo "<br>";
                // echo $questionThread->first()->answer->user->username;

                // $users = $questionThread->pluck('answers.user')->unique();

                // echo response()->json([
                //     'questionThread' => $questionThread,
                //     'user' => $users
                // ]);

                if (!empty($questionThread->attached_img)) {
                    $base64encoded = self::encodeQuestionImageBase64($questionThread->attached_img);

                    $question_synopsis = json_decode($questionThread->question_synopsis, true);

                    if (isset($question_synopsis['ops']) && is_array($question_synopsis['ops'])) {
                        foreach ($question_synopsis['ops'] as &$item) {
                            if (is_array($item) && isset($item['insert']) && is_array($item['insert']) && isset($item['insert']['image'])) {
                                $item['insert']['image'] = $base64encoded;
                            }
                        }
                    }

                    $questionThread->question_synopsis = json_encode($question_synopsis);
                }

                $createdAt = Carbon::parse($questionThread->created_at);
                $diffForHumans = $createdAt->diffForHumans();


                $tags = QuestionTag::with('tag')->where('question_id', $questionThread->id)->get();

                $relatedThreads = Question::with('user', 'answer')
                    ->where('title', 'LIKE', '%' . $questionThread->title . '%')
                    ->where('id', '!=', $questionThread->id)
                    ->limit(4)->withCount('answer')->get();

                if ($relatedThreads->isEmpty()) {
                    $relatedThreads = Question::with('user', 'answer')
                        ->where('id', '!=', $questionThread->id)
                        ->orderBy('created_at', 'desc')
                        ->limit(4)->withCount('answer')->get();
                } else if ($relatedThreads->count() < 4) {
                    $addition_LIMIT = 4 - $relatedThreads->count();

                    $relatedThreads2 = Question::with('user', 'answer')
                        ->where('id', '!=', $questionThread->id)
                        ->where('id', '!=', $relatedThreads[0]->id)
                        ->orderBy('created_at', 'desc')
                        ->limit($addition_LIMIT)
                        ->withCount('answer')
                        ->get();

                    $relatedThreads = $relatedThreads->concat($relatedThreads2);
                }

                $relatedThreads = $relatedThreads->map(function ($relatedThread) {
                    $relatedThread->encrypted_id = Crypt::encryptString($relatedThread->id);
                    $createdAt = Carbon::parse($relatedThread->created_at);
                    $relatedThread->elapsed_time = $createdAt->diffForHumans();


                    $hasAnswerVerified = $relatedThread->answer->contains(function ($answer) {
                        $ai_classification_status = $answer->ai_classification_status;
                        $moderated_as = $answer->moderated_as;

                        // $boolHasVerified = strpos($ai_classification_status, 'fact') !== false || strpos($ai_classification_status, 'potential true') && $moderated_as == 'true';
                        $boolHasVerified = $ai_classification_status && $moderated_as;
                        return $boolHasVerified;
                    });
                    $relatedThread->hasAnswerVerified = $hasAnswerVerified;

                    return $relatedThread;
                });



                return view('threadDetails', compact('questionThread', 'diffForHumans', 'tags', 'relatedThreads', 'questionIdEncrypted'));
            } else {
                return redirect('/threads');
            }
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            // return response()->json([
            //     'message' => 'The given data was invalid.',
            //     'errors' => $exception->errors(),
            // ], 422);
            return redirect('/threads');
        }
    }

    public function addReaction(Request $request)
    {
        // 'user_id',
        // 'answer_id',
        // 'reaction_emoji',
        try {
            $validatedData = $request->validate([
                'answer_id' => 'required|string',
                'reaction_emoji' => 'required|string',
            ]);

            $answer = Answer::where('id', Crypt::decryptString($request->input('answer_id')))->first();

            if(empty($answer)){
                return response()->json([
                    'message' => 'The given data was invalid.'
                ], 422);
            }else{
                $newReaction = new Reaction;
                $newReaction->user_id = auth()->user()->id;
                $newReaction->answer_id = $answer->id;
                $newReaction->reaction_emoji = $request->input('reaction_emoji');
                $newReaction->save();

                return response()->json([
                    'status' => 'success',
                    'reaction_emoji' => $request->input('reaction_emoji')
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }


    public function addQuestion(Request $request)
    {
        // 'title',
        // 'question_synopsis',
        // 'created_at',
        // 'updated_at',
        // 'attached_img',
        // 'isHotThread',
        // 'isDeleted',
        // 'user_id'
        try {
            $validatedData = $request->validate([
                'title' => 'required|string',
                'quillData' => 'required|json',
                'tags' => 'required|json'
            ]);

            $quillData = $request->input('quillData');

            $question = new Question;
            $question->title = $request->input('title');
            $question->user_id = auth()->user()->id;
            $question->question_synopsis = $quillData;


            $tagsArray = json_decode($request->input('tags'), true);

            // $tags = Tag::where('id', Crypt::decryptString($param));


            $question->save();


            foreach ($tagsArray as $tag) {
                $questTag = new QuestionTag;
                $questTag->tag_id = Tag::where('id', Crypt::decryptString($tag))->first()->id;
                $questTag->question_id = $question->id;
                $questTag->save();
                // echo Tag::where('id', Crypt::decryptString($tag))->first()->tag_name . '<br>';
            }

            return response()->json([
                'status' => 'success',
                'question_id' => Crypt::encryptString($question->id)
            ]);
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function addAnswer(Request $request)
    {
        // 'answer_synopsis',
        // 'attached_img',
        // 'created_at',
        // 'updated_at',
        // 'ai_classification_status',
        // 'moderated_as',
        // 'isDeleted',
        // 'question_id',
        // 'user_id'
        try {
            $validatedData = $request->validate([
                'question_id' => 'required|string',
                'quillData' => 'required|json'
            ]);

            $quillData = $request->input('quillData');

            $answer = new Answer;
            $answer->user_id = auth()->user()->id;
            $answer->question_id = Crypt::decryptString($request->input('question_id'));
            $answer->answer_synopsis = $quillData;


            $answer->save();


            return response()->json([
                'status' => 'success',
                'answer_id' => Crypt::encryptString($answer->id)
            ]);
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function upVote(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'answer_id' => 'required|string'
            ]);

            $checkUpVote = UpVote::where('answer_id', Crypt::decryptString($request->answer_id))->where('user_id', auth()->user()->id)->first();
            $checkDownVote = DownVote::where('answer_id', Crypt::decryptString($request->answer_id))->where('user_id', auth()->user()->id)->first();

            if(empty($checkUpVote) && empty($checkDownVote)){
                $newUpvote = new UpVote();
                $newUpvote->answer_id = Crypt::decryptString($request->answer_id);
                $newUpvote->user_id = auth()->user()->id;
                $newUpvote->save();

                $upvote_is_active = true;
            }else if(!empty($checkUpVote) && empty($checkDownVote)){
                $checkUpVote->delete();

                $upvote_is_active = false;
            }else if(!empty($checkDownVote) && empty($checkUpVote)){
                $checkDownVote->delete();

                $newUpvote = new UpVote();
                $newUpvote->answer_id = Crypt::decryptString($request->answer_id);
                $newUpvote->user_id = auth()->user()->id;
                $newUpvote->save();

                $upvote_is_active = true;
            }


            return response()->json([
                'status' => 'success',
                'upvote_is_active' => $upvote_is_active
            ]);
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function downVote(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'answer_id' => 'required|string'
            ]);

            $checkUpVote = UpVote::where('answer_id', Crypt::decryptString($request->answer_id))->where('user_id', auth()->user()->id)->first();
            $checkDownVote = DownVote::where('answer_id', Crypt::decryptString($request->answer_id))->where('user_id', auth()->user()->id)->first();

            if(empty($checkUpVote) && empty($checkDownVote)){
                $newDownvote = new DownVote();
                $newDownvote->answer_id = Crypt::decryptString($request->answer_id);
                $newDownvote->user_id = auth()->user()->id;
                $newDownvote->save();
                $downvote_is_active = true;
            }else if(!empty($checkUpVote) && empty($checkDownVote)){
                $checkUpVote->delete();

                $newDownvote = new DownVote();
                $newDownvote->answer_id = Crypt::decryptString($request->answer_id);
                $newDownvote->user_id = auth()->user()->id;
                $newDownvote->save();

                $downvote_is_active = true;
            }else if(!empty($checkDownVote) && empty($checkUpVote)){
                $checkDownVote->delete();

                $downvote_is_active = false;
            }


            return response()->json([
                'status' => 'success',
                'downvote_is_active' => $downvote_is_active
            ]);
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function addQuestionImage(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'question_id' => 'required|string',
                'image_upload' => 'required|string'
            ]);

            $payload = $request->all();

            $question = Question::where('id', Crypt::decryptString($payload['question_id']))->first();

            $createdAt = Carbon::parse($question->created_at);
            $now = Carbon::now();

            $base64Data = substr($payload['image_upload'], strpos($payload['image_upload'], ',') + 1);


            if (!empty($payload['image_upload']) && empty($question->attached_img) && $createdAt->diffInSeconds($now) < 5 && base64_decode($base64Data, true) !== false) {

                $binaryData = base64_decode($base64Data);

                $fileExtension = '';
                if (preg_match('/^data:image\/(\w+);base64,/', $payload['image_upload'], $matches)) {
                    $fileExtension = $matches[1];
                }

                $unique_string = self::guidv4();
                $fileName = $unique_string . "_" . auth()->user()->username . "_" . $question->id . "." . $fileExtension;


                $question->attached_img = $fileName;
                $question->save();

                $filePath = 'public/assets/question_images/' . $fileName;

                Storage::put($filePath, $binaryData);

                return response()->json([
                    'question_id' => $payload['question_id'],
                    'image_upload' => !empty($payload['image_upload']),
                    'payload' => base64_decode($base64Data, true) !== false,
                    'file_extension' => $fileExtension

                ]);

                // return response()->json([
                //     'message' => 'Success.'
                // ]);
            } else {
                return response()->json([
                    'message' => 'The given data was invalid.'
                ], 422);
            }
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }


    public function addAnswerImage(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'answer_id' => 'required|string',
                'image_upload' => 'required|string'
            ]);

            $payload = $request->all();

            $answer = Answer::where('id', Crypt::decryptString($payload['answer_id']))->first();

            $createdAt = Carbon::parse($answer->created_at);
            $now = Carbon::now();

            $base64Data = substr($payload['image_upload'], strpos($payload['image_upload'], ',') + 1);


            if (!empty($payload['image_upload']) && empty($answer->attached_img) && $createdAt->diffInSeconds($now) < 5 && base64_decode($base64Data, true) !== false) {

                $binaryData = base64_decode($base64Data);

                $fileExtension = '';
                if (preg_match('/^data:image\/(\w+);base64,/', $payload['image_upload'], $matches)) {
                    $fileExtension = $matches[1];
                }

                $unique_string = self::guidv4();
                $fileName = $unique_string . "_" . auth()->user()->username . "_" . $answer->id . "." . $fileExtension;


                $answer->attached_img = $fileName;
                $answer->save();

                $filePath = 'public/assets/answer_images/' . $fileName;

                Storage::put($filePath, $binaryData);

                return response()->json([
                    'answer_id' => $payload['answer_id'],
                    'image_upload' => !empty($payload['image_upload']),
                    'payload' => base64_decode($base64Data, true) !== false,
                    'file_extension' => $fileExtension
                ]);

            } else {
                return response()->json([
                    'message' => 'The given data was invalid.'
                ], 422);
            }
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }


    public function addQuestionImage2(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'question_id' => 'required|string',
                'image_upload' => 'required|string'
            ]);
            $payload = $request->all();

            $question = Question::where('id', Crypt::decryptString($payload['question_id']))->first();


            $base64Data = substr($payload['image_upload'], strpos($payload['image_upload'], ',') + 1);

            $binaryData = base64_decode($base64Data);

            $fileExtension = '';
            if (preg_match('/^data:image\/(\w+);base64,/', $payload['image_upload'], $matches)) {
                $fileExtension = $matches[1];
            }

            $unique_string = self::guidv4();
            $fileName = $unique_string . "_" . auth()->user()->username . "_" . $question->id . "." . $fileExtension;
            $question->attached_img = $fileName;
            $question->save();

            $filePath = 'public/assets/question_images/' . $fileName;

            Storage::put($filePath, $binaryData);

            return response()->json([
                'question_id' => $payload['question_id'],
                'imageUpload' => !empty($payload['image_upload']),
                'payload' => base64_decode($base64Data, true) !== false,
                '$fileExtension' => $fileExtension

            ]);
        } catch (\Throwable $th) {
            throw $th;
        } catch (ValidationException $exception) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], 422);
        }
    }
}
