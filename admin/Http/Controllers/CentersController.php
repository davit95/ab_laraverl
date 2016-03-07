<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsStateService;
use App\Services\CountryService;
use App\Http\Requests;
use Admin\Http\Requests\CenterRequest;

use App\Http\Controllers\Controller;


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
    public function index()
    {
        dd('asd'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UsStateService $usStateService, CountryService $countryService)
    {   
        //dd($usStateService->getAllStates()->lists('name', 'name')->toArray());
        $selectArray = [
            'select' => 'select',
            'IndividualOffice' => 'Individual Office',
            'lobby' => 'Lobby',
            'BreakRoom' => 'Break Room',
            'CommonArea' => 'Common Area',
            'MeetingRoom' => 'Meeting Room',
            'unknown' => 'Unknown'
        ];
        return view('admin.centers.create', ['selectArray' => $selectArray,'states' => $usStateService->getAllStates()->lists('name', 'name')->toArray(),'countries' => $countryService->getAllCountries()->lists('name', 'name')->toArray()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CenterRequest $request, CenterService $centerService)
    {
        //dd($request->all());
        //$centerService->storeCenter($request->all());
        //return redirect('centers/create')->withWarning('This Section not finished yet.');
        if ( null != $center = $centerService->storeCenter( $request->all() ) ) {
            return redirect('owners')->withSuccess('Center has been successfully added.');
        }
        return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\OwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
    }

    public function getAddMeetingRoom()
    {
        return view('admin.centers.add_meeting_room');
    }
}