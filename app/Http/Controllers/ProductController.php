<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\ImageLibrary;
use App\Services\ImageService;
use App\Models\Promotion;
use Auth;
class ProductController extends Controller
{
    protected $imageService;
    protected $product;
    public function __construct(ImageService $imageService, Product $product)
    {      
        $this->image_service = $imageService;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with(['Promotion'])->orderBy('id','desc')->get();
        $products = Product::where('idPromotion',1)->get();
        $category = Category::where('status',1)->get();
        $productType = ProductType::where('status',1)->get();
        $promotion = Promotion::where('endDay','>',now())->get();
        return view('back-end.pages.product.index', ['product' => $product,'category' => $category, 'productType' => $productType,'promotion'=>$promotion,'products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotion = Promotion::where('endDay','>',now())->get();
        $category = Category::where('status',1)->get();
        $productType = ProductType::where('status',1)->get();
        return view('back-end.pages.product.add',['category' => $category, 'productType' => $productType, 'promotion'=>$promotion]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('multipleImage')){
            foreach($request->multipleImage as $key => $image) {
                if($this->image_service->checkFile($image) == 1) {
                    $fileName = $this->image_service->moveImage($image,'assets/img/upload/product/');
                    if($fileName != 0) {
                        $mutipleImage[] =  $fileName;
                    }
                }elseif($this->image_service->checkFile($image) == 0){
                    return response()->json(['error'=>'File ảnh liên quan phải nhỏ hơn 1MB']);
                }else {
                    return response()->json(['error'=>'Ảnh liên quan không phải file ảnh']);
                }
            }
        }
        if($request->hasFile('image')){
            $file = $request->image;
            if($this->image_service->checkFile($file) == 1) {
                $fileName = $this->image_service->moveImage($file,'assets/img/upload/product/');
                if($fileName != 0) {
                    $idPromotion = $request->idPromotion;
                    $promotion = Promotion::find($idPromotion);
                    $data = $request->all();
                    $oldPrice = $request->oldPrice;
                    $data['slug'] = utf8tourl($request->name);
                    $data['image'] = $fileName;
                    $data['sold'] = "0";
                    $data['react'] = "0";
                    $data['currentPrice'] = $oldPrice-($promotion->promotional*$oldPrice)/100;
                    $product = Product::create($data); 
                    if(isset($mutipleImage)){
                        $idproduct = $product->id;
                        foreach($mutipleImage as $value) {
                            $insertImage[] = [
                                'idProduct' => $idproduct,
                                'path' => $value
                            ];
                        }
                        ImageLibrary::insert($insertImage);
                    }
                    return response()->json($data);
                    
                }
            }elseif($this->image_service->checkFile($file) == 0){
                return response()->json(['error'=>'File ảnh phải nhỏ hơn 1MB']);
            }else {
                return response()->json(['error'=>'File không phải ảnh']);
            }
        }else{
            return response()->json(['error'=>'Bạn chưa chọn ảnh cho sản phẩm']);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
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
        if($request->hasFile('multipleImage')){
            foreach($request->multipleImage as $key => $image) {
                if($this->image_service->checkFile($image) == 1) {
                    $fileName = $this->image_service->moveImage($image,'assets/img/upload/product/');
                    if($fileName != 0) {
                        $mutipleImage[] =  $fileName;
                    }
                }elseif($this->image_service->checkFile($image) == 0){
                    return response()->json(['error'=>'File ảnh liên quan phải nhỏ hơn 1MB']);
                }else {
                    return response()->json(['error'=>'Ảnh liên quan không phải file ảnh']);
                }
            }
        }
        $product = Product::find($id);
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($request->hasFile('image')){
            $file = $request->image;
            if($this->image_service->checkFile($file) == 1) {
                $fileName = $this->image_service->moveImage($file,'assets/img/upload/product/');
                if($fileName != 0) {
                    $data['image'] = $fileName;
                    $this->image_service->deleteFile($product->image,'assets/img/upload/product/');
                }
            }elseif($this->image_service->checkFile($file) == 0){
                return response()->json(['error'=>'File ảnh phải nhỏ hơn 1MB']);
            }else {
                return response()->json(['error'=>'File không phải ảnh']);
            }
        }else{
            $data['image'] = $product->image;
        }
        $idPromotion = $request->idPromotion;
        $promotion = Promotion::find($idPromotion);
        $oldPrice = $request->oldPrice;
        $data['currentPrice'] = $oldPrice-($promotion->promotional*$oldPrice)/100;
        $product->update($data);
        $product['nameCategory'] = $product->Category['name'];
        $product['nameProductType'] = $product->ProductType['name'];
        $product['Promotion'] = $product->Promotion['promotional'];
        if(isset($mutipleImage)){
            $idproduct = $product->id;
            foreach($mutipleImage as $value) {
                $insertImage['idProduct'] = $idproduct;
                $insertImage['path'] = $value;
                $dataImg[] = ImageLibrary::create($insertImage);
            }
            return response()->json(['product'=>$product, 'dataImg'=>$dataImg]);
        }
        return response()->json(['product'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            $this->image_service->deleteFile($product->image,'assets/img/upload/product/');
            $img_library = ImageLibrary::where('idProduct',$id)->get();
            if(count($img_library) > 0) {
                foreach($img_library as $value) {
                    $this->image_service->deleteFile($value->path,'assets/img/upload/product/');
                    $value->delete();
                }
            }
            return response()->json(['success'=>'Xóa thành công sản phẩm']);
        } catch (\Throwable $th) {
            return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }      
    }

    public function deleteImage($id) {
        $img_library = ImageLibrary::find($id);
        $this->image_service->deleteFile($img_library->path,'assets/img/upload/product/');
        $id = $img_library->id;
        $img_library->delete();
        return response()->json(['id'=>$id]);
    }

    public function apiProduct()
    {
        $product = $this->product->getProduct();
        return response()->json($product, 200);     
    }

    public function productRelate($id)
    {
        $products = $this->product->productRelate($id);
        return Response()->json($products);
    }

    public function addPromotionProduct(Request $request)
    {
        if(Auth::check()) {
            $idProduct = $request->idProduct;
            $result = $this->product->addPromotionProduct($request->idProduct, $request->idPromotion);
            return Response()->json($result);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }
    }

    public function getProductById($id)
    {
        $product = $this->product->getProductById($id);
        return Response()->json($product);
    }

}
