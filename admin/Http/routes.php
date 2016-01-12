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

Route::get('/', 'HomeController@dashboard');

Route::get('/login', 'Auth\AuthController@login');

Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/logout', 'Auth\AuthController@logout');

Route::get('/reports', 'ReportsController@index');

Route::get('/owners/add-document', 'OwnersController@getAddDocument');
Route::resource('/owners', 'OwnersController');

Route::resource('/users', 'UsersController');

Route::get('/centers/add-meeting-room', 'CentersController@getAddMeetingRoom');
Route::resource('/centers', 'CentersController', [ 'only' => ['create', 'store'] ]);