<?php

namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($quiz)
    {
        //
    }

    public function answers( Question $question) {
        return $question->answers->map(function( $answer) {
            return $answer->only(['id', 'text', 'score', 'correct']);
        });
    }

    public function question_answers( Quiz $quiz) {
        $questions = Question::with('answers')->get();
        return Question::with(["quiz_id" => function($q){
            $q->where('user_id', '=', 1);
        }])->get();
    }

    /**
     * Get the number of questions for a quiz
     *
     * @param  \App\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function count(Quiz $quiz)
    {
        return Question::where('quiz_id', $quiz->id)->count();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->user()->can('edit-question')) {
            return response('Geen toegang', 403);
        }

        $request->validate([
            'text' => 'required|max:255',
            'display_order' => 'required|numeric|min:0',
            'quiz_id' => 'required|numeric'
        ]);

        Question::create($request->post());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        if(!$request->user()->can('edit-question')) {
            return response('Geen toegang', 403);
        }

        $request->validate([
            'text' => 'required|max:255',
            'display_order' => 'required|numeric|min:0',
            'quiz_id' => 'required|numeric'
        ]);

        $question->update($request->post());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
        return ['success' => true];
    }

}
