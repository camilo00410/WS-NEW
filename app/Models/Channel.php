<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function rooms(){
        return $this->hasMany('App\Models\Room');
    }

    public function sessions(){
        return $this->hasManyThrough('App\Models\Session', 'App\Models\Room');
    }
}
