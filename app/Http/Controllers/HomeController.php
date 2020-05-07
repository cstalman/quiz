<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quizzes = Quiz::orderBy('title')->get();
        return view('home', [
            'quizzes' => $quizzes, 
        ]);
    }
}
