<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
    	'name','slug','status',
    ];

    public function productType()
    {
    	return $this->hasMany('App\Models\ProductType','idCategory','id');
    }

    function deleteCategory($id) 
    {
        try {
            $category = $this->find($id);
            $category->delete();
            return $category;
        } catch (\Throwable $th) {
            return false;
        }

    }
}
