<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Admin\Services\CenterService;
use App\Services\CountryService;

use App\Services\UsStateService;


class ReportsController extends Controller
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
    public function index(CenterService $centerService  , UsStateService $UsStateService, CountryService $countryService)
    {
/*        $usCenters = $UsStateService->getAllStates()->toArray();
        $countries = $countryService->getAllCountries()->toArray();
        $centers = array_merge($usCenters,$countries);*/
        //dd($centers);
        $role_id = \Auth::user()->role_id;
        $centers = [];
        $packages = [];
        foreach ($centers as $center) {
            $packages[] = $this->packages($center);
        }
        //dd($packages[100]['Platinum Plus']->current_currency_price->price);
        return view('admin.reports.index', [ 'reports' => [], 'centers' => $centers,'packages' => $packages, 'role_id' => $role_id ]);
    }

    public function downloadCsv()
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));
    }


    private function packages($center) {
        $packages = [];
        foreach ($center->prices as $price) {
            if ($price->package->name === 'Platinum Package') {
                $packages['Platinum'] = $price;
            }
            if ($price->package->name === 'Platinum Plus Package') {
                $packages['Platinum Plus'] = $price;
            }
        }
        if (isset($packages['Platinum'])  && $packages['Platinum']->current_currency_price->price &&
            isset($packages['Platinum Plus']) && $packages['Platinum Plus']->current_currency_price->price
        ) {
            $remainder                        = round(($packages['Platinum Plus']->current_currency_price->price-$packages['Platinum']->current_currency_price->price)/session('rate'), 2);
            $with_live_receptionist_remainder = round(($packages['Platinum Plus']->current_currency_price->with_live_receptionist_pack_price-$packages['Platinum']->current_currency_price->with_live_receptionist_pack_price)/session('rate'), 2);
            session(['remainder' => $remainder, 'with_live_receptionist_remainder' => $with_live_receptionist_remainder]);
        } else {
            session()->forget('remainder');
            session()->forget('with_live_receptionist_remainder');
        }
        return $packages;
    }
}