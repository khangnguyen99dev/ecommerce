<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Auth;
class PromotionController extends Controller
{
    protected $promotion;

    public function __construct(Promotion $promotion)
    {
        $this->promotion = $promotion;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotion = $this->promotion->getAllPromotion();
        return view('back-end.pages.promotion.index',['promotion'=>$promotion]);
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
        
        if(Auth::check()){
            if($request->startDay < $request->endDay){
                $data = [
                    'name'=>$request->name,
                    'promotional'=>$request->promotional,
                    'startDay'=>$request->startDay,
                    'endDay'=>$request->endDay
                ];
                $promotion = $this->promotion->addPromotion($data);
                return Response()->json($promotion);
            }else{
                return Response()->json(['error'=>'Ngày bắt đầu phải nhỏ hơn ngày kết thúc']);
            }

        }else{
            return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::check()) {
            if($request->startDay < $request->endDay){
                $data = [
                    'name'=>$request->name,
                    'promotional'=>$request->promotional,
                    'startDay'=>$request->startDay,
                    'endDay'=>$request->endDay,
                ];
                $result = $this->promotion->updatePromotion($id,$data);
                return Response()->json($result);
            }else{
                return Response()->json(['error'=>'Ngày bắt đầu phải nhỏ hơn ngày kết thúc']);
            }

        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->promotion->deletePromotion($id);
        return $result;
    }
}
