<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            'num_ads'=> $this->num_ads == null ? 'Permium Plan' : $this->num_ads,
            'num_days'=>$this->num_days,
            'price'=>$this->price,
            'description'=>$this->description
        ];
    }
}
