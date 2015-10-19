<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Country extends Model
{
    public function active_cities()
    {
    	return $this->hasMany('App\\City', 'country_id')->where('active', 1);
    }

    public function active_cities_count()
    {
    	return $this->hasOne('App\\City')->where('active', 1)->selectRaw('country_id , count(*) as count')->groupBy('country_id');
    }
}
