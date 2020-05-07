@extends('layouts.app')

@section('title', '- Questions')

@section('content')
    <questions-quiz :initial-questions="{{ $questions }}" ></quiz-manager>
@endsection