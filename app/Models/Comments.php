<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $fillable = [
    	'idUser','idProduct','message',
    ];

    public function User()
    {
    	return $this->belongsTo('App\Models\User','idUser','id')->select(['id','name', 'avatar']);
    }

    public function Product()
    {
        return $this->belongsTo('App\Models\Product','idProduct','id');
    }

    function ListComment($idProduct) 
    {
		$comments = $this->with('User')->where('idProduct',$idProduct)->get();
		foreach($comments as $key => $value){
			$comments[$key]['date'] = date('d M y, h:i a', strtotime($value->created_at));
		}	
		return $comments;
    }

    function deleteComment($id)
    {
      $comment = $this->find($id);
      $comment->delete();
      return $comment;
    }
}
