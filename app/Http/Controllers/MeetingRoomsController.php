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

class MeetingRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(UsStateService $usStateService, CountryService $countryService)
    {
        return view('meeting-rooms.index', ['states' => $usStateService->getAllStates(), 'countries' => $countryService->getAllCountries()]);
    }

    /**
     * Display countrie's centers, and cities listing.
     *
     * @return Response
     */
    public function getCountryMeetingRooms($country_slug, CountryService $countryService, UsStateService $usStateService, CityService $cityService)
    {
        if(null != $state = $usStateService->getStateBySlug($country_slug))
        {
            $active_cities = $cityService->getStateActiveCitiesWithPagination($state->id);
            return view('meeting-rooms.state-meeting-rooms-list', ['state' => $state, 'active_cities' => $active_cities]);
        }
        elseif(null != $country = $countryService->getCountryBySlug($country_slug))
        {
            $active_cities = $cityService->getCountryActiveCitiesWithPagination($country->id);
            return view('meeting-rooms.country-meeting-rooms-list', ['country' => $country, 'active_cities' => $active_cities]);
        }
    }

    /**
     * Display citie's centers.
     *
     * @return Response
     */
    public function getCityMeetingRooms($country_code, $city_slug, CenterService $centerService, CityService $cityService, CenterCoordinateService $centerCoordinateService)
    {
        if(null != $city = $cityService->getCityByCountryCodeAndCitySlug($country_code, $city_slug))
        {
            $centers = $centerService->getMeetingRoomsByCityId($city->id);
            $nearby_center_ids = $centerCoordinateService->getNearbyCentersByCityName($city->name);
            $nearby_centers = $centerService->getMeetingRoomsByIds($nearby_center_ids);
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
            }
            return view('meeting-rooms.city-meeting-rooms-list', ['centers' => $centers, 'city' => $city, 'center_addresses_for_google_maps' => json_encode($center_addresses_for_google_maps), 'google_maps_center_city' => $google_maps_center_city]);
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
    public function getMeetingRoomShowPage($country_code, $city_slug, $center_slug, CenterService $centerService, CenterCoordinateService $centerCoordinateService)
    {
        if(null != $center = $centerService->getMeetingRoomByCenterSlug($country_code, $city_slug, $center_slug))
        {
           $nearby_centers_ids = $centerCoordinateService->getNearbyCentersByLatLng($center->coordinate->lat, $center->coordinate->lng);
           $nearby_centers = $centerService->getMeetingRoomsByIds($nearby_centers_ids['ids']);
           foreach($nearby_centers as $k => $v)
           {
                $nearby_centers[$k]->distance = round($nearby_centers_ids['distances'][$v->id], 2);
           }
           $nearby_centers = $nearby_centers->sortBy('distance');
           foreach ($center->meeting_rooms as $key => $mr)
           {
               $included = [];
               $paid = [];
               
               $phone_rates = explode('||', $mr->options->phone_rate);
               if($phone_rates[0] < '1' || $phone_rates[0] == '')
               {
                    $included[] = 'Phone Access';
               } 
               elseif($phone_rates[0] != 'NA')
               {
                    $paid[] = 'Phone Access|Phone_Rate';
               }

               $network_rates = explode('||', $mr->options->network_rate);
               if($network_rates[0] < '1' || $network_rates[0] == '')
               {
                    $included[] = 'Network Connection';
               } 
               elseif($network_rates[0] != 'NA')
               {
                    $paid[] = 'Network Connection|Network_Rate';
               }

               $whiteboard_rates = explode('||', $mr->options->whiteboard_rate);
               if($whiteboard_rates[0] < '1' || $whiteboard_rates[0] == '')
               {
                    $included[] = 'Whiteboard';
               } 
               elseif($whiteboard_rates[0] != 'NA')
               {
                    $paid[] = 'Whiteboard|Whiteboard_Rate';
               }

               $wireless_rates = explode('||', $mr->options->wireless_rate);
               if($wireless_rates[0] < '1' || $wireless_rates[0] == '')
               {
                    $included[] = 'WiFi';
               } 
               elseif($wireless_rates[0] != 'NA')
               {
                    $paid[] = 'WiFi|Wireless_Rate';
               }

               $tvdvdplayer_rates = explode('||', $mr->options->tvdvdplayer_rate);
               if($tvdvdplayer_rates[0] < '1' || $tvdvdplayer_rates[0] == '')
               {
                    $included[] = 'TV / DVD Player';
               } 
               elseif($tvdvdplayer_rates[0] != 'NA')
               {
                    $paid[] = 'TV / DVD Player|Tvdvdplayer_Rate';
               }

               $projector_rates = explode('||', $mr->options->projector_rate);
               if($projector_rates[0] < '1' || $projector_rates[0] == '')
               {
                    $included[] = 'Projector';
               } 
               elseif($projector_rates[0] != 'NA')
               {
                    $paid[] = 'Projector|Projector_Rate';
               }

               $videoconferencing_rates = explode('||', $mr->options->videoconferencing_rate);
               if($videoconferencing_rates[0] < '1' || $videoconferencing_rates[0] == '')
               {
                    $included[] = 'Video Conferencing';
               } 
               elseif($videoconferencing_rates[0] != 'NA')
               {
                    $paid[] = 'Video Conferencing|Videoconferencing_Rate';
               }

               $admin_services_rates = explode('||', $mr->options->admin_services_rate);
               if($admin_services_rates[0] < '1' || $admin_services_rates[0] == '')
               {
                    $included[] = 'Admin Services';
               } 
               elseif($admin_services_rates[0] != 'NA')
               {
                    $paid[] = 'Admin Services|Admin_Services_Rate';
               }

               $parking_rates = explode('||', $mr->options->parking_rate);
               if($parking_rates[0] < '1' || $parking_rates[0] == '')
               {
                    $included[] = 'Parking';
               } 
               elseif($parking_rates[0] != 'NA')
               {
                    $paid[] = 'Parking|Parking_Rate';
               }

               if($mr->bridge_connection_available == 'yes')
               {
                    $included[] = 'Bridge Connection Available';
               }

               if($mr->catering == 'yes')
               {
                    $included[] = 'Catering Available';
               }



               $center->meeting_rooms[$key]->included = $included;
               $center->meeting_rooms[$key]->paid = $paid;
           }
           //dd( $center , $nearby_centers);
           return view('meeting-rooms.show', ['center' => $center, 'nearby_centers' => $nearby_centers]);
        }
        else
        {
            return 'aa';
        }
    }
}
