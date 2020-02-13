@extends('layouts.app')

@section('page-title')
    Add New Client
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Client</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('ClientController@store') }}">
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                @include('clients.fields')

                <button type="submit" class="btn btn-lg btn-success">Create Client</button>

            </div>
        </div>
    </form>
@endsection