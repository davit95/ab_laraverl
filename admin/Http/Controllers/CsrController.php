<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsStateService;
use App\Services\CountryService;
use App\Services\CustomerService;
use App\Http\Requests;
use Admin\Http\Requests\CenterRequest;

use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;
use Admin\Contracts\UserInterface;
use Admin\Services\CenterService;

class CsrController extends Controller
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
    public function index(UserInterface $userService)
    {
        //dd(\Auth::user()->role_id);
        if(\Auth::user()->role_id == 1) {
            $customers = $userService->getALlCustomers(\Auth::user()->role_id);
            //$role_id = \Auth::user()->role_id;
        } elseif(\Auth::user()->role_id == 3) {
            $customers[] = \Auth::user();
            //$role_id = \Auth::user()->role_id;
        } elseif(\Auth::user()->role_id == 5) {
             $customers = $userService->getALlCustomersByOwnerId(\Auth::user()->owner_id);
             //$role_id = \Auth::user()->role_id;
        }
        elseif(\Auth::user()->role_id == 2) {
            //$role_id = \Auth::user()->role_id;
            dd('in progress');
        }
        $role_id = \Auth::user()->role_id;
        
        return view('admin.csr.index', ['customers' => $customers, 'role_id' => $role_id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccounts()
    {
        $role_id = \Auth::user()->role_id;
        return view('admin.csr.accounting', ['accounts' => [], 'role_id' => $role_id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exitInterview()
    {
        $role_id = \Auth::user()->role_id;
        return view('admin.csr.exit-interview', ['role_id' => $role_id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function declined()
    {
        $role_id = \Auth::user()->role_id;
        return view('admin.csr.declined', ['role_id' => $role_id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending(CustomerService $customerService)
    {
        $role_id = \Auth::user()->role_id;
        $customers = $customerService->getALlCustomers();
        return view('admin.csr.customers.csr-pending-mrs', ['customers' => $customers, 'role_id' => $role_id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function charge(CustomerService $customerService)
    {
        $role_id = \Auth::user()->role_id;
        return view('admin.csr.charge', ['customer' => [], 'role_id' => $role_id]);
    }

    public function test($name, $id,CustomerService $customerService)
    {
        /*need more information*/
        $role_id = \Auth::user()->role_id;
        $customer = $customerService->getCustomerById($id);
        return view('admin.csr.test', ['customer' => $customer, 'role_id' => $role_id]);
    }
}