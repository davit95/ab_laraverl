<?php

namespace App\Services;

use App\Models\TelPrefix;

class TelPrefixService
{
	public function __construct(TelPrefix $telPrefix)
	{
		$this->telPrefix = $telPrefix;
	}

	/**
     * Get all countries from tel_countries table with list.
     *
     * @return Response
     */
	public function getPrefixesByCountryCode($code)
	{
		return $this->telPrefix->where('country_code', $code)->orderBy('prefix', 'ASC')->get();
	}
	
}