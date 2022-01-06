<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;
    protected $table = 'district';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'name','type','idCity',
    ];

	public function Ward() 
	{
		return $this->hasMany('App\Models\Ward','idDistrict','id');
	}

    public function City() 
	{
		return $this->belongsTo('App\Models\City','idCity','id');
	}

	function getDistrict($idCity) {
		return $this->where('idCity',$idCity)->get();
	}

}
