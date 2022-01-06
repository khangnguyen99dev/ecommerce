<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
    	'code_order','idUser','idEmployee','name','address','phone','money','message','status','created_at'
    ];

    public function User()
    {
    	return $this->belongsTo('App\Models\User','idUser','id');
    }

    public function OrderDetail() {
        return $this->hasMany('App\Models\OrderDetail','idOrder','id');
    }

    function getAllList() {
        return $this->where('status',0)->orderBy('status','DESC')->get();
    }

    function getAllListAccepted()
    {
        return $this->where('status',1)->orderBy('status','ASC')->get();
    }

    function showOrder($id) {
        $order = $this->with(["User","OrderDetail"])->find($id);
        foreach($order->OrderDetail as $key => $value) {
            $order->OrderDetail[$key]['product'] = $order->OrderDetail[$key]->Product;
        }
        return $order;
    }

    // function updatePersonTick($id,$idEmployee,$option) {
    //     $order = $this->find($id);
    //     if(intval($option) == 1){
    //         $data = [
    //             'idEmployee' => intval($idEmployee),
    //             'status' => 1
    //         ];
    //     }elseif(intval($option) == 2){
    //         $data = [
    //             'idEmployee' => intval($idEmployee),
    //             'status' => 2
    //         ]; 
    //     }else{
    //         $data = [
    //             'idEmployee' => intval($idEmployee),
    //             'status' => 0
    //         ];         
    //     }
    //     $order->update($data);
    //     foreach($order->OrderDetail as $key => $value) {
    //         $order->OrderDetail[$key]['product'] = $order->OrderDetail[$key]->Product;
    //     }
    //     return $order;
    // }

    function getOrder($idUser,$key) {
        if($key == "ready"){
            $order = $this->select(['id','code_order','name','address','status','money','message','created_at'])->where('idUser', $idUser)->where('status',0)->get();
        }elseif($key == "accepted"){
            $order = $this->select(['id','code_order','name','address','status','money','message','created_at'])->where('idUser', $idUser)->where('status',1)->get();
        }elseif($key == "completed"){
            $order = $this->select(['id','code_order','name','address','status','money','message','created_at'])->where('idUser', $idUser)->where('status',2)->get();
        }elseif($key == "cancel"){
            $order = $this->select(['id','code_order','name','address','status','money','message','created_at'])->where('idUser', $idUser)->where('status',4)->get();
        }elseif($key == "all"){
            $order = $this->select(['id','code_order','name','address','status','money','message','created_at'])->where('idUser', $idUser)->get();
        }elseif($key == "rated"){
            $order = $this->select(['id','code_order','name','address','status','money','message','created_at'])->where('idUser', $idUser)->where('status',3)->get();
        }else{
            $order = false;
        }
        
        return $order;
    }

    function destroyOrder($id) {
        $order = $this->find($id);
        $order->status = 4;
        $order->save();
        return $order;
    }

    function delivery() 
    {
        $delivery = $this->where('status',1)->orderBy('status','DESC')->get();
        return $delivery;
    }

    function setDelivery($id)
    {
        try {
            $order = $this->find($id);
            $order->status = 2;
            $order->save();
    
            $orderDetail = OrderDetail::where('idOrder',$id)->get();
    
            foreach($orderDetail as $value){
                $product = Product::find($value->idProduct);
                $product->sold = $product->sold + $value->quantity;
                $product->save();
            }
            DB::commit();
            return Response()->json(['success'=>'Xác nhận đơn hàng thành công!']);
        } catch (\Throwable $th) {
            DB::rollback();
            return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }
    }

    function filterOrder($from_date, $to_date)
    {
        $orders = $this->whereIn('status',[2,3])->whereBetween('created_at',[$from_date,$to_date])->orderBy('created_at','ASC')->get();
        return $orders;
    }

    function accept_order($idOrder, $idEmployee)
    {
        $order = $this->find($idOrder);
        $order->status = 1;
        $order->idEmployee = $idEmployee;
        $order->save();
        return $order;
    }
}
