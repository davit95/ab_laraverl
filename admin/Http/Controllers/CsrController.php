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
use App\Services\InvoiceService;

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
    public function index(UserInterface $userService, CustomerService $customerService, InvoiceService $invoiceService)
    {
        $invoices = null;
        // dd($pending_invoices);
        $role = \Auth::user()->role->name;  
        if($role === 'super_admin' || $role == 'accounting_user') {
            $invoices = $invoiceService->getPendingInvoices();
            $customers = $userService->getALlCustomers();
        } elseif(\Auth::user()->role->name === 'client_user') {
            // $customers[] = \Auth::user();
            //$role_id = \Auth::user()->role_id;
        } elseif(\Auth::user()->role->name === 'owner_user') {
             // $customers = $userService->getALlCustomersByOwnerId(\Auth::user()->owner_id);
        }
        elseif(\Auth::user()->role->name === 'admin') {
            $role_id = \Auth::user()->role_id;
            $your_customers = $userService->getYourCustomers(\Auth::id());
            $customers = $userService->getALlCustomers(); 
            $new_customers = $customers->diff($your_customers);
            //dd($new_customers);
            return view('admin.csr.index', ['customers' => $customers, 'role' => $role, 'your_customers' => $your_customers, 'new_customers' => $new_customers]);  
        }
       // dd($customers); 
        return view('admin.csr.index', ['invoices' => $invoices, 'role' => $role, 'customers' => $customers]);
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


    public function getCustomerInfo($id,CustomerService $customerService, UserInterface $userService)

    {
        /*need more information*/
        $role = \Auth::user()->role->name;
        $customer = $userService->getCustomerByIdAndRole($id, \Auth::user()->role->name);
        $next_invoices = $userService->getCustomerPendingInvoices($id);
        $declined_invoices = $userService->getCustomerDeclinedInvoices($id);
        $completed_invoices = $userService->getCustomerCompletedInvoices($id);
        //dd($next_invoices);
        return view('admin.csr.customer_info',
        [
            'customer'           => $customer, 
            'role'               => $role, 
            'next_invoices'      => $next_invoices, 
            'declined_invoices'  => $declined_invoices,
            'completed_invoices' => $completed_invoices
        ]);
    }

    public function customerSearch(Request $request, CustomerService $customerService)
    {
        $customers = $customerService->searchCustomerByKey($request->key);
        //dd($customers->where('center_id', 102)->first());
        //dd($customers[5]->centers);
        return view('admin.csr.customers.customers-search', ['customers' => $customers]);
    }

    public function biilingFaq()
    {
        return view('admin.csr.billing-faq');
    }

    public function manangBalance($id,CustomerService $customerService, UserInterface $userService){
        $role = \Auth::user()->role->name;
        $customer = $userService->getCustomerByIdAndRole($id, \Auth::user()->role->name);
        return view('admin.csr.manage_balance', ['customer' => $customer, 'role' => $role]);
    }
}