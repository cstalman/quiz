<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function quiz() {
        $quizzes = Quiz::orderBy('title')->get();
        $questions = Question::orderBy('display_order')->get();
        return view('admin.quiz-editor', [
            'quizzes' => $quizzes,
            'questions' => $questions
        ]);
    }
}
