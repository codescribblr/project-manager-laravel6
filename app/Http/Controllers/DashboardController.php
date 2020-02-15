<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $totals = [
            'projects' => \App\Project::count(),
            'clients' => \App\Client::count(),
            'overdue_tasks_percent' => number_format((float)\App\Task::overdue()->count() / \App\Task::open()->count() * 100, 2, '.', ','),
            'monthly_server_cost' => \App\Server::active()->totalMonthlyCost() / 100,
        ];
        $servers = \App\Server::where('updated_at', '>', strtotime('last month'))->orderBy('updated_at', 'desc')->limit(10)->get();
        $projects = \App\Project::where([
            ['updated_at', '>', strtotime('last month')],
            ['status', '=', 'active'],
        ])->orderBy('updated_at', 'desc')->limit(10)->get();
        $tasks = \App\Task::where([
            ['updated_at', '>', strtotime('last month')],
            ['status', '=', 'open'],
        ])->orderBy('updated_at', 'desc')->limit(10)->get();
        $clients = \App\Client::where('updated_at', '>', strtotime('last month'))->orderBy('updated_at', 'desc')->limit(10)->get();
        return view('dashboard.index')
            ->with('totals', $totals)
            ->with('servers', $servers)
            ->with('clients', $clients)
            ->with('tasks', $tasks)
            ->with('projects', $projects);
    }
}
