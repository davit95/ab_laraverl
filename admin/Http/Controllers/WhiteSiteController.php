<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Admin\Contracts\UserInterface;
use Admin\Contracts\WhiteSiteServiceInterface;
use Admin\Contracts\CenterInterface;


class WhiteSiteController extends Controller
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct(CenterInterface $centerService, WhiteSiteServiceInterface $whiteSiteService)
    {
    	$this->whiteSiteService = $whiteSiteService;
    	$this->centerService = $centerService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$auth_user = \Auth::user();
    	$role = $auth_user->role->name;
    	$included_centers = $this->centerService->getIncludedCentersListsIdName($auth_user->id);    	
    	$removed_centers = $this->centerService->getRemovedCentersListsIdName($auth_user->id);
    	$offerings = $this->whiteSiteService->getOfferings($auth_user->id);  
    	$white_site = $this->whiteSiteService->getUserWhiteSite($auth_user->id);
     	return view('admin.white-site.index', ['offerings' => $offerings, 'role' => $role, 'included_centers'=> $included_centers, 'removed_centers' => $removed_centers, 'white_site' => $white_site]);
    }

    /**
     * Remove the specified resources from storage.
     *     
     * @return \Illuminate\Http\Response
     */
    public function removeCenter(Request $request)
    {    	
    	$this->centerService->removeCenterFromWhiteSite($request->ids, \Auth::id());
        return response()->json(['status' => 'success']);
    }

    public function addCenter(Request $request)
    {
    	$this->centerService->addCenterToWhiteSite($request->ids, \Auth::id());
        return response()->json(['status' => 'success']);
    }

    public function updateOfferings(Request $request)
    {    	
    	$result = $this->whiteSiteService->updateOfferings(\Auth::id(), $request->all());
    	if($result){
    		return redirect()->back()->with('success', 'Updated successfully');
    	}
    	return redirect()->back()->with('error', 'Something went wrong');
    }

    public function updateLogo(Request $request)
    {
    	$result = $this->whiteSiteService->updateLogo(\Auth::id(), $request->logo);
    	if($result){
    		return redirect()->back()->with('success', 'Updated successfully');	
    	}
    	return redirect()->back()->with('error', 'Something went wrong');
    }

    public function updateCompanyInformation(Request $request)
    {
    	$result = $this->whiteSiteService->updateCompanyInformation(\Auth::id(), $request->all());
    	if($result){
    		return redirect()->back()->with('success', 'Updated successfully');	
    	}
    	return redirect()->back()->with('error', 'Something went wrong');
    }

    public function show($white_site_id)
    {
    	
    }
}
