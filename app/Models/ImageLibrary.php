<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageLibrary extends Model
{
    public $timestamps = false;
	protected $table = 'image_library';

	protected $fillable = [
		'idProduct','path',
	];   

	public function Product()
	{
		return $this->belongsTo('App\Models\Product','idProduct','id');
	}

}
