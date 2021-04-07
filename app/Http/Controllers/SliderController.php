<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use App\Services\ImageService;

class SliderController extends Controller
{
    protected $slider;
    protected $imageService;
    public function __construct(Slider $slider,ImageService $imageService) {
        $this->slider = $slider;
        $this->image_service = $imageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response()->json(['slider'=> $this->slider->getAllList()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->image;
            if($this->image_service->checkFile($file) == 1) {
                $fileName = $this->image_service->moveImage($file,'assets/img/upload/slider/');
                if($fileName != 0) {
                    $data['image'] = $fileName;
                }
            }elseif($this->image_service->checkFile($file) == 0){
                return response()->json(['error'=>'File ảnh phải nhỏ hơn 1MB']);
            }else {
                return response()->json(['error'=>'File không phải ảnh']);
            }
        }else{
            return response()->json(['error'=>'Bạn chưa chọn ảnh cho sản phẩm']);
        }
        $slider = $this->slider->createSlider($data);
        return Response()->json(['slider'=>$slider]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $data = $request->all();
        $data['name'] = $request->name;
        if($slider->exists()){
            if($request->hasFile('image')){
                $file = $request->image;
                if($this->image_service->checkFile($file) == 1) {
                    $fileName = $this->image_service->moveImage($file,'assets/img/upload/slider/');
                    if($fileName != 0) {
                        $data['image'] = $fileName;
                        $this->image_service->deleteFile($slider->image,'assets/img/upload/slider/');
                    }
                }elseif($this->image_service->checkFile($file) == 0){
                    return response()->json(['error'=>'File ảnh phải nhỏ hơn 1MB']);
                }else {
                    return response()->json(['error'=>'File không phải ảnh']);
                }
            }else{
                $data['image'] = $slider->image;
            }
        }else{
            return response()->json(['error'=>'Không tìm thấy dữ liệu']);
        }
        $sliderUpdate = $this->slider->updateSlider($data, $id);
        if($sliderUpdate) {
            return response()->json(['slider'=>$sliderUpdate]);
        }else{
            return response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sliderDel = $this->slider->deleteSlider($id);
        if($sliderDel) {
            return response()->json(['slider'=>$sliderDel]);
        }else{
            return response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }
    }
}
