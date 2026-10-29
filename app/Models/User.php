<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <-- 1. Import Sanctum trait

class User extends Authenticatable
{
    use HasApiTokens, Notifiable; // <-- 2. Add HasApiTokens here

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}