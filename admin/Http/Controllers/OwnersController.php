<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Admin\Contracts\OwnerInterface;
use Admin\Contracts\CityInterface;
use Admin\Contracts\RegionInterface;
use Admin\Contracts\UsStateInterface;
use Admin\Contracts\CountryInterface;
use Admin\Http\Requests\OwnerRequest;

class OwnersController extends Controller
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
    public function index(Request $request, OwnerInterface $ownerService)
    {
        $ownerService->setFilterParams( $request->all() );        
        return view('admin.owners.index', [ 'owners' => $ownerService->getAllOwners() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(
        CityInterface $cityService,
        RegionInterface $regionService,
        UsStateInterface $usStateService,
        CountryInterface $countryService)
    {
        return view('admin.owners.create', [
            'cities' => json_encode($cityService->getAllCitiesSelectList()),
            'regions' => json_encode($regionService->getAllRegionsSelectList()),
            'us_states' => json_encode($usStateService->getAllUsStatesSelectList()),
            'countries' => json_encode($countryService->getAllCountriesSelectList()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerRequest $request, OwnerInterface $ownerService)
    {
        if ( null != $owner = $ownerService->storeOwner( $request->all() ) ) {
            return redirect('owners/'.$owner->id)->withSuccess('Owner has been successfully created.');
        }
        return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, OwnerInterface $ownerService)
    {
        $owner = $ownerService->getOwnerByID($id);        
        return view('admin.owners.show', [ 'owner' => $owner ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, 
        OwnerInterface $ownerService,
        CityInterface $cityService,
        RegionInterface $regionService,
        UsStateInterface $usStateService,
        CountryInterface $countryService)
    {
        return view('admin.owners.edit', [ 
            'owner' => $ownerService->getOwnerByID($id),
            'cities' => json_encode($cityService->getAllCitiesSelectList()),
            'regions' => json_encode($regionService->getAllRegionsSelectList()),
            'us_states' => json_encode($usStateService->getAllUsStatesSelectList()),
            'countries' => json_encode($countryService->getAllCountriesSelectList()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\OwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, OwnerRequest $request, OwnerInterface $ownerService)
    {
        if ( null != $owner = $ownerService->updateOwner($id, $request->all() ) ) {
            return redirect('owners/'.$owner->id)->withSuccess('Owner has been successfully updated.');
        }
        return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, OwnerInterface $ownerService)
    {
        if ( null != $owner = $ownerService->destroyOwner($id) ) {
            return redirect('owners')->withSuccess('Owner has been successfully deleted.');
        }
        return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
    }

    /**
    * Display the add-document page.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function getAddDocument()
    {
        return view('admin.owners.add_document');
    }
}
