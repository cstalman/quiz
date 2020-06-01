<?php

use App\Answer;
use App\Question;
use App\Quiz;
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

//admin routes

/* quiz routes */
Route::get('/quizzes', 'QuizController@quizzes');
Route::post('/quizzes/insup', 'QuizController@insup');
Route::delete('/quizzes/{quiz}', 'QuizController@destroy');

Route::get('/quizzes/{quiz}/questions', 'QuizController@questions');

/* question routes */
Route::get('/questions/{question}', function (Question $question) {
    return $question;
});
Route::post('/questions/add', 'QuestionController@store');
Route::post('/questions/{question}', 'QuestionController@update');
Route::delete('/questions/{question}', 'QuestionController@destroy');

Route::get('/questions/{question}/answers', 'QuestionController@answers');

/* answer routes */
Route::get('/answers/{answer}', function (Answer $answer) {
    return $answer;
});
Route::post('/answers/add', 'AnswerController@store');
Route::post('/answers/{answer}', 'AnswerController@update');
Route::delete('/answers/{answer}', 'AnswerController@destroy');

// user routes


/* list all quizzes */
Route::get('/quizzes/{quiz}', function (Quiz $quiz) {
    return $quiz;
});

/* get questions & answers for a quiz */
Route::get('/quizzes/{quiz}/qa', 'QuizController@qa');

/* get questions count for a quiz */
Route::get('/questions/{quiz}/count', 'QuestionController@count');

/* insert or update an answer */
Route::post('/questionnaire/insup', 'QuestionnaireController@insup');

/* get users correct answers count for a quiz */
Route::get('/questionnaires/{quiz}/correct', 'QuestionnaireController@correct');

/* check if user already submitted a quiz */
Route::get('/questionnaires/result', 'QuizController@quizzesDone');

