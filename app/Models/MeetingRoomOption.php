<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRoomOption extends Model
{
    protected $table = 'meeting_rooms_options';
    protected $fillable = [
    	'room_description',
    	'parking_rate',
    	'parking_description',
    	'network_rate',
    	'wireless_rate',
    	'phone_rate',
    	'admin_services_rate',
    	'whiteboard_rate',
    	'tvdvdplayer_rate',
    	'projector_rate',
    	'videoconferencing_rate',
    	'video_equipment',
    	'bridge_connection_available',
    	'catering',
    	'credit_cards'
    ];
    public $timestamps = false;
}
