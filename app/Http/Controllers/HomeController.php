<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Category;
use App\Models\User;
use App\Models\District;
use App\Models\Ward;
use App\Models\Rating;
use App\Models\ImageLibrary;
use App\Models\OrderDetail;
use App\Models\Promotion;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use DB;
class HomeController extends Controller
{

    protected $district;
    protected $ward;
    protected $product;
    protected $imageLibrary;
    protected $user;
    protected $promotion;
    public function __construct(District $district, Ward $ward, Product $product,ImageLibrary $imageLibrary, User $user, OrderDetail $orderDetail, Promotion $promotion) {
        $this->district = $district;
        $this->ward = $ward;
        $this->product = $product;
        $this->imageLibrary = $imageLibrary;
        $this->user = $user;
        $this->orderDetail = $orderDetail;
        $this->promotion = $promotion;
    }
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
        if(Auth::check() && Auth::user()->status == 1){
            Auth::logout();
            return view('auth.login',['error'=>'Tài khoản đã bị khóa']);
        }
        $promotion = $this->promotion->checkPromotion();
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

    public function getDetail($slug,$id) 
    {
        $detailProduct = $this->product->getDetailProduct($slug,$id);
        $rating = Rating::where('idProduct',$id)->get();
        $avgStar = $rating->avg('star');
        $detailProduct['rating'] = $avgStar;
        $detailProduct['star'] = round($avgStar);
        $detailProduct['countRate'] = sizeof($rating);
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

    public function chooseAddressEdit(Request $request) {
        $data = $request->all();
        $output = '';
        if($data['action'] == 'cityEdit'){
            $district = $this->district->getDistrict($data['id']);
            foreach($district as $value) {
                $output.='<option value="'.str_pad($value->id,3,'0',STR_PAD_LEFT).'">'.$value->name.'</option>';
            }       
        }else{
            $ward = $this->ward->getWard($data['id']);
            foreach($ward as $value) {
                $output.='<option value="'.str_pad($value->id,5,'0',STR_PAD_LEFT).'">'.$value->name.'</option>';
            }     
        }

        return Response()->json(['address'=>$output]);
    }

    public function search(Request $request)
    {  
        $category = Category::all();
        $productType = ProductType::all();
        return view('front-end.pages.index',['search'=> $request['query'],'category'=>$category,'productType'=>$productType]);
    }

    public function searchProduct($key)
    {
        $product = $this->product->search($key);
        return Response()->json($product);
    }

    public function categoryAll() 
    {
        $product = $this->product->categoryAll();
        $category = Category::all();
        $productType = ProductType::all();
        return view('front-end.pages.index',['product'=> $product,'category'=>$category,'productType'=>$productType,'allProduct'=>true]);        
    }
    
    public function getProductByCategory($slug,$id) 
    {
        if($id == "all"){
            $product = $this->product->categoryAll();
        }else{
            $product = $this->product->productByCategory($id);
        }     
        return Response()->json($product);      
    }

    public function productByCategory($slug,$id)
    {
        $category = Category::all();
        $productType = ProductType::all();
        return view('front-end.pages.index',['categoryjs'=> $id,'category'=>$category,'productType'=>$productType]);
    }

    public function getProductByProductType($slug,$id)
    {
        $product = $this->product->productByProductType($id);
        return Response()->json($product);
    }
    public function productByProductType($slug,$id)
    {
        $category = Category::all();
        $productType = ProductType::all();
        return view('front-end.pages.index',['productTypejs'=> $id,'category'=>$category,'productType'=>$productType]);
    }

    public function imageLibraryByProduct($id)
    {
        $images = $this->imageLibrary->getImageByProduct($id);
        return Response()->json($images);
    }

    public function checkmail($value) {
        $checkmail = $this->user->checkmail($value);
        return Response()->json($checkmail);
    }

    public function updateQty(Request $request) {
        $data = $request->data;
        $updateQty = $this->orderDetail->updateQty($data);
        if($updateQty) {
            return Response()->json($updateQty);
        }else{
            return Response()->json(['error'=>'Không thể cập nhật số lượng']);
        }
    }
}

