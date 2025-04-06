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
        'email',
        'jalur_masuk',
        'profil_sekolah',
        'kesiapan_akademik',
        'kesiapan_ekonomi',
        'dukungan_ortu',
        'endurance_cita-cita',
    ];
    public function kelas()
    {
      return $this->belongsTo(Kelas::class);
    }
}
