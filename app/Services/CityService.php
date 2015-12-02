<?php

namespace App\Services;

use App\Models\City;
use URL;

class CityService
{
	public function __construct(City $city)
	{
		$this->city = $city;
	}

	/**
     * Get city by county code and city slug.
     *
     * @return Response
     */
	public function getCityByCountryCodeAndCitySlug($country_code, $city_slug)
	{
		return $this->city->where('country_code', $country_code)->where('slug', $city_slug)->first();
	}

	/**
     * Get city by us_state_id from cities table.
     *
     * @return Response
     */
	public function getStateActiveCitiesWithPagination($us_state_id)
	{
		return $this->city->where('us_state_id', $us_state_id)->where('active', 1)->paginate(5);
	}

	/**
     * Get city by us_state_id from cities table.
     *
     * @return Response
     */
	public function getCountryActiveCitiesWithPagination($country_id)
	{
		return $this->city->where('country_id', $country_id)->where('active', 1)->paginate(5);
	}

	/**
     * Get city by key.
     *
     * @return Response
     */
	public function searchCityByKey($key)
	{
		$cities = $this->city->where('name', 'LIKE', "{$key}%")->where('active', 1)->get();
		foreach ($cities as $key => $value)
		{
			$cities[$key]->vo_url = URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => $value->country_code, 'city_slug' => $value->slug]);
			$cities[$key]->mr_url = URL::action('MeetingRoomsController@getCityMeetingRooms', ['country_code' => $value->country_code, 'city_slug' => $value->slug]);
		}
		//dd($cities);
		return $cities;
	}

	
}