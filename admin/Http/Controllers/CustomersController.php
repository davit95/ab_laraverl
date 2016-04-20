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
        $customers = $customerService->getAllCustomers();
        return view('admin.csr.customers.customers', ['customers' => $customers]);
    }

    public function show($id, CustomerService $customerService)
    {
        $customer = $customerService->getCustomerById($id);
        return view('admin.csr.customers.customer-show', ['customer' => $customer]);
    }

    public function store(Request $request, CustomerService $customerService) 
    {
        //
    }

    public function edit($id, CustomerService $customerService)
    {
        $customer = $customerService->getCustomerById($id);
        return view('admin.csr.customers.customer-edit',['customer' => $customer]);
    }

    public function update($id, Request $request, CustomerService $customerService)
    {
        if ($customerService->updateCustomer($id, $request->all())) {
            return redirect('customers/'.$id)->withSuccess('Center has been successfully updated.');
        }
        else {
            return redirect()->back()->withWarning('Whoops, looks like something went wrong, please try later.');
        }
    }
}