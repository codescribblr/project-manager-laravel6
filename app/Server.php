<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'hostname', 'public_ip', 'platform', 'cost', 'slots', 'capacity', 'status',
    ];

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'projects_servers');
    }

    public function notes()
    {
        return $this->hasMany('App\ServerNote');
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', 'active');
    }

    public function scopeTotalMonthlyCost($query)
    {
        return $query->sum('cost');
    }
}
