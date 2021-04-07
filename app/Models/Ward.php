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

}
