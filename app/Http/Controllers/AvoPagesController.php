<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SendContactrequest;
use App\Http\Controllers\Controller;
use App\Services\TelCountryService;

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
    public function sendcontact(SendContactrequest $request)
    {
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
