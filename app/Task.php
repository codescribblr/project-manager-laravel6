<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'start_date', 'due_date', 'status', 'completed_at',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function notes()
    {
        return $this->hasMany('App\TaskNote');
    }

    public function files()
    {
        return $this->hasMany('App\TaskFile');
    }

    public function scopeOpen($query)
    {
        return $query->where('status', '=', 'open');
    }

    public function scopeOverdue($query)
    {
        return $query->whereNotNull('due_date')
                ->where('due_date', '<', strtotime('today'));
    }
}
