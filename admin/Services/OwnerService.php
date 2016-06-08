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
use App\Models\Role;
use App\Models\Staff;
use App\User;

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
		Center $center,
		User $user,
		Staff $staff,
		Role $role)
	{
		$this->owner = $owner;
		$this->city = $city;
		$this->state = $state;
		$this->country = $country;
		$this->region = $region;
		$this->center = $center;
		$this->user = $user;
		$this->role = $role;
		$this->staff = $staff;
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
	public function getOwnerById($id)
	{
		$owner = $this->user->find($id);
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
		//$role_id = $this->role->where('name', 'owner_user')->first()->id;
		//dd($role_id);
		
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
		//$params['role_id'] = $role_id;

		//dd($params, 'asd');
		return $params;
	}

	public function getOwnerUserParams($params)
	{
		$role_id = $this->role->where('name', 'owner_user')->first()->id;
		$params['role_id'] = $role_id;
		$params['password'] = bcrypt($params['password']);
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
		//dd($params);
		return $params;
		//dd($params, 'params');
	}

	/**
	 * Create new Owner
	 *
	 * @param $owner_params (array)
	 * @return return new owner
	 */
	public function createOwner($owner_params)
	{
		//dd($owner_params);
		//$owner = $this->owner->create($this->getOwnerParams($owner_params));
		//dd($owner_params);
		$owner_user = $this->user->create($this->getOwnerUserParams($owner_params));
		// if($owner_user) {
		// 	$this->center->find($owner_params['center_id'])->update(['owner_id' => $owner_user->id]);

		// }

		$staffs_params = $this->getOwnerStaffsParams($owner_params);
		if(!empty($staffs_params)) {
			$staffs = $this->staff->insert($staffs_params);
		}
		if($staffs) {
			$this->user->find($owner_user->id)->staffs()->attach($this->getStaffsIds($staffs_params));
		}
		
		return $owner_user;
	}

	public function getStaffsIds($staffs_params)
	{
		$array_count = count($staffs_params);
		$max_staff_id = $this->staff->max('id');
		$ids = $this->staff->where('id', '>', $max_staff_id - $array_count)->lists('id')->toArray();
		return $ids;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $id, $params (int,array)
	 * @return return new owner
	 */
	public function updateOwner($id, $params)
	{
		$owner = $this->getOwnerById($id);
		//dd($owner, $params);
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
		return $this->owner->paginate(10);
		// $role_id = $this->role->where('name', 'owner_user')->first()->id;
		// return $this->user->where('role_id', $role_id)->get();
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

	public function getOwnersByRole($user)
	{
		//dd($user->id);
		if($user->role->name === 'super_admin') {
			$owner_role_id = $this->getUserIdByRoleName('owner_user');
			return $this->user->where('role_id', $owner_role_id)->paginate(10);
		} elseif($user->role->name === 'owner_user') {
			return $this->user->where('id', $user->id)->paginate(10);
		}
	}

	public function getOwnerByIDPaginate($id)
	{
		return $this->user->where('id', $id)->paginate(10);
	}

	public function getOwnerStaffsParams($params)
	{
		$inputs = [];
		for($i = 1; $i <= 4; $i++) {
			if(isset($params['contact_name_'.$i]) && $params['contact_name_'.$i] !== '') {
				$inputs[$i]['name'] = $params['contact_name_'.$i];
			}
			if(isset($params['title_'.$i]) && $params['title_'.$i] !== '') {
				$inputs[$i]['title'] = $params['title_'.$i];
			}
			if(isset($params['phone_1_'.$i]) && $params['phone_1_'.$i] !== '') {
				$inputs[$i]['phone_1'] = $params['phone_1_'.$i];
			}
			if(isset($params['phone_2_'.$i]) && $params['phone_2_'.$i] !== '') {
				$inputs[$i]['phone_2'] = $params['phone_2_'.$i];
			}
			if(isset($params['ext_1_'.$i]) && $params['ext_1_'.$i] !== '') {
				$inputs[$i]['ext_1'] = $params['ext_1_'.$i];
			}
			if(isset($params['ext_2_'.$i]) && $params['ext_2_'.$i] !== '') {
				$inputs[$i]['ext_2'] = $params['ext_2_'.$i];
			}
			if(isset($params['contact_email_'.$i]) && $params['contact_email_'.$i] !== '') {
				$inputs[$i]['email'] = $params['contact_email_'.$i];
			}
		}
		foreach ($inputs as $key => $input) {
			if(count($input) != 5) {
				unset($inputs[$key]);
			}
		}
		return $inputs;
	}

	public function getOwnerByIDAndRoleName($id, $role)
	{
		if($role === 'super_admin') {
			$owner = $this->user->find($id);
			if($owner) {
				return $owner;
			}
			throw new NotFoundHttpException('Invalid URL.');
		}
	}

	public function getUserIdByRoleName($role)
	{
		return $this->role->where('name', $role)->first()->id;
	}
	
}