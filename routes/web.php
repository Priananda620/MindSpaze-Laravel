<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TutorController;
use App\Models\Tutor;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/thread-detail', [HomeController::class, 'test'])->name('threaddetail');

Route::get('/test', [AuthController::class, 'test'])->name('test');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/threads', [HomeController::class, 'threads'])->name('threads');

Route::get('/add-question', [HomeController::class, 'addQuestion'])->name('addQuestion');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');

    Route::post('/doLogin', [AuthController::class, 'loginWeb'])->name('doLogin');
    Route::post('/doRegister', [TutorController::class, 'createTutor'])->name('doRegister');
});


Route::middleware(['checkLoginSession'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile/{param}', [HomeController::class, 'profile'])->name('profile');
});


