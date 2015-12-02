<?php

namespace App\Services;

use App\Models\TelephonyPackageInclude;

class TelephonyPackageIncludeService
{
	public function __construct(TelephonyPackageInclude $telephonyPackageInclude)
	{
		$this->telephonyPackageInclude = $telephonyPackageInclude;
	}

	/**
     * Get all countries from telephony_package_include table  by center id and package id.
     *
     * @return Response
  */
	public function getByPartNumber($center_id, $package_id)
	{
    return $this->telephonyPackageInclude->where('center_id', $center_id)->where('package_id', $package_id)->get();
	}

}
