<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_ads',
        'num_days',
        'description',
        'is_permium',
        'price'
    ];

    public function scopePermium($query)
    {
        return $query->where('is_permium',true);
    }

    public function scopeNotPermium($query)
    {
        return $query->where('is_permium',false);
    }

    public function scopeFilter($query, $params)
    {
        if(isset($params['is_permium']))
        {
            $query->where('is_permium',$params['is_permium']);
        }
        return $query;
    }

}
