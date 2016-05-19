<?php

namespace Admin\Services;

use Admin\Contracts\UserInterface;
use App\Models\User;
use App\Models\Role;
use App\Models\Owner;
use Auth;

class UserService implements UserInterface
{
	/**
	 * Create a new user service instance.
	 */
	public function __construct(User $user, Role $role, Owner $owner) {
		$this->user = $user;
		$this->role = $role;
		$this->owner = $owner;
	}

	/**
	 * Create a new user service instance.
	 */
	public function createUser($input) {
		//dd('ass');
		$input['password'] = bcrypt($input['password']);
		$input['role_id'] = 5;
		$owner = $this->getOwnerByName($input['name']);
		$input['owner_id'] = $owner->id;
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

	public function getUsersRole()
	{
		// //dd(Auth::user()->role);
		// $user_role = 
		// dd($user_role);
	}
}