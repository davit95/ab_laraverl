<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsStateService;
use App\Services\CountryService;
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
        dd('need more information...');
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
            'select' => 'select',
            'IndividualOffice' => 'Individual Office',
            'lobby' => 'Lobby',
            'BreakRoom' => 'Break Room',
            'CommonArea' => 'Common Area',
            'MeetingRoom' => 'Meeting Room',
            'unknown' => 'Unknown'
        ];
        $packages = [];
        //$states = $usStateService->getAllStates()->lists('name', 'name')->toArray();
        //dd($states);
        $packages['platinum Package']      = 'platinum Package';
        $packages['Platinum Plus Package'] = 'Platinum Plus Package';
        //dd($packages);
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
        //dd($centerService->getVirtualOfficeById($id)->meeting_room_seo);
        /*'packages' => $centerService->getPackages()->lists('name', 'name')->toArray(),*/
         //dd($centerService->test($id));
         $selectArray = [
            'select' => 'select',
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
        return view('admin.centers.create', [
                                            'selectArray' => $selectArray,
                                            'states' => $usStateService->getAllStates()->lists('name', 'name')->toArray(),
                                            'countries' => $countryService->getAllCountries()->lists('name', 'name')->toArray(),
                                            'packages' => $packages,
                                            'center' => $centerService->getVirtualOfficeById($id),
                                            'center_coordinates' => $centerService->getCentersCoordinatesByCenterId($id),
                                            'prices' => $centerService->getCenterPrices($id)[0],
                                            'photos' => $centerService->test($id)]);
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
        try {
            if ($center = $centerService->updateCenter($id, $request->all(), $request->file()) ) {
                return redirect('centers/create')->withSuccess('Center has been successfully updated.');
            }
        }
        catch(FailedTransactionException $e)
        {
            if($e->getCode() === -1) {
                return redirect('centers/create')->withWarning('Whoops, looks like something went wrong, please try later.');
            }
        }
        //dd($centerService->updateCenter($id, $request->all()));
        /*if ($center = $centerService->updateCenter($id, $request->all()) ) {
            return redirect('centers/create')->withSuccess('Center has been successfully updated.');
        }
        return redirect('centers/create')->withWarning('Whoops, looks like something went wrong, please try later.');*/
    }

    public function show($id)
    {
        dd($id);
    } 
}