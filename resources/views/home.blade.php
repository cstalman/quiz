@extends('layouts.app')

@section('content')

<quiz-taker :quizzes="{{$quizzes}}"></quiz-taker>

@endsection
