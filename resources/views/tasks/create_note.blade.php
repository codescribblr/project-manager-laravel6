@extends('layouts.app')

@section('page-title')
    Add New Task Note
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Task Note</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('TaskNoteController@store', ['task' => $task]) }}">
    @csrf
    <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-group">
                    <label for="details">Note Details</label>
                    <textarea name="details" class="form-control" required id="details" placeholder="Enter note details">{{ old('details')}}</textarea>
                    <small class="form-text text-danger">{{ $errors->first('details') }}</small>
                </div>

                <button type="submit" class="btn btn-lg btn-info">Create Task Note</button>

            </div>
        </div>
    </form>
@endsection