@extends('layouts.app')

@section('page-title')
    Delete Server Note
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Delete Server Note</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('ServerNoteController@destroy', ['server' => $server, 'note' => $note]) }}">
        @method('DELETE')
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <p class="message warning">Are you sure you want to delete this note?</p>
                <p><strong>Note Details:</strong><br>
                    {{ $note->details }}
                </p>

                <a href="{{ action('ServerController@show', ['server' => $note->server]) }}" class="btn btn-lg btn-warning">Cancel</a>
                <button type="submit" class="btn btn-lg btn-danger">Delete Server Note</button>

            </div>
        </div>
    </form>
@endsection