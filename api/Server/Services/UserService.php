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
}