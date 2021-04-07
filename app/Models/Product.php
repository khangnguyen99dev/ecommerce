<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'product';

	protected $fillable = [
		'name','slug','description','quantity','sold','oldPrice','currentPrice','image','react','promotional','idCategory','idProductType','status',
	];   

	public function ProductType()
	{
		return $this->belongsTo('App\Models\ProductType','idProductType','id');
	}

	public function Category()
	{
		return $this->belongsTo('App\Models\Category','idCategory','id');
	}

	public function OrderDetail() 
	{
		return $this->hasMany('App\Models\OrderDetail','idProduct','id');
	}

	public function ImageLibrary() 
	{
		return $this->hasMany('App\Models\ImageLiary','idProduct','id');
	}

	function updateQty($id, $qty, $option) {
		$product = $this->find($id);
		if($option == 1) {		
			$data['quantity'] = $product->quantity - $qty;
		}else{
			$data['quantity'] = $product->quantity + $qty;		
		}
		$product->update($data);
		return $product;
	}
}
