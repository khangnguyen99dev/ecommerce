<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Category;
use App\Models\User;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Support\Facades\Hash;
use Auth;
use Facade\FlareClient\Http\Response;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::where('status',1)->get();
        $productType = ProductType::where('status',1)->get();
        return view('front-end.pages.index',['category'=>$category,'productType'=>$productType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
   
    }

    public function getDetail($slug,$id) {
        $detailProduct = Product::where('slug',$slug)->where('id',$id)->first();
        return view('front-end.pages.detailProduct',['detailProduct'=> $detailProduct]);
    }

    public function chooseAddress(Request $request) {
        $data = $request->all();
        $output = '';
        if($data['action'] == 'city') {
            $selectDistrict = District::where('idCity',$data['idCity'])->orderBy('id','ASC')->get();
            $output.='<option value="">--Chọn Quận / Huyện--</option>';
            foreach($selectDistrict as $value) {
                $output.='<option value="'.str_pad($value->id,3,'0',STR_PAD_LEFT).'">'.$value->name.'</option>';
            }
        }else{
            $selectWard = Ward::where('idDistrict',$data['idCity'])->orderBy('id','ASC')->get();
            $output.='<option value="">--Chọn Phường / Xã--</option>';
            foreach($selectWard as $key => $value) {
                $output.='<option value="'.str_pad($value->id,5,'0',STR_PAD_LEFT).'">'.$value->name.'</option>';
            }
        }   
        return Response()->json(['address'=>$output]);
    }

}

