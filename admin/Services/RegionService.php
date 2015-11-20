<?php

namespace Admin\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Admin\Contracts\RegionInterface;
use App\Region;

class RegionService implements RegionInterface
{
	/**
     * Create a new region service instance.
     */
	public function __construct(Region $region)
	{
		$this->region = $region;
	}

	/*
	 * Get the specified resource.
	 */
	public function getAllRegions()
	{
		return $this->region->all();
	}

	/*
	 * Get a listing of the resource.
	 */
	public function getRegionByID($id)
	{
		$region = $this->region->find($id);
		if ($region) {
			return $region;
		}
		throw new NotFoundHttpException('Invalid URL.');
	}

	/*
	 * Get a listing of the resource for html select.
	 */
	public function getAllRegionsSelectList()
	{
		return $this->region->lists('name','id')->toArray();
	}
}