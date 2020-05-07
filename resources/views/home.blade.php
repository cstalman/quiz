@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            @foreach ($quizzes as $quiz)
                <div class="card mt-3">
                    <div class="card-header">{{ $quiz->title }}</div>

                    <div class="card-body">
                        {{ $quiz->description }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
