<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Questionnaire;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store an answer for a user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function insup( Request $request) {
        //dd($request);
        
        $answer = $request->post('answer');
        
        $question = Answer::select('question_id')->where('id', '=', $answer)->first();
        
        $questionnaire['answer_id'] = $answer;
        $questionnaire['question_id'] = $question->question_id;
        $questionnaire['user_id'] = auth()->user()->id;

        Questionnaire::updateOrInsert(
            ['user_id' => $questionnaire['user_id'], 'question_id' => $questionnaire['question_id']],
            ['answer_id' => $questionnaire['answer_id']]);

        return ['success' => true];
    }

    /**
     * Get the number of correct responses
     *
     * @param  \App\Quiz $quiz
     * @return \Illuminate\Http\Response
     * 
     */
    public function correct(Quiz $quiz)
    {
        $user_id = auth()->user()->id;

        return Question::join('answers', 'questions.id', '=', 'answers.question_id')
            ->leftJoin('questionnaires', 'answers.id', '=', 'questionnaires.answer_id')
            ->where([
                ['answers.correct', '1'],
                ['user_id', $user_id], 
                ['quiz_id', $quiz->id]
            ])
            ->count();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        //
    }
}
