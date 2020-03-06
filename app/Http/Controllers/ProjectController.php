<?php

namespace App\Http\Controllers;

use App\Project;
use App\Client;
use App\ProjectFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $client = Client::find($valid['client']);
            $project = $client->projects()->create($valid);
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
            $project->fill($valid);
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

    public function archive(Request $request, Project $project)
    {
        if($request->isMethod('post')){
            $project->completed_at = Carbon::now();
            $project->status = 'inactive';
            $project->save();
            return redirect()->action('ProjectController@show', ['project' => $project]);
        }
    }

    /**
     * Upload a file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, Project $project)
    {
        $filename = $request->file('file')->store('project_files');
        $project->files()->create([
            'filename' => $filename,
            'name' => $request->file('file')->getClientOriginalName(),
        ]);

        return redirect()->action('ProjectController@show', ['project' => $project]);
    }

    /**
     * Upload a file.
     *
     * @param  \App\Project  $project
     * @param  \App\ProjectFile  $file
     * @return \Illuminate\Http\Response
     */
    public function deleteFile(Project $project, ProjectFile $file)
    {
        Storage::delete($file->filename);
        $file->delete();

        return redirect()->action('ProjectController@show', ['project' => $project]);
    }
}
