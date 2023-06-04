<?php

namespace App\Http\Controllers;


use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use Carbon\Carbon;
use Exception;
use Illuminate\Validation\ValidationException;

class ThreadController extends Controller
{
    public function getTitle(Request $request){
        try {
            $validatedData = $request->validate([
                'query' => 'required|string',
            ]);

            $results = Question::where('title', 'LIKE', '%' . $request->input('query') . '%')->get();

            return response()->json([
                'threads' => $results,
                'total' => $results->count()
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
