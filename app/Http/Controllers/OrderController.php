<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use DB;
use PDF;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use PhpParser\Node\Stmt\TryCatch;

class OrderController extends Controller
{
    protected $order;
    protected $orderDetail;
    protected $product;
    public function __construct(Order $order, OrderDetail $orderDetail, Product $product) {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response()->json(['order'=> $this->order->getAllList()]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderDetail = $this->order->showOrder($id);
        if($orderDetail){
            return Response()->json(['orderDetail'=>$orderDetail]);
        }else{
            return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
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
        $updateOrderDetail = $this->orderDetail->updateOrderDetail($request->quantity, $id);
        if($updateOrderDetail) {
            $product = Product::find($updateOrderDetail->idProduct);
            $updateOrderDetail['qtyStock'] = $product->quantity; 
            return Response()->json(['orderDetail'=>$updateOrderDetail]);
        }else{
            return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function printOrder(Request $request) {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($request));
        return $pdf->stream();
    }

    public function print_order_convert($request) {
        $html = '<style>
            body{
            font-family: DejaVu Sans;
            font-size: 12px;
            }
            table, td, th {
                border: 1px solid black;
                text-align: center;
              }
              
              table {
                width: 100%;
                border-collapse: collapse;
              }
              .modal-title {
                  font-size: 18px;
              }
              .center {
                text-align: center;
              }
              .title {
                  font-size: 20px;
              }
            </style>';
        $html.='<p>CỬA HÀNG PHỤ TÙNG XE MÁY KANE STORE</p>
        <p>Địa chỉ: Phường Xuân Khánh,Quận Ninh Kiều, Cần Thơ</p>
        <p>Số điện thoại: 0911904945</p>
        <h3 class="center title">ĐƠN MUA HÀNG</h3>';
        $html .= $request->tableAccount.''.$request->tableProduct.''.$request->tableOrder;
        return $html;
    }

    public function orderProcess(Request $request) {
        if(Auth::user()->role == 1 || Auth::user()->role == 2){
            try{
                $idOrder = $request->idOrder;
                $idPerson = Auth::user()->id;
                $option = $request->option; 
                $statusOrder = Order::find($idOrder); 
                if($option == 1 || $option == 0) {
                    foreach($request->data as $value) {    
                        $this->product->updateQty($value['id'], $value['qty'],$option);      
                    }
                }elseif($option == 2 && $statusOrder->status == 1) {
                    foreach($request->data as $value) {    
                        $this->product->updateQty($value['id'], $value['qty'],$option);      
                    }   
                }             
                $order = $this->order->updatePersonTick($idOrder,$idPerson,$option);
                DB::commit();
                return Response()->json(['orderDetail'=>$order]);
            }catch (Exception $e){
                DB::rollback();
                return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện']);
            }
        }else{
            return Response()->json(['error'=>'Chức năng không được sử dụng']);
        }
    }
}
