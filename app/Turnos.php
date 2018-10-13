<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GrupoFamiliar;

class Turnos extends Model
{
    public function modulos(){
    	return $this->belongsToMany('App\Modulo')->withTimestamps();
    }
    public function tipoPaciente(){
    	return $this->belongsToOne('App\TipoPaciente');
    }

    public function grupoFamiliar(){
    	$this->belongsTo('App\GrupoFamiliar');
    }
}
