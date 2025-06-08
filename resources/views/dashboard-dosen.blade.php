@extends('layouts.app')

@section('content')

<style>
    html, body {
        height: 100%; /* Pastikan tinggi halaman mencakup seluruh layar */
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    body {
        font-family: 'Poppins', sans-serif;
        padding-top: 80px; /* Sesuaikan dengan tinggi navbar */
        background-color: #EBEDF4;
    }

    .container {
        flex: 1; /* Membuat konten utama fleksibel untuk mengisi ruang */
        font-family: Poppins, sans-serif;
    }

    footer {
        background-color: #0E1F4D; /* Warna latar belakang footer */
        color: #ffffff; /* Warna teks footer */
        text-align: left;
        padding: 20px 0;
        margin-top: auto; /* Dorong footer ke bawah */
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
        transition: all 0.3s ease; /* Animasi transisi */
        font-size: 20px;
        border: none;
    }

    .btn-outline-primary:hover {
        background-color: #70788F; /* Warna latar belakang saat hover */
        color: #FFFFFF; /* Warna teks saat hover */
        border: none;
    }

    .btn-custom{
        background-color: #F37AB0; /* Warna saat hover */
        color: #ffffff; /* Warna teks saat hover */
        border: 2px solid #F37AB0; /* Warna border default */
        transition: all 0.3s ease; /* Animasi transisi */
        font-size: 20px;
    }

    .btn-custom:hover {
        background-color: #E2A6C1; /* Warna saat hover */
        color: #FFFFFF; /* Warna teks saat hover */
        transition: background-color 0.3s ease, color 0.3s ease; /* Animasi transisi */
    }

    .dashboard-title {
        font-size: 40px;
        font-weight: bold;
        color: #0E1F4D;
        position: relative;
    }

    .dashboard-title span {
        display: block;
        margin-top: 4px;
        height: 4px;
        width: 100%;
        background-color: #84A7CF;
    }

    .dashboard-description {
        color: #6c757d; /* Warna teks */
        font-size: 20px; /* Ukuran font */
        margin-bottom: 0; /* Margin bawah */
    }

    .card-tambah {
        background-color: #FFFFFF;
        border-radius: 5px;;/* Warna latar belakang */
    }

    .upper-card-body {
        color: #0E1F4D;
        padding: 20px;
    }

    .mb-3 {
        color: #0E1F4D;
    }

    .row {
        margin-bottom: 20px; /* Jarak antar baris */
}
    .card-diagram {
        padding: 10px;
        padding-top: 20px;
        background-color: #ffffff; /* Warna latar belakang */
    }

    .fixed-size-card {
        width: 350px; /* Lebar tetap */
        height: 170px; /* Tinggi tetap */
        display: flex;
        align-items: left;
        justify-content: left;
        text-align: left;
    }

    /* Dark Theme */
    body.dark-theme {
        background-color: #1B1B1B;
    }

    body.dark-theme footer {
        background-color: #162449; /* Warna latar belakang footer */
    }

    body.dark-theme .btn-outline-primary {
        background-color: #162449; /* Warna latar belakang default */
        color: #ffffff /* Warna teks default */
    }

    body.dark-theme .btn-outline-primary:hover {
        background-color: #777F95; /* Warna latar belakang saat hover */
        color: #ffffff; /* Warna teks saat hover */
        border: none;
    }

    body.dark-theme .btn-custom {
        background-color: #F481B4;
    }

    body.dark-theme .dashboard-title {
        color: #FFFFFF;
    }

    body.dark-theme .dashboard-description {
        color: #CFD3D6; /* Warna teks */
    }

    body.dark-theme .mb-3 {
        color: #FFFFFF;
    }

    body.dark-theme .card-tambah {
        background-color: #2D2D2D; /* Warna latar belakang */
    }

    body.dark-theme .upper-card-body {
        color: #ffffff;
        padding: 20px;
    }

    body.dark-theme .upper-card-body p {
        color: #ffffff;
    }

    body.dark-theme .card-diagram {
        background-color: #2D2D2D; /* Warna latar belakang */
    }
</style>

<div class="container py-0"> <!-- Ubah dari py-5 ke py-3 -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="dashboard-title">
            Dashboard Dosen
            <span></span>
        </h2>
    </div>

    <!-- Flexbox untuk teks dan tombol -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="dashboard-description">
            Halo, <strong>{{ ucwords($dosen->nama) }}</strong>! Berikut daftar kelas yang Anda ampu.
        </p>
    </div>

    <!-- Section Tambah Kelas -->
    <div class="row g-6">
    <div class="card-tambah shadow-sm p-4 mb-5 position-relative">
        <div class="upper-card-body">
            <div>
                <h5 class="fw-bold mt-1 mb-2">Olah Data Mahasiswa Anda Untuk Mendapatkan Rekomendasi Pembelajaran</h5>
                <p class="text-klik mb-3">Klik tombol di bawah ini untuk mengakses template form data mahasiswa</p>
            <!-- Tombol Google Form -->
            <a href="https://docs.google.com/forms/d" target="_blank"
                class="btn btn-custom"
                style="font-size: 0.8rem; padding: 6px 12px;">
                <i class="fas fa-external-link-alt me-1"></i>Buat Template Formulir Disini
            </a>

            </div>
        </div>

        <!-- Gambar kecil kanan dalam -->
        <img src="{{ asset('images/img-dashboard.png') }}" alt="Icon Tambah Kelas"
            style="position: absolute; right: 50px; bottom: 20px; height: 150px;">
    </div>
</div>
</div>

<div class="row d-flex align-items-stretch">
    <!-- Kolom Kiri: Kotak Jumlah Kelas -->
    <div class="col-md-4 d-flex flex-column gap-3">
        <div class="mb-3">
            <h3 class="fw-bold" style="font-size: 28px;">Data Total Kelas</h3>
            <p class="textdesc-desc-data">Berikut adalah data total kelas dan mahasiswa yang Anda ampu.</p>
        </div>
        <div class="card shadow-sm text-white position-relative fixed-size-card" style="background-color: #84A7CF; border: none;">
            <div class="card-body">
                <h5 class="card-title">Jumlah Kelas</h5>
                <p class="card-text display-4">{{ $jumlah_kelas }}</p>
                <i class="fas fa-school position-absolute siluet"></i>
            </div>
        </div>
        <div class="card shadow-sm text-white position-relative fixed-size-card" style="background-color: #84A7CF; border: none;">
            <div class="card-body">
                <h5 class="card-title">Total Mahasiswa</h5>
                <p class="card-text display-4">{{ $total_mahasiswa }}</p>
                <i class="fas fa-user-graduate position-absolute siluet"></i>
            </div>
        </div>
        <div class="card shadow-sm text-white position-relative fixed-size-card" style="background-color: #84A7CF; border: none;">
            <div class="card-body">
                <h5 class="card-title">Jalur Masuk Dominan</h5>
                <p class="card-text display-4">{{ $jalur_masuk_dominan ?? 'Tidak Ada' }}</p>
                <i class="fas fa-chart-pie position-absolute siluet"></i>
            </div>
        </div>
    </div>

    <!-- Garis Pemisah -->
    <div class="col-md-1 d-flex justify-content-center">
        <div style="width: 2px; background-color: #D4D4D4; height: 100%;"></div>
    </div>

    <!-- Kolom Kanan: Kotak Diagram -->
    <div class="col-md-7 d-flex flex-column gap-3">
        <div class="mb-3">
            <h3 class="fw-bold" style="font-size: 28px;">Persentase Aspek Penunjang Rekomendasi</h3>
            <p class="text-desc-presentase">Diagram berikut menunjukkan persentase aspek penunjang rekomendasi untuk setiap kelas.</p>
        </div>
        <div class="row">
            @foreach ($kelas as $index => $k)
            <div class="col-md-6 mb-4">
                <div class="card-diagram shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $k->nama_kelas }}</h5>
                        <canvas id="chart-{{ $index }}" width="200" height="200"></canvas>
                        <p class="mt-2">Kode Mata Kuliah: {{ $k->kode_mata_kuliah }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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
                        borderWidth: 0, // Hilangkan border
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
