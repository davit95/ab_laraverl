<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\UsStateService;
use App\Services\CenterService;
use App\Services\CityService;
use App\Services\CenterCoordinateService;
use App\Services\CountryService;
use App\Services\TelephonyPackageIncludeService;

class VirtualOfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(UsStateService $usStateService, CountryService $countryService)
    {
        return view('virtual-offices.index', ['states' => $usStateService->getAllStates(), 'countries' => $countryService->getAllCountries()]);
    }

    /**
     * Display countrie's centers, and cities listing.
     *
     * @return Response
     */
    public function getCountryVirtualOffices($country_slug, CountryService $countryService, UsStateService $usStateService, CityService $cityService, TelephonyPackageIncludeService $telephonyPackageIncludeService)
    {
        if(null != $state = $usStateService->getStateBySlug($country_slug))
        {
            $active_cities = $cityService->getStateActiveCitiesWithPagination($state->id);
            foreach($active_cities as $city)
            {
                foreach($city->active_virtual_offices as $center)
                {
                    $center->packages_arr = $this->packages($center);
                    $center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
                }
            }
            return view('virtual-offices.state-virtual-offices-list', ['state' => $state, 'active_cities' => $active_cities]);
        }
        elseif(null != $country = $countryService->getCountryBySlug($country_slug))
        {
            $active_cities = $cityService->getCountryActiveCitiesWithPagination($country->id);
            foreach($active_cities as $city)
            {
                foreach($city->active_virtual_offices as $center)
                {
                    $center->packages_arr = $this->packages($center);
                    $center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
                }
            }
            return view('virtual-offices.country-virtual-offices-list', ['country' => $country, 'active_cities' => $active_cities]);
        }

    }

    /**
     * Display citie's centers.
     *
     * @return Response
     */
    public function getCityVirtualOffices($country_code, $city_slug, CenterService $centerService, CityService $cityService, CenterCoordinateService $centerCoordinateService, TelephonyPackageIncludeService $telephonyPackageIncludeService)
    {
        if(null != $city = $cityService->getCityByCountryCodeAndCitySlug($country_code, $city_slug))
        {
            $centers = $centerService->getVirtualOfficesByCityId($city->id);
            $nearby_center_ids = $centerCoordinateService->getNearbyCentersByCityName($city->name);
            $nearby_centers = $centerService->getVirtualOfficesByIds($nearby_center_ids);
            $centers = $centers->merge($nearby_centers);
            $center_addresses_for_google_maps = [];
            $google_maps_center_city = $city->name;
            foreach ($centers as $key => $center)
            {
                $center_addresses_for_google_maps[] =
                [
                    'address' => $center->address1.' '.$center->address2.' '.$center->postal_code,
                    'id' => $center->id
                ];
                $center->packages_arr = $this->packages($center);
                $center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
            }
            return view('virtual-offices.city-virtual-offices-list', ['centers' => $centers, 'city' => $city, 'center_addresses_for_google_maps' => json_encode($center_addresses_for_google_maps), 'google_maps_center_city' => $google_maps_center_city]);
        }
        else
        {
            return '404';
        }
    }

    /**
     * Display center's final page.
     *
     * @return Response
     */
    public function getVirtualOfficeShowPage($country_code, $city_slug, $center_slug, CenterService $centerService, CenterCoordinateService $centerCoordinateService)
    {
        if(null != $center = $centerService->getVirtualOfficeByCenterSlug($country_code, $city_slug, $center_slug))
        {
           $nearby_centers_ids = $centerCoordinateService->getNearbyCentersByLatLng($center->coordinate->lat, $center->coordinate->lng);
           $nearby_centers = $centerService->getVirtualOfficesByIds($nearby_centers_ids['ids']);
           foreach($nearby_centers as $k => $v)
           {
                $nearby_centers[$k]->distance = round($nearby_centers_ids['distances'][$v->id], 2);
           }
           $nearby_centers = $nearby_centers->sortBy('distance');
           return view('virtual-offices.show', ['center' => $center, 'nearby_centers' => $nearby_centers, 'packages' => $this->packages($center)]);

           dd($center);
        }
    }

    /**
     * Display center pricing grid.
     *
     * @return Response
     */
    public function getCenterPricengGrid($center_id, CenterService $centerService, TelephonyPackageIncludeService $telephonyPackageIncludeService)
    {
        $center = $centerService->getVirtualOfficeById($center_id);
        $center->telephony_includes_arr = $telephonyPackageIncludeService->getByPartNumber($center->id, 402);
        return view('virtual-offices.pricing-grid', ['center' => $center, 'packages_arr' => $this->packages($center)]);
    }
    private function packages($center)
    {
        $packages = [];
        foreach($center->prices as $price)
        {
            if($price->package->name === 'Platinum Package')
            {
                 $packages['Platinum'] = $price;
            }
            if($price->package->name === 'Platinum Plus Package')
            {
                $packages['Platinum Plus'] = $price;
            }
        }
        return $packages;
    }
}
