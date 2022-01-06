<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    protected $fillable = [
    	'idOrder','idProduct','quantity','price',
    ];

    public function Order()
    {
    	return $this->belongsTo('App\Models\Order','idOrder','id');
    }

    public function Product()
    {
    	return $this->belongsTo('App\Models\Product','idProduct','id')->select(['id','name','slug','image','quantity']);
    }

    function updateOrderDetail($qty, $id) {
        $orderDetail = $this->find($id);
        if($orderDetail){
            $data['quantity'] = $qty;
            $orderDetail->update($data);
            return $orderDetail;
        }else{
            return false;
        }
    }

    function getOrderDetail($order) {   
        foreach($order as $key => $value) {
            $order[$key]['OrderDetail'] = $this->select(['id','idOrder','idProduct','price','quantity'])->with('Product')->where('idOrder', $value->id)->get();
        }
        return $order;
    }

    function showOrderDetail($id)
    {
        $order = Order::find($id);
        $order['orderDetail'] = $this->select(['id','idOrder','idProduct','price','quantity'])->with('Product')->where('idOrder', $id)->get();
        return $order;
    }

    function ratingOrderDetail($idOrder)
    {
        $orderDetail = $this->where('idOrder',$idOrder)->get();
        return $orderDetail;
    }

    function updateQty($data) {  
        try {         
            DB::beginTransaction();
            $result = [];
            foreach($data as $value){
                $orderDetail = $this->find($value['id']);
                $orderDetail->quantity = $value['qty'];
                $orderDetail->save();
                array_push($result,$orderDetail);
            }
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
