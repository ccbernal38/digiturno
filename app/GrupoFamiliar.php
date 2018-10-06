<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Turnos;

class GrupoFamiliar extends Model
{
    protected $table = 'grupoFamiliar';

	public function turnos(){
		return $this->hasMany('App\Turnos');
	}
}
