@extends('layouts.app')

@section('page-title')
    Task List
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tasks</h1>
        <a href="{{ action('TaskController@create') }}" class="d-sm-inline-block btn btn-info btn-icon-split">
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
            <h2 class="h5 mb-0 text-gray-800">Open Tasks</h2>
            @if(count($tasks->where('status', 'open')) > 0)
                <div class="list-group">
                    @foreach($tasks->where('status', 'open') as $task)
                        <a href="{{ action('TaskController@show', ['task' => $task->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-info">{{ $task->name }}</a>
                    @endforeach
                </div>
            @else
                <p>No open tasks yet.</p>
                <p><a href="{{ action('TaskController@create') }}" class="btn btn-info btn-lg">Create One Now</a></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2 class="h5 mb-0 text-gray-800">Completed Tasks</h2>
            @if(count($tasks->where('status', 'completed')) > 0)
                <div class="list-group">
                    @foreach($tasks->where('status', 'completed') as $task)
                        <a href="{{ action('TaskController@show', ['task' => $task->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-info">{{ $task->name }}</a>
                    @endforeach
                </div>
            @else
                <p>No completed tasks.</p>
            @endif
        </div>
    </div>
@endsection