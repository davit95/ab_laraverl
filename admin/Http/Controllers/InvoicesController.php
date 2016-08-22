<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use App\Services\CustomerService;
use Admin\Services\UserService;
use Exception;

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
    public function show($id, InvoiceService $invoiceService)
    {
        $invoice = $invoiceService->getInvoiceById($id);
        $invoiceService->makeAdminCustomer($id);
        return view('admin.invoices.show', ['invoice' => $invoice]);
        //return redirect('users');
    }

    public function chargeAllInvoices($id, InvoiceService $invoiceService, UserService $userService)
    {
        //dd('talking with support to need more information . this section in progress...');
        $all_invoices = $invoiceService->getAllPendingInvoicesByCustomerId($id);
        $total_price = 0;
        foreach ($all_invoices as $invoice) {
            $total_price = $total_price + $invoice->price;
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
        //dd($customer);
        $amount    = $total_price;
        $order_id  = $invoice_id;
        \Braintree_Configuration::environment($braintree_enviorenment);
        \Braintree_Configuration::merchantId($braintree_configs['merchant_id']);
        \Braintree_Configuration::publicKey($braintree_configs['public_key']);
        \Braintree_Configuration::privateKey($braintree_configs['private_key']);

        $customer = unserialize($customer->customer_serialized_result);
        //dd($customer->customer->creditCards[0]->token, $amount, $order_id);
        $result = \Braintree_Transaction::sale(
          [
            'paymentMethodToken' => $customer->customer->creditCards[0]->token,
            'orderId' => $order_id,
            'amount' => 2000
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
                return redirect('/csr')->withSuccess('need more info where to redircet after success payment');
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
        if(!$invoice || !$invoice->customer) {
            throw new Exception("Invalid invoice", 1);
        }
        $customer = $invoice->customer;
        $customer_id = $customer->id;
        //dd($customer);
        // if(!$this->checkCustomerCreditCardCredentials($customer)) {
        //     throw new Exception("The Customer CC credentials are invalid", 1);
            
        // }
        $amount    = $invoice->price;
        $order_id  = $invoice->id;
        // $cc_number = $braintree_enviorenment == 'production' ? $customer->cc_number : 4012000033330026 ;
        // $cc_month  = $customer->cc_month;
        // $cc_year   = $customer->cc_year;
        //dd($customer);
        \Braintree_Configuration::environment($braintree_enviorenment);
        \Braintree_Configuration::merchantId($braintree_configs['merchant_id']);
        \Braintree_Configuration::publicKey($braintree_configs['public_key']);
        \Braintree_Configuration::privateKey($braintree_configs['private_key']);

        // $customer = \Braintree_Customer::create([
        //     'creditCard' => [
        //             'number' => $cc_number,
        //             'expirationMonth' => $cc_month,
        //             'expirationYear' => $cc_year,

        //         'billingAddress' => [
        //             'firstName' => 'Jen',
        //             'lastName' => 'Smith',
        //             'company' => 'Braintree',
        //             'streetAddress' => '123 Address',
        //             'locality' => 'City',
        //             'region' => 'State',
        //             'postalCode' => '12345',
        //         ],


        //     ]
        // ]);
        //dd($customer->success);
        //dd($customer->customer->id);

        //$customer = \Braintree_Customer::find($customer->customer->id);
        //dd($customer->customer->creditCards[0]->token);
        $customer = unserialize($customer->customer_serialized_result);
        //dd($customer);
        $result = \Braintree_Transaction::sale(
          [
            'paymentMethodToken' => $customer->customer->creditCards[0]->token,
            'orderId' => $order_id,
            'amount' => $invoice->price
          ]
        );
        $result = \Braintree_Transaction::submitForSettlement($result->transaction->id);
        //dd($result);
        //dd($result);

        /**/
        // $result = \Braintree_Transaction::sale(array(
        //            'amount' => $amount,
        //            'orderId' => $order_id,
        //            // 'paymentMethodNonce' => 'fake-processor-declined-visa-nonce',
        //            // 'paymentMethodNonce' => 'fake-valid-visa-nonce',
        //            'creditCard' => array(
        //            'number' => $cc_number,
        //            'expirationMonth' => $cc_month,
        //            'expirationYear' => $cc_year,
        //                 ),
        //                'options' => array(
        //                    'submitForSettlement' => true
        //                 )
        //            ));
        // $new_result = \Braintree_Transaction::submitForSettlement($result->transaction->id, '35.00');
        // $result = \Braintree_Transaction::refund($result->transaction->id);
        // dd($result);
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
                        return redirect('/customers/'.$customer_id)->withSuccess('you must wait until your payment approve');
                    } else {
                        //something whent wrong
                    }
                } else {
                    $invoice = $invoiceService->updateInvoiceParamsById($id, $attributes);
                    if($invoice) {
                        return redirect('/customers/'.$customer_id)->withSuccess('you must wait until your payment approve');
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
