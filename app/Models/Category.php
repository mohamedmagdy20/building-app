<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'type'
    ];

    public function scopeFilter($query, $params)
    {
        if(isset($params['type']))
        {
            $query->whereIn('type',[$params['type'],'both']);
        }
        return $query;
    }


}
