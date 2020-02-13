<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskNote;
use Illuminate\Http\Request;

class TaskNoteController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        $note = new TaskNote();
        return view('tasks.create_note')
            ->with('task', $task)
            ->with('note', $note);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        $valid = $this->validate(
            $request,
            [
                'details' => ['required', ]
            ]
        );
        if($valid){
            $note = $task->notes()->create($request->input());
            return redirect()->action('TaskController@show', ['task' => $task]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @param  \App\TaskNote  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, TaskNote $note)
    {
        return view('tasks.edit_note')
            ->with('task', $task)
            ->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @param  \App\TaskNote  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task, TaskNote $note)
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
            return redirect()->action('TaskController@show', ['task' => $task]);
        }
    }

    /**
     * Show the form for destroying the specified resource.
     *
     * @param  \App\Task  $task
     * @param  \App\TaskNote  $note
     * @return \Illuminate\Http\Response
     */
    public function destroyConfirm(Task $task, TaskNote $note)
    {
        return view('tasks.delete_note')
            ->with('task', $task)
            ->with('note', $note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @param  \App\TaskNote  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, TaskNote $note)
    {
        $note->delete();
        return redirect()->action('TaskController@show', ['task' => $task]);
    }
}
