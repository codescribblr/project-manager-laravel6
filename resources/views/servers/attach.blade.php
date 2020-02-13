@extends('layouts.app')

@section('page-title')
    Attach Server
@endsection

@section('page-heading')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Attach Server to Project - {{ $project->name }}</h1>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ action('ServerController@attach', ['project' => $project]) }}">
        @csrf
        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="form-group">
                    <label for="server">Server</label>
                    <select name="server" id="server" class="custom-select">
                        @foreach($servers as $server)
                            <option value="{{ $server->id }}" {{ old('server') === $server->id ? 'selected' : '' }}>{{ $server->hostname }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-lg btn-warning">Attach Server</button>

            </div>
        </div>
    </form>
@endsection