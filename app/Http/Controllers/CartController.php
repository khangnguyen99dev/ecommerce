<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\City;
use Cart;
use Auth;
use DB;
use Exception;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cart::destroy();
        if(Auth::check()){
            $cart = Cart::content();
            return view('front-end.pages.cart',['cart'=>$cart]);
        }else{
            return back()->with('message','Bạn cần đăng nhập trước khi xem giỏ hàng');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $total = 0;
            forEach($request->idProduct as $value) {
                $getCart = Cart::get($value);
                $product[] = $getCart;
                $total += $getCart->price*$getCart->qty;
            }
            if($total == $request->money){
                $order = $request->all();
                $order['code_order'] = $this->generateRandomString(20);
                $order['status'] = 0;
                $order['idUser'] = Auth::user()->id;
                DB::beginTransaction();
                try {
                    $orderCreate = Order::create($order);
                    // get product
                    $idOrder = $orderCreate->id;
                    $orderDetail = [];
                    forEach($product as $value) {
                        $now = Carbon::now();
                        $orderDetail[] = [
                            'idOrder' => $idOrder,
                            'idProduct' => $value->id,
                            'quantity' => $value->qty,
                            'price' => $value->price,
                            'created_at' => $now,
                            'updated_at' => $now
                        ];
                        Cart::remove($value->rowId);
                    }
                    OrderDetail::insert($orderDetail);
                    DB::commit();
                    return Response()->json(['message'=>'Đặt hàng thành công']);
                } catch(Exception $e) {
                    DB::rollback();
                    return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
                }
            }else{
                return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
            }
        }else{
            return back()->with('message','Bạn cần đăng nhập trước khi xem giỏ hàng');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
        if($request->ajax()){
            Cart::update($id, $request->quantity);
            $cartCount = Cart::count();
            $cartContent = Cart::content();
            return Response()->json(['cartContent'=>$cartContent,'cartCount'=>$cartCount]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        $cartCount = Cart::count();
        return Response()->json(['cartCount'=>$cartCount]);
    }

    public function addCart($id, Request $request) {
        if(Auth::check()){
            $product = Product::find($id);

            $cart = ['id' => $id, 'name' => $product->name, 'qty' => $request->quantity, 'price' => $product->currentPrice, 'options' => ['image' => $product->image,'oldPrice' => $product->oldPrice,'Category'=> $product->Category['name']], 'weight' => 0];
    
            Cart::add($cart);
            $cartCount = Cart::count();
            $cartContent = Cart::content();
            return Response()->json(['cartContent'=>$cartContent,'cartCount'=>$cartCount,'message'=>'Đã thêm sản phẩm vào giỏ hàng']);
        }else{
            return Response()->json(['message'=>'Bạn vui lòng đăng nhập trước khi mua hàng!']);
        }

    }

    public function checkOut(Request $request)
    {   
        if(Auth::check()){
            $arr = $request->item;
            $total = 0;
            $qtyProduct = 0;
            forEach($arr as $key => $value) {
                forEach(Cart::content()->where('id',$value) as $object) {
                    $cart[] = $object;
                    $total+=$object->price*$object->qty;
                    $qtyProduct+=$object->qty;
                }
            }
            $customer = Auth::user()->Customer;
            $city = City::orderBy('id','ASC')->get();
            return view('front-end.pages.checkout',['cart'=>$cart,'customer'=>$customer,'total'=>$total,'quantity'=>$qtyProduct,'city'=>$city]);
        }else{
            return back()->with('message','Bạn cần đăng nhập trước khi xem giỏ hàng');
        }
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
