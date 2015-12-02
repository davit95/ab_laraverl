<?php

namespace App\Services;

use App\Models\CenterCoordinate;
use DB;

class CenterCoordinateService
{
	public function __construct(CenterCoordinate $centerCoordinate)
	{
		$this->centerCoordinate = $centerCoordinate;
	}

	/**
     * Get nearby centers in city.
     *
     * @return Response
     */
	public function getNearbyCentersByCityName($city_name, $radius = 25)
	{
		$google_maps_base_url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=";
		$city_map_url = $google_maps_base_url.urlencode($city_name);
		$json = file_get_contents($city_map_url);
		$data = json_decode($json, TRUE);
		if($data['status'] === 'OK')
		{
			$result = $data['results'][0]['geometry']['location'];
			$center_lat = $result['lat'];
			$center_lng = $result['lng'];
		}
		$q = DB::select( DB::raw("SELECT center_id, ( 3959 * acos( cos( radians($center_lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($center_lng) ) + sin( radians($center_lat) ) * sin( radians( lat ) ) ) ) AS distance FROM centers_coordinates HAVING distance < $radius ORDER BY distance"));
		//dd($q);
		$ids = [];
		foreach ($q as $key => $value)
		{
			$ids[] = $value->center_id;
		}

		return $ids;
	}

	/**
     * Get nearby centers by current center.
     *
     * @return Response
     */
	public function getNearbyCentersByLatLng($center_lat, $center_lng, $radius = 25)
	{
		$q = DB::select( DB::raw("SELECT center_id, ( 3959 * acos( cos( radians($center_lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($center_lng) ) + sin( radians($center_lat) ) * sin( radians( lat ) ) ) ) AS distance FROM centers_coordinates HAVING distance < $radius ORDER BY distance"));
		$ids = [];
		foreach ($q as $key => $value)
		{
			$ids[] = $value->center_id;
			$distances[$value->center_id] = $value->distance;
		}
		return ['ids' => $ids, 'distances' => $distances];
	}
}