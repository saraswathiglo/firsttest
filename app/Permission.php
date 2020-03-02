<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles(){
    	return $this->belongstoMany(Role::class, 'role_permissions');
    }
}
