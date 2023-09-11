<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'advertisments';
    public $timestamps = true;
    protected $fillable = 
    [
        'category_id',
        'title',
        'is_expire',
        'user_id',
        'area_id',
        'price',
        'advantages',
        'links',
        'description',
        'space',
        'location',
        'number',
        'num_of_rooms',
        'num_of_lounges',
        'num_of_bath',
        'num_of_apartments',
        'num_of_floor',
        'type',
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

    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
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

    public function scopeDraft($query)
    {
        $query->where('ads_type','draft');
    }
    
    public function scopeNotDraft($query)
    {
        $query->where('ads_type','!=','draft');
    }

    
    public function scopeSpecial($query)
    {
        $query->where('ads_type','special');   
    }

    public function scopeRent($query)
    {
        $query->where('type','rent');
    }

    public function scopeSale($query)
    {
        $query->where('type','sale');
    }

    public function scopeInstead($query)
    {
        $query->where('type','instead');
    }

    public function scopeFilter($query, $params)
    {
        if(isset($params['category_id']))
        {
            $query->where('category_id',$params['category_id']);
        }
        if(isset($params['area_id']))
        {
            $query->where('area_id',$params['area_id']);
        }

        if(isset($params['type']))
        {
            $query->where('type',$params['type']);
        }

        
        if(isset($params['expire']))
        {
            $query->where('is_expire',$params['expire']);
        }

        if(isset($params['category_ads_type']))
        {
            switch ($params['category_ads_type']) {
                case 1:
                    $query->whereHas('category',function($q){
                        $q->where('type','residential');
                    });
                break;

                case 2:
                    $query->whereHas('category',function($q){
                        $q->where('type','commercial_units');
                    });
                break;

                case 3:
                    $query->whereHas('category',function($q){
                        $q->where('type','commercial');
                    });
                break;

                case 4:
                    $query->whereHas('category',function($q){
                        $q->where('type','investment');
                    });
                break;
 
                case 5:
                    $query->whereHas('category',function($q){
                        $q->where('type','industrial');
                    });
                break;

                
                case 6:
                    $query->whereHas('category',function($q){
                        $q->where('type','chalet');
                    });
                break;

                case 7:
                    $query->whereHas('category',function($q){
                        $q->where('type','farm');
                    });
                break;

                
                case 8:
                    $query->whereHas('category',function($q){
                        $q->where('type','break');
                    });
                break;

                
                case 9:
                    $query->whereHas('category',function($q){
                        $q->where('type','lands');
                    });
                break;
            }
        }

        if(isset($params['q']))
        {
            $word = $params['q'];
            $query->where('number',$word)->orWhere('price',$word)->orWhere('space',$word)->orWhere('title','LIKE', '%' . $word . '%');
            // $query->where(function ($query) use ($word) {
            //     $query->whereHas('city', function ($q) use ($word) {
            //         $q->where('name_en', 'LIKE', '%' . $word . '%')
            //           ->orWhere('name_ar', 'LIKE', '%' . $word . '%');
            //     })->orWhereHas('category', function ($q) use ($word) {
            //         $q->where('name_en', 'LIKE', '%' . $word . '%')
            //           ->orWhere('name_ar', 'LIKE', '%' . $word . '%');
            //     });
            // });
        }
        return $query;
    }
}
