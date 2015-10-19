<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CenterPrice extends Model
{
    protected $table = 'centers_prices';

    public function package()
    {
    	return $this->belongsTo('App\\Product', 'package_id', 'part_number');
    }
}
