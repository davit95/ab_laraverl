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
        $inputs  = $request->all();
        $role    = Role::where('name', 'allwork_user')->first();
        $role_id = isset($role) ? $role->id : null;
        $inputs['role_id'] = $role_id;
        $user    = User::create($inputs);
        $user_id = isset($user) ? $user->id : null;
        return response()->json(['status' => 'success', 'abcn_user_id' => $user_id]);
    }
}