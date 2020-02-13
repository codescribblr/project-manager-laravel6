<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskNote extends Model
{
    protected $fillable = ['details', ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
