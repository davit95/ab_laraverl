<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Center;
use App\Product;
use App\Http\Requests\SendContactrequest;
use App\Http\Requests\CustomizeMailRequest;
use App\Http\Controllers\Controller;
use App\Services\TelCountryService;
use Illuminate\Cookie\CookieJar;
use App\Services\TempCartItemService;
use Illuminate\Auth\Guard;
use Cookie;


class AvoPagesController extends Controller
{
    /**
     * Display the live-receptionist page.
     *
     * @return Response
     */
    public function liveReceptionist()
    {
        return view('avo-pages.live-receptionist');
    }

    /**
     * Display the all-features page.
     *
     * @return Response
     */
    public function allFeatures()
    {
        return view('avo-pages.all-features');
    }
    
    /**
     * Display the all-features page.
     *
     * @return Response
     */
    public function customizePhone(TelCountryService $telCountryService)
    {
        $country_codes = $telCountryService->getAllCountriesWithList();
        return view('avo-pages.customize-phone', ['country_codes' => $country_codes]);
    }

    public function storePhoneSettings( Request $request , TempCartItemService $tempCartItemService )
    {       
        // dd($request->all());
        $temp_user_id = Cookie::get('temp_user_id');
        if( null != $tempCartItemService->update( $temp_user_id , $request->all()) ){
            return redirect('/customer-information');
        }else{
            return redirect()->back()->withErrors('Error');
        }
    }

    /**
     * Display the all-features page.
     *
     * @return Response
     */
    public function customerInformation(TelCountryService $telCountryService)
    {
        $country_codes = $telCountryService->getAllCountriesWithList();
        return view('avo-pages.customer-information');
    }

    /**
     * Display the all-features page.
     *
     * @return Response
     */
    public function customizeMail(CustomizeMailRequest $request, TelCountryService $telCountryService)
    {
        if($request->has('cid')) {
            $center_id = $request->get('cid');
        } else {
            $center_id = 0;
        }
        if($request->has('b')) {
            $live_receptionist = 1;
        }else{
            $live_receptionist = 0;
        }
        $package_option = $request->get('p');

        //$country_codes = $telCountryService->getAllCountriesWithList();
        return view('avo-pages.customize-mail', ['center_id' => $center_id , 'live_receptionist' => $live_receptionist, 'package_option' => $package_option ]);
    }

    /**
     * Display the all-features page.
     *
     * @return Response
     */
    public function orderReview(TelCountryService $telCountryService)
    {
        //$country_codes = $telCountryService->getAllCountriesWithList();
        return view('avo-pages.order-review');
    }

    /**
     * Display the contact page.
     *
     * @return Response
     */
    public function contact()
    {
        return view('avo-pages.contact');
    }

    /**
     * Display the contact page.
     *
     * @return Response
     */
    public function sendcontact( Center $center, Guard $auth, SendContactrequest $request ,CookieJar $cookieJar, TempCartItemService $tempCartItemService)
    {        
        $inputs = $request->all();
        if (isset($inputs['upgrade']) && $inputs['upgrade']=='yes') {
            if ($inputs['package_option'] == 103) {
                $inputs['package_option'] = 105;
            }
        }
        $package = $inputs['package_option'];
        $center_id = $inputs['center_id'];
        $price = $center->find($center_id)->prices()->where('package_id', $package )->first()->price;
        $package_option = $tempCartItemService->getPackageName($package);
        $inputs['price'] = $price;
        $inputs['vo_plan'] = $package_option;
        if( $auth->guest() ){
            if(null != $cookie = Cookie::get('temp_user_id')) {
                $temp_user_id = $cookie;
            } else {
                $temp_user_id = str_random(40);
                $cookieJar->queue('temp_user_id', $temp_user_id, 999999);
            }
            
            $inputs['temp_user_id'] = $temp_user_id;
            if(null != $tempCartItemService->create($inputs))
            {
                if( $request->has('live_receptionist') ) {
                    return redirect('/customize-phone');
                } else {
                    return redirect('/cart');
                }
            }
        }

        return redirect()->back()->withSuccess('Successfully send!');
    }

    /**
     * Display the about page.
     *
     * @return Response
     */
    public function about()
    {
        return view('avo-pages.about');
    }

    /**
     * Display the management page.
     *
     * @return Response
     */
    public function management()
    {
        return view('avo-pages.management');
    }

    /**
     * Display the faq page.
     *
     * @return Response
     */
    public function faq()
    {
        return view('avo-pages.faq');
    }
}
