<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    use HasFactory;
    protected $table = 'advertisments';
    protected $fillable = 
    [
        'category_id',
        'address',
        'area',
        'piece',
        'street',
        'gha',
        'number',
        'floor',
        'house_number',
        'city_id',
        'price',
        'type',
        'user_id',
        'abroved',
        'ads_type'
    ];

    public function adsImage()
    {
        return $this->hasMany(AdvertismentImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function scopeNormal($query)
    {
        $query->where('ads_type','normal');   
    }

    
    public function scopeFixed($query)
    {
        $query->where('ads_type','fixed');   
    }

    
    public function scopeSpecial($query)
    {
        $query->where('ads_type','special');   
    }


    public function scopeFilter($query, $params)
    {
        if(isset($params['category_id']))
        {
            $query->where('category_id',$params['category_id']);
        }
        if(isset($params['city_id']))
        {
            $query->where('city_id',$params['city_id']);
        }

        if(isset($params['type']))
        {
            $query->where('type',$params['type']);
        }

        if(isset($params['q']))
        {
            $word = $params['q'];
            $word = str_replace(' ', '', $word);
            // $query->whereHas('city',function($q) use($word){
            //     $q->where('name_en', 'LIKE', '%'.$word.'%')->orWhere('name_ar', 'LIKE', '%'.$word.'%');
            // })
            // ->orWhereHas('category',function($q) use($word){
            //     $q->where('name_en', 'LIKE', '%'.$word.'%')->orWhere('name_ar', 'LIKE', '%'.$word.'%');
            // });
            $query->where(function ($query) use ($word) {
                $query->whereHas('city', function ($q) use ($word) {
                    $q->where('name_en', 'LIKE', '%' . $word . '%')
                      ->orWhere('name_ar', 'LIKE', '%' . $word . '%');
                })->orWhereHas('category', function ($q) use ($word) {
                    $q->where('name_en', 'LIKE', '%' . $word . '%')
                      ->orWhere('name_ar', 'LIKE', '%' . $word . '%');
                });
            });
        }
        return $query;
    }
}
