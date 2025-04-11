@extends('layouts.app')

@section('title', 'Hasil Rekomendasi Gaya Belajar')

@section('content')
<div class="container" style="padding-top: 70px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block" style="color: #0E1F4D;">
        Hasil Rekomendasi Gaya Belajar Mahasiswa
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #ffffff;"></span>
    </h2>


    {{-- Informasi Kelas --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">📘 Informasi Kelas</h5>
            <p><strong>Nama Kelas:</strong>
            <span class="badge bg-success fs-6">{{ $kelas->nama_kelas }}</span>
            </p>

            <p><strong>Kode Mata Kuliah:</strong>
                <span class="badge bg-warning text-dark fs-6">{{ $kelas->kode_mata_kuliah }}</span>
            </p>
            <p><strong>Dosen Pengampu:</strong>
                <span class="text-muted">{{ auth()->user()->nama }}</span>
            </p>
        </div>
    </div>


    {{-- Tambahkan canvas di atas tabel --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Distribusi Gaya Belajar Mahasiswa</h5>
    </div>
    <div class="card-body text-center">
        <canvas id="profilChart" width="300" height="300"></canvas>
    </div>
</div>


    {{-- Tabel Hasil Rekomendasi --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jalur Masuk</th>
                    <th>Akademik</th>
                    <th>Ekonomi</th>
                    <th>Endurance</th>
                    <th>Sekolah</th>
                    <th>Ortu</th>
                    <th>Pola</th>
                    <th>Adaptasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelas->mahasiswa as $index => $mhs)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $mhs->nama_lengkap }}</td>
                        <td>{{ $mhs->email }}</td>
                        <td class="text-center">{{ $mhs->jalur_masuk }}</td>
                        <td class="text-center">{{ $mhs->kesiapan_akademik }}</td>
                        <td class="text-center">{{ $mhs->kesiapan_ekonomi }}</td>
                        <td class="text-center">{{ $mhs->endurance_cita_cita }}</td>
                        <td class="text-center">{{ $mhs->profil_sekolah }}</td>
                        <td class="text-center">{{ $mhs->profil_ortu }}</td>
                        <td class="text-center">{{ $mhs->pola_belajar }}</td>
                        <td class="text-center">{{ $mhs->kemampuan_adaptasi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">Belum ada data hasil rekomendasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tombol Aksi --}}

</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('profilChart');

        if (ctx) {
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Visual', 'Auditori', 'Kinestetik'],
                    datasets: [{
                        // GANTI INI DENGAN DATA DUMMY
                        data: [10, 5, 7],
                        backgroundColor: ['#1E2E45', '#748DAC', '#E0E1DC'],
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.label + ": " + context.raw + " mahasiswa";
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>



@endpush

@endsection
