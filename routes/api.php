<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login',[UserController::class,'login']);
Route::get('/addUsers',[UserController::class,'addUsers']);
Route::get('/startGame',[UserController::class,'startGame']);

Route::get('/loginMember',[QuestionController::class,'loginMember']);
Route::get('/answers',[QuestionController::class,'answers']);
Route::get('/getAnswers',[QuestionController::class,'getAnswers']);
