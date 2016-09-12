<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use App\Services\CustomerService;
use Admin\Services\UserService;
use Exception;
use Carbon\Carbon;

class InvoicesController extends Controller
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
    public function show($id, InvoiceService $invoiceService, CustomerService $customerService)
    {
        $invoice = $invoiceService->getInvoiceById($id);
        $sum_extra_charge_price = $invoiceService->getExtraChargesPrice($invoice);
        $invoiceService->makeAdminCustomer($id);
        $prorated_amount = $invoiceService->getInvoiceProratedAmount($invoice);
        return view('admin.invoices.show', ['invoice' => $invoice, 'prorated_amount' => $prorated_amount, 'sum_extra_charge_price' => $sum_extra_charge_price]);
        //return redirect('users');
    }

    public function chargeAllInvoices($id, InvoiceService $invoiceService, UserService $userService)
    {
        //dd('talking with support to need more information . this section in progress...');
        $all_invoices = $invoiceService->getAllPendingInvoicesByCustomerId($id);
        $total_price = 0;
        foreach ($all_invoices as $invoice) {
            $price = $invoice->price;
            if($invoice->recurring_attempts == 0) {
                $first_price = unserialize($invoice->serialized_card_item_info)['first_prorated_amount'];
                if($first_price != 0) {
                    $price = $first_price;
                }
            } elseif($invoice->recurring_attempts == $invoice->recurring_period_within_month) {
                $price = unserialize($invoice->serialized_card_item_info)['last_prorated_amount'];
            }
            if(!$invoice || !$invoice->customer) {
                throw new Exception("Invalid invoice", 1);
            }
            $extra_charges = $invoiceService->getInvoiceExtraCharges($invoice);
            foreach ($extra_charges as $extra_charge) {
                if($extra_charge->step != $extra_charge->period) {
                    $price = $price + $extra_charge->amount;
                }
            }
        }
        dd($price);
        $invoice_id = rand(1,999999999);

        $braintree_enviorenment = config('braintree.env');
        $braintree_configs = [];
        if($braintree_enviorenment == 'production') {
            $braintree_configs = config('braintree.production_credentials');
        } elseif($braintree_enviorenment == 'sandbox') {
            //dd('as');
            $braintree_configs = config('braintree.sandbox_credentials');
        } else {
            throw new Exception("Braintree enviorenment was incorrect. must be 'production or sandbox'", 1);
            
        }
        
        $customer = $userService->getUser($id);
        $customer_id = $customer->id;
        $amount    = $price;
        //dd($amount, 'aa');
        $order_id  = $invoice_id;
        \Braintree_Configuration::environment($braintree_enviorenment);
        \Braintree_Configuration::merchantId($braintree_configs['merchant_id']);
        \Braintree_Configuration::publicKey($braintree_configs['public_key']);
        \Braintree_Configuration::privateKey($braintree_configs['private_key']);

        $customer = unserialize($customer->customer_serialized_result);
        //dd($customer->customer->creditCards[0]->token, $amount, $order_id);
        //dd($customer->customer->creditCards[0]->token);
        $result = \Braintree_Transaction::sale(
          [
            'paymentMethodToken' => $customer->customer->creditCards[0]->token,
            'orderId' => $order_id,
            'amount' => $amount
          ]
        );
        // 
        if($braintree_enviorenment == 'sandbox') {
            // logic for sandox mode
            if($result->success) {
                $f = serialize($result);
                $attributes = unserialize($f)->transaction;
                $attributes = serialize($attributes);  
                foreach ($all_invoices as $invoice) {
                    $new_extra_charge = $invoiceService->createExtraCharge($invoice->id);
                    $new_invoice = $invoiceService->createInvoice($invoice->id);
                    if($new_invoice) {
                        $invoice = $invoiceService->updateInvoiceParams($invoice->id, $attributes);
                        // if(null !== $invoice) {
                        //     //return redirect('/csr')->withSuccess('need more info where to redircet after success payment');
                        // } else {
                        //     //something whent wrong
                        // }
                    } else {
                        $invoice = $invoiceService->updateInvoiceParamsById($invoice->id, $attributes);
                        // if($invoice) {
                        //     //
                        // } else {
                        //     // something whent wrong
                        // }
                    }
                }  
                return redirect('/customers/'.$customer_id)->withSuccess('your payment has been approved');
            } else {
                dd($result);
                dd('need more info where to redircet when payment is declined');
            }
        } else {
            // logic for production
            if($result->success) {
                //
            } else {
                //
            }
        }    
        

    }

    public function chargeInvoice($id, InvoiceService $invoiceService, CustomerService $customerService)
    {
        $braintree_enviorenment = config('braintree.env');
        $braintree_configs = [];
        if($braintree_enviorenment == 'production') {
            $braintree_configs = config('braintree.production_credentials');
        } elseif($braintree_enviorenment == 'sandbox') {
            //dd('as');
            $braintree_configs = config('braintree.sandbox_credentials');
        } else {
            throw new Exception("Braintree enviorenment was incorrect. must be 'production or sandbox'", 1);
            
        }
        $invoice = $invoiceService->getInvoiceById($id);

        $price = $invoice->price;
        if($invoice->recurring_attempts == 0) {
            $first_price = unserialize($invoice->serialized_card_item_info)['first_prorated_amount'];
            if($first_price != 0) {
                $price = $first_price;
            }
        } elseif($invoice->recurring_attempts == $invoice->recurring_period_within_month) {
            $price = unserialize($invoice->serialized_card_item_info)['last_prorated_amount'];
        }
        if(!$invoice || !$invoice->customer) {
            throw new Exception("Invalid invoice", 1);
        }
        $extra_charges = $invoiceService->getInvoiceExtraCharges($invoice);
        foreach ($extra_charges as $extra_charge) {
            if($extra_charge->step != $extra_charge->period) {
                $price = $price + $extra_charge->amount;
            }
        }
        $customer = $invoice->customer;
        $customer_id = $customer->id;

        $order_id  = $invoice->id;

        \Braintree_Configuration::environment($braintree_enviorenment);
        \Braintree_Configuration::merchantId($braintree_configs['merchant_id']);
        \Braintree_Configuration::publicKey($braintree_configs['public_key']);
        \Braintree_Configuration::privateKey($braintree_configs['private_key']);

        $customer = unserialize($customer->customer_serialized_result);

        $result = \Braintree_Transaction::sale(
          [
            'paymentMethodToken' => $customer->customer->creditCards[0]->token,
            'orderId' => $order_id,
            'amount' => $price
          ]
        );


        if($result) {
            $result = \Braintree_Transaction::submitForSettlement($result->transaction->id);    
        }
        
        if($braintree_enviorenment == 'sandbox') {
            // logic for sandox mode
            if($result->success) {
                $f = serialize($result);
                $attributes = unserialize($f)->transaction;
                //dd($attributes);
                $attributes = serialize($attributes);
                $new_extra_charge = $invoiceService->createExtraCharge($id);
                $new_invoice = $invoiceService->createInvoice($id);
                if($new_invoice) {
                    $invoice = $invoiceService->updateInvoiceParams($id, $attributes);
                    if(null !== $invoice) {
                        return redirect('/customers/'.$customer_id)->withSuccess('your payment has been approved');
                    } else {
                        //something whent wrong
                    }
                } else {
                    $invoice = $invoiceService->updateInvoiceParamsById($id, $attributes);
                    if($invoice) {
                        return redirect('/customers/'.$customer_id)->withSuccess('your payment has been approved');
                    } else {
                        // something whent wrong
                    }
                }    
            } else {
                $new_decline_invoice = $invoiceService->createDeclineInvoice($id);
                if($new_decline_invoice) {
                    return redirect()->back()->withError('You have an error');
                } else {
                    //something whent wrong
                }
            }
        } else {
            // logic for production
            if($result->success) {
                $f = serialize($result);
                $attributes = unserialize($f)->transaction;
                $attributes = serialize($attributes);
                $invoice = $invoiceService->updateInvoiceStatus($id, $attributes);
                if($invoice) {
                    $new_invoice = $invoiceService->createInvoice($id);
                    dd($new_invoice, 'aa');
                }    
            } else {
                return redirect()->back()->withError('You have an error');
            }
        }    
    }

    private function checkCustomerCreditCardCredentials($customer)
    {
        if( $customer->cc_name === null || $customer->cc_name == '' ||
            $customer->cc_number === null || $customer->cc_number == '' || 
            $customer->cc_year === null || $customer->cc_year == '' || 
            $customer->cc_month === null || $customer->cc_month == '' || 
            $customer->cvv2 === null || $customer->cvv2 == '' ) {

            return false;
        }
        return true;
    }

    public function extraCharge($id, InvoiceService $invoiceService) 
    {
        $invoice = $invoiceService->getInvoiceById($id);
        $extra_charge_max_period = $invoice->recurring_period_within_month - $invoice->recurring_attempts;
        $charge_reasons = [
            ''                             => 'Please Select',
            'Refreshments'                 => 'Refreshments',
            'A/V Rental'                   => 'A/V Rental',
            'Office Supplies'              => 'Office Supplies',
            'Meeting Supplies'             => 'Meeting Supplies',
            'Building Services'            => 'Building Services',
            'Shipping / Courier Services'  => 'Shipping / Courier Services',
            'Administrative Assistant'     => 'Administrative Assistant',
            'Conference and Meeting Rooms' => 'Conference and Meeting Rooms',
            'Parking Validations'          => 'Parking Validations'
        ];
        $period = [];
        for($i = 1; $i <= $extra_charge_max_period; $i++) {
            $period[$i] = $i;
        }
        return view('admin.csr.extra_charge', ['invoice' => $invoice, 'extra_charge_max_period' => $extra_charge_max_period, 'charge_reasons' => $charge_reasons, 'period' => $period]);
    }

    public function addExtraCharge($id, Request $request, InvoiceService $invoiceService) 
    {
        $extra_charge = $invoiceService->addExtraCharge($id, $request->all());
        if($extra_charge) {
            return redirect('/invoices/'.$id)->withSuccess('Extra charge has been successfully created');
        } else {
            return redirect()->back()->withWarning('Ops. Something went wrong please try later');
        }
    }

}
