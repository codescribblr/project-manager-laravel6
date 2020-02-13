<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientNote extends Model
{
    protected $fillable = ['details', ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
