<?php

namespace Admin\Contracts;

interface CountryInterface
{
	/*
	 * Get a listing of the resource.
	 */
	public function getAllCountries();

	/*
	 * Get the specified resource.
	 */
	public function getCountryByID($id);

	/*
	 * Get a listing of the resource for html select.
	 */
	public function getAllCountriesSelectList();
}