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
use Carbon\Carbon;

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
        $role = \Auth::user()->role->name;  
        if($role === 'super_admin' || $role == 'accounting_user') {
            $invoices = $invoiceService->getAllInvoices();
            //$customers = $userService->getALlCustomers();
        } elseif(\Auth::user()->role->name === 'client_user') {
            // $customers[] = \Auth::user();
            //$role_id = \Auth::user()->role_id;
        } elseif(\Auth::user()->role->name === 'owner_user') {
             // $customers = $userService->getALlCustomersByOwnerId(\Auth::user()->owner_id);
        }
        elseif(\Auth::user()->role->name === 'admin') {
            $role_id = \Auth::user()->role_id;
            $your_invoices = $invoiceService->getYourInvoices();
            $new_invoices = $invoiceService->getNewInvoices();
            $new_invoices_ids = $invoiceService->checkStatus();
            return view('admin.csr.index', ['role' => $role, 'your_invoices' => $your_invoices, 'new_invoices' => $new_invoices, 'new_invoices_ids' => $new_invoices_ids]);  
        }
        return view('admin.csr.index', ['invoices' => $invoices, 'role' => $role, 'new_invoices_ids' => []]);
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
    public function charge(CustomerService $customerService, InvoiceService $invoiceService)
    {
        $role = \Auth::user()->role->name;
        $invoices = $invoiceService->getAllNextInvoices();
        //dd($invoices);
        return view('admin.csr.charge', ['customer' => [], 'role_id' => $role, 'invoices' => $invoices]);
    }


    public function getCustomerInfo($id,CustomerService $customerService, UserInterface $userService, InvoiceService $invoiceService)
    {
        $customerService->getCustomerPrices($id);
        $role = \Auth::user()->role->name;
        $customer = $userService->getCustomerByIdAndRole($id, \Auth::user()->role->name);
        $next_invoices = $userService->getCustomerPendingInvoices($id);
        $declined_invoices = $userService->getCustomerDeclinedInvoices($id);
        $completed_invoices = $userService->getCustomerCompletedInvoices($id);
        $recurring_invoice = $userService->getRecurringInvoice($id);
        $recurring_invoice_start_date = '';
        $recurring_invoice_end_date = '';
        $invoices = $customerService->getCustomerPrices($id);
        $extra_charges_amount = $customerService->getCustomersExtraChargesAmount($id);
        $date = new Carbon;
        if($recurring_invoice) {
            $recurring_invoice_start_date = $date->parse($recurring_invoice->created_at)->format('d/m/Y');
            $recurring_invoice_end_date = $date->parse($recurring_invoice->created_at)->addMonth($recurring_invoice->recurring_period_within_month)->format('d/m/Y');   
        }
        //dd(unserialize($next_invoices[3]->serialized_card_item_info)['first_prorated_amount']);

        return view('admin.csr.customer_info',
        [
            'customer'           => $customer, 
            'invoices'           => $invoices, 
            'role'               => $role, 
            'next_invoices'      => $next_invoices, 
            'declined_invoices'  => $declined_invoices,
            'completed_invoices' => $completed_invoices,
            'recurring_invoice'  => $recurring_invoice,
            'recurring_invoice_start_date'  => $recurring_invoice_start_date,
            'recurring_invoice_end_date'    => $recurring_invoice_end_date,
            'extra_charges_amount' => $extra_charges_amount
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
}