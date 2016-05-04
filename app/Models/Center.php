<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model {

	protected $fillable = ['city_name',
							'name',
	 					   'slug', 'owner_id',
	  					   'city_name',
	   					   'city_id',
	    				   'country', 
	    				   'country_id', 
	    				   'us_state', 
	    				   'us_state_id', 
	    				   'region_id',
	    				   'company_name', 
	    				   'building_name',
	    				   'address1',
	    				   'address2',
	    				   'postal_code',
	    				   'summary',
	    				   'location',
	    				   'amenities',
	    				   'review_data',
	    				   'active_flag',
	    				   'email_flag',
	    				   'notes',
	    				   'virtual_tour_url',
	    				   'map_url',
	    				   'status_changed_at',
	    				   'tax_name',
	    				   'tax_percentage'
	    				   ];
	public function vo_photos() {
		return $this->belongsToMany('App\\Models\\Photo', 'vo_photos', 'center_id', 'photo_id');
	}

	public function mr_photos() {
		return $this->belongsToMany('App\\Models\\Photo', 'mr_photos', 'center_id', 'photo_id');
	}

	public function virtual_office_seo() {
		return $this->hasOne('App\\Models\\VirtualOfficeSeo');
	}

	public function meeting_room_seo() {
		return $this->hasOne('App\\Models\\MeetingRoomSeo');
	}

	public function owner() {
		return $this->hasOne('App\\Models\\Owner', 'id', 'owner_id');
	}

	public function center_filter() {
		return $this->hasOne('App\\Models\\CenterFilter', 'center_id', 'id');
	}

	public function prices() {
		return $this->hasMany('App\\Models\\CenterPrice');
	}

	public function city() {
		return $this->belongsTo('App\\Models\\City');
	}

	public function meeting_rooms() {
		return $this->hasMany('App\\Models\\MeetingRoom');
	}

	public function virtual_office_lowest_price() {
		return $this->hasOne('App\\Models\\CenterPrice')->where('price', '>', 0.00)->selectRaw('center_id , min(price) as min_price')->groupBy('center_id');
	}

	public function meeting_room_lowest_price() {
		return $this->hasOne('App\\Models\\MeetingRoom')->where('hourly_rate', '>', 0.00)->selectRaw('center_id , min(hourly_rate) as min_price')->groupBy('center_id');
	}

	public function coordinate() {
		return $this->hasOne('App\\Models\\CenterCoordinate');
	}

	public function local_number() {
		return $this->hasOne('App\\Models\\CenterLocalNumber', 'center_id', 'id');
	}

	public function telephony_includes() {
		return $this->hasMany('App\\Models\\TelephonyPackageInclude', 'center_id', 'id');
	}

	public function owner()
	{
		return $this->belongsTo('App\\Models\\Owner');
	}
}
