<?php

namespace App\Services;

use App\Models\TelCountry;

class TelCountryService
{
	public function __construct(TelCountry $telCountry)
	{
		$this->telCountry = $telCountry;
	}

	/**
     * Get all countries from tel_countries table with list.
     *
     * @return Response
     */
	public function getAllCountriesWithList()
	{
		//dd($this->telCountry->orderBy('country_code', 'ASC')->lists('full_name', 'country_code')->toArray());
		return $this->telCountry->orderBy('country_code', 'ASC')->lists('full_name', 'country_code')->toArray();
	}
	
}