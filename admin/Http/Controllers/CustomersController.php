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
use Cookie;
use Admin\Services\CenterService;
use App\Services\InvoiceService;
use Carbon\Carbon;

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
        //dd('show');
        $temp_user_id = Cookie::get('temp_user_id');
        //dd($temp_user_id);
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
        $not_date = '';

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
            return view('admin.csr.customers.customer-edit',[ 'customer' => $customer, 'role_id' => $customer = \Auth::user()->role_id ]);
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
    }

    public function getBalance($id, CustomerService $customerService)
    {
        $customer = $customerService->getCustomerById($id);
        return view('admin.csr.customers.customer-balance',['customer' => $customer, 'role_id' => $customer = \Auth::user()->role_id]);
    }

    public function getInvoice($id, UserInterface $userService)
    {

        $customer = $userService->getCustomerByIdAndRole($id,\Auth::user()->role->name);
        $customer_invoice = $userService->getCusomerInvoice($id);
        if($customer_invoice == false){
            return view('errors.404');
        }
        else{
            if($customer_invoice->vo_plan != null){
                $center_package_price = $userService->getPackagePrice($customer_invoice->vo_plan);
            }
            else { 
                $center_package_price = '';
            }
        }
        if($customer_invoice->lr_id == 402)
            {
                $lr_price = '95';
            }
        elseif($customer_invoice->lr_id == 403)
            {
                $lr_price = '145';
            }
        elseif($customer_invoice->lr_id == 404)
            {
                $lr_price = '225';
            }
        elseif($customer_invoice->lr_id == 401)
            {
                $lr_price = '40';
            }
        else{

            $lr_price = '';
        }    
         
        if($customer_invoice->vo_mail_forwarding_frequency == 1)
            {
                $frequency  = 'Monthly';
                $quality = 1;
        }
        elseif($customer_invoice->vo_mail_forwarding_frequency == 2)
            {
                $frequency  = 'Bi-Wekly';
                $quality = 2;
        }
        elseif($customer_invoice->vo_mail_forwarding_frequency == 4)
            {
                $frequency  = 'Weekly';
                $quality = 4;
        }
        elseif($customer_invoice->vo_mail_forwarding_frequency == 30)
            { 
                $frequency  = 'Daily';
                $quality = 30;
        }
        else{
            $frequency  = '';
            $quality = '';
        }
        
        $mail_forwarding_description = $userService->getMailForwardingPrice($customer_invoice->vo_mail_forwarding_package);
        $center_address = $userService->getCenterAddress($customer_invoice->center_id);
        
        if($customer_invoice->mr_id != null){
            $mr_name = $userService->getMeetingRoomName($customer_invoice->mr_id, $customer_invoice->center_id);
            $data_start = \Carbon\Carbon::parse($customer_invoice->mr_start_time);
            $data_end = \Carbon\Carbon::parse($customer_invoice->mr_end_time);
            $data_min = $data_start->diffInMinutes($data_end);
            $data_hour = $data_start->diffInHours($data_end);
        }else{
            $mr_name = '';
            $mr_option_price = '';
            $data_min =  '';
            $data_hour = '';
        }
        if($customer) {
            return view('admin.csr.customers.invoice',['customer' => $customer,
               'role' => $customer = \Auth::user()->role->name ,
               'invoice' => $customer_invoice, 'package_price' => $center_package_price,
               'mail_forwarding' => $mail_forwarding_description,
               'center_addres' => $center_address,
               'mr_name' => $mr_name,
               'lr_price' => $lr_price,
               'frequency' => $frequency,
               'quality' => $quality,
               'data_min' => $data_min,
               'data_hour' => $data_hour
            ]);
        } else {
            dd(404);
        }
    }

    public function UpdateStatus($id, Request $request, UserInterface $userService)
    {
        //dd($request->all());
        if(null != $customer = $userService->updateCustomerStatus($id, $request->get('customer_status'))) {
            return redirect('customers/'.$customer->id)->withSuccess('Customer status has been successfully updated.');
        }
        return redirect('customers/'.$customer->id)->withWarning('Whoops, looks like something went wrong, please try later.');
    }

    public function manangBalance($id,CustomerService $customerService, UserInterface $userService, InvoiceService $invoiceService){
        $role = \Auth::user()->role->name;
        $customer = $userService->getCustomerByIdAndRole($id, \Auth::user()->role->name);
        $invoices = $invoiceService->getInvoicesByCustomerId($id);
        $balance_types = [
            'check'   => 'Check',
            'wire'    => 'Wire',
            'cc'      => 'Credit Card',
            'bitcoin' => 'Bitcoin'
        ];
        $months = array();
        $currentMonth = (int)date('m');

        for ($x = $currentMonth; $x < $currentMonth + 12; $x++) {
           $months[date('m', mktime(0, 0, 0, $x, 1))] = date('M', mktime(0, 0, 0, $x, 1));
        }
        $mytime = Carbon::now();
        $years = 
        [                     
            date("Y",strtotime("-0 year")) => date("Y",strtotime("-0 year")),
            date("Y",strtotime("-1 year")) => date("Y",strtotime("-1 year")),
            date("Y",strtotime("-2 year")) => date("Y",strtotime("-2 year"))
        ];

        $days = $customerService->getMonthDaysArray(date("t"));
        $customer_balance_amount = $customerService->getCustomerBalance($id);
        $balance_change_date = $customerService->getCustomerChangeDate($id);
        $last_pending_invoice = $invoiceService->getLastPendingInvoice($id);
        $next_invoice = $invoiceService->getNextInvoice($id);
        return view('admin.csr.manage_balance',
        [
            'customer' => $customer, 
            'role' => $role, 
            'invoices' => $invoices,
            'balance_types' => $balance_types,
            'months' => $months,
            'years' => $years,
            'days' => $days,
            'customer_balance_amount' => $customer_balance_amount,
            'balance_change_date' => $balance_change_date,
            'last_pending_invoice' => $last_pending_invoice,
            'next_invoice' => $next_invoice
        ]);
    }

    public function addBalance($id, Request $request, CustomerService $customerService)
    {
        $balance = $customerService->createBalance($request->all(), $id);
        if($balance) {
            return redirect('customers/'.$id.'/manage-balance')->withSuccess('Balance has been successfuly added');
        } else {
            return redirect()->back()->withWarning('Ops. Something went wrong. Please try later');
        }
    }

    public function ManageInvoiceFromBalance(Request $request, InvoiceService $invoiceService)
    {
        $id = $request->input('customer_id');
        if(null != $balance = $invoiceService->checkInvoice($request->all())) {
            return redirect('customers/'.$id.'/manage-balance')->withSuccess('Balance has been successfuly updated');
        }
        return redirect()->back()->withWarning('Ops. Something went wrong. Please try later');
    }
}