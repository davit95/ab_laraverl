<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsStateService;
use App\Services\CountryService;
use App\Http\Requests;
use Admin\Http\Requests\StaffRequest;
use Admin\Contracts\OwnerInterface;
use App\Http\Controllers\Controller;


use Admin\Services\CenterService;
use Admin\Services\OwnerService;
use Admin\Contracts\StaffInterface;

class StaffsController extends Controller
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
        dd('staff');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request, OwnerInterface $ownerService)
    {
        //dd($request->all());
        $owner_id = $request['owner_id'];
        if ( null != $staff = $ownerService->createStaff( $request->all() ) ) {
            return redirect('owners/'.$owner_id)->withSuccess('Owner has been successfully created.');
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
        //
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
}