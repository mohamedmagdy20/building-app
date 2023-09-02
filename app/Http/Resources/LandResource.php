<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class LandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $visitCount =  DB::table('shetabit_visits')->where('visitor_id',$this->id)->count();
        return [

            'id'=>$this->id,
            'title'=>$this->title,
            'user'=>$this->user->name,
            'category'=>$request->header('lang')=='en' ? $this->category->name_en : $this->category->name_ar ,
            'area'=>$request->header('lang')=='en' ? $this->area->name_en : $this->area->name_ar,
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
            'views'=>$visitCount
        ];
        
    }
}
