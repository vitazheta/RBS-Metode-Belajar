@extends('layouts.app')

@section('content')
{{-- Ini adalah blok <style> KHUSUS untuk halaman dashboard-dosen.blade.php --}}
<style>
    /*
    PENTING:
    - Semua CSS GLOBAL (seperti untuk html, body, dan semua aturan body.dark-theme)
      serta CSS untuk NAVBAR dan FOOTER harus berada di app.blade.php.
    - DI SINI HANYA ADA CSS YANG SPESIFIK UNTUK ELEMEN-ELEMEN DI HALAMAN DASHBOARD-DOSEN INI.
    */

    /* Gaya Umum Elemen di Halaman Ini (Light Mode Default) */
    /* Hapus bagian yang duplikat dengan app.blade.php dari sini */

    /* Gaya tombol khusus halaman ini */
    .btn-custom{
        background-color: #F37AB0;
        color: #ffffff;
        border: 2px solid #F37AB0;
        transition: all 0.3s ease;
        font-size: 20px;
    }
    .btn-custom:hover {
        background-color: #E2A6C1;
        color: #FFFFFF;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .dashboard-title {
        /* font-size: 40px; */
        font-weight: bold;
        color: #0E1F4D; /* Default light mode color */
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
        color: #6c757d; /* Default light mode color */
        font-size: 20px;
        margin-bottom: 0;
    }

    .card-tambah {
        background-color: #FFFFFF; /* Default light mode color */
        border-radius: 5px;
    }
    .upper-card-body {
        color: #0E1F4D; /* Default light mode color */
        padding: 20px;
    }
    .upper-card-body p {
        color: #0E1F4D; /* Default light mode color */
    }
    .mb-3 {
        color: #0E1F4D; /* Default light mode color for mb-3 text */
    }
    .row {
        margin-bottom: 20px;
    }
    .card-diagram {
        padding: 10px;
        padding-top: 20px;
        background-color: #ffffff; /* Default light mode color */
    }
    .fixed-size-card {
        width: 350px;
        height: 170px;
        display: flex;
        align-items: left;
        justify-content: left;
        text-align: left;
        background-color: #84A7CF; /* Default light mode color (dipindahkan dari inline style) */
        border: none; /* Dipindahkan dari inline style */
    }
    .siluet { /* Jika siluet ada di card ini, pastikan warnanya kontras */
        right: 10px;
        bottom: 10px;
        font-size: 80px;
        opacity: 0.2;
        transform: rotate(-15deg);
    }

    /* Garis pemisah */
    .divider-line {
        width: 2px;
        background-color: #D4D4D4; /* Default light mode color (dipindahkan dari inline style) */
        height: 100%; /* Dipindahkan dari inline style */
    }

    /* Untuk paragraf deskripsi di kolom kiri */
    .textdesc-desc-data,
    .text-desc-presentase {
        color: #6c757d; /* Default light mode color */
    }

    /* --- DARK THEME STYLES (KHUSUS UNTUK KOMPONEN DI DASHBOARD-DOSEN.BLADE.PHP) --- */
    /* Ini akan memastikan elemen-elemen di halaman ini merespons tema gelap */
    body.dark-theme .dashboard-title {
        color: #FFFFFF;
    }
    body.dark-theme .dashboard-description {
        color: #CFD3D6;
    }
    body.dark-theme .mb-3 {
        color: #FFFFFF;
    }
    body.dark-theme .card-tambah {
        background-color: #2D2D2D;
    }
    body.dark-theme .upper-card-body {
        color: #ffffff;
    }
    body.dark-theme .upper-card-body p {
        color: #ffffff;
    }
    body.dark-theme .card-diagram {
        background-color: #2D2D2D;
    }
    body.dark-theme .fixed-size-card {
        background-color: #4A4A5A;
        color: #FFFFFF;
    }
    body.dark-theme .divider-line {
        background-color: #4A4A5A;
    }
    body.dark-theme .textdesc-desc-data,
    body.dark-theme .text-desc-presentase {
        color: #CFD3D6;
    }

</style>

{{-- PENTING: Tambahkan style="padding-top: 80px;" di div.container pertama di sini --}}
<div class="container" style="padding-top: 80px;"> <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="dashboard-title">
            Dashboard Dosen
            <span></span>
        </h2>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="dashboard-description">
            Halo, <strong>{{ ucwords($dosen->nama) }}</strong>! Berikut daftar kelas yang Anda ampu.
        </p>
    </div>

    <div class="row g-6">
        <div class="card-tambah shadow-sm p-4 mb-5 position-relative">
            <div class="upper-card-body">
                <div>
                    <h5 class="fw-bold mt-1 mb-2">Olah Data Mahasiswa Anda Untuk Mendapatkan Rekomendasi Pembelajaran</h5>
                    <p class="text-klik mb-3">Klik tombol di bawah ini untuk mengakses template form data mahasiswa</p>
                    <a href="https://docs.google.com/forms/d/1pT-I0OIaEgM6VIgy6kMPkOAHIIi-kejayblKL6NZbFc/edit" target="_blank"
                        class="btn btn-custom"
                        style="font-size: 0.8rem; padding: 6px 12px;">
                        <i class="fas fa-external-link-alt me-1"></i>Buat Template Formulir Disini
                    </a>
                </div>
            </div>
            <img src="{{ asset('images/img-dashboard.png') }}" alt="Icon Tambah Kelas"
                style="position: absolute; right: 50px; bottom: 20px; height: 150px;">
        </div>
    </div>
