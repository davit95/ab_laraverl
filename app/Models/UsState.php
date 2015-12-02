<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsState extends Model
{
    protected $table = 'us_states';

    public function cities()
    {
    	return $this->hasMany('App\\Models\\City', 'us_state_id');
    }

    public function active_cities()
    {
    	return $this->hasMany('App\\Models\\City', 'us_state_id')->where('active', 1);
    }
}
