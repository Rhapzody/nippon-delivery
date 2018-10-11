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

//user management
Route::get('/staff/user/{search_mode?}/{search_text?}', 'UserBackController@searchUser')->where([
        'search_mode'=>'[0-9]+',
        'search_text'=>'.*'
]);
Route::get('/staff/user/add', 'UserBackController@addUser');
Route::post('/staff/user/add/process', 'UserBackController@addUserProcess');
Route::get('/staff/user/edit/{id}', 'UserBackController@editUser')->where(['id'=>'[0-9]+']);
Route::post('/staff/user/edit/changePassword', 'UserBackController@editPassword');
Route::post('/staff/user/edit/process', 'UserBackController@editUserProcess');
Route::delete('/staff/user/{id}', 'UserBackController@deleteUser')->where(['id'=>'[0-9]+']);
Route::get('/district_by_province_id', 'UserBackController@getDistrictsByProvinceId');
Route::get('/sub_district_by_district_id', 'UserBackController@getSubDistrictsByProvinceId');
Route::get('/user_detail_by_id', 'UserBackController@getUserDetailById');
