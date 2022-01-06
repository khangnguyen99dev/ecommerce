<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Pusher\Pusher;

class CommentsController extends Controller
{
    protected $comment;
    public function __construct(Comments $comment) {
        $this->comment = $comment;
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
        if(Auth::check()) {
            $idUser = Auth::id();

            $user = User::find($idUser);

            $idProduct = $request->idProduct;
            $message = $request->message;
    
            $data = [
                'idUser' => $idUser,
                'idProduct' => $idProduct,
                'message' => $message,
            ];
    
            $object = Comments::create($data);
    
            $date = date('d M y, h:i a', strtotime($object->created_at));
    
            $options = array(
                'cluster' => 'eu',
                'useTLS' => true
            );
    
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $name = $user->name;
            $avatar = $user->avatar;

            $data = [
                'idUser' => $idUser,
                'idProduct' => $idProduct,
                'message' => $message, 
                'date' => $date,
                'name' => $name,
                'avatar' => $avatar
            ];
            $pusher->trigger('my-comment', 'my-comment', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = $this->comment->ListComment($id);
        return Response()->json(['comment'=>$list,'idUser'=>Auth::id()]);      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = $this->comment->deleteComment($id);
        if($comment){
            return Response()->json(['success'=>'Xóa thành công!']);
        }else{
            return Response()->json(['error'=>'Có lỗi trong quá trình thực hiện!']);
        }
    }
}
