<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rating;
use DB;
class Product extends Model
{
	protected $table = 'product';

	protected $fillable = [
		'name','slug','description','quantity','sold','oldPrice','currentPrice','image','react','idPromotion','idCategory','idProductType','status',
	];   

	public function ProductType()
	{
		return $this->belongsTo('App\Models\ProductType','idProductType','id')->select(['id','name','slug']);
	}

	public function Category()
	{
		return $this->belongsTo('App\Models\Category','idCategory','id')->select(['id','name','slug']);
	}

	public function Promotion()
	{
		return $this->belongsTo('App\Models\Promotion','idPromotion','id')->select(['id','promotional','startDay','endDay']);
	}

	public function OrderDetail() 
	{
		return $this->hasMany('App\Models\OrderDetail','idProduct','id');
	}

	public function ImageLibrary() 
	{
		return $this->hasMany('App\Models\ImageLiary','idProduct','id');
	}

	public function Comment() 
	{
		return $this->hasMany('App\Models\Comments','idProduct','id');
	}

	public function Rating() 
	{
		return $this->hasMany('App\Models\Rating','idProduct','id');	
	}

	public function avgRating()
	{
		return $this->Rating()->selectRaw('avg(star) as avg_star, idProduct')->groupBy('idProduct');
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

	function getProduct()
	{
		$product = $this->with(['ProductType','Category','avgRating','Promotion'])->where('status',1)->take(20)->get();
		return $product;
	}

	function getDetailProduct($slug,$id) 
	{
		$detailProduct = $this->select(['id','slug','name','quantity','sold','oldPrice','currentPrice','image','react','idPromotion','description','idCategory','idProductType'])
		->with(['Category','ProductType','avgRating','Promotion'])
		->where('slug',$slug)
		->where('id',$id)->first();
		return $detailProduct;
	}

	function productByCategory($id) 
	{
		$product = $this
		->select(['id','slug','name','quantity','sold','oldPrice','currentPrice','image','react','idPromotion','description','idCategory','idProductType'])
		->with(['Category','ProductType','avgRating','Promotion'])
		->where('idCategory',$id)->get();
		return $product;
	}

	function productByProductType($id)
	{
		$product = $this->select(['id','slug','name','quantity','sold','oldPrice','currentPrice','image','react','description','idPromotion','idCategory','idProductType'])
		->with(['Category','ProductType','avgRating','Promotion'])
		->where('idProductType',$id)->get();
		return $product;		
	}

	function categoryAll() 
	{
		$product = $this->with(['ProductType','Category','avgRating','Promotion'])->get();
		return $product;	
	}

	function search($query)
	{
		$product = $this->with(['Category','ProductType'])->where('name','LIKE','%'.$query.'%')
		->orWhere('currentPrice','LIKE','%'.$query.'%')->get();
		return $product;
	}

    function productRelate($id)
    {
        $product = $this->where('id',$id)->first();

        $products = $this->with(['Promotion'])->where('idCategory',$product->idCategory)->where('status',1)->get();

        return $products;
    }

	function addPromotionProduct($idProduct, $idPromotion)
	{
		try {
			$product = $this->find($idProduct);
			$product->idPromotion = $idPromotion;
			$product->save();
			return $product;
		} catch (\Throwable $th) {
			return ['error'=>'Có lỗi trong quá trình thực hiện'];
		}
	}

	function getProductById($id)
	{
		$product = $this->find($id);
		return $product;
	}

}
