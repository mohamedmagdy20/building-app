<?php

namespace App\Http\Controllers\Api;

use App\Events\ChatEvent;
use App\Events\StartChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChatRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    //
    protected $chat ;
    protected $message;
    public function __construct(Chat $chat , Message $message)
    {
        $this->chat = $chat;
        $this->message = $message;
    }

    public function createChat(ChatRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            $isChatExist =  $this->chat->where('user_id',$this->auth($request->access_token)->id)->where('user_to_id',$data['user_to_id'])->first();
            if(!$isChatExist)
            {
                $chat =  $this->chat->create(array_merge($data,['user_id'=>$this->auth($request->access_token)->id]) );
            }else{
                return response()->json([
                'status'=>403,
                'data'=>null,
                'message'=>'Chat Already Exist'
                ],403);
            }
                
            
            DB::commit();
            // Send Notification For Start Chat
            // event(new StartChatEvent($this->auth($request->access_token)->id,$data['user_to_id']));
            return response()->json([
                'status'=>200,
                'data'=>[
                    'user_id'=>$chat->user_id,
                    'chat_id'=>$chat->id,
                    'user_to_id'=>$chat->user_to_id
                ],
                'message'=>'success'
            ]);
        }catch(\Exception $e)
        {
            DB::rollBack();
            return $e;
        }
       
    }


    public function sendMessage(MessageRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            $message = $this->message->create($data);
            DB::commit();
            // Send Notification For Start Chat
            event(new ChatEvent($message));

            return response()->json([
                'status'=>200,
                'data'=>null,
                'message'=>'Message Sent'
            ]);

        }catch(\Exception $e)
        {
            DB::rollBack();
            return $e;
        }
    }


    public function getMessagesChat(Request $request)
    {
        $id = $this->auth($request->access_token)->id;
        $chat = $this->chat->where('user_id',$id)->orWhere('user_to_id',$id)->with('message')->get();
        // return $chat;
        return response()->json([
            'data'=> ChatResource::collection($chat),
            'message'=>'Success',
            'status'=>200
        ]);
    }

    public function getMessages(Request $request)
    {
        $data = $this->message->where('chat_id',$request->get('chat_id'))->get();
        return response()->json([
            'data'=> MessageResource::collection($data),
            'message'=>'Success',
            'status'=>200
        ]);
    }
}
