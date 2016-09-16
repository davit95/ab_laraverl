<?php

namespace App\Services;
use App\Models\WhiteSite;
use App\Models\Country;
use App\Models\UsState;
use App\Models\City;
use App\Models\Center;

class WhiteSiteService
{
	public function __construct(WhiteSite $whiteSite, Country $country, UsState $us_state, City $city, Center $center)
	{
		$this->whiteSite = $whiteSite;
		$this->country = $country;
		$this->us_state = $us_state;
		$this->city = $city;
		$this->center = $center;
	}

	public function getWhiteSite($white_site_id)
	{
		return $this->whiteSite->find($white_site_id);
	}

	public function getAvailableCountries($white_site)
	{
		if(null!= $white_site){
			$removed_centers_ids = json_decode($white_site->removed_centers_ids);			
			$countries = $this->country->whereHas('centers', function($query) use ($removed_centers_ids){
				$query->whereNotIn('id', $removed_centers_ids)->where('active_flag', 'Y');
			})->lists('name', 'code');
		}else{
			$countries = $this->country->whereHas('centers', function($query){
				$query->where('active_flag', 'Y');
			})->lists('name', 'code');
		}		
		return $countries;
	}

	public function getAvailableStates($white_site)
	{
		if(null!= $white_site){
			$removed_centers_ids = json_decode($white_site->removed_centers_ids);
			$states = $this->us_state->whereHas('centers', function($query) use ($removed_centers_ids){
				$query->whereNotIn('id', $removed_centers_ids)->where('active_flag', 'Y');
			})->lists('name', 'code');
		}else{
			$states = $this->us_state->whereHas('centers', function($query){
				$query->where('active_flag', 'Y');
			})->lists('name', 'code');
		}
		return $states;
	}

	public function getCitiesByCountryAndState($white_site, $country, $state)
	{
		if($state != null && $state != ""){
			$cities = $this->city->where('country_code', $country)->where('us_state_code', $state);
		}else{
			$cities = $this->city->where('country_code', $country);
		}
		if(null!= $white_site){
			$removed_centers_ids = json_decode($white_site->removed_centers_ids);
			$cities = $cities->whereHas('centers', function($query) use ($removed_centers_ids){
				$query->whereNotIn('id', $removed_centers_ids)->where('active_flag', 'Y');
			})->lists('name', 'id');
		}else{
			$cities = $cities->lists('name', 'id');
		}
		return $cities;
	}

	public function getCentersLiist($white_site, $country, $state, $city_id)
	{
		if($state != null && $state != ""){
			$centers = $this->center->where('country', $country)->where('us_state', $state);
		}else{
			$centers = $this->center->where('country', $country);
		}
		$centers = $centers->where('city_id', $city_id)->where('active_flag', 'Y');
		$centers->with(['vo_photos' => function($q){
			$q->first();
		}]);
		if(null!= $white_site){
			$removed_centers_ids = json_decode($white_site->removed_centers_ids);
			$centers = $centers->whereNotIn('id', $removed_centers_ids)->get(['id', 'name', 'address1', 'address2', 'country', 'us_state', 'city_id', 'city_name', 'postal_code'])->toArray();
		}else{
			$centers = $centers->get(['id', 'name', 'address1', 'address2', 'country', 'us_state', 'city_id', 'city_name', 'postal_code'])->toArray();
		}
		return $centers;
	}

	public function getCenter($white_site, $center_id)
	{
		if(null!= $white_site){
			$removed_centers_ids = json_decode($white_site->removed_centers_ids);			
			if(!in_array($center_id, $removed_centers_ids)){				
				return $this->center->where('id', $center_id)->with('vo_photos')->first()->toArray();
			}
			return null;
		}

	}
}