<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\ClientService;
use App\Services\TelPrefixService;
use Illuminate\Http\Request;

class PhonesController extends Controller {
	/**
	 * Display a listing of the resource options.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getAreaCodes(Request $request, ClientService $clientService, TelPrefixService $telPrefixService) {
		$country_code = $request->get('country_code');
		if ($country_code != 1) {
			$codes = $clientService->getAreaCodes($request->get('country_code'));
			return view('phones.area-codes', ['codes' => $codes]);
		} else {
			$us_area_codes = $telPrefixService->getPrefixesByCountryCode($country_code);
			return view('phones.us-area-codes', ['codes' => $us_area_codes]);
		}
	}

	/**
	 * Display a listing of the resource options.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getAreaNumbers(Request $request, ClientService $clientService) {
		$prefix       = $request->get('prefix');
		$country_code = $request->get('country_code');
		$numbers      = $clientService->getAreaNumbersByAreaPrefix($country_code, $prefix);
		return view('phones.area-codes', ['codes' => $numbers]);
	}

	/**
	 * Display a listing of the resource options.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getTollFreeNumbers(Request $request, ClientService $clientService) {
		$prefix  = $request->get('prefix');
		$numbers = $clientService->getAreaNumbersByAreaPrefix(1, $prefix);
		//dd($numbers);
		return view('phones.area-codes', ['codes' => $numbers]);
	}
}
