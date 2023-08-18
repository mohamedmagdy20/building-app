<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ResidentialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'user'=>$this->user->name,
            'category'=>$request->header('lang')=='en' ? $this->category->name_en : $this->category->name_ar ,
            'area'=>$request->header('lang')=='en' ? $this->area->name_en : $this->area->name_ar,
            'price'=>$this->price,
            'advantages'=>explode(',',$this->advantages),
            'links'=>$this->links,
            'description'=>$this->description,
            'num_of_rooms'=>$this->num_of_rooms,
            'num_of_lounges'=>$this->num_of_lounges,
            'num_of_bath'=>$this->num_of_bath,
            'space'=>$this->space,          
            'number'=>$this->number,
            'type'=>$this->type,
            'ads_type'=>$this->ads_type,
            'abroved'=>$this->abroved,

            'date_created'=>Carbon::parse($this->created_at)->format('M d Y'),

            'images'=>AdvertismantImages::collection($this->adsImage),
            'views'=> 0

        ];
    }
}
