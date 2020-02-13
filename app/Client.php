<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'contact_name',
        'contact_email',
        'contact_phone',
        'status'
    ];

    public function notes()
    {
        return $this->hasMany('App\ClientNote');
    }
}
