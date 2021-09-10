<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    public $timestamps = false;

    public function channel(){
        return $this->belongsTo('App\Models\Channel');
    }

    public function Sessions(){
        return $this->hasMany('App\Models\Session');
    }

    public function Registrations(){
        return $this->hasManyThrough('App\Models\SessionRegistration', 'App\Models\Session');
    }
}
