<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\CenterService;

use App\Services\CityService;
use App\Services\CountryService;
use App\Services\UsStateService;
use Illuminate\Http\Request;

class CentersController extends Controller {
	/**
	 * Display a home page of app.
	 *
	 * @return Response
	 */
	public function getCenterById($id, CenterService $centerService) {
		if (null != $center = $centerService->getCenterByIdAjax($id)) {
			return response()                  ->json($center);
		}
	}

	/**
	 * Autocomplete search.
	 *
	 * @return Response
	 */
	public function autocomplete(CenterService $centerService, Request $request, CountryService $countryService, CityService $cityService, UsStateService $usStateService) {
		$countries = $countryService->searchCountryByKey($request->get('q'));
		$cities    = $cityService->searchCityByKey($request->get('q'));
		$states    = $usStateService->searchStateByKey($request->get('q'));
		return response()->json(['countries' => $countries, 'cities' => $cities, 'states' => $states]);
	}
}
