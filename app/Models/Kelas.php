<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'Kelas'; // Nama tabel di database

    protected $fillable = [
        'dosen_id',
        'nama_kelas',
        'kode_matkul',
        'kolom1',
        'kolom2',
    ];
}
