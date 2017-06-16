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
Route::get('profile', 'userController@profile');
Route::get('home', 'HomeController@index');
Route::get('admin', 'AdminController@index' );
Route::get('activeusers', 'AdminController@activeUsers');
Route::get('completedjob/{id}', 'JobController@markCompleted');
Route::get('adminedit', 'AdminController@editProfile');
Route::get('jobhouses/{id}', 'JobController@jobActiveHouses');
Route::post('adminsave', 'AdminController@saveProfile');
Route::get('completedjobs', 'JobController@completedJobs');
Route::post('passwordsave', 'AdminController@passwordsave');
Route::resource('payments', 'PaymentsController');
Route::resource('employees', 'EmployeeController');
Route::resource('counties', 'CountyController');
Route::resource('locations', 'LocationController');
Route::resource('houses', 'HouseController');
Route::resource('vehicles', 'VehicleController');
Route::resource('jobs', 'JobController');
Route::get('exjobs/{job_id}', 'ExceptionJobController@job' );
Route::get('exceptionjobs', 'ExceptionJobController@index' );
route::post('exceptionsave', 'ExceptionJobController@store');
Route::get('unreadcomplaints', 'ComplainController@indexUnread');
Route::get('readcomplaints', 'ComplainController@indexRead');
Route::get('read/{id}', 'ComplainController@read');
Route::get('suggestions', 'ComplainController@index');
Route::post('suggestions/save', 'ComplainController@store');
Route::get('useredit/{id}', 'userController@edit');
Route::post('usersave', 'userController@update');
Route::post('changepassword', 'userController@updatepassword');
Route::get('allhouses', 'AdminController@viewHouses');
Route::get('activatehouses', 'AdminController@activateHouses');
Route::post('allhouses/more', 'AdminController@moreDetails');
Route::post('makeActive', 'AdminController@makeActive');
Route::get('sms','AdminController@sendSms');
Route::get('demo', 'HomeController@updateBalance');
Route::post('email', 'ReminderController@index');
Route::get('genemail/{id}','ReminderController@sendmail');
Route::get('housepay/{id}','HouseController@housepay');
Route::get('payforhouses', 'HouseController@houses');
Route::get('paymentsave', 'HouseController@payhouse');
Route::get('demo', 'HomeController@dailyNotifications');
Route::get('debthouses', 'AdminController@debthouses');

Route::post('paypal','PaypalController@charge');
Route::get('paypal/cancel','PaypalController@cancel');
Route::get('paypal/success','PaypalController@success');