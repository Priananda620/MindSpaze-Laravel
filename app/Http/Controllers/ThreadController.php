<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
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

                    $boolHasVerified = strpos($ai_classification_status, 'fact') !== false || strpos($ai_classification_status, 'potential true') && $moderated_as == 'true';

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

    private function encodeQuestionImageBase64($fileName)
    {
        $imagePath = 'public/assets/question_images/'.$fileName;
        $imageData = base64_encode(Storage::get($imagePath));
        $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $base64Image = 'data:image/' . $fileExtension . ';base64,' . $imageData;

        return $base64Image;
    }

    public function getThreadDetails(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'question_id' => 'required|string'
            ]);

            $questionThread = Question::with('user', 'answer')->where('questions.id', Crypt::decryptString($request->input('question_id')))->first();

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
                }

                if ($relatedThreads->count() < 4) {
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

                        $boolHasVerified = strpos($ai_classification_status, 'fact') !== false || strpos($ai_classification_status, 'potential true') && $moderated_as == 'true';

                        return $boolHasVerified;
                    });
                    $relatedThread->hasAnswerVerified = $hasAnswerVerified;

                    return $relatedThread;
                });



                return view('threadDetails', compact('questionThread', 'diffForHumans', 'tags', 'relatedThreads'));
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
