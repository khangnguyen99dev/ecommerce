<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $timestamps = false;
    protected $table = 'ward';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'name','type','idDistrict',
    ];

    public function District() 
	{
		return $this->belongsTo('App\Models\District','idDistrict','id');
	}

	function getWard($idDistrict) {
		return $this->where('idDistrict',$idDistrict)->get();
	}
}