</div>

<div class="row d-flex align-items-stretch">
    <div class="col-md-4 d-flex flex-column gap-3">
        <div class="mb-3">
            <h3 class="fw-bold" style="font-size: 28px;">Data Total Kelas</h3>
            <p class="textdesc-desc-data">Berikut adalah data total kelas dan mahasiswa yang Anda ampu.</p>
        </div>
        <div class="card shadow-sm text-white position-relative fixed-size-card">
            <div class="card-body">
                <h5 class="card-title">Jumlah Kelas</h5>
                <p class="card-text display-4">{{ $jumlah_kelas }}</p>
                <i class="fas fa-school position-absolute siluet"></i>
            </div>
        </div>
        <div class="card shadow-sm text-white position-relative fixed-size-card">
            <div class="card-body">
                <h5 class="card-title">Total Mahasiswa</h5>
                <p class="card-text display-4">{{ $total_mahasiswa }}</p>
                <i class="fas fa-user-graduate position-absolute siluet"></i>
            </div>
        </div>
        <div class="card shadow-sm text-white position-relative fixed-size-card">
            <div class="card-body">
                <h5 class="card-title">Jalur Masuk Dominan</h5>
                <p class="card-text display-4">{{ $jalur_masuk_dominan ?? 'Tidak Ada' }}</p>
                <i class="fas fa-chart-pie position-absolute siluet"></i>
            </div>
        </div>
    </div>

    <div class="col-md-1 d-flex justify-content-center">
        <div class="divider-line"></div>
    </div>

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
    // Definisikan array global untuk menyimpan semua instance chart
    window.myChartInstances = window.myChartInstances || [];

    // Fungsi untuk mendapatkan warna berdasarkan tema
    function getChartColors(isDarkMode) {
        return {
            labelColor: isDarkMode ? '#EEEEEE' : '#333333', // Warna teks label/legend
            gridColor: isDarkMode ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)', // Warna grid (jika ada)
            tooltipBgColor: isDarkMode ? 'rgba(0,0,0,0.7)' : 'rgba(255,255,255,0.7)',
            tooltipBorderColor: isDarkMode ? '#666666' : '#DDDDDD',
            tooltipLabelColor: isDarkMode ? '#EEEEEE' : '#333333',
            segmentColors: [ // Warna potongan pie untuk light mode
                "#1E2E45",
                "#748DAC",
                "#E0E1DC",
                "#F37AB0"
            ],
            darkSegmentColors: [ // Warna potongan pie untuk dark mode (disesuaikan jika perlu)
                "#2D3B5C",
                "#5A6E8C",
                "#A0A39C",
                "#E86BB0"
            ],
            chartBgColor: isDarkMode ? '#2D2D2D' : '#FFFFFF' // Warna latar belakang kanvas chart
        };
    }

    // Fungsi untuk memperbarui semua chart yang ada
    window.updateAllChartsBasedOnTheme = function() {
        const isDarkMode = document.body.classList.contains('dark-theme');
        const colors = getChartColors(isDarkMode);

        window.myChartInstances.forEach(chart => {
            // Update options Chart.js
            chart.options.plugins.legend.labels.color = colors.labelColor;
            chart.options.plugins.tooltip.backgroundColor = colors.tooltipBgColor;
            chart.options.plugins.tooltip.borderColor = colors.tooltipBorderColor;
            chart.options.plugins.tooltip.titleColor = colors.tooltipLabelColor;
            chart.options.plugins.tooltip.bodyColor = colors.tooltipLabelColor;
            chart.options.backgroundColor = colors.chartBgColor; // Update latar belakang kanvas

            // Update warna segmen
            chart.data.datasets[0].backgroundColor = isDarkMode ? colors.darkSegmentColors : colors.segmentColors;

            chart.update(); // Memicu Chart.js untuk menggambar ulang
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        @foreach ($kelas as $index => $k)
        var ctx = document.getElementById("chart-{{ $index }}");

        if (ctx) {
            // Deteksi tema awal saat DOMContentLoaded
            const isDarkModeInitial = document.body.classList.contains('dark-theme');
            const colorsInitial = getChartColors(isDarkModeInitial);

            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Akademik dan Endurance", "Latar Belakang", "Pola Belajar", "Perkuliahan"],
                    datasets: [{
                        data: [
                            {{ $k->persen_akademik ?? 0 }},
                            {{ $k->persen_latar_belakang ?? 0 }},
                            {{ $k->persen_pola_belajar ?? 0 }},
                            {{ $k->persen_perkuliahan ?? 0 }}
                        ],
                        backgroundColor: isDarkModeInitial ? colorsInitial.darkSegmentColors : colorsInitial.segmentColors, // Pilih warna awal berdasarkan tema
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    backgroundColor: colorsInitial.chartBgColor, // Latar belakang kanvas chart awal
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: colorsInitial.labelColor
                            }
                        },
                        tooltip: {
                            backgroundColor: colorsInitial.tooltipBgColor,
                            borderColor: colorsInitial.tooltipBorderColor,
                            borderWidth: 1,
                            titleColor: colorsInitial.tooltipLabelColor,
                            bodyColor: colorsInitial.tooltipLabelColor,
                            callbacks: {
                                label: function(tooltipItem) {
                                    let value = tooltipItem.raw;
                                    return tooltipItem.label + ": " + value + "%";
                                }
                            }
                        }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
            window.myChartInstances.push(chart); // Simpan instance chart ke array global
        }
        @endforeach
    });
</script>
@endsection
