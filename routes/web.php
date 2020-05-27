<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/quiz-taker/{any?}', 'HomeController@index');

Route::get('/quizzes', 'QuizController@index');

Route::get('/quiz-editor/{any?}', 'AdminController@quiz')
    ->middleware('can:edit-quiz')
    ->where('any', '.*');
//Route::get('/questions', 'QuestionController@index');
//Route::get('/quizzes/{quiz}/questions', 'QuestionController@index');
