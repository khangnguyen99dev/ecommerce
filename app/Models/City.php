<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    protected $table = 'city';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'name','type',
    ];

	public function District() 
	{
		return $this->hasMany('App\Models\District','idCity','id');
	}

    function getCity() {
        return $this->all();
    }

}
