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
        'akademik_total',
        'sekolah_total',
        'ekonomi_total',
        'perkuliahan_total',
    ];

    public function kelas()
    {
      return $this->belongsTo(Kelas::class);
    }
}
