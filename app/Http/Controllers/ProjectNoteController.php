<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectNote;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $note = new ProjectNote();
        return view('projects.create_note')
            ->with('project', $project)
            ->with('note', $note);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $valid = $this->validate(
            $request,
            [
                'details' => ['required', ]
            ]
        );
        if($valid){
            $note = $project->notes()->create($request->input());
            return redirect()->action('ProjectController@show', ['project' => $project]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\ProjectNote  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, ProjectNote $note)
    {
        return view('projects.edit_note')
            ->with('project', $project)
            ->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @param  \App\ProjectNote  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, ProjectNote $note)
    {
        $valid = $this->validate(
            $request,
            [
                'details' => ['required', ]
            ]
        );
        if($valid){
            $note->fill($request->input());
            $note->save();
            return redirect()->action('ProjectController@show', ['project' => $project]);
        }
    }

    /**
     * Show the form for destroying the specified resource.
     *
     * @param  \App\Project  $project
     * @param  \App\ProjectNote  $note
     * @return \Illuminate\Http\Response
     */
    public function destroyConfirm(Project $project, ProjectNote $note)
    {
        return view('projects.delete_note')
            ->with('project', $project)
            ->with('note', $note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @param  \App\ProjectNote  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, ProjectNote $note)
    {
        $note->delete();
        return redirect()->action('ProjectController@show', ['project' => $project]);
    }
}
