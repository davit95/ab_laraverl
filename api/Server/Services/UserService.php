<?php

namespace Api\Server\Services;
use App\User;
class UserService {
	/**
	 * Create a new oauth service instance.
	 */
	public function __construct(User $user) {
		$this->user = $user;
	}

	public function getUserById($user_id) 
	{
		return $this->user->find($user_id);
	}

	public function updateUser($user_id, $user_details)
	{
		$user = $this->getUserById($user_id);
		$user->update($user_details);
		return $user;
	}
}