<?php

namespace Admin\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Admin\Contracts\OwnerInterface;
use App\Models\Owner;

class OwnerService implements OwnerInterface
{
	/**
     * Create a new owner service instance.
     */
	public function __construct(Owner $owner)
	{
		$this->owner = $owner;
		$this->filter_params = [];
		$this->per_page = config('abcn.owners.pagination.per_page');
	}

	/*
	 * Set get params for filtering query result.
	 */
	public function setFilterParams($params)
	{
		$this->filter_params = $params;
	}

	/*
	 * Get a listing of the resource.
	 */
	public function getAllOwners()
	{
		if ( isset($this->filter_params['company_or_owner_name']) ) {
			$this->owner = $this->owner->where(function($owner){
				$owner->where('company_name', 'LIKE', '%'.$this->filter_params['company_or_owner_name'].'%')
					->orWhere('name', 'LIKE', '%'.$this->filter_params['company_or_owner_name'].'%');
			});
		}
		return $this->owner->orderBy('id', 'DESC')->paginate($this->per_page);
	}

	/*
	 * Get the specified resource.
	 */
	public function getOwnerByID($id)
	{
		$owner = $this->owner->find($id);
		if ($owner) {
			return $owner;
		}
		throw new NotFoundHttpException('Invalid URL.');
	}

	/*
	 * Store a newly created resource in storage.
	 */
	public function storeOwner($params)
	{
		return  $this->owner->create($params);
	}

	/*
	 * Update the specified resource in storage.
	 */
	public function updateOwner($id, $params)
	{
		$owner = $this->getOwnerByID($id);
		$owner->update($params);
		return $owner;
	}

	/*
	 * Remove the specified resource from storage.
	 */
	public function destroyOwner($id)
	{
		$owner = $this->getOwnerByID($id);
		return $owner->delete();
	}
	
}