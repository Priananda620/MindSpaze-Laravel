<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThreadController;
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

Route::post('/loginWeb', [AuthController::class, 'LoginWeb']);


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('thread')->group(function () {
        Route::post('/post', [ThreadController::class, 'addQuestion']);
    });


    Route::get('/user', [AuthController::class, 'getUser']);

    Route::get('/get-thread-title', [ThreadController::class, 'getTitle']);
});
