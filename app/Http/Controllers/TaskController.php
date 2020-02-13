<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::get();
        return view('tasks.index')
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $projects = Project::where('status', 'active')->get();
        return view('tasks.create')
            ->with('task', $task)
            ->with('projects', $projects);
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
            $project = Project::find($request->input('project'));
            $task = $project->tasks()->create($request->input());
            return redirect()->action('TaskController@show', ['task' => $task]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show')
            ->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $projects = Project::get();
        return view('tasks.edit')
            ->with('task', $task)
            ->with('projects', $projects);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $valid = $this->validate(
            $request,
            [
                'name' => ['required', 'max:255'],
            ]
        );
        if($valid){
            $task->fill($request->input());
            $task->save();
            return redirect()->action('TaskController@show', ['task' => $task]);
        }
    }

    /**
     * Show the form for destroying the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroyConfirm(Task $task)
    {
        return view('tasks.delete')
            ->with('task', $task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->action('TaskController@index');
    }
}
