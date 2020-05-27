<?php

use App\Answer;
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

//admin

Route::get('/quizzes', 'QuizController@quizzes');
Route::post('/quizzes/insup', 'QuizController@insup');
Route::delete('/quizzes/{quiz}', 'QuizController@destroy');

Route::get('/quizzes/{quiz}/questions', 'QuizController@questions');

Route::get('/questions/{question}', function (Question $question) {
    return $question;
});
Route::post('/questions/add', 'QuestionController@store');
Route::post('/questions/{question}', 'QuestionController@update');

Route::get('/questions/{question}/answers', 'QuestionController@answers');

Route::get('/answers/{answer}', function (Answer $answer) {
    return $answer;
});
Route::post('/answers/add', 'AnswerController@store');
Route::post('/answers/{answer}', 'AnswerController@update');

// user
Route::get('/quizzes/{quiz}/qa', 'QuizController@qa');
