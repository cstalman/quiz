<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Carbon;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manage', 'App\Quiz');
        $quizzes = Quiz::orderBy('title')->get();
        return view('admin.quizzes.index', [
            'quizzes' => $quizzes
        ]);
    }

    public function insup( Request $request) {
        $this->authorize('manage', 'App\Quiz');
        $quizzes = $request->post('quizzes');
        
        foreach($quizzes as $quiz) {
            if ($quiz['id']) {
                $quiz['created_at'] = date('Y-m-d h:m:s', strtotime($quiz['created_at']));
                $quiz['updated_at'] = date('Y-m-d h:m:s', strtotime($quiz['updated_at']));
                Quiz::where('id', $quiz['id'])->update($quiz);
            }
            else {
                Quiz::create($quiz);
            }

        }
        return ['success' => true, 'quizzes' => Quiz::all()];
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
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $this->authorize('delete', $quiz);
        $quiz->delete();
        return ['success' => true];
    }
}
