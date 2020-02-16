<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $task = new Task();
        if($request->input('project') != null){
            return view('tasks.create')
                ->with('task', $task)
                ->with('project', Project::find($request->input('project')));
        }
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
        $completed_at = $task->completed_at;
        if($valid){
            $task->fill($request->input());
            if($task->status == 'open'){
                $task->completed_at = null;
            } else {
                $task->completed_at = $completed_at;
            }
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

    public function markComplete(Request $request, Task $task)
    {
        if($request->isMethod('post')){
            $task->completed_at = Carbon::now();
            $task->status = 'completed';
            $task->save();
            return redirect()->action('TaskController@show', ['task' => $task]);
        }
    }
}
