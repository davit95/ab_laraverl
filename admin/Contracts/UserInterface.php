<?php

namespace Admin\Contracts;

interface UserInterface
{
	/**
	 * Create a new user
	 */
	public function createUser($input);

	/**
	 * get all users
	 */
	public function getAllUsers();

	/**
	 * search user bay firstName
	 */
	public function searchUserByFirstName($firstName);
}