<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'Mahasiswa'; // Nama tabel di database

    protected $fillable = [
        'kelas_id',
        'nama_lengkap',
        'profil_sekolah',
        'kesiapan_akademik',
        'kesiapan_ekonomi',
        'dukungan_ortu',
        'endurance_cita-cita',
    ];
}
