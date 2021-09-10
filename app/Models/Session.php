<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    public $timestamps = false;

    public function room(){
        return $this->belongsTo('App\Models\Room');
    }

    public function Registrations(){
        return $this->hasMany('App\Models\SessionRegistration');
    }
}
