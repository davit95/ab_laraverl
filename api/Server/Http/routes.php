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
Route::get('/location/us/{state}', 'LocationsController@getStateLocations');
Route::get('/location/search/{key}', 'LocationsController@getSearchLocation');
Route::get('/location/search/{country_slug}/{key}', 'LocationsController@getSearchLocationByCountry');
Route::get('/location/countries', 'LocationsController@getAllCountries');
Route::get('/location/owner-email/{center_id}', 'LocationsController@getCenterOwnerEmail');
Route::get('/location/all-search', 'LocationsController@getAllLocationsForSearch');
Route::get('/location/us/{state}/{city}', 'LocationsController@getStateCityLocations');
Route::get('/location/{country_slug}/{city}', 'LocationsController@getCityLocations');
Route::get('/location/us/{state}/{city}/{center_id}', 'LocationsController@getStateCenterLocation');
Route::get('/location/{country_slug}/{city}/{center_id}', 'LocationsController@getCenterLocation');
Route::get('/location/{country_slug}', 'LocationsController@getCountryLocations');
Route::resource('/location', 'LocationsController');
Route::post('/authorization', 'OAuthController@postAuthorization');
Route::post('/refresh-token', 'OAuthController@postRefreshToken');
Route::post('/add-user-from-allwork', 'UsersController@postAddUserFromAllwork');
Route::post('/check-access-token', 'OAuthController@postCheckAccessToken');