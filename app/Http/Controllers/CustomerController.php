<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use App\Services\ImageService;

class CustomerController extends Controller
{
    protected $user;
    protected $imageService;
    protected $customer;
    protected $city;
    protected $district;
    protected $ward;
    protected $order;
    protected $OrderDetail;
    public function __construct(ImageService $imageService, User $user, Customer $customer, City $city, District $district, Ward $ward, Order $order, OrderDetail $orderDetail) {
        $this->user = $user;
        $this->image_service = $imageService;
        $this->customer = $customer;
        $this->city = $city;
        $this->district = $district;
        $this->ward = $ward;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            $id = Auth::id();
            $user = $this->user->getUser($id);
            return view('front-end.pages.infoCustomer.infoAccount',['user'=>$user]);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập!']);
        }
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
        $user = User::find(Auth::id());
        $data = $request->all();
        if($request->hasFile('avatar')){
            $file = $request->avatar;
            if($this->image_service->checkFile($file) == 1) {
                $fileName = $this->image_service->moveImage($file,'assets/img/upload/avatar/');
                if($fileName != 0) {
                    $data['avatar'] = $fileName;
                    $this->image_service->deleteFile($user->avatar,'assets/img/upload/avatar/');
                }
            }elseif($this->image_service->checkFile($file) == 0){
                return response()->json(['error'=>'File ảnh phải nhỏ hơn 1MB']);
            }else {
                return response()->json(['error'=>'File không phải ảnh']);
            }
        }else{
            $data['avatar'] = $user->avatar;
        }
        $user->update($data);

        return Response()->json(['user'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $customer = Customer::where('email',$request->email)->first();
        // if($customer) {
        //     return Response()->json(['message'=>'Email đã tồn tại']);
        // }else{
        //     return Response()->json(['error'=>'Not found']);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
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
        $customer = Customer::find($id);
        $data = $request->all();
        if($customer){            
            $customer->update($data);
            return Response()->json(['customer'=>$data]);
        }else{
            return Response()->json(['error'=>'Không tìm thấy dữ liệu']);
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
        $customer = $this->customer->deleteCustomer($id);
        return Response()->json($customer);
    }

    public function addAddress(Request $request) {
        if(Auth::check()){
            $user = Auth::user();
            $data = $request->all();   
            $data['email'] = $user->email;
            $data['idUser'] = $user->id;
            if($request->active == 1){
                $customer = Customer::where('idUser',$user->id)->where('active',1)->first();
                if(!empty($customer)) {
                    $customer->active = 0;
                    $customer->save();
                }
            }
            $info = Customer::create($data);
            $getData = $this->customer->getAddressAdd($info->id);
            return Response()->json(['info'=>$getData]);
        }else{
            return back()->with('message','Bạn cần đăng nhập trước khi xem giỏ hàng');
        }
    }


    public function showAddress() {
        if(Auth::check()) {
            $id = Auth::id();
            $user = $this->user->getUser($id);
            $user['Customer'] = $this->customer->getAddress($id);
            $city = City::orderBy('id','ASC')->get();
            return view('front-end.pages.infoCustomer.infoAddress',['user'=>$user,'city'=>$city]);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập!']);
        }
    }

    public function setAddressDefault(Request $request) {
        $customer = Customer::where('idUser',Auth::id())->where('active',1)->first();
        if(!empty($customer)) {
            $customer->active = 0;
            $customer->save();
        }     
        
        $defaultAdd = Customer::find($request->id);
        $defaultAdd->active = 1;
        $defaultAdd->save();
        return $defaultAdd;
    }

    public function showEditAddress(Request $request) {
        $city = $this->city->getCity();

        $district = $this->district->getDistrict($request->idCity);

        $ward = $this->ward->getWard($request->idDistrict);

        return Response()->json(['city'=>$city, 'district'=>$district, 'ward'=>$ward]);
    }


    public function showPurchased($key) {
        if(Auth::check()){
            $id = Auth::id();
            $user = $this->user->getUser($id);
            $order = $this->order->getOrder($id,$key);
            $order = $this->orderDetail->getOrderDetail($order);
            return view('front-end.pages.infoCustomer.purchased',['user'=>$user,'order'=>$order,'key'=>$key]);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập!']);
        }
    }

}
