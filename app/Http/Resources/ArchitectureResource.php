<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ArchitectureResource extends JsonResource
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
            'num_of_apartments'=>$this->num_of_apartments,
            'num_of_floor'=>$this->num_of_floor,
            'price'=>$this->price,
            'location'=>explode(',',$this->location),
            'links'=>$this->links,
            'description'=>$this->description,
            'space'=>$this->space,          
            'number'=>$this->number,
            'type'=>$this->type,
            'ads_type'=>$this->ads_type,
            'abroved'=>$this->abroved,
            'images'=>AdvertismantImages::collection($this->adsImage),
            'date_created'=>Carbon::parse($this->created_at)->format('M d Y'),
            'views'=> 0
        ];
    }
}