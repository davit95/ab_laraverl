<?php

namespace App\Services;

use App\Models\Center;
use mikehaertl\pdftk\Pdf;
use mikehaertl\pdftk\FdfFile;
use DateTime;

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
		//dd($id);
		//session(['centerid' => $this->center->find($id)]);
		return $this->center->find($id);
	}

	public function downloadPdf($params)
	{
		$dt = new DateTime();
		$pdf = new Pdf(public_path().'/pdf/CMRA-form.pdf');
		$rand_name = str_random(30).".pdf";
		$pdf->fillForm(array(
			'untitled1'=> $dt->format('Y-m-d H:i:s'),
			'untitled2'=> $params['first_name'],
			'untitled3'=> $params['address1'],
			'untitled4'=> $params['city'],
			'untitled4'=> $params['state'],
			'untitled5'=> $params['postal_code'],
			'untitled6'=> $params['address1'],
			'untitled7'=> $params['city'],
			'untitled8'=> $params['address1'],
			'untitled8'=> $params['postal_code'],
			'untitled9'=> $params['first_name'].$params['last_name'],
			'untitled10'=> $params['city'],
			'untitled11'=> $params['state'],
			'untitled12'=> $params['postal_code'],
			'untitled13'=> $params['phone'],
			'untitled14'=> $params['city'],
			'untitled15'=> $params['address1'],
			'untitled16'=> $params['city'],
			'untitled17'=> $params['state'],
			'untitled18'=> $params['postal_code'],
			'untitled19'=> $params['phone'],
			))
   			->needAppearances()
   			->saveAs(public_path().'/pdf/'.$rand_name);
   		$result = $pdf->send(public_path().'/pdf/'.$rand_name);
   		\File::delete(public_path().'/pdf/'.$rand_name);
	}
}
