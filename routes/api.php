<?php

use App\Question;
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

Route::post('/questions/add', 'QuestionController@store');

Route::post('/questions/{question}', 'QuestionController@update');

Route::get('/questions/{question}', function (Question $question) {
    return $question;
});

Route::get('/quizzes/{quiz}/questions', 'QuizController@questions');

