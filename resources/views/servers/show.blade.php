@extends('layouts.app')

@section('page-title')
    Server Details
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Server Detail - {{ $server->hostname }}</h1>
        <a href="{{ action('ServerController@edit', ['server' => $server]) }}" class="d-sm-inline-block btn btn-warning btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
            <span class="text">Edit</span>
        </a>
    </div>

@endsection

@section('content')
    <!-- Content Row -->
    <div class="row mb-4">
        <div class="col-lg-12 mb-4">

            <!-- Server Details -->
            <div class="card mb-2">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Server Details</h6>
                </div>
                <div class="card-body">
                    <p><strong>Server Name:</strong> {{ $server->hostname }}</p>
                    <p><strong>Server Public IP:</strong> {{ $server->public_ip }}</p>
                    <p><strong>Server Platform:</strong> {{ $server->platform }}</p>
                    <p><strong>Server Montly Cost:</strong> {{ $server->cost }}</p>
                    <p><strong>Server Total Slots:</strong> {{ $server->slots }}</p>
                    <p><strong>Server Available Slots:</strong> {{ $server->slots - $server->projects()->count() }}</p>
                    <p><strong>Server Capacity:</strong> {{ $server->capacity }}</p>
                    <p><strong>Status:</strong> {{ $server->status }}</p>
                </div>
            </div>

        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Files</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card mb-2">
                <!-- Inactive Servers -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="" class="text-primary">Project 1</a></li>
                        <li><a href="" class="text-primary">Project 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card mb-2">
                <!-- Inactive Servers -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Files</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="" class="text-warning">File 1</a></li>
                        <li><a href="" class="text-warning">File 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Server Notes</h2>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12 mb-4">

            @if(count($server->notes) > 0)
                @foreach($server->notes->sortByDesc('updated_at') as $note)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p>Posted: {{ date('F j, Y H:i a', strtotime($note->updated_at)) }}
                                <a href="{{ action('ServerNoteController@destroyConfirm', ['server' => $server, 'note' => $note]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-danger float-sm-right ml-1">
                                    <span class="icon text-white">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                                <a href="{{ action('ServerNoteController@edit', ['server' => $server, 'note' => $note]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-warning btn-icon-split float-sm-right">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit Note</span>
                                </a>
                            </p>
                            <p>{{ $note->details }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No server notes yet.</p>
            @endif


        </div>
        <div class="col-lg-12 mb">
            <a href="{{ action('ServerNoteController@create', ['server' => $server]) }}" class="d-xs-block d-sm-inline-block btn btn-warning btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Note</span>
            </a>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12">
            <a href="{{ action('ServerController@destroyConfirm', ['server' => $server]) }}" class="btn btn-danger float-right">Delete Server</a>
        </div>
    </div>
@endsection