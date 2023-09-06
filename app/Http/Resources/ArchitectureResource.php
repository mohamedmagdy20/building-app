<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
        $typeArr = ['residential','commercial_units','commercial','investment','industrial','chalet','farm','break','lands'];
        $index = array_search($this->category->type,$typeArr);
        $visitCount =  DB::table('shetabit_visits')->where('visitor_id',$this->id)->count();

        return[
            'id'=>$this->id,
            'title'=>$this->title,
            
            'user'=>$this->user->name,
            'category'=>$request->header('lang')=='en' ? $this->category->name_en : $this->category->name_ar ,
            'area'=>$request->header('lang')=='en' ? $this->area->name_en : $this->area->name_ar,
            'category_type_id'=>$index+1,
            'category_id'=>$this->category->id,
            'area_id'=>$this->area->id,
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
            'phone'=>$this->user->phone,
            'images'=>AdvertismantImages::collection($this->adsImage),
            'date_created'=>Carbon::parse($this->updated_at)->format('M d Y'),
            'views'=>$visitCount
         ];
    }
}
