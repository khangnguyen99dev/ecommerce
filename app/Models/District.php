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

}
