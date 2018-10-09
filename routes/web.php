<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/staff/user', 'UserBackController@user');
Route::get('/staff/user/add', 'UserBackController@addUser');
Route::post('/staff/user/add/process', 'UserBackController@addUserProcess');
Route::get('/staff/user/edit', 'UserBackController@editUser');
Route::get('/district_by_province_id', 'UserBackController@getDistrictsByProvinceId');
Route::get('/sub_district_by_district_id', 'UserBackController@getSubDistrictsByProvinceId');
