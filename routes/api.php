<?php

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

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/quizzes/insup', 'QuizController@insup');

Route::delete('/quizzes/{quiz}', 'QuizController@destroy');

Route::get('/quizzes/{quiz}/questions', 'QuestionController@index');

Route::post('/questions/{quiz}/insup', 'QuestionController@insup');

Route::delete('/questions/{quiz}/{question}', 'QuestionController@destroy');