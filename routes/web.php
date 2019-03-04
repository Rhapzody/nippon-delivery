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

Auth::routes(['verify' => true]);

//staff dispatcher
Route::group(['middleware' => ['auth', 'role:เจ้าของร้าน|พนักงานรับออเดอร์|พนักงานส่งสินค้า']], function () {
    Route::get('staff/dispatch', 'IndexController@staffDispatch');
});

//user management
Route::group(['middleware' => ['auth', 'role:เจ้าของร้าน']], function () {
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
    Route::post('staff/user/undelete/{id}', 'UserBackController@unDeleteUser')->where(['id' => '[0-9]+']);
    Route::get('user_detail_by_id', 'UserBackController@getUserDetailById');
});
Route::post('staff/user/edit/changePassword', 'UserBackController@editPassword')->middleware('auth');
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
    Route::delete('staff/product/delete/{id}', 'ProductBackController@deleteProduct')->where(['id' => '[0-9]+']);
    Route::post('staff/product/undelete/{id}', 'ProductBackController@unDelete')->where(['id' => '[0-9]+']);
    Route::get('staff/product/product_detail_by_id', 'ProductBackController@getProductDetailById');
    Route::get('staff/product/edit/{id}', 'ProductBackController@editProduct')->where(['id' => '[0-9]+']);
    Route::post('staff/product/edit/process', 'ProductBackController@editProductProcess');
    Route::get('staff/product/product_tags_by_id', 'ProductBackController@getProductTagsById');
    Route::get('staff/product/product_pictures_by_id', 'ProductBackController@getProductPicturesById');
});

// store branch
Route::group(['middleware' => ['auth', 'role:เจ้าของร้าน']], function () {
    Route::get('staff/branch', 'BranchController@detail');
    Route::post('staff/branch/close', 'BranchController@close');
    Route::post('staff/branch/open', 'BranchController@open');
    Route::post('staff/branch/create', 'BranchController@create');
    Route::post('staff/branch/changePromotion', 'BranchController@changePromotion');
});
Route::get('staff/branch/all', 'BranchController@all');
Route::get('staff/branch/subdistrict', 'BranchController@getSubdistrictBranch');

// order reception
Route::group(['middleware' => ['auth', 'role:พนักงานรับออเดอร์']], function () {
    Route::get('staff/order', 'OrderReceptionController@showPage');
    Route::post('staff/order/1to2', 'OrderReceptionController@oneToTwo');
    Route::post('staff/order/2to3', 'OrderReceptionController@twoToThree');
    Route::post('staff/order/addToBranch', 'OrderReceptionController@addToBranch');
    Route::post('staff/order/return', 'OrderReceptionController@remove');
    Route::post('staff/order/cancle', 'OrderReceptionController@cancle');
});

//sales
Route::group(['middleware' => ['auth', 'role:เจ้าของร้าน']], function () {
    Route::get('staff/sales', 'SalesController@show');
    Route::get('staff/sales/data', 'SalesController@data');
    Route::get('staff/sales/todayStat', 'SalesController@todayStat');
});

//history
Route::group(['middleware' => ['auth', 'role:เจ้าของร้าน']], function () {
    Route::get('staff/history', 'HistoryBackController@show');
    Route::get('staff/history/find', 'HistoryBackController@find');
    Route::get('staff/history/{branch_id}/{status_code}/{from}/{to}', 'HistoryBackController@search');
    Route::get('staff/history/order/{id}', 'HistoryBackController@order');
});

//delivery
Route::group(['middleware' => ['auth', 'role:พนักงานส่งสินค้า']], function () {
    Route::get('staff/deliver', 'DeliverController@show');
    Route::post('staff/deliver/3to4', 'DeliverController@threeToFour');
    Route::post('staff/deliver/4to5', 'DeliverController@fourToFive');
});

//front

//index
Route::get('home', 'IndexController@index')->name('home');

//store
Route::get('store/{type?}', 'StoreController@store');

//product
Route::get('product/{id}', 'ProductController@product');


//checkout
Route::post('user/checkout', 'CheckoutController@checkout')->middleware(['auth', 'verified']);
Route::post('user/checkout/process', 'CheckoutController@process')->middleware(['auth', 'verified']);

//cart
Route::get('cart', 'CartController@cartList')->middleware('auth');
Route::post('cart/add/{id}', 'CartController@add')->middleware('auth');
Route::post('cart/plus/{id}', 'CartController@plus')->middleware('auth');
Route::post('cart/delete/{id}', 'CartController@delete')->middleware('auth');

//whish list
Route::get('whish', 'WhishListController@whish')->middleware('auth');
Route::post('whish/add/{id}', 'WhishListController@add')->middleware('auth');
Route::post('whish/delete/{id}', 'WhishListController@delete')->middleware('auth');
Route::get('whish/count', 'WhishListController@count')->middleware('auth');

//history
Route::get('user/history/order/{id}', 'HistoryController@order')->middleware('auth');
Route::get('user/history/{code}', 'HistoryController@statSearch')->where(['code' => '[0-9]+'])->middleware('auth');

//user
Route::get('user/whishlist', 'WhishListController@whish')->middleware('auth');
Route::get('user/cart', 'CartController@cart')->middleware('auth');
Route::get('user/history', 'HistoryController@history')->middleware('auth');
Route::get('user/edit', 'UserFrontController@edit')->middleware('auth');
Route::post('user/edit/process', 'UserFrontController@editProcess')->middleware('auth');

//notification
Route::get('noti/test', 'NotificationController@testTriggerNoti'); //->middleware('auth');
