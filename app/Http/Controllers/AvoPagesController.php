<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomizeMailRequest;
use App\Http\Requests\SendContactrequest;
use App\Models\Center;
use App\Models\Package;
use App\Services\TelCountryService;
use App\Services\TempCartItemService;
use App\Services\CenterService;
use Admin\Services\MeetingRoomService;
use App\Services\CountryService;
use App\Services\CustomerService;
use Cookie;
use Illuminate\Auth\Guard;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Carbon\Carbon;
use Auth;




class AvoPagesController extends Controller {
	/**
	 * Display cvv2 information page in popup.
	 *
	 * @return Response
	 */
	public function __construct(TempCartItemService $tempCartItemService)
	{
		$this->tempCartItemService = $tempCartItemService;
	}
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
	public function customerInformation(CenterService $centerService, TelCountryService $telCountryService, Request $request) {
		//dd(\Auth::user());
		$country_codes = $telCountryService->getAllCountriesWithList();	
		$center = $centerService->getCenterById(session()->get('centerid'));	
		isset($center->email_flag) && $center->email_flag == "Y" ? $email_flag = true : $email_flag = false;
		//dd(session()->get('center_id'));
		return view('avo-pages.customer-information', ['countries' => $country_codes, 'email_flag' => $email_flag, 'center' => $center]);
	}

	/**
	 * Store customer information.
	 *
	 * @return Response
	 */
	public function postCustomerInformation( Invoice $invoice, CustomerRequest $request, CountryService $countryService ,CustomerService $customerService, Center $centers , Package  $package ,TempCartItemService  $tempCartItemService, Auth $auth) {
		$inputs = $request->all();
		$email = $request->get('email');
		$temp_user_id = Cookie::get('temp_user_id');
		$card_items = $this->getTempCardItems();
		$invoice_insertable = [];
		$customer = $customerService->getCustomerByEmail($email);
		// dd($card_items);
		//dd($request->first_name);
		if($customer) {
			return redirect()->back()->withErrors('Email has been already taken. Please login');
		} else {
			if( null !== $countryService->getCountryById( $request->get('country_id') ) ) {
				$inputs['country'] = $countryService->getCountryById( $request->get('country_id') )->name;		
			}
			$inputs['duration'] = session('term');
			session(['customer_information' => $inputs]);
			$center = session('center');
			$curency_id = session('currency');
			if(null !== $user = $customerService->createCustomer($inputs, $center)) {
				$tempCartItemService->updateUserId($temp_user_id, $user->id);
				$customer_id = $user->id;
				\Auth::loginUsingId($user->id);

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
				// if(!$this->checkCustomerCreditCardCredentials($user)) {
				//     throw new Exception("The Customer CC credentials are invalid", 1);
				    
				// }
				$cc_number = $braintree_enviorenment == 'production' ? $customer->cc_number : 4012000033330026 ;
				$cc_month  = $request->cc_month;
				$cc_year   = $request->cc_year;
				\Braintree_Configuration::environment($braintree_enviorenment);
				\Braintree_Configuration::merchantId($braintree_configs['merchant_id']);
				\Braintree_Configuration::publicKey($braintree_configs['public_key']);
				\Braintree_Configuration::privateKey($braintree_configs['private_key']);
				$customer = \Braintree_Customer::create([
				    'creditCard' => [
				            'number' => $cc_number,
				            'expirationMonth' => $cc_month,
				            'expirationYear' => $cc_year,

				        'billingAddress' => [
				            'firstName' => $request->first_name,
				            'lastName' => $request->last_name,
				            'company' => $request->company_name,
				            'streetAddress' => $request->address1,
				            'locality' => $request->city,
				            'region' => $request->state,
				            'postalCode' => $request->postal_code,
				        ],


				    ]
				]);
				if($customer->success) {
					$customerService->createCustomerSerializedInfo($customer,$customer_id);
				} else {
					return redirect()->back()->withWarning('You have payment error ');
				}	
			}
		}
		// dd($customer);
		// dd($inputs);
		
		// dd($card_items->toArray());
		// dd($inputs);
		// foreach ($card_items as $value) {
		// 	$price = 0;
		// 	if($value->type == 'vo') { 
		// 		$price = $value->sum;
		// 	} elseif($value->type == 'mr') {
		// 		$price = $value->price_due;
		// 	} elseif($value->type == 'lr') {
		// 		$price = $value->price;
		// 	}

		// 	$item_id = null;
		// 	if($value->type == 'vo') { 
		// 		$item_id = $value->center_id;
		// 	} elseif($value->type == 'mr') {
		// 		$item_id = $value->mr_id;
		// 	} elseif($value->type == 'lr') {
		// 		$item_id = $value->lr_id;
		// 	}
		// 	$temp['type'] = $value->type;
		// 	$temp['payment_type'] = 'initial';
		// 	$temp['item_id'] = $item_id;
		// 	$temp['price'] = $price;
		// 	$temp['is_recurring'] = $value->type == 'vo' ? 1 : 0;
		// 	$temp['recurring_period_within_month'] = $value->type == 'vo' ? $value->monthly_period : null;
		// 	$temp['recurring_attempts'] = $value->type == 'vo' ? 0 : null;
		// 	$temp['customer_id'] = $customer_id;
		// 	$temp['status'] = 'pending';
		// 	$temp['payment_response'] = null;
		// 	$temp['serialized_card_item_info'] = serialize($value->toArray());
		// 	$temp['created_at'] = Carbon::now()->__toString();
		// 	$temp['updated_at'] = Carbon::now()->__toString();
		// 	$invoice_insertable[] = $temp;
		// }
		// session(['customer_information' => $inputs]);
		//$invoice->insert($invoice_insertable);
		// dd($invoice_insertable);
		//$cookie = Cookie::forget('temp_user_id');
		//->withCookie($cookie)
		return redirect('order-review')->withSuccess('Customer has been saccessfully created');
	}

