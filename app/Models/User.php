<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'access_token',
        'image',
        'type',
        'account_type',
        'points',
        'plan_id',
        'notification_token',
        'otp',
        'is_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class,'plan_id');
    }

    public function advertisment()
    {
        return $this->hasMany(Advertisment::class);
    }
    
    public function scopeNormal($query)
    {
        $query->where('account_type','normal');
    }

    public function scopePremium($query)
    {
        $query->where('account_type','premium');
    }

    public function scopePersonal($query)
    {
        $query->where('type','personal');
    }

    public function scopeCompany($query)
    {
        $query->where('type','company');
    }
    
}
