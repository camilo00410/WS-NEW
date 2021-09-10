<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $table = 'event_tickets';
    protected $guarded = [];
    public $timestamps = false;

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function registrations(){
        return $this->hasMany('App\Models\Registration');
    }
}
