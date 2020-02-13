<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerNote extends Model
{
    protected $fillable = ['details', ];

    public function server()
    {
        return $this->belongsTo('App\Server');
    }
}
