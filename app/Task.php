<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'start_date', 'due_date', 'status',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function notes()
    {
        return $this->hasMany('App\TaskNote');
    }

    public function scopeOpen($query)
    {
        return $query->where('status', '=', 'open');
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', strtotime('today'));
    }
}
