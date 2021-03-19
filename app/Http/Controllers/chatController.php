<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Message;
use App\User;
use Pusher\Pusher;

class chatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('properties.chat')->with('users',$users);
    }


    public function getMessage($user_id){
        // return $user_id;
        $my_id = Auth::id();

        //getting all messages for selected user
        $messages = Message::where(function($query) use ($user_id, $my_id){
            $query->where('user_id', $user_id)->where('reciever_id', $my_id);
        })->orWhere(function($query) use ($user_id, $my_id){
            $query->where('user_id', $my_id)->where('reciever_id', $user_id);
        })->get();

        return view('properties.messages')->with('messages', $messages);

    }

    
    public function sendMessage(Request $request){
        $user_id = Auth::id();
        $receiver_id = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->user_id = $user_id;
        $data->reciever_id = $receiver_id;
        $data->message = $message;
        $data->save();

        $options = array( 
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new pusher(
                 env('PUSHER_APP_KEY'),
                 env('PUSHER_APP_SECRET'),
                 env('PUSHER_APP_ID'),
                 $options
        );
           
         $data = ['user_id'=> $user_id, 'reciever_id'=> $receiver_id];
         $pusher->trigger('my-channel', 'my-event', $data);
    }
}