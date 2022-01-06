<?php

use Illuminate\Support\Facades\Route;
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

//Admin
Route::view('admin/login','back-end.pages.login')->name('login.admin');
Route::POST('admin/login','UserController@loginAdmin')->name('admin.login');

Route::GET('getproducttype','AjaxController@getProductType');
Route::GET('getcategory','AjaxController@getCategory');

Route::group(['prefix' => 'admin','middleware'=>'AdminMiddleWare'], function() {
    Route::view('/','back-end.pages.admin');

	Route::resource('category','CategoryController',['only' => [
    'index', 'store', 'update', 'destroy']]);
	Route::resource('productType','ProductTypeController',['only' => [
    'index', 'store', 'update', 'destroy']]);
	Route::resource('product','ProductController',['only' => [
    'index','create', 'store', 'update', 'destroy']]);

    Route::resource('promotion','PromotionController');
    Route::post('addPromotionProduct', 'ProductController@addPromotionProduct');

    Route::post('addPromotion', 'PromotionController@store');
    Route::post('editPromotion/{id}', 'PromotionController@update');
    Route::delete('deletePromotion/{id}', 'PromotionController@destroy');

    Route::delete('deleteEmployee/{id}','UserController@deleteEmployee');
    Route::post('addEmployee', 'UserController@addEmployee');
    Route::post('updateEmployee', 'UserController@updateEmployee');

    Route::post('accountStatus/{id}', 'UserController@accountStatus');

    Route::POST('printorder','OrderController@printOrder')->name('printOrder');
    Route::POST('updateproduct/{id}','ProductController@update');
    Route::POST('deleteImg/{id}','ProductController@deleteImage');

    Route::GET('banner','BannerController@getBanner');
    Route::GET('slider','SliderController@getSlider');

    Route::GET('order', 'OrderController@index');
    Route::GET('orderAccepted','OrderController@orderAccepted');

    Route::GET('delivery','OrderController@deliveryAll')->name('delivery');

    Route::GET('profile','UserController@profile')->name('profile');
    Route::GET('changePass','UserController@changePass')->name('changePass');

    Route::GET('account/employee','UserController@accountEmployee')->name('account.employee');
    Route::GET('account/guest','UserController@accountGuest')->name('account.guest');
    Route::GET('account/delivery','UserController@accountDelivery')->name('account.delivery');
});

//Employee

Route::group(['prefix' => 'employee','middleware'=>'EmployeeMiddleWare'], function() {
    Route::view('/','back-end.pages.admin');

    Route::GET('banner','BannerController@getBanner');
    Route::GET('slider','SliderController@getSlider');

    Route::GET('order', 'OrderController@index');
    Route::GET('orderAccepted','OrderController@orderAccepted');
    
    Route::GET('profile','UserController@profile');
    Route::GET('changePass','UserController@changePass');
});

Route::group(['prefix' => 'delivery','middleware'=>'DeliveryMiddleWare'], function() {
    Route::view('/','back-end.pages.admin');
    Route::GET('delivery','OrderController@deliveryAll');

    Route::GET('profile','UserController@profile');
    Route::GET('changePass','UserController@changePass');
});

//Client

Route::get('/','HomeController@index')->name('home');


// Route::get('/auth/redirect/{provider}', 'HomeController@redirect');
// Route::get('/callback/{provider}', 'HomeController@callback');


Route::GET('addcart/{id}','CartController@addCart');

Route::resource('cart','CartController');

Route::POST('checkout','CartController@checkOut')->name('checkout');

Route::GET('order/{id}', 'OrderController@show');

Route::POST('staticical','OrderController@staticical');

Route::GET('filterDate','OrderController@filterDate');

Route::post('updateDelivery/{id}','OrderController@updateDelivery');

Route::post('updateProfile','UserController@updateProfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::POST('chooseaddress','HomeController@chooseAddress');

Route::POST('chooseAddressEdit','HomeController@chooseAddressEdit');

Route::resource('message','MessageController');

Route::resource('comment','CommentsController');

Route::POST('addAddress','CustomerController@addAddress')->name('addAddress');

Route::resource('customer','CustomerController');

Route::POST('customer/{id}','CustomerController@update');

Route::POST('showEditAddress','CustomerController@showEditAddress');

Route::GET('address','CustomerController@showAddress')->name('customer.address');

Route::POST('defaultAddress', 'CustomerController@setAddressDefault');

Route::GET('category/{slug}_{id}.html','Homecontroller@productByCategory')->name('productByCategory');

Route::GET('producttype/{slug}_{id}.html','Homecontroller@productByProductType')->name('productByProductType');

Route::GET('category','Homecontroller@categoryAll')->name('category');

Route::GET('{slug}_{id}.html','Homecontroller@getDetail')->name('detailProduct');

Route::POST('search','Homecontroller@search')->name('search');


Route::POST('cancelOrder/{id}','OrderController@destroy')->name('cancelOrder');
Route::GET('purchased/{key}','CustomerController@showPurchased')->name('customer.purchased');
Route::GET('detailpurchased/{id}','OrderDetailController@show')->name('detailpurchased');
Route::GET('showRating/{id}','OrderDetailController@showRating');
Route::GET('change-pass-user','UserController@showChangePass');
Route::POST('updatePass','UserController@updatePassCustomer');


Route::POST('rating','OrderDetailController@store');

Route::DELETE('comment/{id}','CommentsController@destroy');

Route::post('acceptOrder/{id}','OrderController@acceptOrder');

Route::GET('category/{slug}_{id}.html','Homecontroller@productByCategory')->name('productByCategory');

Route::GET('productType/{slug}_{id}.html','Homecontroller@productByProductType')->name('productByProductType');

Route::GET('banner','BannerController@index');

Route::GET('slider','SliderController@index');

Route::get('product','ProductController@apiProduct');

Route::get('product/{id}','ProductController@getProductById');

Route::GET('categories/{slug}_{id}.html','HomeController@getProductByCategory');

Route::GET('productTypes/{slug}_{id}.html','HomeController@getProductByProductType');

Route::GET('imageLibrary/{id}','HomeController@imageLibraryByProduct');

Route::GET('rating/{id}','RatingController@show');

Route::get('productRelate/{id}','ProductController@productRelate');

Route::GET('comment/{id}','CommentsController@show');

Route::get('orderdetail/{id}','OrderDetailController@getOrderDetail');

Route::post('updateQty','HomeController@updateQty');

Route::GET('search/{key}','HomeController@searchProduct');

Route::resource('message','MessageController');

Route::get('checkmail/{value}','HomeController@checkmail');

Route::post('updatePass', 'UserController@updatePass');





