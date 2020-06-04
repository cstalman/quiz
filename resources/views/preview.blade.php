@extends('layouts.app')

@section('content')

<quiz-preview :quizzes="{{$quizzes}}" :quizId={{$quiz_id}}></quiz-preview>

@endsection
