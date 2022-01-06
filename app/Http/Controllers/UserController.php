<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\ImageService;
use Hash;
use Auth;

class UserController extends Controller
{
    protected $user;
    protected $imageService;
    public function __construct(User $user, ImageService $imageService) {
        $this->user = $user;
        $this->image_service = $imageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function loginAdmin(Request $request) {
        $data = $request->only('email','password');
        if(Auth::attempt($data,$request->has('remember'))){
            if(Auth::user()->role == 1) {
                return redirect('/admin');
            }elseif(Auth::user()->role == 2){
                return  redirect('/employee');
            }elseif(Auth::user()->role == 3){
                return redirect('/delivery');
            }else{
                return redirect('/home');
            }
        }else{
            return redirect('/home');
        }
    }

    function profile() 
    {
        if(Auth::check()){
            $user = Auth::user();
            return view('back-end.pages.profile.index',['user'=>$user]);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }
    }

    function changePass()
    {
        if(Auth::check()){
            return view('back-end.pages.profile.change-pass');
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }        
    }

    function updateProfile(Request $request) 
    {
        if(Auth::check()) {
            $idUser = Auth::id();
            $data = [
                'name'=>$request->name,
                'phone'=>$request->phone,
                'gender'=>$request->gender
            ];
        $user = User::find($idUser);

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
        $result = $this->user->updateProfile($idUser, $data);

            return Response()->json(['user'=>$result]);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }
    }

    function updatePass(Request $request) {
        if(Auth::check()){
            $idUser = Auth::id();
            $data = [
                'password'=>$request->password,
                'newpass'=>$request->newpass,
            ];
            $result = $this->user->updatePass($idUser, $data);
            return Response()->json($result);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }  
    }

    function accountEmployee() 
    {
        $employee = $this->user->accountEmployee();
        return view("back-end.pages.account.employee.index",['employee'=>$employee]);
    }

    function accountGuest() 
    {
        $guest = $this->user->accountGuest();
        return view("back-end.pages.account.guest.index",['guest'=>$guest]);
    }

    function accountDelivery() 
    {
        $delivery = $this->user->accountDelivery();
        return view("back-end.pages.account.delivery.index",['delivery'=>$delivery]);
    }

    function addEmployee(Request $request) 
    {
        if(Auth::check()){
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
                'role'=>2,
            ];

            $employee = $this->user->createEmployee($data);

            return Response()->json(['employee'=>$employee]);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }
    }

    function accountStatus(Request $request, $id)
    {
        if(Auth::check()){
            $result = $this->user->accountStatus($id,$request->status);
            return Response()->json($result);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }       
    }

    function deleteEmployee($id) 
    {
        if(Auth::check()){
            $result = $this->user->deleteEmployee($id);
            return Response()->json($result);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }          
    }

    function updateEmployee(Request $request)
    {
        if(Auth::check()){
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
            ];
            if(isset($request->newpass)) {
                $data['password'] = Hash::make($request->newpass);
            }
            $result = $this->user->updateEmployee($request->id, $data);
            return Response()->json($result);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }         
    }

    function addDelivery(Request $request)
    {
        if(Auth::check()){
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
                'role'=>3,
            ];

            $delivery = $this->user->createDelivery($data);

            return Response()->json(['deli$delivery'=>$delivery]);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập']);
        }
    }

    function showChangePass()
    {
        if(Auth::check()) {
            $id = Auth::id();
            $user = $this->user->getUser($id);
            return view('front-end.pages.infoCustomer.changePass',['user'=>$user]);
        }else{
            return Response()->json(['error'=>'Vui lòng đăng nhập!']);
        }
    }

    function updatePassCustomer(Request $request)
    {
        if($request->password == NULL || $request->newpass == NULL || $request->renewpass == NULL){
            return Response()->json(['error'=>'Vui lòng điền đầy đủ thông tin']);
        }elseif($request->newpass != $request->renewpass) {
            return Response()->json(['error'=>'Mật khẩu nhập lại không đúng']);
        }else{
            if(Auth::check()){
                $idUser = Auth::id();
                $data = [
                    'password'=>$request->password,
                    'newpass'=>$request->newpass,
                ];
                $result = $this->user->updatePass($idUser, $data);
                return Response()->json($result);
            }else{
                return Response()->json(['error'=>'Vui lòng đăng nhập']);
            }  
        }
    }
}
 