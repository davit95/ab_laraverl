<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomizeMailRequest;
use App\Http\Requests\SendContactrequest;
use App\Models\Center;

use App\Services\TelCountryService;
use App\Services\TempCartItemService;
use Cookie;
use Illuminate\Auth\Guard;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;

class AvoPagesController extends Controller {
	/**
	 * Display cvv2 information page in popup.
	 *
	 * @return Response
	 */
	public function cvv2() {
		return view('avo-pages.cvv2');
	}

	/**
	 * Set currency for current session.
	 *
	 * @return Response
	 */
	public function changeCurrency(Request $request) {
		foreach (session('currencies') as $key => $currency) {
			if ($request->currency == $currency->name) {
				$currency_id = $currency->id;
				session(['currency' => (array) $currency]);
				$rates = session('rates');
				session(['rate' => round($rates[$currency->name], 2)]);
				break;
			}
		}
		return redirect()->back();
	}

	/**
	 * Display mr-terms information page in new tab.
	 *
	 * @return Response
	 */
	public function mrTerms() {
		return view('avo-pages.mr-terms');
	}

	/**
	 * Display the all-features page.
	 *
	 * @return Response
	 */
	public function allFeatures() {
		return view('avo-pages.all-features');
	}

	/**
	 * Display the all-features page.
	 *
	 * @return Response
	 */
	public function customizePhone(TelCountryService $telCountryService) {
		$country_codes = $telCountryService->getAllCountriesWithList();
		return view('avo-pages.customize-phone', ['country_codes' => $country_codes]);
	}

	public function storePhoneSettings(Request $request, TempCartItemService $tempCartItemService) {
		// dd($request->all());
		$temp_user_id = Cookie::get('temp_user_id');
		if (null != $tempCartItemService->update($temp_user_id, $request->all())) {
			return redirect('/customer-information');
		} else {
			return redirect()->back()->withErrors('Error');
		}
	}

	/**
	 * Display the all-features page.
	 *
	 * @return Response
	 */
	public function customerInformation(TelCountryService $telCountryService) {
		$country_codes = $telCountryService->getAllCountriesWithList();
		return view('avo-pages.customer-information', ['countries' => $country_codes]);
	}

	/**
	 * Store customer information.
	 *
	 * @return Response
	 */
	public function postCustomerInformation(CustomerRequest $request) {
		session(['customer_information' => $request->all()]);
		//TODO: Need to know where we want to save customer information;
		return redirect('order-review')->withWarning('Need to know where we want to save customer information.');
	}

	/**
	 * Display the all-features page.
	 *
	 * @return Response
	 */
	public function customizeMail(CustomizeMailRequest $request, TelCountryService $telCountryService) {
		if ($request->has('cid')) {
			$center_id = $request->get('cid');
		} else {
			$center_id = 0;
		}
		if ($request->has('b')) {
			$live_receptionist = 1;
		} else {
			$live_receptionist = 0;
		}
		$package_option = $request->get('p');
		$response       = [
			'center_id'         => $center_id,
			'live_receptionist' => $live_receptionist,
			'package_option'    => $package_option
		];
		//$country_codes = $telCountryService->getAllCountriesWithList();
		return view('avo-pages.customize-mail', $response);
	}

	/**
	 * Display the all-features page.
	 *
	 * @return Response
	 */
	public function orderReview(TelCountryService $telCountryService, TempCartItemService $tempCartItemService) {
		if (!session('customer_information')) {
			return redirect('customer-information');
		}
		$customer = session('customer_information');
		//$country_codes = $telCountryService->getAllCountriesWithList();
		$price_total = 0;
		$has_vo      = false;
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
					$has_vo = true;
				}
				if ($item->type == 'lr') {
					$item->sum = $item->price;
					$price_total += $item->sum;
				}
			}

		} else {
			$items = [];
		}
		return view('avo-pages.order-review', ['customer' => (object) $customer, 'has_vo' => $has_vo, 'items' => $items, 'price_total' => round($price_total, 2)]);
	}

	/**
	 * Display the all-features page.
	 *
	 * @return Response
	 */
	public function postOrderReview() {
		return redirect()->back()->withWarning('Need to know what we want to do after placing the order.');
	}

	/**
	 * Display the contact page.
	 *
	 * @return Response
	 */
	public function contact() {
		return view('avo-pages.contact');
	}

	/**
	 * Display the contact page.
	 *
	 * @return Response
	 */
	public function sendcontact(Center $center, Guard $auth, SendContactrequest $request, CookieJar $cookieJar, TempCartItemService $tempCartItemService) {
		$inputs = $request->all();
		if (isset($inputs['upgrade']) && $inputs['upgrade'] == 'yes') {
			if ($inputs['package_option'] == 103) {
				$inputs['package_option'] = 105;
			}
		}
		$package      = $inputs['package_option'];
		$center_id    = $inputs['center_id'];
		$center_price = $center->find($center_id)->prices()->where('package_id', $package)->first();
		$price        = $center_price->price;
		if ($request->has('live_receptionist')) {
			$inputs['lr_id']   = 402;
			$inputs['lr_name'] = 'VIRTUAL OFFICE LIVE RECEPTIONIST 50';
			$price             = $center_price->with_live_receptionist_pack_price;
		}
		$package_option    = $tempCartItemService->getPackageName($package);
		$inputs['price']   = $price;
		$inputs['vo_plan'] = $package_option;
		if ($auth->guest()) {
			if (null != $cookie = Cookie::get('temp_user_id')) {
				$temp_user_id = $cookie;
			} else {
				$temp_user_id = str_random(40);
				$cookieJar->queue('temp_user_id', $temp_user_id, 999999);
			}

			$inputs['temp_user_id'] = $temp_user_id;
			if (null != $tempCartItemService->create($inputs)) {
				if ($request->has('live_receptionist')) {
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
	public function about() {
		return view('avo-pages.about');
	}

	/**
	 * Display the management page.
	 *
	 * @return Response
	 */
	public function management() {
		return view('avo-pages.management');
	}

	/**
	 * Display the faq page.
	 *
	 * @return Response
	 */
	public function faq() {
		return view('avo-pages.faq');
	}
}
