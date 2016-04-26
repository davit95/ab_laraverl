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
    public function __construct(LocationService $locationService)
    {
        $this->middleware('oauth');
        $this->locationService = $locationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LocationService $locationService)
    {
        $locations = $this->locationService->getAllLocations();        
        return response()->json($locations);
    }

    public function getStateLocations($state)
    {
        $locations = $this->locationService->getStateLocations('us', $state);
        return response()->json(['locations' => $locations]);
    }

    public function getCountryLocation($country_slug)
    {
        $locations = $this->locationService->getCountryLocation($country_slug);
        return response()->json(['locations' => $locations]);
    }

    public function getStateCityLocations($state, $city)
    {
        $locations = $this->locationService->getStateCityLocations($state, $city);
        return response()->json(['locations' => $locations]);
    }

    public function getCityLocations($country_slug, $city)
    {
        $locations = $this->locationService->getCityLocations($country_slug, $city);
        return response()->json(['locations' => $locations]);
    }

    public function getStateCenterLocation($state, $city, $center_id)
    {
        $locations = $this->locationService->getStateCenterLocation($state, $city, $center_id);
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
        
}