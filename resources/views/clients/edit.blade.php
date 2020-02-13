@extends('layouts.app')

@section('page-title')
    Edit Client
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Client - {{ $client->name }}</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('ClientController@update', ['client' => $client]) }}">
        @method('PUT')
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                @include('clients.fields')

                <a href="{{ action('ClientController@show', ['client' => $client]) }}" class="btn btn-lg btn-danger">Cancel</a>
                <button type="submit" class="btn btn-lg btn-success">Update Client</button>

            </div>
        </div>
    </form>
@endsection