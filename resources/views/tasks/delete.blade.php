@extends('layouts.app')

@section('page-title')
    Delete Task
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Delete Task - {{ $task->name }}</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('TaskController@destroy', ['task' => $task]) }}">
        @method('DELETE')
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <p class="message warning">Are you sure you want to delete this task?</p>

                <a href="{{ action('TaskController@show', ['task' => $task]) }}" class="btn btn-lg btn-info">Cancel</a>
                <button type="submit" class="btn btn-lg btn-danger">Delete Task</button>

            </div>
        </div>
    </form>
@endsection