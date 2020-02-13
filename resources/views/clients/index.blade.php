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
            @if(count($clients) > 0)
                <div class="list-group">
                    @foreach($clients as $client)
                        <a href="{{ action('ClientController@show', ['client' => $client->id]) }}" class="h6 mb-1 list-group-item list-group-item-action text-success">{{ $client->name }}</a>
                    @endforeach
                </div>
            @else
                <p>No clients yet.</p>
                <p><a href="{{ action('ClientController@create') }}" class="btn btn-success btn-lg">Create One Now</a></p>
            @endif
        </div>
    </div>
@endsection