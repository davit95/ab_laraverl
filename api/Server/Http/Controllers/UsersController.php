<?php

namespace Api\Server\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;
use App\User;
use App\Models\Role;
class UsersController extends Controller
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('oauth');            
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
    }

    public function postAddUserFromAllwork(Request $request)
    {        
        $inputs = $request->all();
        $role_id = Role::where('name', 'admin')->first()->id;
        $inputs['role_id'] = $role_id;
        User::create($inputs);
    }
}