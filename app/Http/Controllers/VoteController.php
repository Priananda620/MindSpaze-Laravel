<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\UpVote;
use App\Models\DownVote;
use Illuminate\Support\Facades\Crypt;

class VoteController extends Controller
{
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


}