<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Services\TempCartItemService;

use Cookie;
use Illuminate\Auth\Guard;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;

class LiveReceptionistsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('live-receptionists.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function addToCart(Request $request, Guard $auth, CookieJar $cookieJar, TempCartItemService $tempCartItemService) {		
		if ($auth->guest()) {
			if (null != $cookie = Cookie::get('temp_user_id')) {
				$temp_user_id = $cookie;
			} else {
				$temp_user_id = str_random(40);
				$cookieJar->queue('temp_user_id', $temp_user_id, 999999);
			}
		}
		$params                      = $request->all();
		$params['live_receptionist'] = 1;
		$params['type']              = 'lr';
		$params['temp_user_id']      = $temp_user_id;

		$tempCartItem = $tempCartItemService->create($params);
		if (is_null($tempCartItem)) {
			return reidrect()->back()->withWarnig('Whoops, looks like something went wrong, please try later.');
		}
		return redirect('customize-phone')->withSuccess('Live Receptionist plan has been successfully added to cart.');
	}
}
