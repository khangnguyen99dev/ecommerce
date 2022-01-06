<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_type';

    protected $fillable = [
    	'idCategory','name','slug','status',
    ];

	public function Category()
	{
		return $this->belongsTo('App\Models\Category','idCategory','id');
	}

	function deleteProductType($id) 
	{
		try {
			$productType = $this->find($id);
			$productType->delete();
			return $productType;
		} catch (\Exception $e) {
			return false;
		}


	}
}
