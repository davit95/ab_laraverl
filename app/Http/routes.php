<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */
Route::get('payment', function () {
		return view('payment');
	});
Route::group(['before' => 'auth.basic'], function () {
		Route::get('/', 'HomeController@index');

		Route::get('/virtual-offices', 'VirtualOfficesController@index');
		Route::get('/virtual-offices/{country_slug}', 'VirtualOfficesController@getCountryVirtualOffices');
		Route::get('/virtual-offices/{country_code}/{city_slug}', 'VirtualOfficesController@getCityVirtualOffices');
		Route::get('/virtual-offices/{country_code}/{city_slug}/{center_slug}/{center_id}', 'VirtualOfficesController@getVirtualOfficeShowPage');
		Route::get('/pricing-grids/{center_id}', 'VirtualOfficesController@getCenterPricengGrid');

		Route::get('/meeting-rooms', 'MeetingRoomsController@index');
		Route::get('/meeting-rooms/{country_slug}', 'MeetingRoomsController@getCountryMeetingRooms');
		Route::get('/meeting-rooms/{country_code}/{city_slug}', 'MeetingRoomsController@getCityMeetingRooms');
		Route::get('/meeting-rooms/{country_code}/{city_slug}/{center_slug}/{center_id}', 'MeetingRoomsController@getMeetingRoomShowPage');
		Route::get('/reset-date', 'MeetingRoomsController@resetDate');
		Route::post('/meeting-rooms/book-meeting-room', 'MeetingRoomsController@bookMeetingRoom');
		//Route::post('/meeting-rooms/{country_code}/{city_slug}/{center_slug}', 'MeetingRoomsController@getMeetingRoomShowPage');

		Route::get('/live-receptionist', 'LiveReceptionistsController@index');
		Route::post('/live-receptionist-add-to-cart', 'LiveReceptionistsController@addToCart');

		// Avo pages
		Route::get('/all-features', 'AvoPagesController@allFeatures');
		Route::get('/customize-phone', 'AvoPagesController@customizePhone');
		Route::post('/save-phone-settings', 'AvoPagesController@storePhoneSettings');
		Route::get('/customize-mail', 'AvoPagesController@customizeMail');
		Route::get('/customer-information', 'AvoPagesController@customerInformation');
		Route::post('/customer-information', 'AvoPagesController@postCustomerInformation');
		Route::get('/order-review', 'AvoPagesController@orderReview');
		Route::post('/order-review', 'AvoPagesController@postOrderReview');
		Route::get('/get-area-codes', 'PhonesController@getAreaCodes');
		Route::get('/get-area-numbers', 'PhonesController@getAreaNumbers');
		Route::get('/get-toll-free-numbers', 'PhonesController@getTollFreeNumbers');

		Route::get('/contact', 'AvoPagesController@contact');
		Route::post('/sendcontact', 'AvoPagesController@sendcontact');
		Route::get('/thank-you', 'AvoPagesController@sendContactThankYou');
		Route::get('/about', 'AvoPagesController@about');
		Route::get('/management', 'AvoPagesController@management');
		Route::get('/faq', 'AvoPagesController@faq');
		Route::get('/privacy-policy', 'AvoPagesController@privacyPolicy');

		Route::group(['prefix' => 'ajax', 'middleware' => 'guest'], function () {
				Route::get('/centers/{id}', 'CentersController@getCenterById');
				Route::get('/autocomplete', 'CentersController@autocomplete');
			});

		Route::get('cdn-cgi/pe/bag2', function () {
				foreach ($_GET['r'] as $key => $route) {
					echo "<script src='".$route."'></script>";
				}
			});

		Route::resource('/cart', 'CartController');

		Route::get('cvv2', 'AvoPagesController@cvv2');
		Route::get('mr-terms', 'AvoPagesController@mrTerms');
		Route::get('change-currency', 'AvoPagesController@changeCurrency');
	});