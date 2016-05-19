<?php

namespace Admin\Contracts;

interface OwnerInterface
{
	/**
	 * Set get params for filtering query result.
	 *
	 * @param $params (array)
	 * @return Response
	 */
	public function setFilterParams($params);

	/**
	 * Get a listing of the resource.
	 *
	 * @param
	 * @return Response
	 */
	public function getAllOwners();

	/**
	 * Get the specified resource.
	 *
	 * @param $id (int)
	 * @return Response
	 */
	public function getOwnerByID($id);

	/**
	 * Get params for owner create
	 *
	 * @param $params (array)
	 * @return return array
	 */
	public function getOwnerParams($params);

	/**
	 * Create new Owner
	 *
	 * @param $owner_params (array)
	 * @return return new owner
	 */
	public function createOwner($owner_params);

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $id, $params (int,array)
	 * @return return new owner
	 */
	public function updateOwner($id, $params);

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id (int)
	 * @return true
	 */
	public function destroyOwner($id);

	/**
	 * Get Regions list
	 *
	 * @param 
	 * @return regions lists array
	 */
	public function getAllRegionsLists();

	/**
	 * Get States list
	 *
	 * @param 
	 * @return states lists array
	 */
	public function getAllStatesLists();

	/**
	 * Get Countries list
	 *
	 * @param 
	 * @return countries lists array
	 */
	public function getAllCountriesLists();

	/**
	 * Get Owners
	 *
	 * @param 
	 * @return all owners
	 */
	public function getOwners();

	/**
	 * Get Owners list
	 *
	 * @param 
	 * @return all owners list
	 */
	public function getOwnersLists();
}