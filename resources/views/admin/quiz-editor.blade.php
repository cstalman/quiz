@extends('layouts.app')

@section('title', '- Quiz editor')

@section('content')
    <quiz-editor :quizzes="{{ $quizzes }}"></quiz-editor>
@endsection