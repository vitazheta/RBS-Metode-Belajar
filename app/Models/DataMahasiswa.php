<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'data_mahasiswa'; // Nama tabel di database

    protected $fillable = [
        'kelas_id',
        'nama_lengkap',
        'asal_sekolah',
        'jalur_masuk',
        'akademik_endurance',
        'latar_belakang',
        'pola_belajar',
        'perkuliahan',
    ];

    public function kelas()
    {
      return $this->belongsTo(Kelas::class);
    }
}
