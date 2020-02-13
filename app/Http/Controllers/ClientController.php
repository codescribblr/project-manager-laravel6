<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();
        return view('clients.index')
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new Client();
        return view('clients.create')
            ->with('client', $client);
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
                'name' => ['required', 'unique:clients', 'max:255'],
                'contact_name' => ['max:255'],
                'contact_email' => ['max:255'],
                'contact_phone' => ['max:255'],
            ]
        );
        if($valid){
            $client = Client::create($request->input());
            return redirect()->action('ClientController@show', ['client' => $client]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show')
            ->with('client', $client)
            ->with('latest_active_projects', $client->projects->where('status', 'active')->sortByDesc('updated_at')->slice(0, 5))
            ->with('latest_inactive_projects', $client->projects->where('status', 'inactive')->sortByDesc('updated_at')->slice(0, 5))
            ->with('latest_open_tasks', \App\Task::hydrate(
                DB::table('tasks')
                    ->join('projects', function($join) use ($client) {
                        $join->on('projects.id', '=', 'tasks.project_id')
                            ->where('projects.client_id', '=', $client->id);
                    })->select('tasks.*')
                    ->limit(5)
                    ->get()
                    ->toArray()
            ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit')
            ->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $valid = $this->validate(
            $request,
            [
                'name' => ['required', Rule::unique('clients')->ignore($client->id), 'max:255'],
                'contact_name' => ['max:255'],
                'contact_email' => ['max:255'],
                'contact_phone' => ['max:255'],
            ]
        );
        if($valid){
            $client->fill($request->input());
            $client->save();
            return redirect()->action('ClientController@show', ['client' => $client]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroyConfirm(Client $client)
    {
        return view('clients.delete')
            ->with('client', $client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->action('ClientController@index');
    }
}
