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
Route::group(['before' => 'auth.basic'], function(){
		Route::get('/', 'HomeController@index');

		Route::get('/virtual-offices', 'VirtualOfficesController@index');
		Route::get('/virtual-offices/{country_slug}', 'VirtualOfficesController@getCountryVirtualOffices');
		Route::get('/virtual-offices/{country_code}/{city_slug}', 'VirtualOfficesController@getCityVirtualOffices');
		Route::get('/virtual-offices/{country_code}/{city_slug}/{center_slug}', 'VirtualOfficesController@getVirtualOfficeShowPage');
		Route::get('/pricing-grids/{center_id}', 'VirtualOfficesController@getCenterPricengGrid');

		Route::get('/meeting-rooms', 'MeetingRoomsController@index');
		Route::get('/meeting-rooms/{country_slug}', 'MeetingRoomsController@getCountryMeetingRooms');
		Route::get('/meeting-rooms/{country_code}/{city_slug}', 'MeetingRoomsController@getCityMeetingRooms');
		Route::get('/meeting-rooms/{country_code}/{city_slug}/{center_slug}', 'MeetingRoomsController@getMeetingRoomShowPage');
		//Route::post('/meeting-rooms/{country_code}/{city_slug}/{center_slug}', 'MeetingRoomsController@getMeetingRoomShowPage');

		// Avo pages
		Route::get('/live-receptionist', 'AvoPagesController@liveReceptionist');
		Route::get('/all-features', 'AvoPagesController@allFeatures');
		Route::get('/customize-phone', 'AvoPagesController@customizePhone');
		Route::get('/get-area-codes', 'PhonesController@getAreaCodes');
		Route::get('/get-area-numbers', 'PhonesController@getAreaNumbers');
		Route::get('/get-toll-free-numbers', 'PhonesController@getTollFreeNumbers');


		Route::get('/contact', 'AvoPagesController@contact');
		Route::post('/sendcontact', 'AvoPagesController@sendcontact');
		Route::get('/about', 'AvoPagesController@about');
		Route::get('/management', 'AvoPagesController@management');
		Route::get('/faq', 'AvoPagesController@faq');

		Route::group(['prefix' => 'ajax', 'middleware' => 'guest'], function()
		{
			Route::get('/centers/{id}', 'CentersController@getCenterById');
			Route::get('/autocomplete', 'CentersController@autocomplete');
		});

		Route::get('cdn-cgi/pe/bag2',function(){
			foreach ($_GET['r'] as $key => $route) {
				echo "<script src='".$route."'></script>";
			}
		});
});
