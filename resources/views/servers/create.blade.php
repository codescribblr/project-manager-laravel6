@extends('layouts.app')

@section('page-title')
    Add New Server
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Server</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('ServerController@store') }}">
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                @include('servers.fields')

                <a href="{{ action('ServerController@index') }}" class="btn btn-lg btn-danger">Cancel</a>
                <button type="submit" class="btn btn-lg btn-warning">Create Server</button>

            </div>
        </div>
    </form>
@endsection