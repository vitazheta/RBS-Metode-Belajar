{{-- resources/views/kelas/daftar_kelas.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')

<div class="container mt-4" style="color: #0E1F4D; padding-top: 70px;">
<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold position-relative d-inline-block" style="color: #0E1F4D;">Daftar Kelas</h2>
    </div>

    <div class="row">
        @foreach ($daftarKelas as $kelas)
            <div class="col-12 mb-3">
                <div class="card" style="width: 100%; max-width: 100%; margin: 0 auto;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Icon di samping Nama Kelas -->
                            <h5 class="card-title">
                                <i class="fas fa-chalkboard-teacher me-2"></i> <!-- Ganti dengan icon yang sesuai -->
                                Kelas: {{ $kelas->nama_kelas }}
                            </h5>
                            <p class="card-text">Kode Mata Kuliah: {{ $kelas->kode_mata_kuliah }}</p>
                        </div>
                        <a href="{{ route('hasil.rekomendasi', $kelas->id) }}" class="btn btn-sm btn-primary">Detail Kelas</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

