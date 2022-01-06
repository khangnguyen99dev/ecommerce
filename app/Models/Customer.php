<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
    	'idUser','name','address','email','phone','active','idCity','idDistrict','idWard',
    ];


    public function User()
    {
    	return $this->belongsTo('App\Models\User','idUser','id');
    }

    public function City()
    {
    	return $this->belongsTo('App\Models\City','idCity','id')->select(['id','name']);
    }

    public function District()
    {
    	return $this->belongsTo('App\Models\District','idDistrict','id')->select(['id','name']);
    }

    public function Ward()
    {
    	return $this->belongsTo('App\Models\Ward','idWard','id')->select(['id','name']);
    }

    function deleteCustomer($id)
    {
        $customer = $this->find($id);
        if($customer->active == 1) {
            return ['error'=>"Không thể xóa địa chỉ mặc định"];
        }else{
            $customer->delete();
            return $customer;
        }
    }

    function getAddress($id) {
        $customer = $this->with(['City','District','Ward'])->where('idUser', $id)->get(); 
        return $customer;
    }

    function getAddressAdd($id) {
        $customer = $this->with(['City','District','Ward'])->where('id', $id)->get();    
        return $customer;
    }   
}
