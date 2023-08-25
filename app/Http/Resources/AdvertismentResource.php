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
            'title'=>$this->title,
            'category'=>$request->header('lang')=='en' ? $this->category->name_en : $this->category->name_ar ,
            'area'=>$request->header('lang')=='en' ? $this->area->name_en : $this->area->name_ar,
            'price'=>$this->price,
            'image'=> $this->adsImage[0]->image !=null ?  asset('uploads/ads/'.$this->adsImage[0]->image) : asset('assets/images/logo-sm.png'),
            'profile_image' => $this->user->image !=null ? asset('uploads/users/'.$this->user->image) : asset('assets/images/logo-sm.png') 
        ];
    }

  
}
