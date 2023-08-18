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
        if(isset($params['type']) )
        {
            if($params['type'] == 1)
            {
                $query->where('type','residential');
            }

            if($params['type'] == 2)
            {
                $query->where('type','commercial');
            }

            if($params['type'] == 3)
            {
                $query->where('type','lands');
            }
        }
        return $query;
    }


}
