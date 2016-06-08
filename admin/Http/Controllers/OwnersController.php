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
use Admin\Contracts\UserInterface;


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
        $this->middleware('superAdmin',['only' => 'create']);
        $this->middleware('superAdminOrOwnerOrCsr');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OwnerInterface $ownerService)
    {
        $role = \Auth::user()->role->name;
        //$ownerService->setFilterParams( $request->all() );        
        return view('admin.owners.index', [ 'owners' => $ownerService->getOwners($role), 'role' => $role ]);
    }

    public function getOwnersCenters(OwnerInterface $ownerService)
    {
        $user = \Auth::user();
        $role = $user->role->name;
        $owners = $ownerService->getOwnersByRole(\Auth::user());
        if($owners) {
            if($role === 'super_admin') {
                return view('admin.centers.index', ['role' => $role, 'owners' => $owners]);   
            } elseif($role === 'owner_user') {
                return view('admin.centers.index', ['role' => $role, 'owners' => $owners]);   
            } elseif($role === 'client_user') {
                return view('admin.centers.index', ['role' => $role, 'owners' => $owners]);   
            } elseif($role === 'admin') {
                return view('admin.centers.index', ['role' => $role, 'owners' => $owners]);
            }
        } else {
            dd(404);
        }
        
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
        $role = \Auth::user()->role->name;
        return view('admin.owners.create', [
            'cities' => json_encode($cityService->getAllCitiesSelectList()),
            'regions' => json_encode($regionService->getAllRegionsSelectList()),
            'us_states' => json_encode($usStateService->getAllUsStatesSelectList()),
            'countries' => json_encode($countryService->getAllCountriesSelectList()),
            'select_countries' => ['' => 'no country'] + $countryService->getAllCountries()->lists('name', 'name')->toArray(),
            'regions_list' => ['' => 'no region'] + $ownerService->getAllRegionsLists(),
            'states_list' => ['' => 'no state'] + $ownerService->getAllStatesLists(),
            'countries_list' => ['' => 'no country'] + $ownerService->getAllCountriesLists(),
            'role' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerRequest $request, OwnerInterface $ownerService, UserInterface $userService)
    {
        //dd($ownerService->test($request->all()));
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
    public function show($id, OwnerInterface $ownerService, UserInterface $userService)
    {
        //dd('as');
        //dd($id);
        $role = \Auth::user()->role->name;
        $owner = $ownerService->getOwnerById($id);
        //dd($owner);
        //dd($owner->country);
        //dd($owner);
        // if(\Auth::user()->role_id == 1) {
        //     $owner = $ownerService->getOwnerByID($id);
        // } elseif(\Auth::user()->role_id == 5) {
        //     if($id != \Auth::user()->owner_id) {
        //         dd(404);
        //     } else {
        //         $owner = $ownerService->getOwnerByID(\Auth::user()->owner_id);    
        //     }
        // }
        
        return view('admin.owners.show', [ 'owner' => $owner, 'role' => $role ]);
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

        $role = \Auth::user()->role->name;
        //dd(\Auth::user());
        $regions_list = ['' => 'no region'] + $ownerService->getAllRegionsLists();
        $states_list = ['' => 'no state'] + $ownerService->getAllStatesLists();
        $countries_list = ['' => 'no country'] + $ownerService->getAllCountriesLists();
        $cities = json_encode($cityService->getAllCitiesSelectList());
        $regions = json_encode($regionService->getAllRegionsSelectList());
        $us_states = json_encode($usStateService->getAllUsStatesSelectList());
        $countries = json_encode($countryService->getAllCountriesSelectList());
        if($role === 'super_admin') {
            $owner = $ownerService->getOwnerByID($id);
            $owner_client = $ownerService->getOwnerById($id);
        } elseif($role === 'owner_user') {
            $owner = $ownerService->getOwnersByRole(\Auth::user());//
            $owner_client = $ownerService->getOwnerById(\Auth::user()->id);//
        }
        //dd($owner_client);

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
            'role' => $role,
            'owner_id' => \Auth::user()->id,
            'owner_client' => $owner_client
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
        //dd($id);
        if ( null != $owner = $ownerService->updateOwner($id, $request->all() ) ) {
            return redirect('owners/'.$owner->id)->withSuccess('Owner has been successfully updated.');
        }
        return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
        // if(\Auth::user()->role_id == 1) {
        //     if ( null != $owner = $ownerService->updateOwner($id, $request->all() ) ) {
        //                 return redirect('owners/'.$owner->id)->withSuccess('Owner has been successfully updated.');
        //             }
        //             return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
        // } else {
        //     if($id != \Auth::user()->owner_id) {
        //         dd(404);
        //     } else {
        //         if ( null != $owner = $ownerService->updateOwner(\Auth::user()->owner_id, $request->all() ) ) {
        //             return redirect('owners/'.$owner->id)->withSuccess('Owner has been successfully updated.');
        //         }
        //         return redirect('owners')->withWarning('Whoops, looks like something went wrong, please try later.');
        //     }
        // }     
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

    public function createOrUpdateOwner(
        $center_id, 
        CityInterface $cityService,
        RegionInterface $regionService,
        UsStateInterface $usStateService,
        CountryInterface $countryService,
        OwnerInterface $ownerService)
    {
        $role = \Auth::user()->role->name;
        return view('admin.owners.create', [
                    'cities' => json_encode($cityService->getAllCitiesSelectList()),
                    'regions' => json_encode($regionService->getAllRegionsSelectList()),
                    'us_states' => json_encode($usStateService->getAllUsStatesSelectList()),
                    'countries' => json_encode($countryService->getAllCountriesSelectList()),
                    'countries_list' => ['' => 'no country'] + $countryService->getAllCountries()->lists('name', 'name')->toArray(),
                    'regions_list' => ['' => 'no region'] + $ownerService->getAllRegionsLists(),
                    'states_list' => ['' => 'no state'] + $ownerService->getAllStatesLists(),
                    'center_id' => $center_id,
                    'role' => $role
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
        dd('as');
        return view('admin.owners.forms.add_staff');
    }   
}
