<?php

namespace Api\Server\Services;
use App\Models\Center;
use App\Models\AllworkRequestDetail;

class RequestDetailService {
	/**
	 * Create a new oauth service instance.
	 */
	public function __construct(Center $center, AllworkRequestDetail $requestDetail) {
		$this->center = $center;
		$this->requestDetail = $requestDetail;
	}

	public function store($center_ids, $inputs)
	{
		unset($inputs['_token'], $inputs['accessToken'], $inputs['center_ids'], $inputs['refresh_token']);		
		$ids = $this->center->whereIn('id', $center_ids)->lists('owner_id', 'id')->toArray();
		$details = [];		
		foreach ($center_ids as $id) {			
			$tmp = $inputs;			
			$tmp['center_id']  = $id;
			$tmp['owner_id']   = $ids[$id];			
			$tmp['created_at'] = date('Y-m-d H:i:s');
			$tmp['updated_at'] = date('Y-m-d H:i:s');
			$details[] = $tmp;
		}
		dd($details);
		$this->requestDetail->insert($details);
	}
}