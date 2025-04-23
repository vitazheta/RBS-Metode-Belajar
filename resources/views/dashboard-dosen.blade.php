@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        padding-top: 80px; /* Sesuaikan dengan tinggi navbar */
        background-color: #EBEDF4;
    }
    .siluet {
        right: 10px;
        bottom: 10px;
        font-size: 80px;
        opacity: 0.2;
        transform: rotate(-15deg); /* Membuat ikon miring */
    }
 
    .btn-outline-primary {
        background-color: #0E1F4D; /* Warna latar belakang default */
        color: white; /* Warna teks default */
        border: 1px solid #0E1F4D; /* Warna border default */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-outline-primary:hover {
        background-color: white; /* Warna latar belakang saat hover */
        color: #0E1F4D; /* Warna teks saat hover */
        border-color: #0E1F4D; /* Warna border saat hover */
    }

    .btn-outline-primary:focus {
        outline: none; /* Hilangkan outline default */
        box-shadow: none; /* Hilangkan efek shadow */
    }

    .btn-custom{
        background-color: #F37AB0; /* Warna saat hover */
        color: #ffffff; /* Warna teks saat hover */
        border: 1px solid #F37AB0; /* Warna border default */
        transition: all 0.3s ease; /* Animasi transisi */
    }

    .btn-custom:hover {
        background-color: white; /* Warna saat hover */
        color: #F37AB0; /* Warna teks saat hover */
        border-color: #F37AB0; /* Warna border saat hover */
        transition: background-color 0.3s ease, color 0.3s ease; /* Animasi transisi */
    }
             

</style>

<div class="container py-0"> <!-- Ubah dari py-5 ke py-3 -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold position-relative d-inline-block" style="color: #0E1F4D;">
            Dashboard Dosen
            <span class="d-block mt-1" style="height: 4px; width: 100%; background-color: #84A7CF;"></span>
        </h2>
    </div>

    <!-- Flexbox untuk teks dan tombol -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted fs-5 mb-0">Halo, <strong>{{ ucwords($dosen->nama) }}</strong>! Berikut daftar kelas yang Anda ampu.</p>
        <!-- Tombol Google Form -->
        <a href="https://docs.google.com/forms/d/1jyMeVSMu5pf2gimqhcDrlytd96g7kdgesi_dwY9QCR4/edit" target="_blank" 
            class="btn btn-outline-primary" 
            style="font-size: 0.8rem; padding: 6px 12px;">
            <i class="fas fa-external-link-alt me-1"></i>Buat Template Formulir Disini
        </a>
    </div>

    <!-- Section Tambah Kelas -->
    <div class="row g-6">
    <div class="card shadow-sm p-4 mb-5 position-relative" style="border: none; background-color: #ffffff;">
        <div class="card-body">
            <div>
                <h5 class="fw-bold mb-2">Olah Data Mahasiswa Anda Untuk Mendapatkan Rekomendasi Pembelajaran</h5>
                <p class="text-muted mb-3">Klik tombol di bawah ini untuk mengolah data mahasiswa</p>
                <!-- Tombol Tambah Kelas -->
                <a href="{{ url('/upload-excel') }}" 
                    class="btn btn-custom" 
                    style="font-size: 0.8rem; padding: 6px 12px;">
                    <i class="fas fa-plus me-2"></i> Upload Data Formulir
                </a>

            </div>
        </div>

        <!-- Gambar kecil kanan dalam -->
        <img src="{{ asset('images/img-dashboard.png') }}" alt="Icon Tambah Kelas"
            style="position: absolute; right: 50px; bottom: 20px; height: 150px;">
    </div>
</div>
</div>

        <!-- Kotak Jumlah Kelas -->
    <div class="row g-6">
        <div class="col-md-4">
            <div class="card shadow-sm text-white mb-3 position-relative"
            style="background-color: #84A7CF; border: none;">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Kelas</h5>
                    <p class="card-text display-4">{{ $jumlah_kelas }}</p>
                    <i class="fas fa-school position-absolute siluet"></i>
                </div>
            </div>
        </div>

        <!-- Kotak Total Mahasiswa -->
        <div class="col-md-4">
            <div class="card shadow-sm text-white mb-3 position-relative"
            style="background-color: #84A7CF; border: none;">
                <div class="card-body">
                    <h5 class="card-title">Total Mahasiswa</h5>
                    <p class="card-text display-4">{{ $total_mahasiswa }}</p>
                    <i class="fas fa-user-graduate position-absolute siluet"></i>
                </div>
            </div>
        </div>

    <!-- Kotak Jalur Masuk Dominan -->
    <div class="col-md-4">
        <div class="card shadow-sm text-white mb-3 position-relative"
        style="background-color: #84A7CF; border: none;">
            <div class="card-body">
                <h5 class="card-title">Jalur Masuk Dominan</h5>
                <p class="card-text display-4">{{ $jalur_masuk_dominan ?? 'Tidak Ada' }}</p>
                <i class="fas fa-chart-pie position-absolute siluet"></i>
            </div>
        </div>
    </div>
    </div>

    <!-- Daftar Kelas -->
    <div class="row g-6">
        @foreach ($kelas as $index => $k)
        <div class="col-md-4">
            <div class="card shadow-sm mb-4" style="border: none; background-color: #ffffff;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $k->nama_kelas }}</h5>
                    <canvas id="chart-{{ $index }}" width="200" height="200"></canvas>
                    <p class="mt-2">Persentase Aspek Penunjang Rekomendasi</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach ($kelas as $index => $k)
        var ctx = document.getElementById("chart-{{ $index }}");

        if (ctx) {
            var chart = new Chart(ctx, {
                type: 'pie', // Ganti dari 'doughnut' ke 'pie'
                data: {
                    labels: ["Akademik dan Endurance", "Latar Belakang", "Pola Belajar", "Perkuliahan"],
                    datasets: [{
                        data: [
                            {{ $k->persen_akademik ?? 0 }},
                            {{ $k->persen_latar_belakang ?? 0 }},
                            {{ $k->persen_pola_belajar ?? 0 }},
                            {{ $k->persen_perkuliahan ?? 0 }}
                        ],
                        backgroundColor: [
                            "#1E2E45", // Biru tua untuk Akademik dan Endurance
                            "#748DAC", // Biru muda untuk Latar Belakang
                            "#E0E1DC", // Cream untuk Pola Belajar
                            "#F37AB0"  // Merah muda untuk Perkuliahan
                        ],
                        hoverOffset: 10 // Efek animasi saat hover
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }, // Tampilkan legenda
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let value = tooltipItem.raw;
                                    return value + "%"; // Menampilkan persen di tooltip
                                }
                            }
                        }
                    },
                    animation: {
                        animateRotate: true, // Animasi rotasi saat muncul
                        animateScale: true  // Animasi pembesaran saat muncul
                    }
                }
            });

            chart.update(); // Update chart setelah konfigurasi
        }
        @endforeach
    });
</script>
@endsection
