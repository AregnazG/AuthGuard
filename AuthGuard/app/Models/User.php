<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'username';

    public $incrementing = false;

    protected $fillable = [
        'username', 'password',
    ];

    public function getUser($username)
    {
        return $this->where('username', $username)->first();
    }

}
