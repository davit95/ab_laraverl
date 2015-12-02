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

	/*
	 * Get a listing of the resource.
	 */
	public function getAllCities()
	{
		return $this->city->all();
	}

	/*
	 * Get the specified resource.
	 */
	public function getCityByID($id)
	{
		$city = $this->city->find($id);
		if ($city) {
			return $city;
		}
		throw new NotFoundHttpException('Invalid URL.');
	}

	/*
	 * Get a listing of the resource for html select.
	 */
	public function getAllCitiesSelectList()
	{
		return $this->city->lists('name','id')->toArray();
	}
}