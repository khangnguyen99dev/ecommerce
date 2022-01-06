<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
	protected $table = 'rating';

	protected $fillable = [
		'idUser','idOrder','idProduct','message','star'
	];   

	public function User()
	{
		return $this->belongsTo('App\Models\User','idUser','id')->select(['id','name','avatar']);
	}

	public function Order()
	{
		return $this->belongsTo('App\Models\Order','idOrder','id');
	}

	public function Product()
	{
		return $this->belongsTo('App\Models\Product','idProduct','id');
	}

	function getRatingProduct($idProduct)
	{
		$rating = $this->with('User')->where('idProduct',$idProduct)->get();
		foreach($rating as $key => $value){
			$rating[$key]['date'] = date('d M y, h:i a', strtotime($value->created_at));
		}	
		return $rating;
	}

}
