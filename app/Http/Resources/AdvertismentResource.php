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
        $typeArr = ['residential','commercial_units','commercial','investment','industrial','chalet','farm','break','lands'];
        $index = array_search($this->category->type,$typeArr);
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'category'=>$request->header('lang')=='en' ? $this->category->name_en : $this->category->name_ar ,
            'area'=>$request->header('lang')=='en' ? $this->area->name_en : $this->area->name_ar,
            'category_id'=>$this->category->id,
            'area_id'=>$this->area->id,
            'category_type_id'=>$index+1,
            'price'=>$this->price,
            'type'=>$this->type,
            'name'=>$this->user->name,
            'phone'=>$this->user->phone,
            'image'=> $this->adsImage[0]->image !=null ?  asset('uploads/ads/'.$this->adsImage[0]->image) : asset('assets/images/logo-sm.png'),
            'profile_image' => $this->user->image !=null ? asset('uploads/users/'.$this->user->image) : asset('assets/images/logo-sm.png'),
            'user_id'=>$this->user_id,
            'account_type'=>$this->user->type
        ];
    }

  
}
