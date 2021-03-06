@extends('layouts.app')

@section('page-title')
    Task Details
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Task Detail - {{ $task->name }}</h1>
        <a href="{{ action('TaskController@edit', ['task' => $task]) }}" class="d-sm-inline-block btn btn-info btn-icon-split">
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

            <!-- Task Details -->
            <div class="card mb-2">
                <!-- Card Header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Task Details</h6>
                </div>
                <div class="card-body">
                    <p><strong>Client:</strong> <a href="{{ action('ClientController@show', ['client' => $task->project->client]) }}" class="text-success">{{ $task->project->client->name }}</a></p>
                    <p><strong>Project:</strong> <a href="{{ action('ProjectController@show', ['project' => $task->project]) }}">{{ $task->project->name }}</a></p>
                    <p><strong>Task Name:</strong> {{ $task->name }}</p>
                    <p><strong>Task Description:</strong> {{ $task->description }}</p>
                    <p><strong>Start Date:</strong> {{ $task->start_date ? date('F j, Y', strtotime($task->start_date)) : "None" }}</p>
                    <p><strong>Due Date:</strong> {{ $task->due_date ? date('F j, Y', strtotime($task->due_date)) : "None" }}</p>
                    <p><strong>Status:</strong> {{ $task->status }}</p>
                    @if($task->status == 'completed')
                        <p><strong>Completed On:</strong> {{ date('F j, Y h:i a', strtotime($task->completed_at)) }}</p>
                    @endif
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
                <!-- Inactive Tasks -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Files</h6>
                </div>
                <div class="card-body">
                    @if($task->files->count() > 0)
                        <ul>
                            @foreach($task->files as $file)
                                <li>
                                    <a href="{{ Storage::url($file->filename) }}" class="text-info">{{ $file->name }}</a>
                                    <a href="{{ action('TaskController@deleteFile', ['task' => $task, 'file' => $file]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-danger ml-1">
                                    <span class="icon text-white">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Files</p>
                    @endif
                    <p><button type="button" data-toggle="modal" data-target="#taskFilesModal" class="btn btn-info">Upload A File</button></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="h4 mb-0 text-gray-800">Task Notes</h2>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12 mb-4">

            @if(count($task->notes) > 0)
                @foreach($task->notes->sortByDesc('updated_at') as $note)
                    <div class="card mb-2">
                        <div class="card-body">
                            <p>Posted: {{ date('F j, Y H:i a', strtotime($note->updated_at)) }}
                                <a href="{{ action('TaskNoteController@destroyConfirm', ['task' => $task, 'note' => $note]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-danger float-sm-right ml-1">
                                    <span class="icon text-white">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </a>
                                <a href="{{ action('TaskNoteController@edit', ['task' => $task, 'note' => $note]) }}" class="d-xs-block d-sm-inline-block btn btn-sm btn-info btn-icon-split float-sm-right">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit Note</span>
                                </a>
                            </p>
                            <p>{!! nl2br(e($note->details)) !!}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No task notes yet.</p>
            @endif


        </div>
        <div class="col-lg-12 mb">
            <a href="{{ action('TaskNoteController@create', ['task' => $task]) }}" class="d-xs-block d-sm-inline-block btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Note</span>
            </a>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12">
            <a href="{{ action('TaskController@destroyConfirm', ['task' => $task]) }}" class="btn btn-danger float-right">Delete Task</a>
            @if($task->status == 'open')
            <form method="POST" action="{{ action('TaskController@markComplete', ['task' => $task]) }}" class="float-right mr-2">
                @csrf
                <button class="d-sm-inline-block btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Mark Complete</span>
                </button>
            </form>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="taskFilesModal" tabindex="-1" role="dialog" aria-labelledby="taskFilesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ action('TaskController@upload', ['task' => $task]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskFilesModalLabel">Upload a Task File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="taskFile" name="file">
                            <label class="custom-file-label" for="taskFile">Choose file</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection