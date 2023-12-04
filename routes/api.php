<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/create-test', [TestController::class, 'createTest'])->middleware('auth:sanctum');
Route::get('/get-questions', [TestController::class, 'getQuestionsByCategory'])->middleware('auth:sanctum');
Route::post('/submit-answer', [TestController::class, 'submitAnswer'])->middleware('auth:sanctum');
Route::get('/get-content', [ContentController::class, 'getContent'])->middleware('auth:sanctum');