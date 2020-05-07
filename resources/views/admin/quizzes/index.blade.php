@extends('layouts.app')

@section('title', '- Quizzes')

@section('content')
    <quiz-manager :initial-quizzes="{{ $quizzes }}" ></quiz-manager>
@endsection