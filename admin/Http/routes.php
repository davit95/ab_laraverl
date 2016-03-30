<?php

use App\Http\Middleware\SuperAdmin;
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

Route::get('/reports', 'ReportsController@index')->middleware('superAdmin');
Route::get('/reports/download', 'ReportsController@downloadCsv');

Route::get('/owners/add-document', 'OwnersController@getAddDocument');
Route::get('/owners/documents', 'OwnersController@getDocuments');
Route::get('/owners/add-staff', 'OwnersController@getAddStaff' );
Route::resource('/owners', 'OwnersController');

Route::resource('/users', 'UsersController');
//Route::get('/user', 'UsersController@index');

Route::get('/centers/add-meeting-room', 'CentersController@getAddMeetingRoom');
Route::resource('/centers', 'CentersController');
Route::resource('/staffs', 'StaffsController');
/*Route::get('/meeting-rooms', 'MeetingRoomsController@index');*/
Route::resource('/meeting-rooms', 'MeetingRoomsController');
Route::get('/meeting-rooms/staff', 'MeetingRoomsController@getStaff');




