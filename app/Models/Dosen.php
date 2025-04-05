<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Dosen extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'dosen'; // Nama tabel di database

    protected $fillable = ['nama', 'email', 'username', 'password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthIdentifierName()
{
    return 'username';
}

}
