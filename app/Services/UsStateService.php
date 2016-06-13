<?php

namespace App\Services;

use App\Models\UsState;
use Cache;
use URl;
class UsStateService
{
	public function __construct(UsState $usState)
	{
		$this->usState = $usState;
	}

	/**
     * Get all states from us_states table.
     *
     * @return Response
     */
	public function getAllStates()
	{
		if(Cache::has('active_us_state_cities')) {
			return Cache::get('active_us_state_cities');
		}
		else {
			Cache::remember('active_us_state_cities', 20000, function()
			{
			    return $this->usState->has('active_cities', '>', 0)->orderBy('name', 'ASC')->get();
			});
		}
		return Cache::get('active_us_state_cities');
	}

	/**
     * Get state by slug from us_states table.
     *
     * @return Response
     */
	public function getStateBySlug($stat_slug)
	{
		return $this->usState->where('slug', $stat_slug)->first();
	}

	/**
     * Get country by key.
     *
     * @return Response
     */
	public function searchStateByKey($key)
	{
		$states = $this->usState->where('name', 'LIKE', "{$key}%")->get();
		foreach ($states as $key => $value) {
			$states[$key]->vo_url = URL::action('VirtualOfficesController@getCountryVirtualOffices', ['country_slug' => $value->slug]);
			$states[$key]->mr_url = URL::action('MeetingRoomsController@getCountryMeetingRooms', ['country_slug' => $value->slug]);
		}
		return $states;
	}

	/**
     * Get all states list from us_states table.
     *
     * @return Response
     */
	public function getAllUsStatesList()
	{
		return $this->usState->lists('name', 'name')->toArray();
	}
}