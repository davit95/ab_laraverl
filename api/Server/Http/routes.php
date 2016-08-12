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
Route::post('/location/update/{id}/{owner_id}', 'LocationsController@updateLocation');
Route::get('/locations/{owner_id}', 'LocationsController@getLocationsByOwnerId');
Route::get('/locations/{id}/{owner_id}', 'LocationsController@getShowOwnerLocation');
Route::post('/add-location', 'LocationsController@addLocation');
Route::post('/request-detail', 'RequestDetailsController@addRequestDetail');
Route::get('/request-details-for-user/{user_id}', 'RequestDetailsController@getUserRequestDetail');
Route::get('/request-details/{id}/{owner_id}', 'RequestDetailsController@showRequestDetail');
Route::get('/location/show/{id}', 'LocationsController@getLocation');
Route::get('/location/us/{state}', 'LocationsController@getStateLocations');
Route::get('/location/search/city/{key}', 'LocationsController@getSearchCity');
Route::get('/location/search/{key}', 'LocationsController@getSearchLocation');
Route::get('/location/search/{space_type}/{key}', 'LocationsController@getSearchLocationBySpaceType');
// Route::get('/location/search/{country_slug}/{key}', 'LocationsController@getSearchLocationByCountry');
Route::get('/location/countries', 'LocationsController@getAllCountries');
Route::get('/cities-by-country', 'LocationsController@getCitiesByCountry');
Route::get('/location/countries-list-name-id', 'LocationsController@getAllCountriesListsNameId');
Route::get('/location/states', 'LocationsController@getAllStates');
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