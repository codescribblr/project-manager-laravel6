@extends('layouts.app')

@section('page-title')
    Project Details
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Project Detail - {{ $project->name }}</h1>
        <a href="{{ action('ProjectController@edit', ['project' => $project]) }}" class="d-sm-inline-block btn btn-primary btn-icon-split">
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

            <!-- Project Details -->
            <div class="card mb-2">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Project Details</h6>
                </div>
                <div class="card-body">
                    <p><strong>Client:</strong> <a href="{{ action('ClientController@show', ['client' => $project->client]) }}" class="text-success">{{ $project->client->name }}</a></p>
                    <p><strong>Project:</strong> {{ $project->description }}</p>
                    <p><strong>Private Info:</strong> <br>
                        <code>{{ $project->private_info }}</code></p>
                    <p><strong>Status:</strong> {{ $project->status }}</p>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Tasks</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6 mb-4">

            <!-- Active Projects -->
            <div class="card mb-2">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Open Tasks</h6>
                </div>
                <div class="card-body">
                    @if($project->tasks->where('status', 'open')->count() > 0)
                        <ul>
                            @foreach($project->tasks->where('status', 'open') as $task)
                                <li><a href="{{ action('TaskController@show', ['task' => $task]) }}" class="text-info">{{ $task->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Active Projects</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">

            <div class="card mb-2">
                <!-- Inactive Projects -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Completed Tasks</h6>
                </div>
                <div class="card-body">
                    @if($project->tasks->where('status', 'completed')->count() > 0)
                        <ul>
                            @foreach($project->tasks->where('status', 'completed') as $task)
                                <li><a href="{{ action('TaskController@show', ['task' => $task]) }}" class="text-info">{{ $task->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Active Projects</p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Servers & Files</h2>
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
                    <h6 class="m-0 font-weight-bold text-primary">Files</h6>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a href="../tasks/detail.html" class="text-primary">Task 1</a></li>
                        <li><a href="../tasks/detail.html" class="text-primary">Task 2</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Project Notes</h2>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12 mb-4">

            @if(count($project->notes) > 0)
                @foreach($project->notes->sortByDesc('updated_at') as $note)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p>Posted: {{ date('F j, Y H:i a', strtotime($note->updated_at)) }}
                                <a href="{{ action('ProjectNoteController@destroyConfirm', ['project' => $project, 'note' => $note]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-danger float-sm-right ml-1">
                                    <span class="icon text-white">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                                <a href="{{ action('ProjectNoteController@edit', ['project' => $project, 'note' => $note]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-primary btn-icon-split float-sm-right">
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
                <p>No project notes yet.</p>
            @endif


        </div>
        <div class="col-lg-12 mb">
            <a href="{{ action('ProjectNoteController@create', ['project' => $project]) }}" class="d-xs-block d-sm-inline-block btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Note</span>
            </a>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12">
            <a href="{{ action('ProjectController@destroyConfirm', ['project' => $project]) }}" class="btn btn-danger float-right">Delete Project</a>
        </div>
    </div>
@endsection