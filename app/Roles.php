<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public function usuarios(){
    	return $this->belongsToMany('App\User', 'assigned_roles', 'assigned_roles', 'user_id', 'roles_id')->withTimestamps();
    }
}
