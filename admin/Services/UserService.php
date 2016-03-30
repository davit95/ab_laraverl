<?php

namespace Admin\Services;

use Admin\Contracts\UserInterface;
use App\Models\User;
use App\Models\Role;
use Auth;

class UserService implements UserInterface
{
	/**
	 * Create a new user service instance.
	 */
	public function __construct(User $user, Role $role) {
		$this->user = $user;
		$this->role = $role;
	}

	/**
	 * Create a new user service instance.
	 */
	public function createUser($input) {
		$input['password'] = bcrypt($input['password']);
		return $this->user->create($input);
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