	private function getTempCardItems()
	{
			$price_total = 0;
			if (null != $temp_user_id = Cookie::get('temp_user_id')) {
         		$items = $this->tempCartItemService->getItemsByTempUserId($temp_user_id);
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
 		return $items;
	}
	private function getUsersTempCardItems()
	{
			$price_total = 0;
         		$items = $this->tempCartItemService->getItemsByUserId(\Auth::id());
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
 		return $items;
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
		session(['center' => $response]);
		return view('avo-pages.customize-mail', $response);
	}

	/**
	 * Display the all-features page.
	 *+
	 * @return Response
	 */
	public function orderReview(TelCountryService $telCountryService, TempCartItemService $tempCartItemService) {
		if (!session('customer_information')) {
			return redirect('customer-information');
		}
		//dd(\Auth::user());
		$customer = session('customer_information');
		$customer = \Auth::user();
		$price_total = 0;
		$has_vo      = false;
		if (null != $temp_user_id = Cookie::get('temp_user_id')) {
			$items = $tempCartItemService->getItemsByTempUserId($temp_user_id);
			//dd($items);
			for($i = count($items) -1; $i >= 0; $i--) {
				if($i == count($items) -1) {
					if($items[$i]->type == 'mr'){
						$mr_start_time        = strtotime($items[$i]->mr_start_time);
						$mr_end_time          = strtotime($items[$i]->mr_end_time);
						$items[$i]->price_per_hour = $items[$i]->price/(($mr_end_time-$mr_start_time)/3600);
						$items[$i]->price_due      = $items[$i]->price*30/100;
						$items[$i]->price_total    = $items[$i]->price-$items[$i]->price_due;
						$price_total += $items[$i]->price_due;
					}
					if($items[$i]->type == 'vo'){
						$items[$i]->sum = $items[$i]->price+$items[$i]->vo_mail_forwarding_price+100;
						$price_total += $items[$i]->sum;
						$has_vo = true;
					}
					if ($items[$i]->type == 'lr') {
						$items[$i]->sum = $items[$i]->price;
						$price_total += $items[$i]->sum;
					}
				}
				else {
					if($items[$i]->type == 'mr'){
						$mr_start_time        = strtotime($items[$i]->mr_start_time);
						$mr_end_time          = strtotime($items[$i]->mr_end_time);
						$items[$i]->price_per_hour = $items[$i]->price/(($mr_end_time-$mr_start_time)/3600);
						$items[$i]->price = $items[$i]->price + $items[$i+1]->price_due;
						$items[$i]->price_due      = $items[$i]->price*30/100;
						$items[$i]->price_total    = $items[$i]->price-$items[$i]->price_due;
						$price_total += $items[$i]->price_due;
					}
					if($items[$i]->type == 'vo'){
						$items[$i]->sum = $items[$i]->price+$items[$i]->vo_mail_forwarding_price+100;
						$price_total += $items[$i]->sum;
						$has_vo = true;
					}
					if ($items[$i]->type == 'lr') {
						$items[$i]->sum = $items[$i]->price;
						$price_total += $items[$i]->sum;
					}
				}
			}
			/*foreach ($items as $item) {
				if ($item->type == 'mr') {
					$mr_start_time        = strtotime($item->mr_start_time);
					$mr_end_time          = strtotime($item->mr_end_time);
					$item->price_per_hour = $item->price/(($mr_end_time-$mr_start_time)/3600);
					$item->price_due      = $item->price*30/100;
					$item->price_total    = $item->price-$item->price_due;
					$price_total += $item->price_due;
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
			}*/
		} else {
			$items = [];
		}
		session(['items' => $items]);
		$customer['term'] = session('term');
		//dd($items);
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
        // $cookieJar->unqueue('temp_user_id');
        // $cookieJar->queue('temp_user_id', null, 0);
        $inputs = $request->all(); 
        //dd($inputs);
        // dd($request->all());
        if(\Auth::check()) {
			\Auth::logout();
		}
        session(['term' => $inputs['term']]);
        if (!isset($inputs['package_option'])) {
            return redirect('thank-you');
        }
        if (isset($inputs['upgrade']) && $inputs['upgrade'] == 'yes') {
            if ($inputs['package_option'] == 103) {
                $inputs['package_option'] = 105;
            }
        }
        $package      = $inputs['package_option'];
        //dd($package);
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
        	//dd($inputs['vo_plan']);
        	//dump('sdfsdf');
        	//return 'sdfsdfsdf';
        	//dd(Cookie::get('temp_user_id'), Cookie::forget('temp_user_id'));
            if (null != $cookie = Cookie::get('temp_user_id')) {
                $temp_user_id = $cookie;
            } else {
            	//dd('aa');
                $temp_user_id = str_random(40);
                $cookieJar->queue('temp_user_id', $temp_user_id, 999999);
            }
            //$inputs['user_id'] = session('user_id');
            $inputs['temp_user_id'] = $temp_user_id;
            if(isset($inputs['term'])) {
	            $inputs['monthly_period'] = $inputs['term']; 
            }
            if (null != $tempCartItemService->create($inputs)) {
                if ($request->has('live_receptionist')) {
                    return redirect('/customize-phone');
                } else {
                    return redirect('/customer-information')->withCenterid($center_id);
                }
            }
        } else {
        	if (null != $cookie = Cookie::get('temp_user_id')) {
                $temp_user_id = $cookie;
            } else {
            	//dd('aa');
                $temp_user_id = str_random(40);
                $cookieJar->queue('temp_user_id', $temp_user_id, 999999);
            }
            //$inputs['user_id'] = session('user_id');
            $inputs['temp_user_id'] = $temp_user_id;
            $inputs['user_id'] = \Auth::id();
            if(isset($inputs['term'])) {
	            $inputs['monthly_period'] = $inputs['term']; 
            }
            if (null != $tempCartItemService->create($inputs)) {
                if ($request->has('live_receptionist')) {
                    return redirect('/customize-phone');
                } else {
                    return redirect('/order-review')->withCenterid($center_id);
                }
            }
        	//return redirect('order-review');
        }
        //return redirect()->back()->withSuccess('Successfully send!');
    }

