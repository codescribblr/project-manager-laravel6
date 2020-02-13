@extends('layouts.app')

@section('page-title')
    Delete Project
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Delete Project - {{ $project->name }}</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('ProjectController@destroy', ['project' => $project]) }}">
        @method('DELETE')
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <p class="message warning">Are you sure you want to delete this project?</p>

                <a href="{{ action('ProjectController@show', ['project' => $project]) }}" class="btn btn-lg btn-primary">Cancel</a>
                <button type="submit" class="btn btn-lg btn-danger">Delete Project</button>

            </div>
        </div>
    </form>
@endsection