@extends('layouts.app')

@section('page-title')
    Delete Server
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Delete Server - {{ $server->hostname }}</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('ServerController@destroy', ['server' => $server]) }}">
        @method('DELETE')
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <p class="message warning">Are you sure you want to delete this server?</p>

                <a href="{{ action('ServerController@show', ['server' => $server]) }}" class="btn btn-lg btn-warning">Cancel</a>
                <button type="submit" class="btn btn-lg btn-danger">Delete Server</button>

            </div>
        </div>
    </form>
@endsection