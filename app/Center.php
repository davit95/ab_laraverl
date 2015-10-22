<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    public function photos()
    {
    	return $this->hasMany('App\\CenterPhoto');
    }

    public function virtual_office_seo()
    {
    	return $this->hasOne('App\\VirtualOfficeSeo');
    }

    public function meeting_room_seo()
    {
        return $this->hasOne('App\\MeetingRoomSeo');
    }

    public function center_filter()
    {
    	return $this->hasOne('App\\CenterFilter', 'center_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany('App\\CenterPrice');
    }

    public function city()
    {
        return $this->belongsTo('App\\City');
    }

    public function meeting_rooms()
    {
        return $this->hasMany('App\\MeetingRoom');
    }

    public function virtual_office_lowest_price()
    {
        return $this->hasOne('App\\CenterPrice')->selectRaw('center_id , min(price) as min_price')->groupBy('center_id');
    }

    public function meeting_room_lowest_price()
    {
        return $this->hasOne('App\\MeetingRoom')->selectRaw('center_id , min(hourly_rate) as min_price')->groupBy('center_id');
    }

    public function coordinate()
    {
        return $this->hasOne('App\\CenterCoordinate');
    }

    public function telephony_includes()
    {
      return $this->hasMany('App\\TelephonyPackageInclude', 'center_id', 'id');
      
    }
}
