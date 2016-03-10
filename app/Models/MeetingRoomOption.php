<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRoomOption extends Model
{
    protected $table = 'meeting_rooms_options';
    protected $fillable = ['parking_description'];
    public $timestamps = false;
}
