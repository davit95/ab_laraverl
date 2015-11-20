<?php

namespace Admin\Contracts;

interface CityInterface
{
	/*
	 * Get a listing of the resource.
	 */
	public function getAllCities();

	/*
	 * Get the specified resource.
	 */
	public function getCityByID($id);

	/*
	 * Get a listing of the resource for html select.
	 */
	public function getAllCitiesSelectList();
}