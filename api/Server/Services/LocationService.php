<?php

namespace Api\Server\Services;

use App\Models\Center;
use App\Models\City;
use App\Models\Country;
use App\Models\UsState;
use App\Models\Site;
use DB;
use Illuminate\Pagination\Paginator;
use App\Services\CenterCoordinateService;
use App\Services\CenterService;
class LocationService {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(Center $center, City $city, Country $country, UsState $usState, CenterCoordinateService $centerCoordinateService, CenterService $centerService, Site $site) {
		$this->center = $center;
		$this->city   = $city;
		$this->country = $country;
		$this->usState = $usState;
		$this->centerCoordinateService = $centerCoordinateService;
		$this->centerService = $centerService;
		$this->site = $site;
	}

	public function getLocationsByOwnerId($owner_id)
	{
		$locations = $this->center
					->where('owner_user_id', $owner_id)
					->where('active_flag', 'Y')
					->get();
		return $locations;
	}

	public function getOwnerLocationById($id, $owner_id)
	{
		$location = $this->center
					->where('id', $id)
					->where('owner_user_id', $owner_id)
					->where('active_flag', 'Y')
					->first();
		return $location;		
	}

	public function addLocation($inputs)
	{
		$site = $this->site->where('name', 'allwork')->first();
		$site_id = isset($site) ? $site->id : null;
		$center = $this->center->create($inputs);
		$center->sites()->attach($site_id);
		return $center;		
	}

	public function getLocationById($id)
	{		
		$location = $this->center->where('id', $id)->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms', 'options', 'space_types'])->get();
		$nearby = isset($nearby);
		$options = isset($options);
		$description = isset($description);
		return $this->getNeccessaryOptions($location, $nearby, $options, $description);
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

	public function getAllCountries()
	{		
		$countries = $this->country->whereHas('active_cities', function($query){})->get(['name', 'code']);
		return $countries;
	}

	public function getAllStates()
	{
		$states = $this->usState->whereHas('active_cities', function($query){})->get(['name', 'code']);
		return $states;
	}

	public function getStateLocations($country_slug, $state, $nearby, $options, $per_page, $page)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
	    $locations = $this->center->join('center_prices','centers.id','=','center_prices.center_id')	    
	    ->where(function($query){
	    	$query->where('center_prices.package_id', '103')
	    	->where('center_prices.price', '<>', '0')
	    	->orWhere(['center_prices.package_id' => '105']);	    	
	    })
	    ->where(['centers.country' => $country_slug, 'centers.us_state' => $state, 'centers.active_flag' => 'Y'])
	    ->with(['prices', 'city', 'telephony_includes', 'coordinate', 'local_number', 'meeting_rooms', 'options'])
	    ->groupBy('centers.id')
	    ->select(['centers.*'])
	    ->orderBy('center_prices.price', 'asc')
	    ->paginate($per_page);
		// $locations = $this->center->where(['country' => $country_slug, 'us_state' => $state, 'active_flag' => 'Y'])->with(['prices', 'telephony_includes', 'coordinate', 'local_number', 'meeting_rooms'])->paginate($per_page);		
		if(isset($nearby) && isset($options)){
			return $this->getNeccessaryOptions($locations, true, true);
		}else if(isset($nearby)){
			return $this->getNeccessaryOptions($locations, true);
		}else{
			return $this->getNeccessaryOptions($locations, false, true);
		}
		return $this->getNeccessaryOptions($locations);
	}

	public function getCountryLocations($country_slug, $nearby, $options, $per_page, $page)
	{
		$page = isset($page) ? $page : 1;
		$per_page = isset($per_page) ? $per_page : 10;
		Paginator::currentPageResolver(function () use ($page) {
		    return $page;
	    });
	    $locations = $this->center->join('center_prices','centers.id','=','center_prices.center_id')	    
	    ->where(function($query){
	    	$query->where('center_prices.package_id', '103')
	    	->where('center_prices.price', '<>', '0')
	    	->orWhere(['center_prices.package_id' => '105']);	    	
	    })
	    ->where(['centers.country' => $country_slug, 'centers.active_flag' => 'Y'])
	    ->with(['prices', 'city', 'telephony_includes', 'coordinate', 'local_number', 'meeting_rooms', 'options'])	    
	    ->groupBy('centers.id')
	    ->select(['centers.*'])
	    ->orderBy('center_prices.price', 'asc')
	    ->paginate($per_page);	    
		// $locations = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y'])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms', 'options'])->paginate($per_page);
		if(isset($nearby) && isset($options)){
			return $this->getNeccessaryOptions($locations, true, true);
		}else if(isset($nearby)){
			return $this->getNeccessaryOptions($locations, true);
		}else if(isset($options)){
			return $this->getNeccessaryOptions($locations, false, true);
		}
		return $this->getNeccessaryOptions($locations);
	}

