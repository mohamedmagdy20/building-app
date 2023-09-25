<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class MessageResource extends JsonResource
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
            'sender'=>$this->sender_id,
            'message'=>$this->message,
            'date'=>Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            
        ];
    }
}
