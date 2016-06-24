<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsStateService;
use App\Services\CountryService;
use App\Services\CustomerService;
use App\Http\Requests;
use Admin\Http\Requests\CenterRequest;
use Admin\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;

use Admin\Services\CenterService;

class CustomersController extends Controller
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

    public function index(CustomerService $customerService)
    {
        $customers = $userService->getALlCustomers();
        return view('admin.csr.customers.customers', ['customers' => $customers, 'role_id' => $customer = \Auth::user()->role_id]);
    }

    public function getOrders(CustomerService $customerService)
    {
        $customers = $customerService->getAllCustomers();
        return view('admin.csr.customers.customers', ['customers' => $customers, 'role_id' => $customer = \Auth::user()->role_id]);
    }

    public function show($id, CustomerService $customerService, UserInterface $userService)
    {
        $months['01'] = 'January (01)';
        $months['02'] = 'February (02)';
        $months['03'] = 'March (03)';
        $months['04'] = 'April (04)';
        $months['05'] = 'May (05)';
        $months['06'] = 'June (06)';
        $months['07'] = 'July (07)';
        $months['08'] = 'August (08)';
        $months['09'] = 'September (09)';
        $months['10'] = 'October (10)';
        $months['11'] = 'November (11)';
        $months['12'] = 'December (12)';

        $userService->test($id,\Auth::id());
        $customer = $userService->getCustomerByIdAndRole($id, \Auth::user()->role->name);

        $files = $customerService->getCustomerFiles($id);

        if($customer) {
            $role_id = \Auth::user()->role_id;
            if($id == $customer->id) {
                $center = $userService->getCustomerCenterById($customer->center_id);
                $end_date = strtotime("+".$customer->duration."months", strtotime($customer->created_at));
                if($customer->duration == 6) {
                    $not_date = strtotime("+5 months", strtotime($customer->created_at));
                } elseif($customer->duration == 12) {
                    $not_date = strtotime("+11 months", strtotime($customer->created_at));
                }
            } else {
                dd(404);
            }
        } else {
            dd(404);
        }
        return view('admin.csr.customers.customer-show', ['customer' => $customer, 'end_date' => $end_date, 'not_date' => $not_date, 'months' => $months, 'center' => $center, 'role_id' => $role_id, 'files' => $files]);
    }

    public function store(Request $request, CustomerService $customerService) 
    {
        dd($request->all());
    }

    public function edit($id, CustomerService $customerService, UserInterface $userService)
    {
        $customer = $userService->getCustomerByIdAndRole($id,\Auth::user()->role->name);
        if($customer) {
            return view('admin.csr.customers.customer-edit',['customer' => $customer, 'role_id' => $customer = \Auth::user()->role_id]);
        } else {
            dd(404);
        }
    }

    public function update($id, Request $request, CustomerService $customerService, UserInterface $userService)
    {
        if ($userService->updateCustomer($id, $request->all())) {
            return redirect('customers/'.$id)->withSuccess('Center has been successfully updated.');
        }
        else {
            return redirect()->back()->withWarning('Whoops, looks like something went wrong, please try later.');
        }    
    }

    public function uploadFile($id, CustomerService $customerService, Request $request)
    {
        if ($customerService->uploadFile($id,$request->all(),$request->file())) {
            return redirect('orders/'.$id)->withSuccess('File has been successfully created.');
        }
        else {
            return redirect()->back()->withWarning('Whoops, looks like something went wrong, please try later.');
        }
        //dd();
    }

    public function getBalance($id, CustomerService $customerService)
    {
        $customer = $customerService->getCustomerById($id);
        return view('admin.csr.customers.customer-balance',['customer' => $customer, 'role_id' => $customer = \Auth::user()->role_id]);
    }

    public function getInvoice($id, UserInterface $userService)
    {
        $customer = $userService->getCustomerByIdAndRole($id,\Auth::user()->role->name);
        dd($userService->getCustomerCenterInfo($customer->center_id));
        if($customer) {
             return view('admin.csr.customers.invoice',['customer' => $customer, 'role' => $customer = \Auth::user()->role->name]);
        } else {
            dd(404);
        }
    }
}