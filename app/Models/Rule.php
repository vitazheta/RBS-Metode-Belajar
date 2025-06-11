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
        'jalur_masuk',
        'akademik',
        'sekolah',
        'ekonomi',
        'perkuliahan',
        'rekomendasi'
    ];
}
