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
    public function index(OwnerRequest $request, OwnerInterface $ownerService)
    {
        $role_id = \Auth::user()->role_id;
        $ownerService->setFilterParams( $request->all() );        
        return view('admin.owners.index', [ 'owners' => $ownerService->getAllOwners(), 'role_id' => $role_id ]);
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
        CountryInterface $countryService,
        OwnerInterface $ownerService)
    {
        $role_id = \Auth::user()->role_id;
        return view('admin.owners.create', [
            'cities' => json_encode($cityService->getAllCitiesSelectList()),
            'regions' => json_encode($regionService->getAllRegionsSelectList()),
            'us_states' => json_encode($usStateService->getAllUsStatesSelectList()),
            'countries' => json_encode($countryService->getAllCountriesSelectList()),
            'select_countries' => ['' => 'no country'] + $countryService->getAllCountries()->lists('name', 'name')->toArray(),
            'regions_list' => ['' => 'no region'] + $ownerService->getAllRegionsLists(),
            'states_list' => ['' => 'no state'] + $ownerService->getAllStatesLists(),
            'countries_list' => ['' => 'no country'] + $ownerService->getAllCountriesLists(),
            'role_id' => $role_id
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
        //dd($request->all());
        if ( null != $owner = $ownerService->createOwner( $request->all() ) ) {
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
        $role_id = \Auth::user()->role_id;
        if(\Auth::user()->role_id == 1) {
            $owner = $ownerService->getOwnerByID($id);
        } elseif(\Auth::user()->role_id == 5) {
            if($id != \Auth::user()->owner_id) {
                dd(404);
            } else {
                $owner = $ownerService->getOwnerByID(\Auth::user()->owner_id);    
            }
        }
        
        return view('admin.owners.show', [ 'owner' => $owner, 'role_id' => $role_id ]);
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

        $role_id = \Auth::user()->role_id;
        $regions_list = ['' => 'no region'] + $ownerService->getAllRegionsLists();
        $states_list = ['' => 'no state'] + $ownerService->getAllStatesLists();
        $countries_list = ['' => 'no country'] + $ownerService->getAllCountriesLists();
        $cities = json_encode($cityService->getAllCitiesSelectList());
        $regions = json_encode($regionService->getAllRegionsSelectList());
        $us_states = json_encode($usStateService->getAllUsStatesSelectList());
        $countries = json_encode($countryService->getAllCountriesSelectList());
        if(\Auth::user()->role_id == 1) {
            $owner = $ownerService->getOwnerByID($id);
        } else {
            if($id != \Auth::user()->owner_id) {
                dd(404);
            } else {
                $owner = $ownerService->getOwnerByID(\Auth::user()->owner_id);//
            }
        }
        //dd($regions_list);
        return view('admin.owners.edit', [ 
            'owner' => $owner,
            'regions_list' => $regions_list,
            'states_list' => $states_list,
            'countries_list' => $countries_list,
            'cities' => $cities,
            'regions' => $regions,
            'us_states' => $us_states,
            'countries' => $countries,
            'role_id' => $role_id,
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
        if(\Auth::user()->role_id == 1) {
            if ( null != $owner = $ownerService->updateOwner($id, $request->all() ) ) {
                        return redirect('owners/'.$owner->id)->withSuccess('Owner has been successfully updated.');
                    }
                    return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
        } else {
            if($id != \Auth::user()->owner_id) {
                dd(404);
            } else {
                if ( null != $owner = $ownerService->updateOwner(\Auth::user()->owner_id, $request->all() ) ) {
                    return redirect('owners/'.$owner->id)->withSuccess('Owner has been successfully updated.');
                }
                return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
            }
        }     
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

    public function createOrUpdateOwner($center_id, 
                                        CityInterface $cityService,
                                        RegionInterface $regionService,
                                        UsStateInterface $usStateService,
                                        CountryInterface $countryService,
                                        OwnerInterface $ownerService)
    {
        $role_id = \Auth::user()->role_id;
        return view('admin.owners.create', [
                    'cities' => json_encode($cityService->getAllCitiesSelectList()),
                    'regions' => json_encode($regionService->getAllRegionsSelectList()),
                    'us_states' => json_encode($usStateService->getAllUsStatesSelectList()),
                    'countries' => json_encode($countryService->getAllCountriesSelectList()),
                    'countries_list' => ['' => 'no country'] + $countryService->getAllCountries()->lists('name', 'name')->toArray(),
                    'regions_list' => ['' => 'no region'] + $ownerService->getAllRegionsLists(),
                    'states_list' => ['' => 'no state'] + $ownerService->getAllStatesLists(),
                    'center_id' => $center_id,
                    'role_id' => $role_id
                ]);
    }

    /**
    * Display the add-document form.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function getAddDocument()
    {
        return view('admin.owners.forms.add_document');
    }

    /**
    * Display documents
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function getDocuments()
    {
        return view('admin.owners.documents');
    }

    /**
    * Display the add-staff form.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function getAddStaff()
    {
        return view('admin.owners.forms.add_staff');
    }   
}
