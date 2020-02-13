@extends('layouts.app')

@section('page-title')
    Client Details
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Client Detail - {{ $client->name }}</h1>
        <a href="{{ action('ClientController@edit', ['client' => $client]) }}" class="d-sm-inline-block btn btn-success btn-icon-split">
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

            <!-- Client Details -->
            <div class="card mb-2">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Contact Details</h6>
                </div>
                <div class="card-body">
                    <p>Contact Name: {{ $client->contact_name }}</p>
                    <p>Contact Email: {{ $client->contact_email }}</p>
                    <p>Contact Phone: {{ $client->contact_phone }}</p>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Projects</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6 mb-4">

            <!-- Active Projects -->
            <div class="card mb-2">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Active Projects</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="../projects/detail.html">Project 1</a></li>
                        <li><a href="../projects/detail.html">Project 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">

            <div class="card mb-2">
                <!-- Inactive Projects -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Inactive Projects</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="../projects/detail.html">Project 1</a></li>
                        <li><a href="../projects/detail.html">Project 2</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Servers & Tasks</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6 mb-4">

            <div class="card mb-2">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Servers</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="../servers/detail.html" class="text-warning">Server 1</a></li>
                        <li><a href="../servers/detail.html" class="text-warning">Server 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">

            <div class="card mb-2">
                <!-- Inactive Projects -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Active Tasks</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="../tasks/detail.html" class="text-info">Task 1</a></li>
                        <li><a href="../tasks/detail.html" class="text-info">Task 2</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Client Notes</h2>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12 mb-4">

            @if(count($client->notes) > 0)
                @foreach($client->notes->sortByDesc('updated_at') as $note)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p>Posted: {{ date('F j, Y H:i a', strtotime($note->updated_at)) }}
                                <a href="{{ action('ClientNoteController@destroyConfirm', ['client' => $client, 'note' => $note]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-danger float-sm-right ml-1">
                                    <span class="icon text-white">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                                <a href="{{ action('ClientNoteController@edit', ['client' => $client, 'note' => $note]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-success btn-icon-split float-sm-right">
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
                <p>No client notes yet.</p>
            @endif


        </div>
        <div class="col-lg-12 mb">
            <a href="{{ action('ClientNoteController@create', ['client' => $client]) }}" class="d-xs-block d-sm-inline-block btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Note</span>
            </a>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12">
            <a href="{{ action('ClientController@destroyConfirm', ['client' => $client]) }}" class="btn btn-danger float-right">Delete Client</a>
        </div>
    </div>
@endsection