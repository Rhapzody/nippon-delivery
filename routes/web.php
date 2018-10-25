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
    return redirect('home');
});

Auth::routes();

//user management
Route::group(['middleware' => []], function () {
    Route::get('staff/user/{search_mode?}/{search_text?}', 'UserBackController@searchUser')->where([
        'search_mode' => '[0-9]+',
        'search_text' => '.*',
    ]);
    Route::get('staff/user/add', 'UserBackController@addUser');
    Route::post('staff/user/add/process', 'UserBackController@addUserProcess');
    Route::get('staff/user/edit/{id}', 'UserBackController@editUser')->where(['id' => '[0-9]+']);
    Route::post('staff/user/edit/changePassword', 'UserBackController@editPassword');
    Route::post('staff/user/edit/process', 'UserBackController@editUserProcess');
    Route::delete('staff/user/{id}', 'UserBackController@deleteUser')->where(['id' => '[0-9]+']);
    Route::get('user_detail_by_id', 'UserBackController@getUserDetailById');
});
Route::get('district_by_province_id', 'UserBackController@getDistrictsByProvinceId');
Route::get('sub_district_by_district_id', 'UserBackController@getSubDistrictsByProvinceId');
Route::get('provinces', 'UserBackController@getAllProvinces');

// product management
Route::group(['middleware' => ['auth', 'role:เจ้าของร้าน']], function () {
    Route::get('staff/product/{search_mode?}/{search_text?}', 'ProductBackController@searchProduct')->where([
        'search_mode' => '[0-9]+',
        'search_text' => '.*',
    ]);
    Route::get('staff/product/add', 'ProductBackController@addProduct');
    Route::post('staff/product/add/process', 'ProductBackController@addProductProcess');
    Route::get('staff/product/edit', 'ProductBackController@editProduct');
    Route::delete('staff/product/{id}', 'ProductBackController@deleteProduct')->where(['id' => '[0-9]+']);
    Route::get('staff/product/product_detail_by_id', 'ProductBackController@getProductDetailById');
    Route::get('staff/product/edit/{id}', 'ProductBackController@editProduct')->where(['id' => '[0-9]+']);
    Route::post('staff/product/edit/process', 'ProductBackController@editProductProcess');
    Route::get('staff/product/product_tags_by_id', 'ProductBackController@getProductTagsById');
    Route::get('staff/product/product_pictures_by_id', 'ProductBackController@getProductPicturesById');
});

// store detail
Route::get('staff/detail', 'StoreDetailController@detail');

//front

//index
Route::get('home', 'IndexController@index')->name('home');

//store
Route::get('store', 'StoreController@store');

//product
Route::get('product', 'ProductController@product');

//checkout
Route::get('checkout', 'CheckoutController@checkout');

//cart
Route::get('cart', 'CartController@cart');

//whish list
Route::get('whish', 'WhishListController@whish');

//user
Route::get('user/edit', 'UserFrontController@edit')->middleware('auth');
