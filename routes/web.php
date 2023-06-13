<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TutorController;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ThreadController;

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


// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    if (Auth::check() && Auth::user()->user_role === 1) {
        return redirect('/admin');
    } else {
        $homeController = new HomeController();
        return $homeController->index(request());
    }
})->name('home');


Route::get('/thread-detail', [HomeController::class, 'test'])->name('threaddetail');

Route::get('/test', [AuthController::class, 'test'])->name('test');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::middleware(['guest'])->group(function () {
    // Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    // Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');

    Route::post('/loginWeb', [AuthController::class, 'loginWeb'])->name('loginWeb');
    Route::post('/registerWeb', [AuthController::class, 'registerWeb'])->name('registerWeb');
});


Route::middleware(['checkLoginSession'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile/{param}', [HomeController::class, 'profile'])->name('profile');

    Route::get('/profile', function () {
        $username = Auth::user()->username;
        return redirect('/profile/'.$username);
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [HomeController::class, 'admin']);
    });

    Route::prefix('thread')->group(function () {
        Route::post('/upload-image', [ThreadController::class, 'addQuestionImage']);

        Route::post('/upload-image-answer', [ThreadController::class, 'addAnswerImage']);

        Route::get('/details', [ThreadController::class, 'getThreadDetails']);
        // Route::post('/upload-image2', [ThreadController::class, 'addQuestionImage2']);
    });

    Route::get('/threads', [HomeController::class, 'threads'])->name('threads');

    Route::get('/test-form', function () {
        return view('TEST');
    });


    Route::get('/add-question', [HomeController::class, 'addQuestion'])->name('addQuestion');
});


// $id = Crypt::decryptString($param);
// if (!$profile) {
//     abort(404);
// }
// $encryptedId = Crypt::encryptString($id);
