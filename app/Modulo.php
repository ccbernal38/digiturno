<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    public function turnos(){
    	return $this->belongsToMany('App\Turnos')->withTimestamps();
    }
}
