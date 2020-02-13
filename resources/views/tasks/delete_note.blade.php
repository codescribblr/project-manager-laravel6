@extends('layouts.app')

@section('page-title')
    Delete Task Note
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Delete Task Note</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('TaskNoteController@destroy', ['task' => $task, 'note' => $note]) }}">
        @method('DELETE')
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <p class="message warning">Are you sure you want to delete this note?</p>
                <p><strong>Note Details:</strong><br>
                    {{ $note->details }}
                </p>

                <a href="{{ action('TaskController@show', ['task' => $note->task]) }}" class="btn btn-lg btn-info">Cancel</a>
                <button type="submit" class="btn btn-lg btn-danger">Delete Task Note</button>

            </div>
        </div>
    </form>
@endsection