	public function getStateCityLocations($state, $city_slug, $nearby, $options, $per_page, $page)
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
	    $locations = $this->center->join('center_prices','centers.id','=','center_prices.center_id')
	    ->where(function($query){
	    	$query->where('center_prices.package_id', '103')
	    	->where('center_prices.price', '<>', '0')
	    	->orWhere(['center_prices.package_id' => '105']);
	    })
	    ->where(['centers.country' => 'us', 'centers.us_state' => $state, 'centers.active_flag' => 'Y', 'centers.city_name' => $city_name])
	    ->with(['prices', 'city', 'telephony_includes', 'coordinate', 'local_number', 'meeting_rooms', 'options'])
	    ->groupBy('centers.id')
	    ->orderBy('center_prices.price', 'asc')
	    ->select(['centers.*'])
	    ->paginate($per_page);
	    
		// $locations = $this->center->where(['country' => 'us', 'us_state' => $state, 'active_flag' => 'Y', 'city_name' => $city_name])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms', 'options'])->paginate($per_page);
		if(isset($nearby) && isset($options)){
			return $this->getNeccessaryOptions($locations, true, true);	
		}else if(isset($nearby)){
			return $this->getNeccessaryOptions($locations, true);
		}else{
			return $this->getNeccessaryOptions($locations, false, true);
		}
		return $this->getNeccessaryOptions($locations);
	}

	public function getCityLocations($country_slug, $city_slug, $nearby, $options, $per_page, $page)
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
	    $locations = $this->center->join('center_prices','centers.id','=','center_prices.center_id')	    
	    ->where(function($query){
	    	$query->where('center_prices.package_id', '103')
	    	->where('center_prices.price', '<>', '0')
	    	->orWhere(['center_prices.package_id' => '105']);
	    })
	    ->where(['centers.country' => $country_slug, 'centers.active_flag' => 'Y', 'centers.city_name' => $city_name])
	    ->with(['prices', 'city', 'telephony_includes', 'coordinate', 'local_number', 'meeting_rooms', 'options'])
	    ->groupBy('centers.id')
	    ->orderBy('center_prices.price', 'asc')
	    ->select(['centers.*'])
	    ->paginate($per_page);
		// $locations = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y', 'city_name' => $city_name])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms', 'options'])->get();
		if(isset($nearby) && isset($options)){
			return $this->getNeccessaryOptions($locations, true, true);	
		}else if(isset($nearby)){
			return $this->getNeccessaryOptions($locations, true);
		}else{
			return $this->getNeccessaryOptions($locations, false, true);
		}
		return $this->getNeccessaryOptions($locations);
	}

	public function getStateCenterLocation($state, $city_slug, $center_id, $nearby, $options, $description)
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
		$location = $this->center->where(['country' => 'US', 'us_state' => $state, 'active_flag' => 'Y', 'city_name' => $city_name, 'id' => $center_id])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms', 'options', 'space_types'])->paginate($per_page);
		$nearby = isset($nearby);
		$options = isset($options);
		$description = isset($description);
		return $this->getNeccessaryOptions($location, $nearby, $options, $description);
	}

	public function getCenterLocation($country_slug, $city_slug, $center_id, $nearby, $options, $description)
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
		$location = $this->center->where(['country' => $country_slug, 'active_flag' => 'Y', 'city_name' => $city_name, 'id' => $center_id])->with(['prices','telephony_includes','coordinate','local_number', 'meeting_rooms', 'options', 'description', 'space_types'])->paginate($per_page);
		$nearby = isset($nearby);
		$options = isset($options);
		$description = isset($description); 		
		return $this->getNeccessaryOptions($location, $nearby, $options, $description);		
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
		$locations = $this->center
					->where(function($query) use ($key){
						$query->where('name', 'LIKE', '%'.$key.'%')->where('active_flag', 'Y');
					})
					->orWhere(function($query) use ($key){
						$query->where('postal_code', 'LIKE', '%'.$key.'%')->where('active_flag', 'Y');
					})
					->with('city')
					->get(['name', 'id', 'city_id', 'country', 'city_name', 'us_state']);					
		foreach ($locations as $location) {
			$location->city_slug = isset($location->city) ? $location->city->slug : '';
			unset($location->city);
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
	
	public function getSearchLocationByCountry($country_slug, $key)
	{
		$searchResult = [];
		if($country_slug == 'US'){
			$usCities = $this->city->where('name', 'LIKE', '%'.$key.'%')->where('country_code', 'US')->distinct('name')->whereHas('centers', function($query){
					$query->where('active_flag', 'Y');
				})->get(['name', 'id', 'us_state_code', 'slug'])->toArray();		
			$searchResult = array_merge($searchResult, $usCities);
			$us_states = $this->usState->where('name', 'LIKE', '%'.$key.'%')->get(['name', 'id', 'code']);
			foreach ($us_states as $state) {
				$state->type = 'state';
			}
			$searchResult = array_merge($searchResult, $us_states->toArray());
		}else{
			$cities = $this->city->where('name', 'LIKE', '%'.$key.'%')->where('country_code', $country_slug)->whereNull('us_state_code')->distinct('name')->whereHas('centers', function($query){
					$query->where('active_flag', 'Y');
				})->get(['name', 'id', 'country_code', 'slug'])->toArray();
			$searchResult = array_merge($searchResult, $cities);
		}
		$locations = $this->center->where('name', 'LIKE', '%'.$key.'%')->where('active_flag', 'Y')->where('country', $country_slug)->get(['name', 'id', 'country', 'city_name', 'us_state']);
		foreach ($locations as $location) {
			$location->type = 'vo';
		}
		$searchResult = array_merge($searchResult, $locations->toArray());
		return $searchResult;
	}

	public function getSearchLocationBySpaceType($type, $key)
	{		
	    $searchResult = [];
	    $usCities = $this->city->where('name', 'LIKE', '%'.$key.'%')
	    						->where('country_code', 'US')
	    						->distinct('name')
	    						->whereHas('centers', function($query) use ($type){
						    		$query->where('active_flag', 'Y');
						    		$query->whereHas('space_types', function($q)  use ($type){
						    			$q->where('type', $type);
						    		});
						    	})->get(['name', 'id', 'us_state_code', 'slug'])->toArray();		
	    $searchResult = array_merge($searchResult, $usCities);
	    $cities = $this->city->where('name', 'LIKE', '%'.$key.'%')
	    					->whereNull('us_state_code')
	    					->distinct('name')
	    					->whereHas('centers', function($query) use ($type){
					    		$query->where('active_flag', 'Y');
					    		$query->whereHas('space_types', function($q) use ($type){
					    			$q->where('type', $type);
					    		});
					    	})->get(['name', 'id', 'country_code', 'slug'])->toArray();
	    $searchResult = array_merge($searchResult, $cities);
	    $countries = $this->country
	    				  ->where('name', 'LIKE', '%'.$key.'%')
	    				  ->whereHas('centers', function($query) use ($type){
					    		$query->where('active_flag', 'Y');
					    		$query->whereHas('space_types', function($q) use ($type){
					    			$q->where('type', $type);
					    		});
					       })
	    				  ->distinct('name')
	    				  ->get(['name', 'id', 'code'])->toArray();
	    $searchResult = array_merge($searchResult, $countries);
	    $locations = $this->center
	    			->where(function($query) use ($key, $type){
	    				$query->where('name', 'LIKE', '%'.$key.'%')
	    				->where('active_flag', 'Y')
	    				->whereHas('space_types', function($q) use ($type){
	    					$q->where('type', $type);
	    				});
	    			})
	    			->orWhere(function($query) use ($key, $type){
	    				$query->where('postal_code', 'LIKE', '%'.$key.'%')
	    				->where('active_flag', 'Y')
	    				->whereHas('space_types', function($q) use ($type){
	    					$q->where('type', $type);
	    				});
	    			})
	    			->with('city')
	    			->get(['name', 'id', 'city_id', 'country', 'city_name', 'us_state']);					
	    foreach ($locations as $location) {
	    	$location->city_slug = isset($location->city) ? $location->city->slug : '';
	    	unset($location->city);
	    	$location->type = 'vo';
	    }
	    $searchResult = array_merge($searchResult, $locations->toArray());
	    $us_states = $this->usState
	                      ->where('name', 'LIKE', '%'.$key.'%')
	                      ->whereHas('centers', function($query) use ($type){
					    		$query->where('active_flag', 'Y');
					    		$query->whereHas('space_types', function($q)  use ($type){
					    			$q->where('type', $type);
					    		});
					       })
	                      ->get(['name', 'id', 'code']);
	    foreach ($us_states as $state) {
	    	$state->type = 'state';
	    }
	    $searchResult = array_merge($searchResult, $us_states->toArray());	
	    return $searchResult;
	}

	public function getSearchCity($key, $country = null, $state = null)
	{
		$query = ['active' => 1];
		$query = isset($country) ? array_merge($query, ['country_code' => $country]) : $query;
		$query = isset($state) ? array_merge($query, ['us_state_code' => $state]) : $query;		
		$cities = $this->city
				->where($query)
				->where('name', 'like', '%'.$key.'%')
				->get(['name', 'slug', 'id']);
		return $cities;
	}

	public function getCenterOwnerEmail($center_id)
	{
		$center = $this->center->find($center_id);
		$owner = $center->owner_user;		
		if(null!== $owner){
			return $owner->email;
		}
	}

	private function getNeccessaryOptions($locations, $nearby = false, $options = false, $description = false)
	{	
		$locationsArray = [];
		foreach ($locations as $location) {			
			$temp = [
				'id'            => $location->id,
				'building_name' => $location->name,
				'address_1'     => $location->address1,
				'address_2'     => $location->address2,
				'city'          => $location->city_name,
				'company_name'  => $location->company_name,
				'city_slug'     => null!= $location->city ? $location->city->slug : '',
				'state'         => $location->us_state,
				'postal_code'   => $location->postal_code,
				'country'       => $location->country,
				'latitude'      => isset($location->coordinate) ? $location->coordinate->lat : "",
				'longitude'     => isset($location->coordinate) ? $location->coordinate->lng : "",
				'tax_name'      => $location->tax_name,
				'tax_percentage'=> $location->tax_percentage,
				'images'        => [],	
				'products'      => [],			
				'space_types'      => [],			

			];			
			foreach ($location->vo_photos as $photo) {
				$tempPhoto = new \stdClass();
				$tempPhoto->name = $photo->path;
				$tempPhoto->location = "https://www.alliancevirtualoffices.com/images/locations/".$photo->name;
				$tempPhoto->type = $photo->description;				
				array_push($temp['images'], $tempPhoto);
			}
			foreach ($location->space_types as $type) {				
				array_push($temp['space_types'], $type);
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

			if($options){
				$temp['center_options'] = $location->options;	
			}
			if($description){
				$temp['description'] = isset($location->description) ? $location->description->avo_description : '';
			}
			if($nearby){
				$temp['nearby_centers'] = $this->getNearByCenters($temp['id'], $temp['latitude'], $temp['longitude']);				
			}			
			array_push($locationsArray, $temp);
			$locationsArray['count'] = count($locations);
		}
		return $locationsArray;
	}

	private function getNearByCenters($id, $lat, $lng)
	{
		$centers = [];		
		$nearby_centers_ids = $this->centerCoordinateService->getNearbyCentersByLatLng($lat, $lng);
		foreach ($nearby_centers_ids['ids'] as $key => $center_id) {
			if($center_id == $id){
				unset($nearby_centers_ids['ids'][$key]);
				unset($nearby_centers_ids['distances'][$id]);
			}						
		}		
		$nearby_centers     = $this->centerService->getVirtualOfficesByIds($nearby_centers_ids['ids']);
		foreach ($nearby_centers as $k => $v) {
			$nearby_centers[$k]->distance = round($nearby_centers_ids['distances'][$v->id], 2);
		}				
		$nearby_centers = $nearby_centers->sortBy('distance');
		foreach ($nearby_centers as $nearby_center) {
			$center = new \stdClass();
			$center->id            = $nearby_center->id;
			$center->building_name = $nearby_center->name;
			$center->address_1     = $nearby_center->address1;
			$center->address_2     = $nearby_center->address2;
			$center->city          = $nearby_center->city_name;
			$center->city_slug     = $nearby_center->city->slug;
			$center->state         = $nearby_center->us_state;
			$center->postal_code   = $nearby_center->postal_code;
			$center->country       = $nearby_center->country;
			$center->latitude      = isset($nearby_center->coordinate) ? $nearby_center->coordinate->lat : "";
			$center->longitude     = isset($nearby_center->coordinate) ? $nearby_center->coordinate->lng : "";
			$center->tax_name      = $nearby_center->tax_name;
			$center->company_name  = $nearby_center->company_name;
			$center->tax_percentage= $nearby_center->tax_percentage;
			$center->distance      = $nearby_center->distance;
			$center->image         = null !== $nearby_center->vo_photos()->first() ? "https://www.alliancevirtualoffices.com/images/locations/".$nearby_center->vo_photos()->first()->path : "";			
			array_push($centers, $center);
		}
		return $centers;
	}
}