<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;
    protected $table = 'banner';

    protected $fillable = [
    	'name','image','description','status',
    ];

    function getAllList() {
        return $this->all();
    }

    function createBanner($request)
    {
        return $this->create($request);
    }

    function updateBanner($request, $id)
    {
        $banner = $this->find($id);
        $banner->update($request);
        return $banner;
    }

    function deleteBanner($id)
    {
        $banner = $this->find($id);
        $banner->delete();
        return $banner;
    }
}
