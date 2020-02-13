<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientNote;
use Illuminate\Http\Request;

class ClientNoteController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        $clientNote = new ClientNote();
        return view('clients.create_note')
            ->with('client', $client)
            ->with('note', $clientNote);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $valid = $this->validate(
            $request,
            [
                'details' => ['required', ],
            ]
        );
        if($valid){
            $clientNote = $client->notes()->create($request->input());
            return redirect()->action('ClientController@show', ['client' => $clientNote->client]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientNote  $clientNote
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, ClientNote $note)
    {
        return view('clients.edit_note')
            ->with('client', $client)
            ->with('note', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientNote  $note
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, ClientNote $note)
    {
        $valid = $this->validate(
            $request,
            [
                'details' => ['required', ],
            ]
        );
        if($valid){
            $note->fill($request->input());
            $note->save();
            return redirect()->action('ClientController@show', ['client' => $note->client]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientNote  $note
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroyConfirm(Client $client, ClientNote $note)
    {
        return view('clients.delete_note')
            ->with('client', $client)
            ->with('note', $note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientNote  $note
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client, ClientNote $note)
    {
        $note->delete();
        return redirect()->action('ClientController@show', ['client' => $client]);
    }
}
