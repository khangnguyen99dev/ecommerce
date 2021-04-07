<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Auth;
use Pusher\Pusher;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::select("select users.id, users.name, users.avatar, users.email, count(is_read) as unread 
        from users LEFT  JOIN  message ON users.id = message.from and is_read = 0 and message.to = " . Auth::id() . "
        where users.id != " . Auth::id() ." and users.role != 1 
        group by users.id, users.name, users.avatar, users.email");
        return view('front-end.layouts.chat',['users'=>$users]);
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
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = [
            'from' => $from,
            'to' => $to,
            'message' => $message,
            'is_read' => 0
        ];

        $object = Message::create($data);

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

        $data = ['from' => $from, 'to' => $to,'message' => $message, 'date' => $date]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $my_id = Auth::id();
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        $messages = Message::where(function ($query) use ($user_id, $my_id){
            $query->where('from', $my_id)->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->get();

        return view('front-end.pages.message',['messages'=>$messages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(message $message)
    {
        //
    }
}
