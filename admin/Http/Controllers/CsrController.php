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
    public function index(UserInterface $userService, CustomerService $customerService)
    {
        $role = \Auth::user()->role->name;  
        if($role === 'super_admin' || $role == 'accounting_user') {
            $customers = $userService->getAllCustomers();
        } elseif(\Auth::user()->role->name === 'client_user') {
            $customers[] = \Auth::user();
            //$role_id = \Auth::user()->role_id;
        } elseif(\Auth::user()->role->name === 'owner_user') {
             $customers = $userService->getALlCustomersByOwnerId(\Auth::user()->owner_id);
        }
        elseif(\Auth::user()->role->name === 'admin') {
            $role_id = \Auth::user()->role_id;
            $your_customers = $userService->getYourCustomers(\Auth::id());
            $customers = $userService->getALlCustomers(); 
            $new_customers = $customers->diff($your_customers);
            //dd($new_customers);
            return view('admin.csr.index', ['customers' => $customers, 'role' => $role, 'your_customers' => $your_customers, 'new_customers' => $new_customers]);  
        }
        
        return view('admin.csr.index', ['customers' => $customers, 'role' => $role]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccounts()
    {
        $role = \Auth::user()->role->name;

        return view('admin.csr.accounting', ['accounts' => [], 'role' => $role]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exitInterview()
    {
        $role = \Auth::user()->role->name;
        return view('admin.csr.exit-interview', ['role' => $role]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function declined()
    {
        $role = \Auth::user()->role->name;
        return view('admin.csr.declined', ['role' => $role]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending(CustomerService $customerService)
    {
        $role = \Auth::user()->role->name;
        $customers = $customerService->getALlCustomers();
        return view('admin.csr.customers.csr-pending-mrs', ['customers' => $customers, 'role' => $role]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function charge(CustomerService $customerService)
    {
        $role = \Auth::user()->role->name;
        return view('admin.csr.charge', ['customer' => [], 'role_id' => $role]);
    }

    public function test($name, $id,CustomerService $customerService, UserInterface $userService)
    {
        /*need more information*/
        $role = \Auth::user()->role->name;
        $customer = $userService->getCustomerByIdAndRole($id, \Auth::user()->role->name);
        return view('admin.csr.test', ['customer' => $customer, 'role' => $role]);
    }
}