<?php

namespace Admin\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Admin\Contracts\UsStateInterface;
use App\Models\UsState;

class UsStateService implements UsStateInterface
{
	/**
     * Create a new usState service instance.
     */
	public function __construct(UsState $usState)
	{
		$this->usState = $usState;
	}

	/*
	 * Get a listing of the resource.
	 */
	public function getAllUsStates()
	{
		return $this->usState->all();
	}

	/*
	 * Get the specified resource.
	 */
	public function getUsStateByID($id)
	{
		$usState = $this->usState->find($id);
		if ($usState) {
			return $usState;
		}
		throw new NotFoundHttpException('Invalid URL.');
	}

	/*
	 * Get a listing of the resource for html select.
	 */
	public function getAllUsStatesSelectList()
	{
		return $this->usState->lists('name','id')->toArray();
	}
}