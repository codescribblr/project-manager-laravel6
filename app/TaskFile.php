<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{
    protected $fillable = [
        'filename', 'name',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
