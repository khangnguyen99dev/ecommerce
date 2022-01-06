<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Rating;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
class OrderDetailController extends Controller
{
    protected $user;
    protected $orderDetail;
    public function __construct(OrderDetail $orderDetail, User $user){
        $this->user = $user;
        $this->orderDetail = $orderDetail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(!empty($request->star)){
            $orderDetail = $this->orderDetail->ratingOrderDetail($request->idOrder);
            DB::beginTransaction();
            try {
                $rating = [];
                $message = $request->contentRate;
                $star = $request->star;
                $idOrder = $request->idOrder;
                $idUser = Auth::id();
                $now = Carbon::now();
                forEach($orderDetail as $value) {
                    $rating[] = [
                        'idUser' => $idUser,
                        'idOrder' => $idOrder,
                        'idProduct' => $value->idProduct,
                        'message' => $message,
                        'star' => $star,
                        'created_at' => $now,
                        'updated_at' => $now
                    ];
                }
                Rating::insert($rating);
                $order = Order::find($idOrder);
                $order->status = 3;
                $order->save();
                DB::commit();
                return Response()->json(['message'=>'Đánh giá thành công']);
            } catch(Exception $e) {
                DB::rollback();
                return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
            }
        }else{
            return Response()->json(['error','Vui lòng chọn số sao']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()){
            $user = $this->user->getUser(Auth::id());
            $order = $this->orderDetail->showOrderDetail($id);
            return view('front-end.pages.infoCustomer.detailPurchased',['order'=>$order,'user'=>$user]);
        }else{
            return view('front-end.pages.index')->with('error','Vui lòng đăng nhập!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }

    public function showRating($id)
    {
        $rating = Rating::select('idUser','star','message','created_at')->where('idOrder',$id)->first();
        $order = $this->orderDetail->showOrderDetail($id);
        $order['rating'] = $rating;
        $order['date'] = date('d M y, h:i a', strtotime($rating->created_at));
        
        $order['user'] = User::select('avatar','name')->where('id',$rating->idUser)->first();
        return Response()->json(['order'=>$order]); 
    }
    
    public function getOrderDetail($id)
    {
        if(Auth::check()){
            $user = $this->user->getUser(Auth::id());
            $order = $this->orderDetail->showOrderDetail($id);
            return Response()->json(['order'=>$order,'user'=>$user]);
        }else{
            return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }      
    }
}
