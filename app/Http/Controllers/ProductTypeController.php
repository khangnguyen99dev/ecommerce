<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productType = ProductType::orderBy('id','desc')->paginate(6);

        $category = Category::where('status',1)->get();

        return view('back-end.pages.productType.index', ['productType' => $productType , 'category' => $category ]);
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
        $productType = ProductType::create([
            'name' => $request->name,
            'idCategory' => $request->idCategory,
            'slug' => utf8tourl($request->name),
            'status' => $request->status,
        ]);
        $productType['nameCategory'] = $productType->Category['name'];
        return response()->json($productType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
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
        $productType = ProductType::find ($id);
        $productType->update($request->all());
        $productType['nameCategory'] = $productType->Category['name'];
        return response()->json($productType);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productType = ProductType::find($id)->delete();
        if($productType){
            return response()->json(['message'=>'Xóa thành công']);
        }else{
            return response()->json(['message'=>'Có lỗi trong quá trình thực hiện']);
        }
        
    }
}
