<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turnos extends Model
{
    public function modulos(){
    	return $this->belongsToMany('App\Modulo')->withTimestamps();
    }
}
