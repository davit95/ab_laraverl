<?php

namespace Admin\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Admin\Contracts\OwnerInterface;
use App\Models\Owner;
use App\Models\City;
use App\Models\Country;
use App\Models\UsState;
use App\Models\Region;
use App\Models\Center;

class OwnerService implements OwnerInterface
{
	/**
     * Create a new owner service instance.
     */
	public function __construct(
								Owner $owner, 
								City $city, 
								Country $country, 
								UsState $state, 
								Region $region,
								Center $center)
	{
		$this->owner = $owner;
		$this->city = $city;
		$this->state = $state;
		$this->country = $country;
		$this->region = $region;
		$this->center = $center;
		$this->filter_params = [];
		$this->per_page = config('abcn.owners.pagination.per_page');
	}

	/**
	 * Set get params for filtering query result.
	 *
	 * @param $params (array)
	 * @return Response
	 */
	public function setFilterParams($params)
	{
		$this->filter_params = $params;
	}

	/**
	 * Get a listing of the resource.
	 *
	 * @param
	 * @return Response
	 */
	public function getAllOwners()
	{
		if ( isset($this->filter_params['company_or_owner_name']) ) {
			$this->owner = $this->owner->where(function($owner){
				$owner->where('company_name', 'LIKE', '%'.$this->filter_params['company_or_owner_name'].'%')
					->orWhere('name', 'LIKE', '%'.$this->filter_params['company_or_owner_name'].'%');
			});
		}
		return $this->owner->orderBy('id', 'DESC')->paginate($this->per_page);
	}

	/**
	 * Get the specified resource.
	 *
	 * @param $id (int)
	 * @return Response
	 */
	public function getOwnerByID($id)
	{
		$owner = $this->owner->find($id);
		if ($owner) {
			return $owner;
		}
		throw new NotFoundHttpException('Invalid URL.');
	}

	/**
	 * Get params for owner create
	 *
	 * @param $params (array)
	 * @return return array
	 */
	public function getOwnerParams($params)
	{
		//dd($params);
		$country_id = $this->country->where('name', $params['country'])->first()->id;
		$state_id = $this->state->where('name', $params['us_state'])->first()->id;
		$region_id = $this->region->where('name', $params['region'])->first()->id;
		$city_id = $this->city->where('country_id', $country_id)->
								where('us_state_id', $state_id)->
								where('name', $params['city'])->first()->id;

		$params['us_state_id'] = $state_id;
		$params['city_id'] = $city_id;
		$params['country_id'] = $country_id;
		$params['region_id'] = $region_id;

		return $params;
	}

	/**
	 * Create new Owner
	 *
	 * @param $owner_params (array)
	 * @return return new owner
	 */
	public function createOwner($owner_params)
	{
		$owner = $this->owner->create($this->getOwnerParams($owner_params));
		if($owner) {
			$this->center->find($owner_params['center_id'])->update(['owner_id' => $owner->id]);	
		}
		return $owner;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $id, $params (int,array)
	 * @return return new owner
	 */
	public function updateOwner($id, $params)
	{
		$owner = $this->getOwnerByID($id);
		$owner->update($params);
		return $owner;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id (int)
	 * @return true
	 */
	public function destroyOwner($id)
	{
		$owner = $this->getOwnerByID($id);
		return $owner->delete();
	}

	/**
	 * Get Regions list
	 *
	 * @param 
	 * @return regions lists array
	 */
	public function getAllRegionsLists()
	{
		return $this->region->lists('name', 'name')->toArray();
	}

	/**
	 * Get States list
	 *
	 * @param 
	 * @return states lists array
	 */
	public function getAllStatesLists()
	{
		return $this->state->lists('name', 'name')->toArray();
	}

	/**
	 * Get Countries list
	 *
	 * @param 
	 * @return countries lists array
	 */
	public function getAllCountriesLists()
	{
		return $this->country->lists('name', 'name')->toArray();
	}

	/**
	 * Get Owners
	 *
	 * @param 
	 * @return all owners
	 */
	public function getOwners()
	{
		return $this->owner->get();
	}

	/**
	 * Get Owners list
	 *
	 * @param 
	 * @return all owners list
	 */
	public function getOwnersLists()
	{
		return $this->owner->lists('name', 'name')->toArray();
	}
	
}