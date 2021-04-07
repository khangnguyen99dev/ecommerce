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

    Route::view('/','back-end.pages.index');
	Route::resource('category','CategoryController',['only' => [
    'index', 'store', 'update', 'destroy']]);
	Route::resource('productType','ProductTypeController',['only' => [
    'index', 'store', 'update', 'destroy']]);
	Route::resource('product','ProductController',['only' => [
    'index','create', 'store', 'update', 'destroy']]);
    Route::POST('printorder','OrderController@printOrder')->name('printOrder');
    Route::POST('updateproduct/{id}','ProductController@update');
    Route::POST('deleteImg/{id}','ProductController@deleteImage');

    Route::view('banner','back-end.pages.banner.index')->name('banner');
    Route::view('slider','back-end.pages.slider.index')->name('slider');
    Route::view('order','back-end.pages.order.index')->name('order');
});


//Client
Route::get('/','HomeController@index')->name('home');

Route::GET('{slug}_{id}.html','Homecontroller@getDetail');
// Route::get('/auth/redirect/{provider}', 'HomeController@redirect');
// Route::get('/callback/{provider}', 'HomeController@callback');


Route::GET('addcart/{id}','CartController@addCart');

Route::resource('cart','CartController');

Route::resource('customer','CustomerController');

Route::POST('checkout','CartController@checkOut')->name('checkout');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::POST('/chooseaddress','HomeController@chooseAddress');

Route::resource('message','MessageController');

