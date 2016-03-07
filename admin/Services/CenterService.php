<?php

namespace Admin\Services;

use Admin\Contracts\CenterInterface;

use App\Models\CenterCoordinate;
use App\Models\Center;
use App\Models\Photo;
use App\Models\UsState;
use App\Models\Country;
use App\Models\City;


class CenterService implements CenterInterface {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(Center $center, Photo $photo, CenterCoordinate $centerCoordinate, UsState $usState, Country $country, City $city) {
		$this->center = $center;
		$this->photo  = $photo;
		$this->usState = $usState;
		$this->country = $country;
		$this->city = $city;
		$this->centerCoordinate = $centerCoordinate;
	}

	/*
	 * Store a newly created resource in storage.
	 */
	public function storeCenter($inputs) {
		
		$params = $this->getCityParams($inputs);
		$city = $this->city->where('slug', $params['city_name'])->first();
		$params['city_id'] = $city->id;
		$params['us_state'] = $params['us_state_code'];
		$params['country'] = $params['country_code'];
		$params['active_flag'] = 'Y';
		$data = new $this->centerCoordinate(['lat' => $params['lat'], 'lng' => $params['lng']]);
		$center = $this->center->create($params);
		$center->coordinate()->save($data);
		$center->vo_photos()->saveMany([
            new $this->photo(['path' => $params['image1']])
        ]);
        return $center;
	}

	public function getAllUscenters()
	{
		return $this->center->where('active_flag', 'Y')->get();
	}

	public function getCityParams($inputs)
	{
		$state = $this->usState->where('name', $inputs['states'])->first();
		$country = $this->country->where('name', $inputs['countries'])->first();
		$inputs['name'] = $inputs['city_name'];
		$inputs['slug'] = $inputs['city_name'];
		$inputs['country_id'] = $country->id;
		$inputs['country_code'] = $country->code;
		$inputs['us_state_id'] = $state->id;
		$inputs['us_state_code'] = $state->code;
		$inputs['us_state'] = $state->name;
		return $inputs;
	}
}