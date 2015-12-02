<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    public function options()
    {
    	return $this->hasOne('App\\Models\\MeetingRoomOption');
    }
}
