<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VocabularyController;
use Illuminate\Http\Request;
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
    Route::apiResource('/users', UserController::class);
    Route::get('/vocabulary/search/{name}',[VocabularyController::class,'search']);
    Route::post('/logout ', [AuthController::class,'logout']);
});

Route::apiResource('/vocabulary', VocabularyController::class);
Route::post('/register ', [AuthController::class,'register']);
Route::post('/login ', [AuthController::class,'login']);



