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
}
