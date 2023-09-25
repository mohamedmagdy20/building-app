<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'image'=>$this->image ? asset('users/'.$this->image) : null,
            'phone'=>$this->phone,
            'type'=>$this->type,
            'access_token'=>$this->access_token,
            'account_type'=>$this->account_type,
            'point'=>$this->points,
            'plan'=>$this->plan,
            'notification_token'=>$this->notification_token,
            'created_at'=>Carbon::parse($this->created_at)->format('Y M D'),
            'updated_at'=>Carbon::parse($this->updated_at)->format('Y M D'),
        ];
    }
}
