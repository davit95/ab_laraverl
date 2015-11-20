<?php

namespace Admin\Contracts;

interface UsStateInterface
{
	/*
	 * Get a listing of the resource.
	 */
	public function getAllUsStates();

	/*
	 * Get the specified resource.
	 */
	public function getUsStateByID($id);

	/*
	 * Get a listing of the resource for html select.
	 */
	public function getAllUsStatesSelectList();
}