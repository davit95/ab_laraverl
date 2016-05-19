<?php

namespace Admin\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Admin\Contracts\CityInterface;
use App\Models\City;

class CityService implements CityInterface
{
	/**
     * Create a new city service instance.
     */
	public function __construct(City $city)
	{
		$this->city = $city;
	}

	/**
	 * Get a listing of the resource.
	 * 
	 * @param 
	 * @return Response
	 */
	public function getAllCities()
	{
		return $this->city->all();
	}

	/**
	 * Get the specified resource.
	 * 
	 * @param $key (int)
	 * @return Response
	 */
	public function getCityByID($id)
	{
		$city = $this->city->find($id);
		if ($city) {
			return $city;
		}
		throw new NotFoundHttpException('Invalid URL.');
	}

	/**
	 * Get a listing of the resource for html select.
	 * 
	 * @param $key (int)
	 * @return Response
	 */
	public function getAllCitiesSelectList()
	{
		return $this->city->lists('name','id')->toArray();
	}

	/**
	 * Get city by key.
	 * 
	 * @param $key (int)
	 * @return Response
	 */
	public function searchCityByKey($key)
	{
		$cities = $this->city->where('name', 'LIKE', "{$key}%")->where('active', 1)->get();
		foreach ($cities as $key => $value)
		{
			/*$cities[$key]->vo_url = URL::action('VirtualOfficesController@getCityVirtualOffices', ['country_code' => $value->country_code, 'city_slug' => $value->slug, 'city_id' => $value->id]);*/
			/*$cities[$key]->mr_url = URL::action('MeetingRoomsController@getCityMeetingRooms', ['country_code' => $value->country_code, 'city_slug' => $value->slug, 'city_id' => $value->id]);*/
																						//isset($center->city_name) ? $center->city_name : null
			$cities[$key]->vo_url = URL::action('VirtualOfficesController@getCityVirtualOfficesWithoutId', ['country_code' => isset($value->us_state_code) ? $value->us_state_code : $value->country_code, 'city_slug' => $value->slug]);
			$cities[$key]->mr_url = URL::action('MeetingRoomsController@getCityMeetingRooms', ['country_code' => $value->country_code, 'city_slug' => $value->slug]);
		}
		return $cities;
	}
	
}