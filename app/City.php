<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function centers()
    {
    	return $this->hasMany('App\\Center');
    }

    public function active_virtual_offices()
    {
    	return $this->hasMany('App\\Center')
                    ->where('active_flag', 'Y')
                    ->where(function($q){
                        $q->whereHas('center_filter', function($q){
                        $q->where('virtual_office', 1);})->orWhere(function($q){
                            $q->has('center_filter', '<', 1);
                        });
                    });
    }

    public function active_meeting_rooms()
    {
        return $this->hasMany('App\\Center')
                    ->where('active_flag', 'Y')
                    ->where(function($q){
                        $q->whereHas('center_filter', function($q){
                        $q->where('meeting_room', 1);})->orWhere(function($q){
                            $q->has('center_filter', '<', 1);
                        });
                    });
    }

    public function country()
    {
    	return $this->belongsTo('App\\Country');
    }

    public function usState()
    {
        return $this->belongsTo('App\\UsState');
    }
}
