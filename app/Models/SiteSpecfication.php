<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSpecfication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'price',
        'type'
    ];

    public function scopeFilter($query, $params)
    {
        if(isset($params['type']) )
        {
            if($params['type'] == 1)
            {
                $query->where('type',1);
            }
            if($params['type'] == 2)
            {
                $query->where('type',2);
            }

            if($params['type'] == 3)
            {
                $query->where('type',3);
            }
        }
        return $query;
    }


}
