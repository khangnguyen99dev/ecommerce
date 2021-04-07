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
}