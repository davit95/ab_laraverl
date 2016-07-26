<?php

namespace Api\Server\Http\Controllers;
use Api\Server\Services\LocationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;

class LocationsController extends Controller
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct(LocationService $locationService, Request $request)
    {
        $this->middleware('oauth');
        $this->locationService = $locationService;
        $this->per_page = $request->per_page;
        $this->page     = $request->page;        
    }

    public function getLocationsByOwnerId($owner_id, LocationService $locationService)
    {        
        $locations = $locationService->getLocationsByOwnerId($owner_id);
        return response()->json($locations);
    }

    public function getShowOwnerLocation($id, $owner_id, LocationService $locationService)
    {
        $location = $locationService->getOwnerLocationById($id, $owner_id);
        return response()->json($location);
    }

    /**
     * Create a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addLocation(Request $request, LocationService $locationService)
    {
        $location = $locationService->addLocation($request->all());
        $status = null!= $location ? 'success' : 'error';
        return response()->json(['status' => $status]);
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLocation($id)
    {
        $locations = $this->locationService->getLocationById($id);
        return response()->json($locations);
    }

    public function updateLocation($id, $owner_id, Request $request)
    {
        $location = $this->locationService->updateLocation($id, $owner_id, $request->all());
        $status = $location ? 'success' : 'error';
        return response()->json(['status' => $status]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LocationService $locationService)
    {
        $locations = $this->locationService->getAllLocations($this->per_page, $this->page);
        return response()->json($locations);
    }

    public function getStateLocations($state, Request $request)
    {                
        $locations = $this->locationService->getStateLocations('us', $state, $request->nearby, $request->options, $this->per_page, $this->page, $request->header('accessToken'));        
        return response()->json(['locations' => $locations]);
    }

    public function getCountryLocations($country_slug, Request $request)
    {
        $locations = $this->locationService->getCountryLocations($country_slug, $request->nearby, $request->options, $this->per_page, $this->page, $request->header('accessToken'));
        return response()->json(['locations' => $locations]);
    }

    public function getStateCityLocations($state, $city, Request $request)
    {
        $locations = $this->locationService->getStateCityLocations($state, $city, $request->nearby, $request->options, $this->per_page, $this->page, $request->header('accessToken'));        
        return response()->json(['locations' => $locations]);
    }

    public function getCityLocations($country_slug, $city, Request $request)
    {
        $locations = $this->locationService->getCityLocations($country_slug, $city, $request->nearby, $request->options, $this->per_page, $this->page, $request->header('accessToken'));
        return response()->json(['locations' => $locations]);
    }

    public function getStateCenterLocation($state, $city, $center_id, Request $request)
    {
        $locations = $this->locationService->getStateCenterLocation($state, $city, $center_id, $request->nearby, $request->options, $request->description, $request->header('accessToken'));        
        return response()->json(['locations' => $locations]);
    }

    public function getCenterLocation($country_slug, $city, $center_id, Request $request)
    {
        $locations = $this->locationService->getCenterLocation($country_slug, $city, $center_id, $request->nearby, $request->options, $request->description, $request->header('accessToken'));
        return response()->json(['locations' => $locations]);
    }

    public function getSearchLocation($key)
    {
        $locations = $this->locationService->getSearchLocation($key);
        return response()->json(['locations' => $locations]);
    }

    public function getSearchCity($key, Request $request)
    {
        $country =  $request->country != "" ? $request->country : null;
        $us_state = $request->us_state != "" ? $request->us_state : null;
        $cities = $this->locationService->getSearchCity($key, $country, $us_state);
        return response()->json(['cities' => $cities]);
    }

    public function getSearchLocationBySpaceType($type, $key)
    {
        $locations = $this->locationService->getSearchLocationBySpaceType($type, $key);
        return response()->json(['locations' => $locations]);
    }

    public function getSearchLocationByCountry($country_slug, $key, Request $request)
    {
        $locations = $this->locationService->getSearchLocationByCountry($country_slug, $key);
        return response()->json(['locations' => $locations]);
    }

    public function getAllLocationsForSearch()
    {
        $locations = $this->locationService->getAllLocationsForSearch();
        return response()->json(['locations' => $locations]);
    }

    public function getCenterOwnerEmail($center_id)
    {
        $email = $this->locationService->getCenterOwnerEmail($center_id);
        return response()->json([$email]);
    }

    public function getAllCountries()
    {        
        $countries = $this->locationService->getAllCountries();
        return response()->json(['countries' => $countries]);
    }

    public function getAllStates()
    {
        $states = $this->locationService->getAllStates();
        return response()->json(['states' => $states]);
    }
}