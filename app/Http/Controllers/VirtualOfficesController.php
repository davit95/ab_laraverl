<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\CenterCoordinateService;
use Illuminate\Http\Request;
use App\Services\CenterService;
use App\Services\CityService;
use App\Services\CountryService;
use App\Services\TelephonyPackageIncludeService;
use App\Services\UsStateService;
use App\Services\LocationSeoService;
class VirtualOfficesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(UsStateService $usStateService, CountryService $countryService) {
		return view('virtual-offices.index', ['states' => $usStateService->getAllStates(), 'countries' => $countryService->getAllCountries()]);
	}

	/**
	 * Display countrie's centers, and cities listing.
	 *
	 * @return Response
	 */
	public function getCountryVirtualOffices($country_slug, CountryService $countryService, UsStateService $usStateService, CityService $cityService, TelephonyPackageIncludeService $telephonyPackageIncludeService) {
		if (null != $state = $usStateService->getStateBySlug($country_slug)) {
			$active_cities = $cityService->getStateActiveCitiesWithPagination($state->id);
			foreach ($active_cities as $city) {
				foreach ($city->active_virtual_offices as $center) {
					$center->packages_arr           = $this->packages($center);
					$center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
				}
			}
			return view('virtual-offices.state-virtual-offices-list', ['state' => $state, 'active_cities' => $active_cities]);
		} elseif (null != $country = $countryService->getCountryBySlug($country_slug)) {
			$active_cities = $cityService->getCountryActiveCitiesWithPagination($country->id);
			foreach ($active_cities as $city) {
				foreach ($city->active_virtual_offices as $center) {
					$center->packages_arr           = $this->packages($center);
					$center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
				}
			}
			return view('virtual-offices.country-virtual-offices-list', ['country' => $country, 'active_cities' => $active_cities]);
		}
	}
	
	/** old
	 * Display citie's centers.
	 *
	 * @return Response
	 */
	public function getCityVirtualOffices($country_code, $city_slug, $city_id , CenterService $centerService, CityService $cityService, CenterCoordinateService $centerCoordinateService, TelephonyPackageIncludeService $telephonyPackageIncludeService , Request $request) {		
		if (null != $city = $cityService->getCityByCountryCodeAndCitySlug($country_code, $city_slug, $city_id)) {
			$centers           = $centerService->getVirtualOfficesByCityId($city->id);
			$center_ids        = $centers->lists('id')->toArray();
			$nearby_center_ids = $centerCoordinateService->getNearbyCentersByCityName($city->name);
			$request_ids       = array_diff($nearby_center_ids, $center_ids);
			$nearby_centers = $centerService->getVirtualOfficesByIds($request_ids);
			$center_addresses_for_google_maps = [];
			$google_maps_center_city          = $city->name;
			foreach ($centers as $key => $center) {
				$center_addresses_for_google_maps[] =
				[
					'address' => $center->address1.' '.$center->address2.' '.$center->postal_code,
					'id'      => $center->id
				];
				$center->packages_arr           = $this->packages($center);
				$center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
			}
			foreach ($nearby_centers as $key => $center) {
				$center_addresses_for_google_maps[] =
				[
					'address' => $center->address1.' '.$center->address2.' '.$center->postal_code,
					'id'      => $center->id
				];
				$center->packages_arr           = $this->packages($center);
				$center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
			}
			return view('virtual-offices.city-virtual-offices-list', [
					'centers'                          => $centers,
					'nearby_centers'                   => $nearby_centers,
					'city'                             => $city,
					'center_addresses_for_google_maps' => json_encode($center_addresses_for_google_maps),
					'google_maps_center_city'          => $google_maps_center_city]);
		} else {
			return '404';
		}
	}

	public function getCityVirtualOfficesWithoutId($country_code, $city_slug , CenterService $centerService, CityService $cityService, CenterCoordinateService $centerCoordinateService, TelephonyPackageIncludeService $telephonyPackageIncludeService , LocationSeoService $locationSeo, Request $request) {
		if (null != $city = $cityService->getCityVirtualOfficesWithoutId($country_code, $city_slug)) {
			$centers           = $centerService->getVirtualOfficesByCityId($city->id);
			$center_ids        = $centers->lists('id')->toArray();
			$nearby_center_ids = $centerCoordinateService->getNearbyCentersByCityName($city->name);
			$request_ids       = array_diff($nearby_center_ids, $center_ids);
			$nearby_centers = $centerService->getVirtualOfficesByIds($request_ids);
			$center_addresses_for_google_maps = [];
			$google_maps_center_city          = $city->name;
			foreach ($centers as $key => $center) {
				$center_addresses_for_google_maps[] =
				[
					'address' => $center->address1.' '.$center->address2.' '.$center->postal_code,
					'id'      => $center->id
				];
				$center->packages_arr           = $this->packages($center);
				$center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
			}
			foreach ($nearby_centers as $key => $center) {
				$center_addresses_for_google_maps[] =
				[
					'address' => $center->address1.' '.$center->address2.' '.$center->postal_code,
					'id'      => $center->id
				];
				$center->packages_arr           = $this->packages($center);
				$center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
			}
			$location=$locationSeo->getCityLocationSeo(strtolower($city->slug),$city->us_state_code,$city->country_code);
			return view('virtual-offices.city-virtual-offices-list', [
					'centers'                          => $centers,
					'nearby_centers'                   => $nearby_centers,
					'city'                             => $city,
					'center_addresses_for_google_maps' => json_encode($center_addresses_for_google_maps),
					'location'						   => $location,
					'google_maps_center_city'          => $google_maps_center_city]);
		} else {
			return '404';
		}
	}

	/**
	 * Display center's final page.
	 *
	 * @return Response
	 */
	public function getVirtualOfficeShowPage($country_code, $city_slug, $center_slug, $center_id, CenterService $centerService, CenterCoordinateService $centerCoordinateService, LocationSeoService $locationSeo) {
		if (null != $center = $centerService->getVirtualOfficeByCenterSlug($country_code, $city_slug, $center_slug, $center_id)) {
			$nearby_centers_ids = $centerCoordinateService->getNearbyCentersByLatLng($center->coordinate->lat, $center->coordinate->lng);	
			$nearby_centers     = $centerService->getVirtualOfficesByIds($nearby_centers_ids['ids']);
			foreach ($nearby_centers as $k => $v) {
				$nearby_centers[$k]->distance = round($nearby_centers_ids['distances'][$v->id], 2);
			}				
			$nearby_centers = $nearby_centers->sortBy('distance');
			$location=$locationSeo->getCityLocationSeo(strtolower($city_slug),null,$country_code);
			return view('virtual-offices.show', ['center' => $center, 'nearby_centers' => $nearby_centers, 'packages' => $this->packages($center), 'location' => $location]);
		}
	}

	/**
	 * Display center pricing grid.
	 *
	 * @return Response
	 */
	public function getCenterPricengGrid($center_id, CenterService $centerService, TelephonyPackageIncludeService $telephonyPackageIncludeService) {
		$center                         = $centerService->getVirtualOfficeById($center_id);
		$center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
		return view('virtual-offices.pricing-grid', ['center' => $center, 'packages_arr' => $this->packages($center)]);
	}
	private function packages($center) {
		$packages = [];
		foreach ($center->prices as $price) {
			if ($price->package->name === 'Platinum Package') {
				$packages['Platinum'] = $price;
			}
			if ($price->package->name === 'Platinum Plus Package') {
				$packages['Platinum Plus'] = $price;
			}
		}
		if (isset($packages['Platinum'])  && $packages['Platinum']->current_currency_price->price &&
			isset($packages['Platinum Plus']) && $packages['Platinum Plus']->current_currency_price->price
		) {
			$remainder                        = round(($packages['Platinum Plus']->current_currency_price->price-$packages['Platinum']->current_currency_price->price)/session('rate'), 2);
			$with_live_receptionist_remainder = round(($packages['Platinum Plus']->current_currency_price->with_live_receptionist_pack_price-$packages['Platinum']->current_currency_price->with_live_receptionist_pack_price)/session('rate'), 2);
			session(['remainder' => $remainder, 'with_live_receptionist_remainder' => $with_live_receptionist_remainder]);
		} else {
			session()->forget('remainder');
			session()->forget('with_live_receptionist_remainder');
		}
		return $packages;
	}

	/*get notar page*/
	public function getNotarPage(CenterService $centerService) {
		//dd(session('first_name'));
		return view('virtual-offices.notar');
	}
}
