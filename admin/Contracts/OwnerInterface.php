<?php

namespace Admin\Contracts;

interface OwnerInterface
{
	/*
	 * Get a listing of the resource.
	 */
	public function getAllOwners();

	/*
	 * Get the specified resource.
	 */
	public function getOwnerByID($id);

	/*
	 * Store a newly created resource in storage.
	 */
	public function storeOwner($params);

	/*
	 * Update the specified resource in storage.
	 */
	public function updateOwner($id, $params);

	/*
	 * Remove the specified resource from storage.
	 */
	public function destroyOwner($id);
}