@extends('layouts.app')

@section('page-title')
    Server List
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Servers</h1>
        <a href="{{ action('ServerController@create') }}" class="d-sm-inline-block btn btn-warning btn-icon-split">
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
            <h2 class="h5 mb-0 text-gray-800">Active Servers</h2>
            @if(count($servers->where('status', 'open')) > 0)
                <div class="list-group">
                    @foreach($servers->where('status', 'active') as $server)
                        <a href="{{ action('ServerController@show', ['server' => $server->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-warning">{{ $server->hostname }}</a>
                    @endforeach
                </div>
            @else
                <p>No active servers yet.</p>
                <p><a href="{{ action('ServerController@create') }}" class="btn btn-warning btn-lg">Create One Now</a></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2 class="h5 mb-0 text-gray-800">Inactive Servers</h2>
            @if(count($servers->where('status', 'completed')) > 0)
                <div class="list-group">
                    @foreach($servers->where('status', 'inactive') as $server)
                        <a href="{{ action('ServerController@show', ['server' => $server->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-warning">{{ $server->hostname }}</a>
                    @endforeach
                </div>
            @else
                <p>No inactive servers.</p>
            @endif
        </div>
    </div>
@endsection