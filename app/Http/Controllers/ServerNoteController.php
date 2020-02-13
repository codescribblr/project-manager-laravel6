<?php

namespace App\Http\Controllers;

use App\Server;
use App\ServerNote;
use Illuminate\Http\Request;

class ServerNoteController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function create(Server $server)
    {
        $note = new ServerNote();
        return view('servers.create_note')
            ->with('server', $server)
            ->with('note', $note);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Server $server)
    {
        $valid = $this->validate(
            $request,
            [
                'details' => ['required', ]
            ]
        );
        if($valid){
            $note = $server->notes()->create($request->input());
            return redirect()->action('ServerController@show', ['server' => $server]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Server  $server
     * @param  \App\ServerNote  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server, ServerNote $note)
    {
        return view('servers.edit_note')
            ->with('server', $server)
            ->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Server  $server
     * @param  \App\ServerNote  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server, ServerNote $note)
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
            return redirect()->action('ServerController@show', ['server' => $server]);
        }
    }

    /**
     * Show the form for destroying the specified resource.
     *
     * @param  \App\Server  $server
     * @param  \App\ServerNote  $note
     * @return \Illuminate\Http\Response
     */
    public function destroyConfirm(Server $server, ServerNote $note)
    {
        return view('servers.delete_note')
            ->with('server', $server)
            ->with('note', $note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Server  $server
     * @param  \App\ServerNote  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server, ServerNote $note)
    {
        $note->delete();
        return redirect()->action('ServerController@show', ['server' => $server]);
    }
}
