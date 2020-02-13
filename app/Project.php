<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'private_info', 'status',
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function notes()
    {
        return $this->hasMany('App\ProjectNote');
    }

}
