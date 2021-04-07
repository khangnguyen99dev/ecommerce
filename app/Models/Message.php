<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $table = 'message';

    protected $fillable = [
    	'from','to','message','is_read',
    ];
}
