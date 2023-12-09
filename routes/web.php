<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard');
    })->name('home');
    Route::resource('user', UserController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('content', ContentController::class);
    Route::resource('material', MaterialController::class);
});

// Route::get('/login', function () {
//     return view('pages.auth.login')->name('login');
// });

// Route::get('/register', function () {
//     return view('pages.auth.register')->name('register');
// });

// Route::get('/users', function () {
//     return view('pages.users.index');
// });
