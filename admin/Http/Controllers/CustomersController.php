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
            $dataMin = $data_start->diffInMinutes($data_end);
            $dataHour = $data_start->diffInHours($data_end);
        }else{
            $mr_name = '';
            $mr_option_price = '';
            $dataMin =  '';
            $dataHour = '';
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
               'mr_option' => $mr_option_price,
               'dataMin' => $dataMin,
               'dataHour' => $dataHour
            ]);
        } else {
            dd(404);
        }
    }
}