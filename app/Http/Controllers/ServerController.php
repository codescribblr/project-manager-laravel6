<?php

namespace App\Http\Controllers;

use App\Server;
use App\Project;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = Server::get();
        return view('servers.index')
            ->with('servers', $servers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $server = new Server();
        return view('servers.create')
            ->with('server', $server);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $this->validate(
            $request,
            [
                'hostname' => ['required', 'max:255'],
                'public_ip' => ['required', 'max:255'],
                'platform' => ['required', 'max:255'],
            ]);
        if($valid){
            $server = Server::create($request->input());
            return redirect()->action('ServerController@show', ['server' => $server]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        return view('servers.show')
            ->with('server', $server);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        return view('servers.edit')
            ->with('server', $server);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        $valid = $this->validate(
            $request,
            [
                'hostname' => ['required', 'max:255'],
                'public_ip' => ['required', 'max:255'],
                'platform' => ['required', 'max:255'],
            ]
        );
        if($valid){
            $server->fill($request->input());
            $server->save();
            return redirect()->action('ServerController@show', ['server' => $server]);
        }
    }

    /**
     * Show the form for destroying the specified resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroyConfirm(Server $server)
    {
        return view('servers.delete')
            ->with('server', $server);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        $server->delete();
        return redirect()->action('ServerController@index');
    }

    /**
     * Show the form for attaching a server.
     *
     * @return \Illuminate\Http\Response
     */
    public function attach(Request $request, Project $project)
    {
        if($request->isMethod('post')){
            $server = Server::find($request->input('server'));
            $project->servers()->save($server);
            return redirect()->action('ProjectController@show', ['project' => $project]);
        }
        $servers = Server::all();
        return view('servers.attach')
            ->with('project', $project)
            ->with('servers', $servers);
    }
}
