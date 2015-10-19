<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    public function options()
    {
    	return $this->hasOne('App\\MeetingRoomOption');
    }
}
