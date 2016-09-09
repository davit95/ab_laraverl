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
        $invoiceService->makeAdminCustomer($id);
        $prorated_amount = $invoiceService->getInvoiceProratedAmount($invoice);
        return view('admin.invoices.show', ['invoice' => $invoice, 'prorated_amount' => $prorated_amount]);
        //return redirect('users');
    }

    public function chargeAllInvoices($id, InvoiceService $invoiceService, UserService $userService)
    {
        //dd('talking with support to need more information . this section in progress...');
        $all_invoices = $invoiceService->getAllPendingInvoicesByCustomerId($id);
        $total_price = 0;
        foreach ($all_invoices as $invoice) {
            //dd($invoice->id, session('price_'.$invoice->id));
            $total_price = $total_price + session('price_'.$invoice->id);
            if(!$invoice || !$invoice->customer) {
                throw new Exception("Invalid invoice", 1);
            }
        }
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
        $amount    = $total_price;
        //dd($amount, 'aa');
        $order_id  = $invoice_id;
        \Braintree_Configuration::environment($braintree_enviorenment);
        \Braintree_Configuration::merchantId($braintree_configs['merchant_id']);
        \Braintree_Configuration::publicKey($braintree_configs['public_key']);
        \Braintree_Configuration::privateKey($braintree_configs['private_key']);

        $customer = unserialize($customer->customer_serialized_result);
        //dd($customer->customer->creditCards[0]->token, $amount, $order_id);
        dd($customer->customer->creditCards[0]->token);
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

}
