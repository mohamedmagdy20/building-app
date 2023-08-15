<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertismentImage extends Model
{
    use HasFactory;
    protected $fillable =[
        'advertisment_id',
        'image'
    ];
}
