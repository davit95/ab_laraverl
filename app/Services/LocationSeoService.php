<?php

namespace App\Services;

use App\Models\Location_SEO;
use Cache;
use URl;
class LocationSeoService
{
	public function __construct(Location_SEO $Location_SEO)
	{
		$this->location_seo = $Location_SEO;
	}
	/**
	* @param $city;
	* @param $state;
	* @return mixed;
	* get city location seo in city,state
	*/
	public function getCityLocationSeo($city,$state,$country_code)
	{ 
		if(null != $this->location_seo->where(['City'=>$city,'State'=>$state,'Type'=>'city_category'])->first()) {
			return $this->location_seo->where(['City'=>$city,'State'=>$state,'Type'=>'city_category'])->first();
		}
		return $this->location_seo->where(['City'=>$city,'Country'=>$country_code,'Type'=>'city_category'])->first();;
	}
}