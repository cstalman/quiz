@extends('layouts.app')

@section('title', '- Quiz editor')

@section('content')
    <quiz-editor :quizzes="{{ $quizzes }}" questions="{{ $questions }}"></quiz-editor>
@endsection