<?php

namespace Admin\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Admin\Contracts\CountryInterface;
use App\Models\Country;

class CountryService implements CountryInterface
{
	/**
     * Create a new country service instance.
     */
	public function __construct(Country $country)
	{
		$this->country = $country;
	}

	/*
	 * Get a listing of the resource.
	 */
	public function getAllCountries()
	{
		return $this->country->all();
	}

	/*
	 * Get the specified resource.
	 */
	public function getCountryByID($id)
	{
		$country = $this->country->find($id);
		if ($country) {
			return $country;
		}
		throw new NotFoundHttpException('Invalid URL.');
	}

	/*
	 * Get a listing of the resource for html select.
	 */
	public function getAllCountriesSelectList()
	{
		return $this->country->lists('name','id')->toArray();
	}
}