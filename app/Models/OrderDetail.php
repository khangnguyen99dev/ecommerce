<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    	return $this->belongsTo('App\Models\Product','idProduct','id');
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
}
