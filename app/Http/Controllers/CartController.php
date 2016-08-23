<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\TempCartItemService;
use Cookie;
use Illuminate\Auth\Guard;

use Illuminate\Http\Request;

class CartController extends Controller {
	/*old index*/
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
         		// dd($items);
         		for($i = count($items) -1; $i >= 0; $i--){
         			if($i == count($items) -1) {
         				if($items[$i]->type == 'mr'){
         					$mr_start_time        = strtotime($items[$i]->mr_start_time);
			                $mr_end_time          = strtotime($items[$i]->mr_end_time);
			                $items[$i]->price_per_hour = $items[$i]->price/(($mr_end_time-$mr_start_time)/3600);
			                $items[$i]->price_due      = $items[$i]->price*30/100;
			                $items[$i]->price_total    = $items[$i]->price-$items[$i]->price_due;
			                $price_total += $items[$i]->price_due;
         				}
         				if ($items[$i]->type == 'vo') {
			                $items[$i]->sum = $items[$i]->price + $items[$i]->vo_mail_forwarding_price+100;
			                $price_total += $items[$i]->sum;
		            	}
			            if ($items[$i]->type == 'lr') {
			                $price_total += $items[$i]->price;
		            	}
         			}
         			else{
         				if($items[$i]->type == 'mr'){
         					$mr_start_time        = strtotime($items[$i]->mr_start_time);
			                $mr_end_time          = strtotime($items[$i]->mr_end_time);
			                $items[$i]->price_per_hour = $items[$i]->price/(($mr_end_time-$mr_start_time)/3600);
			                $items[$i]->price = $items[$i]->price + $items[$i+1]->price_due;
			                $items[$i]->price_due      = $items[$i]->price*30/100;
			                $items[$i]->price_total    = $items[$i]->price-$items[$i]->price_due;
			                $price_total += $items[$i]->price_due;
         				}
         				if ($items[$i]->type == 'vo') {
			                $items[$i]->sum = $items[$i]->price + $items[$i]->vo_mail_forwarding_price+100;
			                $price_total += $items[$i]->sum;
			                
		            	}
			            if ($items[$i]->type == 'lr') {
			                $price_total += $items[$i]->price;
		            	}
         			}
         		}	
         	}
         	else {
         		$items = [];
     		}  
     		// dd($items, $price_total);
     		return view('cart.index', ['items' => $items, 'price_total' => round($price_total, 2)]);
		} else {
			$price_total = 0;
			$items = [];
     		$items = $tempCartItemService->getItemsByUserId(\Auth::id());
     		// dd($items);
     		for($i = count($items) -1; $i >= 0; $i--){
     			if($i == count($items) -1) {
     				if($items[$i]->type == 'mr'){
     					$mr_start_time        = strtotime($items[$i]->mr_start_time);
		                $mr_end_time          = strtotime($items[$i]->mr_end_time);
		                $items[$i]->price_per_hour = $items[$i]->price/(($mr_end_time-$mr_start_time)/3600);
		                $items[$i]->price_due      = $items[$i]->price*30/100;
		                $items[$i]->price_total    = $items[$i]->price-$items[$i]->price_due;
		                $price_total += $items[$i]->price_due;
     				}
     				if ($items[$i]->type == 'vo') {
		                $items[$i]->sum = $items[$i]->price + $items[$i]->vo_mail_forwarding_price+100;
		                $price_total += $items[$i]->sum;
	            	}
		            if ($items[$i]->type == 'lr') {
		                $price_total += $items[$i]->price;
	            	}
     			}
     			else{
     				if($items[$i]->type == 'mr'){
     					$mr_start_time        = strtotime($items[$i]->mr_start_time);
		                $mr_end_time          = strtotime($items[$i]->mr_end_time);
		                $items[$i]->price_per_hour = $items[$i]->price/(($mr_end_time-$mr_start_time)/3600);
		                $items[$i]->price = $items[$i]->price + $items[$i+1]->price_due;
		                $items[$i]->price_due      = $items[$i]->price*30/100;
		                $items[$i]->price_total    = $items[$i]->price-$items[$i]->price_due;
		                $price_total += $items[$i]->price_due;
     				}
     				if ($items[$i]->type == 'vo') {
		                $items[$i]->sum = $items[$i]->price + $items[$i]->vo_mail_forwarding_price+100;
		                $price_total += $items[$i]->sum;
		                
	            	}
		            if ($items[$i]->type == 'lr') {
		                $price_total += $items[$i]->price;
	            	}
     			}
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
