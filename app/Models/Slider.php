<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false;
    protected $table = 'slider';

    protected $fillable = [
    	'name','image','description','status',
    ];

    function getAllList() {
        return $this->all();
    }

    function createSlider($request)
    {
        return $this->create($request);
    }

    function updateSlider($request, $id)
    {
        $slider = $this->find($id);
        $slider->update($request);
        return $slider;
    }

    function deleteSlider($id)
    {
        $slider = $this->find($id);
        $slider->delete();
        return $slider;
    }
}
