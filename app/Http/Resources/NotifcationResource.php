<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class NotifcationResource extends JsonResource
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
            'message'=>$this->message,
            'type'=>$this->type,
            'ads_id'=>$this->advertisment_id,
            'date'=>Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
