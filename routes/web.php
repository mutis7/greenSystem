<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/profile', 'userController@profile');

Route::get('/home', 'HomeController@index');
Route::get('/admin', 'AdminController@index' );
Route::get('/activate', 'AdminController@inactiveUsers');
Route::get('/activate/{user}','AdminController@activateUser');
Route::get('/activeusers', 'AdminController@activeUsers');
Route::resource('/payments', 'PaymentsController');
Route::resource('/employees', 'EmployeeController');
Route::resource('/counties', 'CountyController');
Route::resource('/locations', 'LocationController');
Route::resource('/houses', 'HouseController');
