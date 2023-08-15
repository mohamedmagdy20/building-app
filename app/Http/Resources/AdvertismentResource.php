<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Shetabit\Visitor\Traits\Visitable;
class AdvertismentResource extends JsonResource
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
            'user'=>$this->user->name,
            'category'=>$request->header('lang')=='en' ? $this->category->name_en : $this->category->name_ar ,
            'city'=>$request->header('lang')=='en' ? $this->city->name_en : $this->city->name_ar,
            'address'=>$this->address,
            'street'=>$this->street,
            'area'=>$this->area,
            'piece'=>$this->piece,
            'gha'=>$this->gha,
            'number'=>$this->number,
            'floor'=>$this->floor,
            'house_number'=>$this->house_number,
            'price'=>$this->price,
            'type'=>$this->type,
            'ads_type'=>$this->ads_type,
            'abroved'=>$this->abroved,
            'images'=>AdvertismantImages::collection($this->adsImage),
            'views'=> 0
        ];
    }

  
}
