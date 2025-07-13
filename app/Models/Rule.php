<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi Laravel (misal jika namanya 'rekomendasi_rules')
    // protected $table = 'rekomendasi_rules';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'rulecode',
        'jalur_masuk',
        'akademik',
        'sekolah',
        'ekonomi',
        'perkuliahan',
        'rek_pendekatan_1',
        'rek_pendekatan_2',
        'rek_pendekatan_3',
        'rek_evaluasi_1',
        'rek_evaluasi_2',
        'rek_evaluasi_3',
    ];
}
