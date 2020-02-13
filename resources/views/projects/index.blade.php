@extends('layouts.app')

@section('page-title')
    Project List
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Projects</h1>
        <a href="{{ action('ProjectController@create') }}" class="d-sm-inline-block btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
            <span class="text">Add New</span>
        </a>
    </div>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2 class="h5 mb-0 text-gray-800">Active Projects</h2>
            @if(count($projects->where('status', 'active')) > 0)
                <div class="list-group">
                    @foreach($projects->where('status', 'active') as $project)
                        <a href="{{ action('ProjectController@show', ['project' => $project->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-primary">{{ $project->name }}</a>
                    @endforeach
                </div>
            @else
                <p>No active projects yet.</p>
                <p><a href="{{ action('ProjectController@create') }}" class="btn btn-primary btn-lg">Create One Now</a></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2 class="h5 mb-0 text-gray-800">Inactive Projects</h2>
            @if(count($projects->where('status', 'inactive')) > 0)
                <div class="list-group">
                    @foreach($projects->where('status', 'inactive') as $project)
                        <a href="{{ action('ProjectController@show', ['project' => $project->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-primary">{{ $project->name }}</a>
                    @endforeach
                </div>
            @else
                <p>No inactive projects.</p>
            @endif
        </div>
    </div>
@endsection