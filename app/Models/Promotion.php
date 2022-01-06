<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Product;
class Promotion extends Model
{
	protected $table = 'promotion';

	protected $fillable = [
		'name','promotional','startDay','endDay',
	];  
    
    public function product()
    {
    	return $this->hasMany('App\Models\Product','idPromotion','id');
    }


    function getAllPromotion() 
    {
        $promotion = $this->all();
        return $promotion;
    }

    function addPromotion($data)
    {
        try {
            $promotion = $this->create($data);
            return $promotion;
        } catch (\Throwable $th) {
            return ['error'=>'Có lỗi trong quá trình thực hiện'];
        }
    }

    function updatePromotion($id, $data)
    {
        try {
            $promotion = $this->find($id);
            $promotion->update($data);
            return $promotion;
        } catch (\Throwable $th) {
            return ['error'=>'Có lỗi trong quá trình thực hiện'];
        }
    }

    function deletePromotion($id)
    {
        try {
            $promotion = $this->find($id);
            $promotion->delete();
            return $promotion;
        } catch (\Throwable $th) {
            return ['error'=>'Có lỗi trong quá trình thực hiện'];
        }
    }
    
    function checkPromotion()
    {
        $now = now();
        $promotion = $this->select('id')->where('endDay','<=',$now)->get();
        $array = [];
        foreach($promotion as $value) {
            array_push($array,$value["id"]);
        }
        $promotions = Product::whereIn('idPromotion', $array)->update(['idPromotion'=>1]);
        return $promotion;
    }
}
