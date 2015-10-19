<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsState extends Model
{
    protected $table = 'us_states';

    public function cities()
    {
    	return $this->hasMany('App\\City', 'us_state_id');
    }

    public function active_cities()
    {
    	return $this->hasMany('App\\City', 'us_state_id')->where('active', 1);
    }
}
