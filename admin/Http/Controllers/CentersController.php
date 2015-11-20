<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.centers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CenterService $centerService)
    {
        return redirect('centers/create')->withWarning('This Section not finished yet.');
        if ( null != $center = $centerService->storeCenter( $request->all() ) ) {
            return redirect('centers/'.$center->id)->withSuccess('Center has been successfully added.');
        }
        return redirect('centers')->withWarning('Whoops, looks like something went wrong, please try later.');
    }
}