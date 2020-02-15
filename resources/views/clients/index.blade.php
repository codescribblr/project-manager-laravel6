@extends('layouts.app')

@section('page-title')
    Client List
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clients</h1>
        <a href="{{ action('ClientController@create') }}" class="d-sm-inline-block btn btn-success btn-icon-split">
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
            <h2 class="h5 mb-3 text-gray-800">Active Clients</h2>
            @if(count($clients->where('status', 'active')) > 0)
                <div class="list-group">
                    @foreach($clients->where('status', 'active') as $client)
                        <a href="{{ action('ClientController@show', ['client' => $client->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-success">{{ $client->name }}</a>
                    @endforeach
                </div>
            @else
                <p>No active clients yet.</p>
                <p><a href="{{ action('ClientController@create') }}" class="btn btn-success btn-lg">Create One Now</a></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h2 class="h5 mb-3 text-gray-800">Inactive Clients</h2>
            @if(count($clients->where('status', 'inactive')) > 0)
                <div class="list-group">
                    @foreach($clients->where('status', 'inactive') as $client)
                        <a href="{{ action('ClientController@show', ['client' => $client->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-success">{{ $client->name }}</a>
                    @endforeach
                </div>
            @else
                <p>No inactive clients.</p>
            @endif
        </div>
    </div>
@endsection