<?php

namespace Admin\Services;

use Admin\Contracts\UserInterface;
use App\Models\User;
use App\Models\Role;
use App\Models\Owner;
use App\Models\City;
use App\Models\UsState;
use App\Models\Center;
use Auth;

class UserService implements UserInterface
{
	/**
	 * Create a new user service instance.
	 */
	public function __construct(User $user, Role $role, Owner $owner, Center $center, City $city, UsState $usState) {
		$this->user = $user;
		$this->role = $role;
		$this->owner = $owner;
		$this->center = $center;
		$this->city = $city;
		$this->usState = $usState;
	}

	/**
	 * Create a new user service instance.
	 */
	public function createUser($input) {
		//dd('ass');
		$input['password'] = bcrypt($input['password']);
		//dd($this->role->where('name', 'owner_user')->first()->id);
		$input['role_id'] = $this->role->where('name', 'owner_user')->first()->id;
		//dd($input);
		$owner = $this->getOwnerByName($input['name']);
		//dd($owner);
		$input['owner_id'] = $owner->id;
		//dd($input);
		return $this->user->create($input);
	}

	public function getOwnerByName($name)
	{
		return $this->owner->where('name', $name)->first();
	}


	/**
	 * get all users
	 */
	public function getAllUsers() {
		return $this->user->get();
	}

	/**
	 * search user bay firstName
	 */
	public function searchUserByFirstName($firstName)
	{
		return $this->user->where('first_name', 'LIKE', '%'.$firstName.'%')->get();
/*		if ( isset($this->filter_params['company_or_owner_name']) ) {
			$this->owner = $this->owner->where(function($owner){
				$owner->where('company_name', 'LIKE', '%'.$this->filter_params['company_or_owner_name'].'%')
					->orWhere('name', 'LIKE', '%'.$this->filter_params['company_or_owner_name'].'%');
			});
		}
		return $this->owner->orderBy('id', 'DESC')->paginate($this->per_page);*/
	}

	public function getAllCustomers($role_id)
	{
		return $this->user->where('role_id', $role_id)->get();
	}

	public function getCustomerById($id,$role_id)
	{
		if($role_id == 1) {
			return $this->user->where('id', $id)->first();
		} elseif($role_id == 3) {
			return $this->user->where('id', $id)->where('role_id', $role_id)->first();
		}
		
	}

	public function getCustomerCenterById($center_id)
	{
		return $this->center->find($center_id);
	}

	public function updateCustomer($id, $inputs)
	{
		// dd($params);
		// return $this->user->where('id', $id)->update($params);
		$inputs = \Input::except('_method', '_token');
		$city_id = $this->city->where('name', $inputs['city'])->first()->id;
		$state_id = $this->usState->where('name', $inputs['state'])->first()->id;
		$inputs['city_id'] = $city_id;
		$inputs['us_state_id'] = $state_id;
		unset($inputs['city']);
		unset($inputs['state']);
		unset($inputs['country']);
		return $this->user->where('id', $id)->update($inputs);
	}

	public function getUser($id)
	{
		return $this->user->find($id);
	}

	public function getALlCustomersByOwnerId($id) 
	{
		return $this->user->where('owner_id', $id)->get();
	}

	public function createAllianceUser($inputs, $role_id)
	{
		$inputs['role_id'] = $this->role->where('name', 'admin')->first()->id;
		$inputs['password'] = bcrypt($inputs['password']);
		return $this->user->create($inputs);
	}
}