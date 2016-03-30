<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{

	protected $fillable = [
			'name', 
			'center_id', 
			'capacity', 
			'hourly_rate', 
			'half_day_rate', 
			'full_day_rate',
			'min_hours_req',
			'floor'
		];
	public $timestamps = false;
    public function options()
    {
    	return $this->hasOne('App\\Models\\MeetingRoomOption');

    }
}
