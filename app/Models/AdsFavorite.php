<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsFavorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'advertisment_id'
    ];
    public function advertisments() {
        return $this->belongsTo(Advertisment::class, "advertisment_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");

    }
}
