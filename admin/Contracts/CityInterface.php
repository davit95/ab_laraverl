<?php

namespace Admin\Contracts;

interface CityInterface
{
	
	/**
	 *
	 * 
	 * @param 
	 * @return All cities
	 */
	public function getAllCities();

	/**
	 *
	 * 
	 * @param $id (int)
	 * @return one city
	 */
	public function getCityByID($id);

	/**
	 *
	 * 
	 * @param 
	 * @return cities list
	 */
	public function getAllCitiesSelectList();

	/**
	 * Get city by key.
	 * 
	 * @param 
	 * @return Response
	 */
	public function searchCityByKey($key);
}