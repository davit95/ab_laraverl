<?php

namespace Admin\Services;

use Admin\Contracts\CenterInterface;

use App\Models\Center;

class CenterService implements CenterInterface {
	/**
	 * Create a new center service instance.
	 */
	public function __construct(Center $center) {
		$this->center = $center;
	}

	/*
	 * Store a newly created resource in storage.
	 */
	public function storeCenter($params) {
		return $this->center->create($params);
	}
}