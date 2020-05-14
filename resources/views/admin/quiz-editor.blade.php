@extends('layouts.app')

@section('title', '- Quiz Editor')

@section('content')
    <quiz-editor :quizzes="{{$quizzes}}"></quiz-editor>
@endsection