<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Facade\FlareClient\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::get('wapper/{id}','ImageLibraryController@getImageByProduct');

Route::POST('banner/{id}','BannerController@update');

Route::POST('slider/{id}','SliderController@update');

Route::resource('order','OrderController');

Route::POST('orderProcess','OrderController@orderProcess')->name('orderProcess');



Route::post('accountStatus/{id}', 'UserController@accountStatus');

Route::post('addDelivery','UserController@addDelivery');

Route::post('updateEmployee', 'UserController@updateEmployee');

Route::resource('slider','SliderController',['only' => ['store', 'destroy']]);

Route::resource('banner','BannerController',['only' => ['store', 'destroy']]);
