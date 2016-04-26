<?php

namespace Api\Server\Services;

use App\Models\Center;
use DB;

class LocationService {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(Center $center) {
		$this->center = $center;		
	}			

	public function getAllLocations()
	{
		$locations = $this->center->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->get();
		return $this->getNeccessaryOptions($locations);
	}

	public function getStateLocations($country_slug, $state)
	{
		$locations = $this->center->where(['country' => $country_slug, 'us_state' => $state, 'active_flag' => 'Y'])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->get();
		return $this->getNeccessaryOptions($locations);
	}

	public function getCountryLocation($country_slug)
	{
		$locations = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y'])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->get();
		return $this->getNeccessaryOptions($locations);	
	}

	public function getStateCityLocations($state, $city)
	{
		$locations = $this->center->where(['country' => 'us', 'us_state' => $state, 'active_flag' => 'Y', 'city_name' => $city])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->get();
		return $this->getNeccessaryOptions($locations);
	}

	public function getCityLocations($country_slug, $city)
	{
		$locations = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y', 'city_name' => $city])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->get();
		return $this->getNeccessaryOptions($locations);	
	}

	public function getStateCenterLocation($state, $city, $center_id)
	{
		$locations = $this->center->where(['country' => 'us', 'us_state' => $state, 'active_flag' => 'Y', 'city_name' => $city, 'id' => $center_id])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->get();
		return $this->getNeccessaryOptions($locations);
	}

	public function getCenterLocation($country_slug, $city, $center_id)
	{
		$locations = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y', 'city_name' => $city, 'id' => $center_id])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->get();
		return $this->getNeccessaryOptions($locations);	
	}

	public function getSearchForLocation($key)
	{
		
	}

	private function getNeccessaryOptions($locations)
	{
		$locationsArray = [];
		foreach ($locations as $location) {
			$temp = [
				'id'            => $location->id,
				'building_name' => $location->name,
				'address_1'     => $location->address1,
				'address_2'     => $location->address2,
				'city'          => $location->city_name,
				'state'         => $location->us_state,
				'postal_code'   => $location->postal_code,
				'country'       => $location->country,
				'latitude'      => isset($location->coordinate) ? $location->coordinate->lat : "",
				'longitude'     => isset($location->coordinate) ? $location->coordinate->lng : "",
				'tax_name'      => $location->tax_name,
				'tax_percentage'=> $location->tax_percentage,
				'images'        => [],	
				'products'      => [],				

			];			
			foreach ($location->vo_photos as $photo) {
				$tempPhoto = new \stdClass();
				$tempPhoto->name = $photo->path;
				$tempPhoto->location = "https://www.alliancevirtualoffices.com/images/locations/".$photo->name;
				$tempPhoto->type = $photo->description;				
				array_push($temp['images'], $tempPhoto);
			}			
			foreach ($location->prices as $price) {
				if($price->package_id == '103' || $price->package_id == '105'){
					$product = new \stdClass();
					$product->id   = $price->package_id;
					$product->name = $price->package->name;
					$product->price= $price->price;
					$product->type = "virtual_office";
					$product->price_type = "total";								
					array_push($temp['products'], $product);					
				}
			}			
			foreach ($location->meeting_rooms as $meeting_room) {
				$product = new \stdClass();
				$product->id = $meeting_room->id;
				$product->name = $meeting_room->name;
				$product->price = $meeting_room->hourly_rate;
				$product->type  = 'meeting_room';
				$product->price_type = 'hourly';
				array_push($temp['products'], $product);
			}
			array_push($locationsArray, $temp);
			$locationsArray['count'] = count($locations);
		}
		return $locationsArray;
	}
}