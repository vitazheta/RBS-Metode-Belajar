<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Dosen extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Guard untuk autentikasi dosen
    protected $guard = 'dosen';

    // Nama tabel yang digunakan
    protected $table = 'dosen';

    // Field yang bisa diisi
    protected $fillable = [
        'nama',
        'email',
        'username',
        'password',
    ];

    // Field yang disembunyikan
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi: Dosen punya banyak kelas
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    // Relasi opsional: Dosen punya banyak metode belajar
    public function metodeBelajar()
    {
        return $this->hasMany(MetodeBelajar::class);
    }
}
