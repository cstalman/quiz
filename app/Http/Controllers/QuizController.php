<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                $quiz['created_at'] = date('Y-m-d h:m:s');
                $quiz['updated_at'] = date('Y-m-d h:m:s');
                Quiz::create($quiz);
            }

        }
        return ['success' => true, 'quizzes' => Quiz::all()];
    }

    /**
     * Show the questions for quiz
     *
     * @return \Illuminate\Http\Response
     */
    public function questions(Quiz $quiz)
    {
        return $quiz->questions->map(function( $question) {
            return $question->only(['id', 'text', 'display_order']);
        });
    }

    /**
     * Show the questions for quiz
     *
     * @return \Illuminate\Http\Response
     */
    public function qa(Quiz $quiz)
    {
        /*$questions = DB::table('questions')
            ->select(DB::raw('id, text'))
            ->where('quiz_id', '=', $quiz->id)
            ->get();
        
        foreach($questions as $key => $question) {
            $questions[$key]['answers'] = DB::table('answers')
                ->select(DB::raw('id, text'))
                ->where('question_id', '=', $question->id)
                ->get();
        }
        return $questions;

        return $questions = DB::table('questions')
        ->select(DB::raw('questions.id, questions.text as question, answers.id as answer_id, answers.text as answer'))
        ->leftJoin('answers', 'questions.id', '=', 'answers.question_id')
        ->where('quiz_id', '=', $quiz->id)
        ->get();
*/
        return $questions = $quiz->questions()
            ->with(['answers' => function ($query) {
                $query->orderBy('id');
            }])
            ->get();

    }

    /**
     * Return all the quizzes
     *
     * @return \Illuminate\Http\Response
     */
    public function quizzes()
    {
        $this->authorize('manage', 'App\Quiz');
        return Quiz::orderBy('title')->get();
    }

        /**
     * Get the quizzes and if they're completed
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function quizzesDone()
    {
        $user_id = auth()->user()->id;


        $quizzesDone = Quiz::join('questions', 'quizzes.id', '=', 'questions.quiz_id')
            ->leftJoin('questionnaires', function($join) use ($user_id) {
                $join->on('questionnaires.question_id', 'questions.id');
                $join->on('user_id', DB::raw("'".$user_id."'"));
            })
            ->groupBy('quizzes.id')
            ->selectRaw('quizzes.id, IF(COUNT(questions.id)=COUNT(DISTINCT questionnaires.question_id), TRUE, FALSE) as test') 
            ->get();
        
        return $quizzesDone;
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
