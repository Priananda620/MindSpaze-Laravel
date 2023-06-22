<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\UpVote;
use App\Models\DownVote;
use Illuminate\Support\Facades\Crypt;

class ModerateController extends Controller
{
    public function moderateAsTrue(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'answer_id' => 'required|string'
            ]);

            $answer = Answer::where('id', Crypt::decryptString($request->answer_id))->first();

            if(!empty($answer)){
                if($answer->moderated_as == 1){
                    $answer->moderated_as = null;
                }else{
                    $answer->moderated_as = 1;
                }

                $answer->save();
            }else{
                return response()->json([
                    'message' => 'The given data was invalid.'
                ], 422);
            }


            return response()->json([
                'status' => 'success'
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

    public function moderateAsFalse(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'answer_id' => 'required|string'
            ]);

            $answer = Answer::where('id', Crypt::decryptString($request->answer_id))->first();

            if(!empty($answer)){
                if($answer->moderated_as !== null && $answer->moderated_as == 0){
                    $answer->moderated_as = null;
                }else{
                    $answer->moderated_as = 0;
                }
                
                $answer->save();
            }else{
                return response()->json([
                    'message' => 'The given data was invalid.'
                ], 422);
            }


            return response()->json([
                'status' => 'success'
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