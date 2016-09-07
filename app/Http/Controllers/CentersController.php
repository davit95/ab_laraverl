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
	public function getCenterById($id, Request $request, CenterService $centerService) {
		if (null != $center = $centerService->getCenterByIdAjax($id)) {
			$prefix = 'virtual-offices';
			$slug   = $center->city?$center->city->slug:'';
			if ($request->has('center_type') && $request->get('center_type') == 'mr') {
				$prefix = 'meeting-rooms';
				if (is_null($photo = $center->mr_photos->first())) {
					$image_src = url('mr-photos/no_pic.gif');
					$image_alt = '';
				} else {
					$image_src = url('mr-photos/all/'.$photo->path);
					$image_alt = $photo->alt;
				}
			} else {
				if (is_null($photo = $center->vo_photos->first())) {
					$image_src = url('mr-photos/no_pic.gif');
					$image_alt = '';
				} else {
					
					if(isset($center) && count($center->sites) != 0) {
						$image_src = '/images/centers/'.$photo->path;
					} else {
						$image_src = 'http://www.abcn.com/images/photos/'.$photo->path;
					}					
					$image_alt = $photo->alt;
				}
			}
			$more_info_link = url('/'.$prefix.'/'.$center->country.'/'.$slug.'/'.$center->slug.'/'.$center->id);
			$response       = [
				'title'          => $center->building_name,
				'address'        => $center->address1.' '.$center->city_name.', '.$center->us_state,
				'image_src'      => $image_src,
				'image_alt'      => $image_alt,
				'more_info_link' => $more_info_link
			];
			return response()->json($response);
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
