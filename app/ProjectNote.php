<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectNote extends Model
{
    protected $fillable = ['details', ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
