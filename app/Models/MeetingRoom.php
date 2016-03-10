<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{

	protected $fillable = ['name','center_id'];
	public $timestamps = false;
    public function options()
    {
    	return $this->hasOne('App\\Models\\MeetingRoomOption');

    }
}
