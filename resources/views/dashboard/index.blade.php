@extends('layouts.app')

@section('page-title')
    Project Manager Dashboard
@endsection

@section('page-heading')
    Dashboard
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Projects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totals['projects'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Clients</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totals['clients'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Overdue Tasks</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totals['overdue_tasks_percent'] }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $totals['overdue_tasks_percent'] }}%" aria-valuenow="{{ $totals['overdue_tasks_percent'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Monthly Server Cost</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $totals['monthly_server_cost'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Active Projects</h6>
                </div>
                <div class="card-body">
                    @if($projects->count() > 0)
                        <ul>
                            @foreach($projects as $project)
                                <li><a href="{{ action('ProjectController@show', ['project' => $project]) }}" class="text-primary">{{ $project->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Recent Active Projects</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Recent Clients</h6>
                </div>
                <div class="card-body">
                    @if($clients->count() > 0)
                        <ul>
                            @foreach($clients as $client)
                                <li><a href="{{ action('ClientController@show', ['client' => $client]) }}" class="text-success">{{ $client->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Recent Clients</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Recent Open Tasks</h6>
                </div>
                <div class="card-body">
                    @if($tasks->count() > 0)
                        <ul>
                            @foreach($tasks as $task)
                                <li><a href="{{ action('TaskController@show', ['task' => $task]) }}" class="text-info">{{ $task->name }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Recent Open Tasks</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Recent Servers</h6>
                </div>
                <div class="card-body">
                    @if($servers->count() > 0)
                        <ul>
                            @foreach($servers as $server)
                                <li><a href="{{ action('ServerController@show', ['server' => $server]) }}" class="text-warning">{{ $server->hostname }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Recent Servers</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection