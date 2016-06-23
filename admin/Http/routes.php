<?php

use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\Admin;
use App\Http\Middleware\SuperAdminOrOwner;
use App\Http\Middleware\SuperAdminOrCsr;
use App\Http\Middleware\Client;
use App\Http\Middleware\SuperAdminOrOwnerOrCsr;
use App\Http\Middleware\AccountingUser;
// use App\Http\Middleware\Owner;
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

Route::get('/', 'HomeController@dashboard');

Route::get('/login', 'Auth\AuthController@login');

Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/logout', 'Auth\AuthController@logout');

Route::get('/reports', 'ReportsController@index');
Route::get('/reports/download', 'ReportsController@downloadCsv');
Route::get('/owners-centers', 'OwnersController@getOwnersCenters');
Route::post('/states/{country}', 'CentersController@getStatesByCountryName');

Route::get('/owners-centers', 'OwnersController@getOwnersCenters');
Route::get('/avo-centers', 'CentersController@getCentersByName');
Route::get('/abcn-centers', 'CentersController@getCentersByName');
Route::get('/allwork-centers', 'CentersController@getCentersByName');


Route::get('/owners/add-document', 'OwnersController@getAddDocument');
Route::get('/owners/documents', 'OwnersController@getDocuments');
Route::get('/owners/{id}/add-staff', 'OwnersController@CreateStaff' );
Route::resource('/owners', 'OwnersController');

//Route::get('/user', 'UsersController@index');

Route::get('/centers/add-meeting-room', 'CentersController@getAddMeetingRoom');

Route::resource('/staffs', 'StaffsController');
/*Route::get('/meeting-rooms', 'MeetingRoomsController@index');*/
Route::resource('/meeting-rooms', 'MeetingRoomsController');
Route::get('/meeting-rooms/staff', 'MeetingRoomsController@getStaff');

Route::get('/center/{id}/owner/create', 'OwnersController@createOrUpdateOwner');
Route::get('owner/{id}/center/create', 'CentersController@create');

/*new*/


Route::resource('/users', 'UsersController');
Route::get('/accounting-admin', 'UsersController@index');



/*ajax*/
Route::post('/alts-and-captions', 'CentersController@getAvoPhotosAltsAndCaptions');


Route::group(['middleware' => 'superAdminOrCsr'], function () {
	Route::get('/csr' , 'CsrController@index');
	Route::get('/csr-accounting' , 'CsrController@getAccounts');
	Route::get('/csr-exit-interview' , 'CsrController@exitInterview');
	Route::get('/csr-declined' , 'CsrController@declined');
	Route::get('/csr-pending-mrs' , 'CsrController@pending');
	Route::get('/orders/{id}' , 'CustomersController@show');
	Route::get('/invoice/{id}' , 'CustomersController@getInvoice');
	Route::get('/charge' , 'CsrController@charge');
	Route::resource('/customers' , 'CustomersController');
	Route::get('/customers/{id}/file' , 'CustomersController@uploadFile');
	Route::post('/customers/{id}/upload' , 'CustomersController@uploadFile');
	Route::get('/customers/{id}/balance' , 'CustomersController@getBalance');
	Route::get('/customers/{name}/{id}' , 'CsrController@test');
});

Route::group(['middleware' => 'client_user'], function () {
	Route::get('/client', 'UsersController@getClientPage');
});

Route::group(['middleware' => 'superAdminOrOwner'], function () {
	Route::resource('/centers', 'CentersController');
	Route::get('/center/{id}/meeting-room/create', 'MeetingRoomsController@addMeetingRoom');
});

Route::group(['middleware' => 'superAdmin'], function () {
	Route::get('/admin-users', 'UsersController@addAllianceUser');
	Route::post('/admin-users', 'UsersController@createAdminUser');
});
