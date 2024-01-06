<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SocialAuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VocabularyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']],function (){
    Route::post('/logout ', [AuthController::class,'logout']);

    Route::get('/users', [UserController::class,'index']);
    Route::post('/users/{id}', [UserController::class,'update']);
    Route::patch('/users/{id}', [UserController::class,'show']);
    Route::delete('/users/{id}', [UserController::class,'destroy']);

    Route::get('/vocabulary', [VocabularyController::class,'index']);
    Route::post('/vocabulary', [VocabularyController::class,'store']);
    Route::post('/vocabulary/{id}', [VocabularyController::class,'update']);
    Route::patch('/vocabulary/{id}', [VocabularyController::class,'show']);
    Route::delete('/vocabulary/{id}', [VocabularyController::class,'destroy']);
});

Route::get('/vocabulary/search/{name}',[VocabularyController::class,'search']);
Route::post('/register ', [AuthController::class,'register']);
Route::post('/login ', [AuthController::class,'login']);



Route::group(['middleware' => ['web']], function () {
    Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirect']);
    Route::get('/auth/google/callback', [SocialAuthController::class, 'callback']);
});


















