<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\users');
    }
}
