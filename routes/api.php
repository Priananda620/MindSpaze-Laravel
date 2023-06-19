<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModerateController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'Login'])->name('loginApi');
Route::post('/register', [UserController::class, 'register'])->name('registerApi');

// Route::post('/loginWeb', [AuthController::class, 'LoginWeb']);


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('thread')->group(function () {
        Route::post('/post', [ThreadController::class, 'addQuestion']);

        Route::post('/post-answer', [ThreadController::class, 'addAnswer']);

        Route::post('/add-reaction', [ThreadController::class, 'addReaction']);

        Route::delete('/delete-answer', [ThreadController::class, 'deleteAnswer']);

        Route::delete('/delete-question', [ThreadController::class, 'deleteQuestion']);

        Route::get('/answers', [ThreadController::class, 'getAnswers']);

        Route::post('/up-vote', [VoteController::class, 'upVote']);
        Route::post('/down-vote', [VoteController::class, 'downVote']);

        Route::post('/moderate-true', [ModerateController::class, 'moderateAsTrue']);
        Route::post('/moderate-false', [ModerateController::class, 'moderateAsFalse']);
    });

    Route::prefix('user')->group(function () {
        Route::post('/change-password', [UserController::class, 'changePassword']);

        Route::post('/update-details', [UserController::class, 'updateDetails']);

        Route::post('/change-password', [UserController::class, 'changePassword']);

        Route::get('/get-threads', [ThreadController::class, 'getUserThreads']);
    });


    Route::get('/user', [UserController::class, 'getUser']);

    // Route::get('/get-threads', [ThreadController::class, 'getThreads']);
    Route::match(['GET', 'POST'], '/get-threads', [ThreadController::class, 'getThreads']);
});
