<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\WhiteSiteService;
use Illuminate\Http\Request;

class WhiteSiteController extends Controller {
	/**
	 * Create a new home controller instance.
	 *
	 * @return void
	 */
	public function __construct(WhiteSiteService $whiteSiteService)
	{
		$this->whiteSiteService = $whiteSiteService;
		$this->white_site = $this->getWhiteSite();	    
	}

	private function getWhiteSite()
	{
		$white_site_id = \Route::current()->getParameter('white_site_id');
		return $this->whiteSiteService->getWhiteSite($white_site_id);
	}

	public function index(Request $request)
	{
		return view('white-site.index', ['white_site' => $this->white_site]);
	}

	public function getVirtualOfficesIntroduction()
	{
		return view('white-site.virtual-offices-introduction', ['white_site' => $this->white_site]);
	}

	public function getVirtualOffices()
	{
		$countries = $this->whiteSiteService->getAvailableCountries($this->white_site);
		$states = $this->whiteSiteService->getAvailableStates($this->white_site);		
		return view('white-site.virtual-offices', ['white_site' => $this->white_site, 'countries' => $countries, 'states' => $states]);
	}

	public function getCitiesByCountryAndState(Request $request)
	{		
		$country = $request->country;
		$state = $request->state;
		$cities = $this->whiteSiteService->getCitiesByCountryAndState($this->white_site, $country, $state);
		return response()->json(['cities' => $cities]);
	}

	public function getCentersLiist(Request $request)
	{
		$country = $request->country;
		$state = $request->state;
		$city_id = $request->city_id;
		$centers = $this->whiteSiteService->getCentersLiist($this->white_site, $country, $state, $city_id);
		return response()->json(['centers' => $centers]);
	}

	public function getShowCenter($white_site_id, $center_id)
	{
		$center = $this->whiteSiteService->getCenter($this->white_site, $center_id);		
		if($center == null){
			return redirect('/white-site/'.$this->white_site->id);
		}
		return view('white-site.centers.show', ['white_site' => $this->white_site, 'center' => $center]);
	}
}
