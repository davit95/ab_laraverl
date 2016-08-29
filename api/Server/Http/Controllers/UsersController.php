<?php

namespace Api\Server\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;
use App\User;
use App\Models\Role;
use App\Models\Staff;
use App\Models\UserStaff;
use App\Models\Company;
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
        return response()->json(['status' => 'success', 'abcn_user_id' => $user_id, 'user' => $user]);
    }

    public function getUserById($id, UserService $userService) {
        $user = $userService->getUserById($id);
        $user_role = '';
        if($user->role) {
            $user_role = $user->role->name;
        }
        return response()->json(['user' => $user, 'user_role' => $user_role, 'company' => $user->company]);
    }

    public function updateUser($id, Request $request, UserService $userService) 
    {
        $user_details = $request->all();
        if(null !== $user = $userService->updateUser($id, $user_details)) {
            return response()->json(['status' => 'success', 'message' => 'Contact has been successfully updated', 'user' => $user]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ooops something went wrong']);
        }
    }

    public function postAddStaffFromAllwork(Request $request, UserService $userService)
    {
        $inputs  = $request->all()['inputs'];
        $role    = Role::where('name', 'staff')->first();
        $role_id = isset($role) ? $role->id : null;
        $inputs['role_id'] = $role_id;
        $inputs['password'] = bcrypt($inputs['password']);
        $auth_id = $inputs['auth_id'];
        $staff    = User::create($inputs);
        $result =  UserStaff::create(['user_id' => $auth_id, 'staff_id' => $staff->id]);
        $user_id = isset($staff) ? $staff->id : null;
        return response()->json(['status' => 'success', 'abcn_user_id' => $staff->id, 'staff' => $staff]);
    }

    public function changePassword(Request $request, UserService $userService)
    {
        $inputs  = $request->all();
        $auth_id = $inputs['auth_id'];
        $new_password = bcrypt($inputs['password']);
        $user = User::find($auth_id);
        if(null !== $user->update(['password' => $new_password])) {
            return response()->json(['status' => 'success', 'user' => $user]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ooops something went wrong']);
        }
    }

    public function createCompany(Request $request)
    {
        $inputs = $request->all();
        $company = Company::create($inputs);
        if($company) {
            return response()->json(['status' => 'success', 'company' => $company]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ooops something went wrong']);
        }
    }

    public function updateCompany($id, Request $request)
    {
        $company_details = $request->all();
        $company = Company::find($id);
        if($company->update($company_details)) {
            return response()->json(['status' => 'success', 'company' => $company]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ooops something went wrong']);
        }
    }
}