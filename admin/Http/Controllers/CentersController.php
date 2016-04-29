<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsStateService;
use App\Services\CountryService;
use App\Http\Services\CityService;
use Admin\Services\OwnerService;
use App\Http\Requests;
use Admin\Http\Requests\CenterRequest;

use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;

use Admin\Services\CenterService;

class CentersController extends Controller
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CenterService $centerService)
    {
        if(\Auth::user()->role_id == 1) {
            return view('admin.centers.index', ['centers' =>$centerService->getAllCenters()]);   
        } elseif(\Auth::user()->role_id == 5) {
            return view('admin.centers.index', ['centers' =>$centerService->getCentersByOwnerId(\Auth::user()->owner_id)]);   
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UsStateService $usStateService,
                           CountryService $countryService,
                           CenterService $centerService)
    {   
        $selectArray = [
            '' => 'select',
            'IndividualOffice' => 'Individual Office',
            'building exterior' => 'building exterior',
            'lobby' => 'Lobby',
            'BreakRoom' => 'Break Room',
            'CommonArea' => 'Common Area',
            'MeetingRoom' => 'Meeting Room',
            'unknown' => 'Unknown'
        ];
        $packages = [];
        $packages['platinum Package']      = 'platinum Package';
        $packages['Platinum Plus Package'] = 'Platinum Plus Package';
        return view('admin.centers.create', [
                                            'selectArray' => $selectArray,
                                            'states' =>  [''=>'select state'] + $usStateService->getAllStates()->lists('name', 'name')->toArray(),
                                            'countries' => [''=>'select country'] + $countryService->getAllCountries()->lists('name', 'name')->toArray(),
                                            'packages' => $packages,
                                            'photos' => []]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CenterRequest $request, CenterService $centerService)
    {
        try {
            if (null != $center = $centerService->storeCenter( $request->all(), $request->file()) ) {
                return redirect('owners')->withSuccess('Center has been successfully added.');
            }
        }
        catch(FailedTransactionException $e)
        {
            if($e->getCode() === -1) {
                return redirect('centers/create')->withWarning('Whoops, looks like something went wrong, please try later.');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CenterService $centerService,CountryService $countryService,
                           UsStateService $usStateService)
    {
        $selectArray = [
            'select' => 'select',
            'building exterior' => 'building exterior',
            'IndividualOffice' => 'Individual Office',
            'lobby' => 'Lobby',
            'BreakRoom' => 'Break Room',
            'CommonArea' => 'Common Area',
            'MeetingRoom' => 'Meeting Room',
            'unknown' => 'Unknown'
        ];
        $packages = [
            'platinum package' => 'Platinum Package',
            'platinum plus package' => 'Platinum Plus Package'
        ];
        
        if(\Auth::user()->role_id == 1) {
            return view('admin.centers.create', 
            [
                'selectArray' => $selectArray,
                'states' => $usStateService->getAllStates()->lists('name', 'name')->toArray(),
                'countries' => $countryService->getAllCountries()->lists('name', 'name')->toArray(),
                'packages' => $packages,
                'center' => $centerService->getVirtualOfficeById($id),
                'center_coordinates' => $centerService->getCentersCoordinatesByCenterId($id),
                'prices' => $centerService->getCenterPrices($id)[0],
                'photos' => $centerService->getPhotosByCenterId($id)
            ]);   
        } elseif(\Auth::user()->role_id == 5) {
            if($center = $centerService->getOwnerVirtualOfficeById($id, \Auth::user()->owner_id)) {
                return view('admin.centers.create', 
                [
                    'selectArray' => $selectArray,
                    'states' => $usStateService->getAllStates()->lists('name', 'name')->toArray(),
                    'countries' => $countryService->getAllCountries()->lists('name', 'name')->toArray(),
                    'packages' => $packages,
                    'center' => $centerService->getVirtualOfficeById($id),
                    'center_coordinates' => $centerService->getCentersCoordinatesByCenterId($id),
                    'prices' => $centerService->getCenterPrices($id)[0],
                    'photos' => $centerService->getPhotosByCenterId($id)
                ]);
            } else {
                dd(404);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\OwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CenterRequest $request, CenterService $centerService)
    {
        //dd($request->all());
        if(\Auth::user()->role_id == 1) {
            try {
                if ($center = $centerService->updateCenter($id, $request->all(), $request->file()) ) {
                    return redirect('centers')->withSuccess('Center has been successfully updated.');
                }
            }
            catch(FailedTransactionException $e)
            {
                if($e->getCode() === -1) {
                    return redirect('centers/create')->withWarning('Whoops, looks like something went wrong, please try later.');
                }
            }
        } elseif(\Auth::user()->role_id == 5) {
            if($center = $centerService->getOwnerVirtualOfficeById($id, \Auth::user()->owner_id)) {
                try {
                    if ($center = $centerService->updateCenter($id, $request->all(), $request->file()) ) {
                        return redirect('centers')->withSuccess('Center has been successfully updated.');
                    }
                }
                catch(FailedTransactionException $e)
                {
                    if($e->getCode() === -1) {
                        return redirect('centers/create')->withWarning('Whoops, looks like something went wrong, please try later.');
                    }
                }
            } else {
                dd(404);
            }
        }
        //dd($centerService->updateCenter($id, $request->all()));
        /*if ($center = $centerService->updateCenter($id, $request->all()) ) {
            return redirect('centers/create')->withSuccess('Center has been successfully updated.');
        }
        return redirect('centers/create')->withWarning('Whoops, looks like something went wrong, please try later.');*/
    }

    public function show($id, CenterService $centerService, OwnerService $ownerService)
    {
        if(\Auth::user()->role_id == 1) {
            $center = $centerService->getVirtualOfficeById($id);
            return view('admin.centers.show',[
                    'center' => $center,
                    'regions_list' => ['' => 'no region'] + $ownerService->getAllRegionsLists(),
                    'states_list' => ['' => 'no state'] + $ownerService->getAllStatesLists(),
                    'countries_list' => ['' => 'no country'] + $ownerService->getAllCountriesLists(),
                ]); 
        } elseif(\Auth::user()->role_id == 5) {
            $center = $centerService->getOwnerVirtualOfficeById($id, \Auth::user()->owner_id);
            if($center) {
                return view('admin.centers.show',[
                    'center' => $center,
                    'regions_list' => ['' => 'no region'] + $ownerService->getAllRegionsLists(),
                    'states_list' => ['' => 'no state'] + $ownerService->getAllStatesLists(),
                    'countries_list' => ['' => 'no country'] + $ownerService->getAllCountriesLists(),
                ]);
            } else {
                dd(404);
            }       
        }    
    }

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
                    $image_src = 'http://www.abcn.com/images/photos/'.$photo->path;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }

    public function getAvoPhotosAltsAndCaptions(CenterService $centerService, Request $request)
    {
        return $centerService->getAvoPhotosALtsAndCaptions($request->all());
    }
}