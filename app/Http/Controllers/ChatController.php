<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ChatController extends Controller
{
    public function getMessages(Request $request)
    {
        $data=DB::table('chats')->where('chatroom_id','=',$request->room_id)->orderBy('time')->get();
        return response()->json($data,200);

    }
    public function sendMessages(Request $request)
    {
        $data=$request->all();
        // $message="'".$request->message."'";
        // $sender="'".$request->sender."'";
        DB::insert('insert into chats (chatroom_id,message,from_user,to_user,sender) values (?, ?,?,?,?)', [
            $request->room,
            $request->message,
            $request->from,
            $request->to,
            $request->sender,
        ]);
        return response()->json($data, 200);
      
    }
    public function chatview($orderid)
    {
                return view('userchat',['orderid'=>$orderid]);
    }
}
