<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password', 'role_id', 'owner_id'];

    public function role()
    {
    	return $this->hasOne('App\Models\Role', 'role_id', 'id');	
    }
}
