<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $fillable = [
        'filename', 'name',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
