<?php

namespace Api\Server\Services;

use App\Models\Center;
use App\Models\City;
use App\Models\Country;
use App\Models\UsState;
use DB;
use Illuminate\Pagination\Paginator;
class LocationService {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(Center $center, City $city, Country $country, UsState $usState) {
		$this->center = $center;
		$this->city   = $city;
		$this->country = $country;
		$this->usState = $usState;
	}

	public function getAllLocations($per_page, $page)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
		$locations = $this->center->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->paginate($per_page);
		return $this->getNeccessaryOptions($locations);
	}

	public function getStateLocations($country_slug, $state, $per_page, $page)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
		$locations = $this->center->where(['country' => $country_slug, 'us_state' => $state, 'active_flag' => 'Y'])->with(['prices', 'telephony_includes', 'coordinate', 'local_number', 'meeting_rooms'])->paginate($per_page);
		return $this->getNeccessaryOptions($locations);
	}

	public function getCountryLocation($country_slug, $per_page, $page)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
		$locations = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y'])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->paginate($per_page);
		return $this->getNeccessaryOptions($locations);	
	}

	public function getStateCityLocations($state, $city_slug, $per_page, $page)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
	    $city = $this->city->where('slug', $city_slug)->first();
	    if(null!= $city){
	    	$city_name = $city->name;
	    }
		$locations = $this->center->where(['country' => 'us', 'us_state' => $state, 'active_flag' => 'Y', 'city_name' => $city_name])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->paginate($per_page);
		return $this->getNeccessaryOptions($locations);
	}

	public function getCityLocations($country_slug, $city_slug, $per_page, $page)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
	    if(null!= $city){
	    	$city_name = $city->name;
	    }
		$locations = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y', 'city_name' => $city_name])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->get();
		return $this->getNeccessaryOptions($locations);
	}

	public function getStateCenterLocation($state, $city, $center_id, $per_page, $page)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
		$locations = $this->center->where(['country' => 'US', 'us_state' => $state, 'active_flag' => 'Y', 'city_name' => $city, 'id' => $center_id])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->paginate($per_page);
		return $this->getNeccessaryOptions($locations);
	}

	public function getCenterLocation($country_slug, $city, $center_id)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
		$locations = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y', 'city_name' => $city, 'id' => $center_id])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms'])->paginate($per_page);
		return $this->getNeccessaryOptions($locations);
	}

	public function getSearchLocation($key)
	{
		$searchResult = [];
		$usCities = $this->city->where('name', 'LIKE', '%'.$key.'%')->where('country_code', 'US')->distinct('name')->whereHas('centers', function($query){
				$query->where('active_flag', 'Y');
			})->get(['name', 'id', 'us_state_code', 'slug'])->toArray();		
		$searchResult = array_merge($searchResult, $usCities);
		$cities = $this->city->where('name', 'LIKE', '%'.$key.'%')->whereNull('us_state_code')->distinct('name')->whereHas('centers', function($query){
				$query->where('active_flag', 'Y');
			})->get(['name', 'id', 'country_code', 'slug'])->toArray();
		$searchResult = array_merge($searchResult, $cities);
		$countries = $this->country->where('name', 'LIKE', '%'.$key.'%')->distinct('name')->get(['name', 'id', 'code'])->toArray();
		$searchResult = array_merge($searchResult, $countries);
		$locations = $this->center->where('name', 'LIKE', '%'.$key.'%')->where('active_flag', 'Y')->get(['name', 'id', 'country', 'city_name', 'us_state']);
		foreach ($locations as $location) {
			$location->type = 'vo';
		}
		$searchResult = array_merge($searchResult, $locations->toArray());
		$us_states = $this->usState->where('name', 'LIKE', '%'.$key.'%')->get(['name', 'id', 'code']);
		foreach ($us_states as $state) {
			$state->type = 'state';
		}
		$searchResult = array_merge($searchResult, $us_states->toArray());	
		return $searchResult;
	}	
	
	public function getCenterOwnerEmail($center_id)
	{
		$center = $this->center->find($center_id);
		$owner = $center->owner;		
		if(null!== $owner){
			return $owner->email;
		}
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
				'city_slug'     => $location->city->slug,
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