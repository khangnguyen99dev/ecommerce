<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductType;

class AjaxController extends Controller
{
    public function getProductType(Request $request){
    	$productType = ProductType::where('idCategory',$request->id)->get();
    	return response()->json($productType);
    } 
    public function getCategory(Request $request){
    	$category = Category::where('id',$request->id)->get();
    	return response()->json($category);
    } 
}
