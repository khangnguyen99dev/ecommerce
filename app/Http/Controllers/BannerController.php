<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use App\Services\ImageService;

class BannerController extends Controller
{
    protected $banner;
    protected $imageService;
    public function __construct(Banner $banner,ImageService $imageService) {
        $this->banner = $banner;
        $this->image_service = $imageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response()->json(['banner'=> $this->banner->getAllList()]);
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
                $fileName = $this->image_service->moveImage($file,'assets/img/upload/banner/');
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
        $banner = $this->banner->createBanner($data);
        return Response()->json(['banner'=>$banner]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
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
        $banner = Banner::find($id);
        $data = $request->all();
        $data['name'] = $request->name;
        if($banner->exists()){
            if($request->hasFile('image')){
                $file = $request->image;
                if($this->image_service->checkFile($file) == 1) {
                    $fileName = $this->image_service->moveImage($file,'assets/img/upload/banner/');
                    if($fileName != 0) {
                        $data['image'] = $fileName;
                        $this->image_service->deleteFile($banner->image,'assets/img/upload/banner/');
                    }
                }elseif($this->image_service->checkFile($file) == 0){
                    return response()->json(['error'=>'File ảnh phải nhỏ hơn 1MB']);
                }else {
                    return response()->json(['error'=>'File không phải ảnh']);
                }
            }else{
                $data['image'] = $banner->image;
            }
        }else{
            return response()->json(['error'=>'Không tìm thấy dữ liệu']);
        }
        $bannerUpdate = $this->banner->updateBanner($data, $id);
        if($bannerUpdate) {
            return response()->json(['banner'=>$bannerUpdate]);
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
        $bannerDel = $this->banner->deleteBanner($id);
        if($bannerDel) {
            return response()->json(['banner'=>$bannerDel]);
        }else{
            return response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }
    }
}
