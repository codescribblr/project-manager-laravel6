<?php

namespace App\Http\Controllers;

use App\Project;
use App\Client;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::get();
        return view('projects.index')
            ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $clients = Client::get();
        return view('projects.create')
            ->with('project', $project)
            ->with('clients', $clients);
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
                'name' => ['required', 'max:255'],
        ]);
        if($valid){
            $client = Client::find($request->input('client'));
            $project = $client->projects()->create($request->input());
            return redirect()->action('ProjectController@show', ['project' => $project]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show')
            ->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $clients = Client::get();
        return view('projects.edit')
            ->with('project', $project)
            ->with('clients', $clients);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $valid = $this->validate(
            $request,
            [
                'name' => ['required', 'max:255'],
            ]
        );
        if($valid){
            $project->fill($request->input());
            $project->save();
            return redirect()->action('ProjectController@show', ['project' => $project]);
        }
    }

    /**
     * Show the form for destroying the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroyConfirm(Project $project)
    {
        return view('projects.delete')
            ->with('project', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->action('ProjectController@index');
    }
}
