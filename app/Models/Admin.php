<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    protected $table = 'admins';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password'
    ];
    // protected $hidden = ['password'];
}
