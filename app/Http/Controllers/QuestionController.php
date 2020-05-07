<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manage', 'App\Question');
        $questions = Question::orderBy('display_order')->get();
        return ['success' => true, 'questions' => $questions];
        /*return view('admin.questions.index', [
            'questions' => $questions
        ]);
        */
    }

    public function insup( Request $request) {
        $this->authorize('manage', 'App\Question');
        $questions = $request->post('questions');
        
        foreach($questions as $question) {
            if ($question['id']) {
                $question['created_at'] = date('Y-m-d h:m:s', strtotime($question['created_at']));
                $question['updated_at'] = date('Y-m-d h:m:s', strtotime($question['updated_at']));
                Question::where('id', $question['id'])->update($question);
            }
            else {
                Question::create($question);
            }

        }
        return ['success' => true, 'questions' => Question::all()];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
