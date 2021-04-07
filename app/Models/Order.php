<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
    	'code_order','idUser','idEmployee','name','address','phone','money','message','status',
    ];

    public function User()
    {
    	return $this->belongsTo('App\Models\User','idUser','id');
    }

    public function OrderDetail() {
        return $this->hasMany('App\Models\OrderDetail','idOrder','id');
    }

    function getAllList() {
        return $this->all();
    }

    function showOrder($id) {
        $order = $this->with(["User","OrderDetail"])->find($id);
        foreach($order->OrderDetail as $key => $value) {
            $order->OrderDetail[$key]['product'] = $order->OrderDetail[$key]->Product;
        }
        return $order;
    }

    function updatePersonTick($id,$idEmployee,$option) {
        $order = $this->find($id);
        if(intval($option) == 1){
            $data = [
                'idEmployee' => intval($idEmployee),
                'status' => 1
            ];
        }elseif(intval($option) == 2){
            $data = [
                'idEmployee' => intval($idEmployee),
                'status' => 2
            ]; 
        }else{
            $data = [
                'idEmployee' => intval($idEmployee),
                'status' => 0
            ];         
        }
        $order->update($data);
        foreach($order->OrderDetail as $key => $value) {
            $order->OrderDetail[$key]['product'] = $order->OrderDetail[$key]->Product;
        }
        return $order;
    }
}
