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
            switch ($params['type']) {
                case 1:
                    $query->where('type','residential');
                break;
                case 2:
                    $query->where('type','commercial_units');
                break;

                case 3:
                    $query->where('type','commercial');
                break;

                
                case 4:
                    $query->where('type','investment');
                break;

                
                case 5:
                    $query->where('type','industrial');
                break;

                case 6:
                    $query->where('type','chalet');
                break;

                
                case 7:
                    $query->where('type','farm');
                break;

                
                case 8:
                    $query->where('type','break');
                break;

                case 9:
                    $query->where('type','lands');
                break;
            }
        }
        return $query;
    }


}
