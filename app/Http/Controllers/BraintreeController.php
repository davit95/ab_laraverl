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
        //
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

        $client_token = \Braintree_ClientToken::generate();
        //dd($client_token);y
        return view('payment', ['client_token' => $client_token]);
        // spl_autoload_register(function ($className) {
        //     if (strpos($className, 'Braintree') !== 0) {
        //         return;
        //     }
        //     $fileName = dirname(__DIR__) . '/lib/';
        //     if ($lastNsPos = strripos($className, '\\')) {
        //         $namespace = substr($className, 0, $lastNsPos);
        //         $className = substr($className, $lastNsPos + 1);
        //         $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        //     }
        //     $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        //     if (is_file($fileName)) {
        //         require_once $fileName;
        //     }
        // });

        // if (version_compare(PHP_VERSION, '5.4.0', '<')) {
        //     throw new Braintree_Exception('PHP version >= 5.4.0 required');
        // }
        // function requireDependencies() {
        //     $requiredExtensions = ['xmlwriter', 'openssl', 'dom', 'hash', 'curl'];
        //     foreach ($requiredExtensions AS $ext) {
        //         if (!extension_loaded($ext)) {
        //             throw new Braintree_Exception('The Braintree library requires the ' . $ext . ' extension.');
        //         }
        //     }
        // }
        // requireDependencies();

        // \Braintree_Configuration::environment('sandbox');
        // \Braintree_Configuration::merchantId('hcz2tmfpjngv9rjk');
        // \Braintree_Configuration::publicKey('5w5dbwftxgt56dxx');
        // \Braintree_Configuration::privateKey('bb8b66c74d8740508bc72d28d116ad07');
        // \Braintree_ClientToken::generate();

        // //$clientToken = \Braintree_ClientToken::generate();
        // //$nonceFromTheClient = $_POST["payment_method_nonce"];
        // //dd($clientToken);
        // return view('braintree.index');
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
        
        if (isset($_GET["id"])) {
            $result = \Braintree_TransparentRedirect::confirm($_SERVER['QUERY_STRING']);
            //var_dump($result);exit();
        }
        if (isset($result) && $result->success) {
            dd('ura');
        }
    }

}
