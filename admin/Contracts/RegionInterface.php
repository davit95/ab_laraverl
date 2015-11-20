<?php

namespace Admin\Contracts;

interface RegionInterface
{
	/*
	 * Get a listing of the resource.
	 */
	public function getAllRegions();

	/*
	 * Get the specified resource.
	 */
	public function getRegionByID($id);

	/*
	 * Get a listing of the resource for html select.
	 */
	public function getAllRegionsSelectList();
}