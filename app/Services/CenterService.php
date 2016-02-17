<?php

namespace App\Services;

use App\Models\Center;

class CenterService {
	public function __construct(Center $center) {
		$this->center = $center;
	}

	/**
	 * Get all virtual offices by city id from centers table.
	 *
	 * @return Response
	 */
	public function getVirtualOfficesByCityId($id) {
		return $this->filteredVirtualOffice()->where('city_id', $id)->get();
	}

	public function getVirtualOfficeById($center_id) {
		return $this->filteredVirtualOffice()->where('id', $center_id)->first();
	}

	/**
	 * Get all meeting rooms by city id from centers table.
	 *
	 * @return Response
	 */
	public function getMeetingRoomsByCityId($id) {
		return $this->filteredMeetingRoom()->where('city_id', $id)->get();
	}

	/**
	 * Get all virtual offices by given array of ids.
	 *
	 * @param $ids (array)
	 * @return Response
	 */
	public function getVirtualOfficesByIds($ids) {
		return $this->filteredVirtualOffice()->whereIn('id', $ids)->get();
	}

	/**
	 * Get all meeting rooms by given array of ids.
	 *
	 * @param $ids (array)
	 * @return Response
	 */
	public function getMeetingRoomsByIds($ids) {
		return $this->filteredMeetingRoom()->whereIn('id', $ids)->get();
	}



	/**
	 * Get center by given id.
	 *
	 * @param $id (int)
	 * @return Response
	 */
	public function getCenterByIdAjax($id) {
		return $this->center->where('id', $id)->with('vo_photos')->first();
	}

	/**
	 * Get center by given id.
	 *
	 * @param $id (int)
	 * @return m_responsekeys(conn, identifier)
	 */
	public function getMeetingRoomPrice($center_id, $mr_id) {
		$center = $this->center->where('id', $center_id)->first();
		return $meeting_rooms = $center->meeting_rooms->where('id', (int)$mr_id)->first()->hourly_rate;
	}


	/**
	 * Get center by given slug.
	 *
	 * @param (string) $country_code, (string) $city_slug, (string) $center_slug
	 * @return Response
	 */
	public function getVirtualOfficeByCenterSlug($country_code, $city_slug, $center_slug, $center_id) {
		return $this->filteredVirtualOffice()
		            ->where('country', $country_code)
		            ->whereHas('city', function ($q) use ($city_slug) {
				$q->where('slug', $city_slug);
			})
			->where('slug', $center_slug)->where('id', $center_id)->first();
	}

	/**
	 * Get center by given slug.
	 *
	 * @param (string) $country_code, (string) $city_slug, (string) $center_slug
	 * @return Response
	 */
	public function getMeetingRoomByCenterSlug($country_code, $city_slug, $center_slug, $center_id) {
		return $this->filteredMeetingRoom()
		            ->where('country', $country_code)
		            ->whereHas('city', function ($q) use ($city_slug) {
				$q->where('slug', $city_slug);
			})
			->where('slug', $center_slug)->where('id', $center_id)->first();
	}

	/**
	 * Filter for virtuall office before any query.
	 *
	 * @return Response
	 */
	private function filteredVirtualOffice() {
		return $this->center
		            ->where('active_flag', 'Y')
		            ->where('city_id', '!=', 0)
		            ->where(function ($q) {
				$q->whereHas('center_filter', function ($q) {
						$q->where('virtual_office', 1);
					})->orWhere(function ($q) {
						$q->has('center_filter', '<', 1);
					});
			});
	}

	/**
	 * Filter for meeting room before any query.
	 *
	 * @return Response
	 */
	private function filteredMeetingRoom() {
		return $this->center
		            ->where('active_flag', 'Y')
		            ->where('city_id', '!=', 0)
		            ->where(function ($q) {
				$q->whereHas('center_filter', function ($q) {
						$q->where('meeting_room', 1);})->orWhere(function ($q) {
						$q->has('center_filter', '<', 1);
					});
			});
	}

	/**
	 * get center
	 *
	 * @return Response
	 */
	public function getCenterById($id)
	{
		return $this->center->find($id);
	}
}
