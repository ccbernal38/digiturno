<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPaciente extends Model
{
    public function turnos(){
    	return $this->hasMany('App\Turnos');
    }
}
