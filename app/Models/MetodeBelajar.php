<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodeBelajar extends Model
{
    use HasFactory;

    protected $table = 'Metode_Belajar'; // Nama tabel di database

    protected $fillable = [
        'kelas_id',
        'metode_ajar',
        'deskripsi',
    ];
}
