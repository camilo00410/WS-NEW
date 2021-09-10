<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Organizer extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function getAuthPassword(){
        return $this->password_hash;
    }

    public function events(){
        return $this->hasMany('App\Models\Event');
    }
}
