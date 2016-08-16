<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\Controller;

class BraintreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('aa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getForm()
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
        \Braintree_Configuration::environment($braintree_enviorenment);
        \Braintree_Configuration::merchantId($braintree_configs['merchant_id']);
        \Braintree_Configuration::publicKey($braintree_configs['public_key']);
        \Braintree_Configuration::privateKey($braintree_configs['private_key']);
        return view('braintree.index');
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

    public function checkout(Request $request){

        $nonceFromTheClient = $_POST["payment_method_nonce"];
        $resultss = \Braintree_Customer::create([
          'firstName'         => 'Artyom',
          'lastName'          => 'Petrosyan',
          'company'           => 'Testcompany',
        'creditCard' => [
            'paymentMethodNonce' => $nonceFromTheClient,
            'billingAddress' => [
            'firstName' => 'Artyom',
            'lastName' => 'Petrosyan',
            'company' => 'Testcompany',
            'streetAddress' => '123 Address',
            'locality' => 'Yerevan',
            'region' => 'Armenia',
            'postalCode' => '12345'
            ],
            'options' => [
                'verifyCard' => true
            ]
        ]
        ]);
        if($resultss->success){
       $result = \Braintree_Transaction::sale([
          'amount' => '10.00',
          'customerId' =>$resultss->customer->id,
          'options' => [
            'submitForSettlement' => True
          ]
        ]);
       }
       dd($result);
    }


    public function token(){
        $clientToken = \Braintree_ClientToken::generate();
        return  response()->json(['token' =>$clientToken]);
    }
    public function callback(Request $request)
    {
        //dd($_POST, $request->all());
        \Braintree_Configuration::environment('sandbox');
               \Braintree_Configuration::merchantId('hcz2tmfpjngv9rjk');
               \Braintree_Configuration::publicKey('5w5dbwftxgt56dxx');
               \Braintree_Configuration::privateKey('bb8b66c74d8740508bc72d28d116ad07');

        if (isset($_GET["id"])) {
               $result = \Braintree_TransparentRedirect::confirm($_SERVER['QUERY_STRING']);
        }
        dd($result);
        //dd($this->create_customer());
        
        //$result = \Braintree_TransparentRedirect::confirm($_SERVER['QUERY_STRING']);
    }

    #Function to store customer's information and credit card to BrainTree Vault
    public function create_customer(){
        dd($_POST);
        #Set timezone if not specified in php.ini
            //date_default_timezone_set('America/Los_Angeles');
        \Braintree_Configuration::environment('sandbox');
                      \Braintree_Configuration::merchantId('hcz2tmfpjngv9rjk');
                      \Braintree_Configuration::publicKey('5w5dbwftxgt56dxx');
                      \Braintree_Configuration::privateKey('bb8b66c74d8740508bc72d28d116ad07');
        $includeAddOn = false;
            
        /* First we create a new user using the BT API */
        $result = \Braintree_Customer::create(array(
                    'firstName' => mysql_real_escape_string($_POST['first_name']),
                    'lastName' => mysql_real_escape_string($_POST['last_name']),
                    'company' => mysql_real_escape_string($_POST['company']),
                    'email' => mysql_real_escape_string($_POST['user_email']),
                    'phone' => mysql_real_escape_string($_POST['user_phone']),
                    
                    // we can create a credit card at the same time
                    'creditCard' => array(
                        'cardholderName' => mysql_real_escape_string($_POST['full_name']),
                        'number' => mysql_real_escape_string($_POST['card_number']),
                        'expirationMonth' => mysql_real_escape_string($_POST['expiry_month']),
                        'expirationYear' => mysql_real_escape_string($_POST['expiry_year']),
                        'cvv' => mysql_real_escape_string($_POST['card_cvv']),
                        'billingAddress' => array(
                            'firstName' => mysql_real_escape_string($_POST['first_name']),
                            'lastName' => mysql_real_escape_string($_POST['last_name'])
                           /*Optional Information you can supply
                'company' => mysql_real_escape_string($_POST['company']),
                            'streetAddress' => mysql_real_escape_string($_POST['user_address']),
                            'locality' => mysql_real_escape_string($_POST['user_city']),
                            'region' => mysql_real_escape_string($_POST['user_state']), 
                            //'postalCode' => mysql_real_escape_string($_POST['zip_code']),
                            'countryCodeAlpha2' => mysql_real_escape_string($_POST['user_country'])
                  */
                        )
                    )
                ));
        if ($result->success) {
            dd($result);
           //Do your stuff
           //$creditCardToken = $result->customer->creditCards[0]->token;
           //echo("Customer ID: " . $result->customer->id . "<br />");
           //echo("Credit card ID: " . $result->customer->creditCards[0]->token . "<br />");
        } else {
            foreach ($result->errors->deepAll() as $error) {
                $errorFound = $error->message . "<br />";
            }
            echo $errorFound ;
            exit;
        }
    }

}
