<?php

namespace Api\Server\Http\Controllers;
use Api\Server\Services\LocationService;
use Illuminate\Http\Request;
use App\Http\Requests;
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

    public function getStateLocations($state)
    {
        $locations = $this->locationService->getStateLocations('us', $state, $this->per_page, $this->page);
        return response()->json(['locations' => $locations]);
    }

    public function getCountryLocation($country_slug)
    {
        $locations = $this->locationService->getCountryLocation($country_slug, $this->per_page, $this->page);
        return response()->json(['locations' => $locations]);
    }

    public function getStateCityLocations($state, $city)
    {
        $locations = $this->locationService->getStateCityLocations($state, $city, $this->per_page, $this->page);
        return response()->json(['locations' => $locations]);
    }

    public function getCityLocations($country_slug, $city)
    {
        $locations = $this->locationService->getCityLocations($country_slug, $city, $this->per_page, $this->page);
        return response()->json(['locations' => $locations]);
    }

    public function getStateCenterLocation($state, $city, $center_id)
    {
        $locations = $this->locationService->getStateCenterLocation($state, $city, $center_id, $this->per_page, $this->page);
        return response()->json(['locations' => $locations]);
    }

    public function getCenterLocation($country_slug, $city, $center_id)
    {
        $locations = $this->locationService->getCenterLocation($country_slug, $city, $center_id);
        return response()->json(['locations' => $locations]);
    }

    public function getSearchLocation($key)
    {        
        $locations = $this->locationService->getSearchLocation($key);
        return response()->json(['locations' => $locations]);
    }

    public function getSearchLocationByCountry($country_slug, $key)
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
        dd($countries);
        return response()->json(['countries' => $countries]);
    }
}