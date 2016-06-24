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
use Admin\Http\Requests\CsrRequest;
use Admin\Http\Requests\UserRequest;
use Admin\Contracts\UserInterface;



class UsersController extends Controller
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
    public function index(Request $request, OwnerInterface $ownerService, UserInterface $userService)
    {
        $role = \Auth::user()->role->name;
        $users = $userService->getCsrOrAccountingUsers($request);
        return view('admin.users.index', ['users' => $users, 'role' => $role]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserInterface $userService)
    {
        if(null != $userService->createUser($request->all())) {
            return redirect()->back()->withSuccess('user successfully created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request, UserInterface $userService)
    {
        $role = \Auth::user()->role->name;
        if($request->is('admin-users')) {
            $user_type = 'accounting_user';
        } else {
            $user_type = 'admin';
        }
        $user = $userService->getUserById($id);
        return view('admin.users.admin-index', ['role' => $role, 'user_type' => $user_type, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\OwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UserInterface $userService, Request $request)
    {
        if ( null != $user = $userService->updateUser($id, $request->all() ) ) {
            return redirect('users/'.$user->id)->withSuccess('User has been successfully updated.');
        }
        return redirect('/users')->withWarning('Whoops, looks like something went wrong, please try later.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addAllianceUser(Request $request, UserInterface $userService)
    {
        $role = \Auth::user()->role->name;
        if($request->is('admin-users')) {
            $user_type = 'accounting_user';
        } else {
            $user_type = 'admin';
        }
        return view('admin.users.admin-index', ['role' => $role, 'user_type' => $user_type]);
        
    }

    public function createAdminUser(CsrRequest $request, UserInterface $userService)
    {
        if(null != $userService->createAllianceUser($request->all())) {
            return redirect()->back()->withSuccess('user successfully created');
        }
    }

    public function getClientPage()
    {
        //dd(\Auth::user());
        return view('admin.client.index', ['role' => 'super_admin','client' => \Auth::user()]);
    }
}
