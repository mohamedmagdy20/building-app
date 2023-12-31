<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [  
            'chat_id'=>$this->id,
            'user_id'=>$this->user_id,
            'user_to_id'=>$this->user_to_id,
            'chat_with'=>new ChatWithResource($this->reciver),
            'profile'=>new ChatWithResource($this->user),

            // [
            //     'name'=>$this->reciver->name,
            //     'image'=>$this->reciver->image != null ?asset('public/uploads/users/'.$this->reciver->image) : asset('assets/images/users/person.jpg')
            // ],
            'messages'=>new MessageResource($this->lastMessage),
        ];
    }
}
