<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\TempCartItemService;
use Cookie;
use Illuminate\Auth\Guard;

use Illuminate\Http\Request;

class CartController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Guard $auth, TempCartItemService $tempCartItemService) {
		if ($auth->guest()) {
			$price_total = 0;
			if (null != $temp_user_id = Cookie::get('temp_user_id')) {
				$items = $tempCartItemService->getItemsByTempUserId($temp_user_id);				
				foreach ($items as $item) {
					if ($item->type == 'mr') {
						$mr_start_time        = strtotime($item->mr_start_time);
						$mr_end_time          = strtotime($item->mr_end_time);
						$item->price_per_hour = $item->price/(($mr_end_time-$mr_start_time)/3600);
						$item->price_due      = $item->price*30/100;
						$item->price_total    = $item->price-$item->price_due;
						$price_total += $item->price_total;						
					}					
					if ($item->type == 'vo') {
						$item->sum = $item->price+$item->vo_mail_forwarding_price+100;
						$price_total += $item->sum;
					}
					if ($item->type == 'lr') {
						$price_total += $item->price;
					}
				}

			} else {
				$items = [];
			}			
			return view('cart.index', ['items' => $items, 'price_total' => round($price_total, 2)]);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id, Guard $auth, TempCartItemService $tempCartItemService) {
		if ($auth->guest()) {
			if (null != $temp_user_id = Cookie::get('temp_user_id')) {
				if ($tempCartItemService->destroyItem($id, $temp_user_id)) {
					return redirect()->back()->withSuccess('Item has been successfully deleted from cart.');
				}
			}
		}
		return redirect()->back()->withSuccess('Whoops, looks like something went wrong, please try later.');
	}
}
