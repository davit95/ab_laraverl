<?php

namespace Api\Server\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;
use App\User;
use App\Models\Role;
use Api\Server\Services\UserService;
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

    public function postAddUserFromAllwork(Request $request, UserService $userService)
    {
        $inputs  = $request->inputs;
        $role    = Role::where('name', 'allwork_user')->first();
        $role_id = isset($role) ? $role->id : null;
        $inputs['role_id'] = $role_id;
        $user    = User::create($inputs);
        $user_id = isset($user) ? $user->id : null;
        return response()->json(['status' => 'success', 'abcn_user_id' => $user_id]);
    }

    public function getUserById($id, UserService $userService) {
        $user = $userService->getUserById($id);
        $user_role = $user->role->name;
        return response()->json(['user' => $user, 'user_role' => $user_role]);
    }
}