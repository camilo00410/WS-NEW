<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    public $timestamps = false;

    public function tickets(){
        return $this->hasMany('App\Models\Ticket');
    }

    public function organizer(){
        return $this->belongsTo('App\Models\Organizer');
    }

    public function channels(){
        return $this->hasMany('App\Models\Channel');
    }

    public function rooms(){
        return $this->hasManyThrough('App\Models\Room', 'App\Models\Channel');
    }
}
