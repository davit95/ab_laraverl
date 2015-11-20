<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use Cookie;

use App\Services\TempCartItemService;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Guard $auth, TempCartItemService $tempCartItemService)
    {
        if($auth->guest()) {
            if(null != $temp_user_id = Cookie::get('temp_user_id')) {
                $items = $tempCartItemService->getItemsByTempUserId($temp_user_id);

                foreach($items as $item) {
                    if(isset($item->vo_plan)) {
                        $item->sum = $item->price + $item->vo_mail_forwarding_price + 100;
                    } else {
                        $mr_start_time = strtotime($item->mr_start_time);
                        $mr_end_time = strtotime($item->mr_end_time);
                        $item->price_per_hour = $item->price/(($mr_end_time - $mr_start_time)/3600);
                        $item->price_due = $item->price*30/100;
                        $item->price_total = $item->price-$item->price_due;
                    }
                }

            } else {
                $items = [];
            }
            //dd($items);
            return view('cart.index', ['items' => $items]);
        }
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
}
