<?php

namespace App\Services;
use App\Models\WhiteSite;
use App\Models\Country;
use App\Models\UsState;

class WhiteSiteService
{
	public function __construct(WhiteSite $whiteSite, Country $country, UsState $us_state)
	{
		$this->whiteSite = $whiteSite;
		$this->country = $country;
		$this->us_state = $us_state;
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
		// dd($removed_centers_ids);
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
}