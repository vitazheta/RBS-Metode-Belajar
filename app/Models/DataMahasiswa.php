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
        'kesiapan_akademik',
        'kesiapan_ekonomi',
        'endurance_cita_cita',
        'profil_sekolah',
        'profil_ortu',
        'pola_belajar',
        'kemampuan_adaptasi',
    ];



    public function kelas()
    {
      return $this->belongsTo(Kelas::class);
    }
}