	public function sendContactThankYou() {
		return view('avo-pages.thank-you');
	}

	public function privacyPolicy() {
		return view('avo-pages.privacy-policy');
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

	public function redirectNotarPage() {
		return view('virtual-offices.notar', ['customer_info' => session('customer_information')]);
		//return redirect('/notar')->withCookie($cookie);
	}

	public function notar(CenterService $centerService, Invoice $invoice, MeetingRoomService $meetingRoomService) {
		$temp_user_id = Cookie::get('temp_user_id');
		$invoice_insertable = [];
		if($temp_user_id) {
			$card_items = $this->getTempCardItems();
			//dd($card_items);
			$invoice_insertable = [];
			foreach ($card_items as $value) {
				$price = 0;
				if($value->type == 'vo') { 
					$price = $value->sum;
					$product = $centerService->getCenterById($value->center_id);
				} elseif($value->type == 'mr') {
					$price = $value->price_due;
					/*dd($value->mr_id);*/
					$product = $meetingRoomService->getMeetingRoomById($value->mr_id);
				} elseif($value->type == 'lr') {
					$price = $value->price;
				}

				$item_id = null;
				if($value->type == 'vo') { 
					$item_id = $value->center_id;
					//$product = $centerService->getCenterById($item_id);
				} elseif($value->type == 'mr') {
					$item_id = $value->mr_id;
				} elseif($value->type == 'lr') {
					$item_id = $value->lr_id;
				}
				$temp['type'] = $value->type;
				$temp['payment_type'] = 'initial';
				$temp['item_id'] = $item_id;
				$temp['price'] = $price;
				$temp['is_recurring'] = $value->type == 'vo' ? 1 : 0;
				$temp['recurring_period_within_month'] = $value->type == 'vo' ? $value->monthly_period : null;
				$temp['recurring_attempts'] = $value->type == 'vo' ? 0 : null;
				$temp['customer_id'] = \Auth::id();
				$temp['status'] = 'pending';
				$temp['payment_response'] = null;
				$arr = $value->toArray();
				$arr['product'] = $product;
				//dd($arr);
				$temp['created_at'] = Carbon::now()->__toString();
				$temp['updated_at'] = Carbon::now()->__toString();

				$month_days_to_seconds = date("t") * 24 * 60 * 60;
			    $one_second_price = $temp['price'] / $month_days_to_seconds;
			    $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $temp['created_at']);
			    $clone_created_at = clone $created_at;
			    $last_day_of_month = $clone_created_at->endOfMonth();
			    $time_diff_by_seconds = $created_at->diffInSeconds($last_day_of_month);
			    $last_days_price = $time_diff_by_seconds * $one_second_price;
			    $arr['first_prorated_amount']  = round($last_days_price);
			    $arr['last_prorated_amount']  = $temp['price']  - $arr['first_prorated_amount'];
			    $temp['serialized_card_item_info'] = serialize($arr);
				$invoice_insertable[] = $temp;
			}
			$invoice->insert($invoice_insertable);
			$cookie = Cookie::forget('temp_user_id');
			return redirect('notar')->withCookie($cookie);
		}
		//dd('aaaa');
		return redirect('notar');
	}

	public function downloadPdf(CenterService $centerService)
	{
		$centerService->downloadPdf(session('customer_information'));
	}
}
