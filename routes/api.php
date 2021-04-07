<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\ImageLibrary;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/product', function(){
	$product = Product::where('status',1)->get();
	for ($i=0; $i < sizeof($product) ; $i++) { 
		$product[$i]['nameCategory']= $product[$i]->Category['name'];
		$product[$i]['nameProductType']= $product[$i]->ProductType['name'];
	}
    return response()->json($product, 200);
});


Route::GET('/warpper',function() {
	$warpper = ImageLibrary::orderBy('id','ASC')->get();
	return Response()->json($warpper,200);
});

Route::resource('banner','BannerController',['only' => ['index', 'store', 'destroy']]);
Route::POST('banner/{id}','BannerController@update');

Route::resource('slider','SliderController',['only' => ['index', 'store', 'destroy']]);
Route::POST('slider/{id}','SliderController@update');

Route::resource('order','OrderController');
Route::POST('orderProcess','OrderController@orderProcess')->name('orderProcess');

Route::resource('message','MessageController');