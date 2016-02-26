<?php

namespace App\Services;

use App\Models\Country;
use Cache;
use URL;

class CountryService
{
	public function __construct(Country $country)
	{
		$this->country = $country;
	}

	/**
     * Get all countries from countries table.
     *
     * @return Response
     */
	public function getAllCountries()
	{
		return $this->country->has('active_cities', '>', 0)->orderBy('name', 'ASC')->get();
		if(Cache::has('active_countries'))
		{
			return Cache::get('active_countries');
		}
		else
		{
			Cache::rememberForever('active_countries', function()
			{
			    return $this->country->has('active_cities', '>', 0)->orderBy('name', 'ASC')->get();
			});
		}
		return Cache::get('active_countries');
	}

	/**
     * Get country by county slug from countries table.
     *
     * @return Response
     */
	public function getCountryBySlug($country_slug)
	{
		return $this->country->where('slug', $country_slug)->first();
	}

	/**
     * Get country by id from countries table.
     *
     * @return Response
     */
	public function getCountryById($id)
	{
		return $this->country->where('id', $id)->first();
	}

	/**
     * Get country by key.
     *
     * @return Response
     */
	public function searchCountryByKey($key)
	{
		$countries = $this->country->where('name', 'LIKE', "{$key}%")->get();
		foreach ($countries as $key => $value)
		{
			/*$countries[$key]->vo_url = URL::action('VirtualOfficesController@getCountryVirtualOffices', ['country_slug' => $value->slug]);*/
			$countries[$key]->vo_url = URL::action('VirtualOfficesController@getCityVirtualOfficesWithoutId', ['country_code' => $value->us_state_code, 'city_slug' => $value->slug]);
			$countries[$key]->mr_url = URL::action('MeetingRoomsController@getCountryMeetingRooms', ['country_slug' => $value->slug]);
		}
		return $countries;
	}	
}