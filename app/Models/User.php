<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hash;
// use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'phone','password','role','status','gender','avatar','social_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function Customer() {
        return $this->hasMany('App\Models\Customer','idUser','id')->select(['address','idCity','id','name','phone','active']);
    }


    public function Order() {
        return $this->hasMany('App\Models\Order','idUser','id');
    }

	public function Comment() 
	{
		return $this->hasMany('App\Models\Comments','idProduct','id');
	}

    function getUser($id) {
        $user = $this->select(['name','phone','email','id','avatar','gender','social_id'])->find($id);
        return $user;
    }

    function checkmail($value) {
        $user = $this->where('email',$value)->first();
        return !empty($user) ? true : false;
    }


    function updateProfile($id, $data) {
        $user = $this->find($id);

        $user->update($data);

        return $user;
    }

    function updatePass($id, $data) 
    {
        $user = $this->find($id);
        $password = $data['password'];
        $newpass = Hash::make($data['newpass']);
        if(Hash::check($password, $user->password)) {
            $user->password = $newpass;
            $user->save();
            return $user;          
        }else{
            return ['error'=>'Mật khẩu không đúng vui lòng nhập lại!'];
        }
    }

    function accountEmployee() 
    {
        $employee = $this->where('role',2)->get();
        return $employee;
    }

    function accountGuest() 
    {
        $employee = $this->where('role',0)->get();
        return $employee;
    }

    function accountDelivery() 
    {
        $delivery = $this->where('role',3)->get();
        return $delivery;        
    }

    function createEmployee($data)
    {
        try {
            $employee = $this->insert($data);
            return $employee;
        } catch (\Throwable $th) {
            return ['error'=>'Có lỗi trong quá trình thực hiện'];
        }
        
    }

    function accountStatus($id, $status)
    {
        $user = $this->find($id);
        $user->status = $status;
        $user->save();
        return $user;
    }

    function deleteEmployee($id)
    {
        try {
            $user = $this->find($id);
            $user->delete();
            return $user;
        } catch (\Throwable $th) {
            return ['error'=>'Có lỗi trong quá trình thực hiện'];
        }
    }

    function updateEmployee($id, $data)
    {
        try {
            $user = $this->find($id);
            $user->update($data);
            return $user;
        } catch (\Throwable $th) {
            return ['error'=>'Có lỗi trong quá trình thực hiện'];
        }
    }

    function createDelivery($data)
    {
        try {
            $delivery = $this->insert($data);
            return $delivery;
        } catch (\Throwable $th) {
            return ['error'=>'Có lỗi trong quá trình thực hiện'];
        }
    }
}
