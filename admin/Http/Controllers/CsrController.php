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
    public function index(CustomerService $customerService)
    {
        $customers = $customerService->getALlCustomers();
        return view('admin.csr.index', ['customers' => $customers]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccounts()
    {
        return view('admin.csr.accounting', ['accounts' => []]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exitInterview()
    {
        return view('admin.csr.exit-interview');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function declined()
    {
        return view('admin.csr.declined');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending(CustomerService $customerService)
    {
        $customers = $customerService->getALlCustomers();
        return view('admin.csr.customers.csr-pending-mrs', ['customers' => $customers]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function charge(CustomerService $customerService)
    {
        return view('admin.csr.charge', ['customer' => []]);
    }

    public function test($name, $id,CustomerService $customerService)
    {
        /*need more information*/
        $customer = $customerService->getCustomerById($id);
        return view('admin.csr.test', ['customer' => $customer]);
    }
}