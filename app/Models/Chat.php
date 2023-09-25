<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_to_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function reciver()
    {
        return $this->belongsTo(User::class,'user_to_id');
        
    }

    public function message()
    {
        return $this->hasMany(Message::class,'chat_id');
    }
    
    public function lastMessage()
    {
        return $this->hasOne(Message::class,'chat_id')->latestOfMany();
    }

}
