<?php

namespace Api\Server\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;
use App\User;
use App\Models\AllworkRequestDetail;
class RequestDetailsController extends Controller
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function addRequestDetail(Request $request, AllworkRequestDetail $requestDetail)
    {        
        $request_detail = $requestDetail->create($request->all());
        return response()->json(['status' => 'success']);
    }
}