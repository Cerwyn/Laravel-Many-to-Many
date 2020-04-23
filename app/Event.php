<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_name', 'event_detail',
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    
}
