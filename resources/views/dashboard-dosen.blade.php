@extends('layouts.app')

@section('content')

<style>
    /*
    PENTING:
    - Semua CSS GLOBAL (seperti untuk html, body, dan semua aturan body.dark-theme)
      serta CSS untuk NAVBAR dan FOOTER harus berada di app.blade.php.
    - DI SINI HANYA ADA CSS YANG SPESIFIK UNTUK ELEMEN-ELEMEN DI HALAMAN DASHBOARD-DOSEN INI.
    */

    /* Gaya Umum Elemen di Halaman Ini (Light Mode Default) */
    /* Pastikan tidak ada duplikasi CSS global dari app.blade.php di sini */

    /* Gaya tombol khusus halaman ini */
    .btn-custom{
        background-color: #F37AB0;
        color: #ffffff;
        border: 2px solid #F37AB0;
        transition: all 0.3s ease;
        font-size: 0.8rem; /* Ukuran font standar yang tidak terlalu besar */
        padding: 8px 12px; /* Padding standar untuk desktop */
    }
    .btn-custom:hover {
        background-color: #E2A6C1;
        color: #FFFFFF;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .dashboard-title {
        /* font-size: 40px; */ /* Didefinisikan di app.blade.php sekarang */
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
        /* font-size: 20px; */ /* Didefinisikan di app.blade.php sekarang */
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
        flex-direction: column; /* Pastikan konten menumpuk vertikal di card */
        align-items: flex-start; /* Konten rata kiri */
        justify-content: center; /* Vertikal di tengah */
        text-align: left;
        background-color: #84A7CF; /* Default light mode color (dipindahkan dari inline style) */
        border: none; /* Dipindahkan dari inline style */
        padding: 20px; /* Tambahkan padding default */
    }
    .fixed-size-card .card-body {
        padding: 0; /* Hapus padding default card-body jika sudah diatur di parent */
        width: 100%;
    }
    .fixed-size-card h5 {
        font-size: 1.5rem; /* Ukuran default untuk desktop */
    }
    .fixed-size-card p.card-text.display-4 {
        font-size: 3rem; /* Ukuran default untuk desktop */
        margin-top: 5px; /* Sedikit jarak */
    }
    .siluet { /* Jika siluet ada di card ini, pastikan warnanya kontras */
        position: absolute;
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

    /* PERBAIKAN: Menargetkan teks di dalam fixed-size-card agar putih di light mode */
    .fixed-size-card h5, /* Menargetkan judul h5 di dalam kartu */
    .fixed-size-card p,  /* Menargetkan paragraf p di dalam kartu */
    .fixed-size-card span, /* Menargetkan span di dalam kartu (jika ada seperti untuk Jalur Masuk Dominan) */
    .fixed-size-card strong /* Menargetkan strong di dalam kartu (jika ada) */
    {
        color: #FFFFFF !important; /* Paksa warna teks menjadi putih di light mode */
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
    /* PERBAIKAN: Lebih spesifik untuk teks di dalam fixed-size-card di dark mode (pastikan tetap putih) */
    body.dark-theme .fixed-size-card h5,
    body.dark-theme .fixed-size-card p,
    body.dark-theme .fixed-size-card span,
    body.dark-theme .fixed-size-card strong {
        color: #FFFFFF !important; /* Tetap putih di dark mode */
    }

    body.dark-theme .divider-line {
        background-color: #4A4A5A;
    }
    body.dark-theme .textdesc-desc-data,
    body.dark-theme .text-desc-presentase {
        color: #CFD3D6;
    }

    /* Tambahan Dark Theme untuk tombol-tombol spesifik */
    .btn-upload-excel { background-color: #0E1F4D !important; color: #fff !important; border: none !important; }
    .btn-upload-excel:hover { background-color: #70788F !important; color: #fff !important; }
    body.dark-theme .btn-upload-excel {
        background-color: #162449 !important;
        color: #FFFFFF !important;
    }
    body.dark-theme .btn-upload-excel:hover {
        background-color: #777F95 !important;
    }
    /* Tambahan Dark Theme untuk tombol simpan/generate jika dipakai di dashboard-dosen */
    body.dark-theme #saveBtn,
    body.dark-theme #generateBtn {
        background-color: #162449 !important;
        color: #FFFFFF !important;
    }
    body.dark-theme #saveBtn:hover,
    body.dark-theme #generateBtn:hover {
        background-color: #777F95 !important;
    }
    body.dark-theme #addRowBtn {
        background-color: #F481B4 !important;
        color: #FFFFFF !important;
    }
    body.dark-theme #addRowBtn:hover {
        background-color: #E5AFC7 !important;
    }

    /* Kelas baru untuk kartu ringkasan data (jika dipakai di dashboard-dosen, meski biasanya di dynamic-table) */
    .summary-card {
        background-color: #ffffff; /* Default light mode */
        border: none;
    }
    body.dark-theme .summary-card {
        background-color: #2D2D2D; /* Latar belakang kartu ringkasan gelap */
    }
    body.dark-theme .summary-card h4 {
        color: #FFFFFF !important;
    }
    body.dark-theme .summary-card p {
        color: #CFD3D6 !important;
    }
    body.dark-theme .summary-card strong {
        color: #FFFFFF !important;
    }

    /* --- RESPONSIVE STYLES --- */

    /* Untuk perangkat yang lebih kecil (misal: smartphone) */
    @media (max-width: 767.98px) {
        .container {
            padding-top: 80px !important; /* Kurangi padding atas di mobile */
            padding-left: 15px !important; /* Tambah padding samping */
            padding-right: 15px !important; /* Tambah padding samping */
        }

        .dashboard-title {
            font-size: 24px; /* Ukuran font lebih kecil untuk judul utama */
            text-align: center; /* Rata tengah judul */
            text-align: center !important;
            margin-bottom: 15px !important;
        }
        .dashboard-title span {
            margin: 0 auto 4px; /* Rata tengah garis bawah judul */
        }
        .dashboard-description {
            font-size: 14px; /* Ukuran font lebih kecil untuk deskripsi */
            text-align: center; /* Rata tengah deskripsi */
            margin-bottom: 20px !important; /* Kurangi margin bawah */
        }

        .d-flex.justify-content-between.align-items-center.mb-4 {
            flex-direction: column; /* Tumpuk elemen di bawah satu sama lain */
            align-items: center; /* Rata tengah item */
        }

        .card-tambah {
            padding: 20px !important; /* Sesuaikan padding */
            text-align: center; /* Rata tengah teks di card */
            margin-bottom: 30px !important; /* Kurangi margin bawah card */
        }
        .card-tambah .upper-card-body {
            padding: 0; /* Hapus padding agar tidak tumpang tindih */
        }
        .card-tambah h5 {
            font-size: 1.25rem; /* Ukuran judul di card tambah */
        }
        .card-tambah p.text-klik {
            font-size: 0.9rem; /* Ukuran font untuk deskripsi tombol */
        }
        .card-tambah .btn-custom {
            font-size: 0.75rem !important; /* Lebih kecil lagi untuk tombol */
            padding: 6px 10px !important; /* Sesuaikan padding tombol */
        }
        .card-tambah img {
            position: static !important; /* Hapus posisi absolut */
            margin-top: 20px; /* Beri jarak dari teks di atasnya */
            height: 80px !important; /* Kecilkan ukuran gambar drastis */
            display: block; /* Pastikan gambar berada di baris baru */
            margin-left: auto; /* Rata tengah gambar */
            margin-right: auto; /* Rata tengah gambar */
        }

        .col-md-4 { /* Kolom kiri untuk total data */
            margin-bottom: 20px; /* Jarak antara kolom kiri dan kanan di mobile */
        }

        /* Penyesuaian khusus untuk fixed-size-card di mobile */
        .fixed-size-card {
            width: 100% !important; /* Lebar penuh di perangkat kecil */
            height: 120px !important; /* Tinggi lebih ringkas di mobile */
            padding: 15px !important; /* Kurangi padding di dalam card */
            flex-direction: row; /* Kembali ke row untuk ikon dan teks */
            align-items: center; /* Rata tengah vertikal */
            justify-content: space-between; /* Jarak antar item */
            text-align: left !important;
        }
        .fixed-size-card .card-body {
            padding: 0 !important;
            flex-grow: 1; /* Biarkan card-body mengambil ruang yang tersedia */
        }
        .fixed-size-card h5 {
            font-size: 1.1rem !important; /* Lebih kecil untuk judul card */
            margin-bottom: 0; /* Hapus margin bawah */
        }
        .fixed-size-card p.card-text.display-4 {
            font-size: 2rem !important; /* Lebih kecil untuk angka */
            line-height: 1.2; /* Kerapatan baris */
            margin-top: 0;
        }
        .fixed-size-card .siluet {
            position: static !important; /* Ubah dari absolut ke statis */
            font-size: 40px !important; /* Kecilkan ukuran siluet */
            opacity: 0.3; /* Sedikit lebih terlihat */
            transform: none !important; /* Hapus rotasi */
            margin-left: 10px; /* Jarak dari teks */
        }

        .divider-line {
            display: none; /* Sembunyikan garis pemisah di perangkat kecil */
        }

        /* Sesuaikan margin untuk judul dan deskripsi di kolom kiri */
        .col-md-4 .mb-3, .col-md-7 .mb-3 {
            text-align: center;
            margin-bottom: 15px !important;
        }
        .col-md-4 .mb-3 h3, .col-md-7 .mb-3 h3 {
            font-size: 22px !important; /* Ukuran judul sub-bagian */
        }

        .textdesc-desc-data,
        .text-desc-presentase {
            font-size: 0.9rem;
            text-align: center;
        }

        .card-diagram {
            padding: 15px !important; /* Sesuaikan padding diagram */
        }
        /* Tambahan untuk chart container */
        .chart-container {
            height: 180px !important; /* Sesuaikan tinggi container chart di mobile */
            width: 100% !important;
            margin-bottom: 10px; /* Jarak antar chart dan teks di bawahnya */
        }
        .card-diagram .card-title {
            font-size: 1.1rem; /* Ukuran judul kelas di diagram */
        }
        .card-diagram p {
            font-size: 0.85rem; /* Ukuran teks kode mata kuliah */
        }
    }

    /* Untuk tablet dan layar yang sedikit lebih besar (misal: landscape tablet) */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .container {
            padding-top: 90px !important;
        }
        .dashboard-title {
            font-size: 32px;
        }
        .dashboard-description {
            font-size: 18px;
        }
        .card-tambah img {
            right: 20px; /* Sesuaikan posisi gambar */
            height: 120px; /* Sesuaikan ukuran gambar */
        }
        .fixed-size-card {
            width: 100% !important; /* Lebar penuh di tablet */
            height: 150px; /* Sesuaikan tinggi */
        }
        .fixed-size-card .siluet {
            font-size: 70px; /* Sesuaikan ukuran siluet */
        }
        .fixed-size-card h5 {
            font-size: 1.3rem;
        }
        .fixed-size-card p.card-text.display-4 {
            font-size: 2.5rem;
        }

        .col-md-4 {
            margin-bottom: 20px; /* Beri jarak antar kolom */
        }
        .divider-line {
            height: 100%; /* Pastikan garis tetap penuh */
        }
        .chart-container {
            height: 250px !important; /* Sesuaikan tinggi container chart di tablet */
        }
    }

    /* Untuk desktop atau layar besar */
    @media (min-width: 992px) {
        .card-tambah img {
            right: 50px; /* Posisi default */
            height: 150px; /* Ukuran default */
        }
        .chart-container {
            height: 200px; /* Tinggi default untuk desktop */
        }
    }

</style>

{{-- PERBAIKAN: Bungkus SELURUH konten halaman ini dengan SATU div.container --}}
<div class="container" style="padding-top: 100px;">

    <h2 class="mb-2 fw-bold position-relative d-inline-block no-print">
        Dashboard Dosen
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>

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
                        class="btn btn-custom">
                        <i class="fas fa-external-link-alt me-1"></i>Buat Template Formulir Disini
                    </a>
                </div>
            </div>
            <img src="{{ asset('images/img-dashboard.png') }}" alt="Icon Tambah Kelas"
                class="img-fluid" style="position: absolute; right: 50px; bottom: 20px; height: 150px;">
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
                </div>
                <i class="fas fa-school position-absolute siluet"></i>
            </div>
            <div class="card shadow-sm text-white position-relative fixed-size-card">
                <div class="card-body">
                    <h5 class="card-title">Total Mahasiswa</h5>
                    <p class="card-text display-4">{{ $total_mahasiswa }}</p>
                </div>
                <i class="fas fa-user-graduate position-absolute siluet"></i>
            </div>
            <div class="card shadow-sm text-white position-relative fixed-size-card">
                <div class="card-body">
                    <h5 class="card-title">Jalur Masuk Dominan</h5>
                    <p class="card-text display-4">{{ $jalur_masuk_dominan ?? 'Tidak Ada' }}</p>
                </div>
                <i class="fas fa-chart-pie position-absolute siluet"></i>
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
                            <div class="chart-container" style="position: relative; height:200px; width:100%;">
                                <canvas id="chart-{{ $index }}"></canvas>
                            </div>
                            <p class="mt-2">Kode Mata Kuliah: {{ $k->kode_mata_kuliah }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
{{-- PENTING: Pastikan Chart.js di-load. Jika sudah di app.blade.php, ini bisa dihapus --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            // chartBgColor: isDarkMode ? '#2D2D2D' : '#FFFFFF' // Ini bukan properti Chart.js untuk background canvas
        };
    }

    // Fungsi untuk memperbarui semua chart yang ada berdasarkan tema
    window.updateAllChartsBasedOnTheme = function() {
        const isDarkMode = document.body.classList.contains('dark-theme');
        const colors = getChartColors(isDarkMode);

        window.myChartInstances.forEach(chart => {
            if (chart) { // Pastikan chart instance ada
                // Update options Chart.js
                chart.options.plugins.legend.labels.color = colors.labelColor;
                chart.options.plugins.tooltip.backgroundColor = colors.tooltipBgColor;
                chart.options.plugins.tooltip.borderColor = colors.tooltipBorderColor;
                chart.options.plugins.tooltip.titleColor = colors.tooltipLabelColor;
                chart.options.plugins.tooltip.bodyColor = colors.tooltipLabelColor;

                // Update warna segmen
                chart.data.datasets[0].backgroundColor = isDarkMode ? colors.darkSegmentColors : colors.segmentColors;

                chart.update(); // Memicu Chart.js untuk menggambar ulang
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Pengecekan awal untuk memastikan Chart.js sudah tersedia
        if (typeof Chart === 'undefined') {
            console.error('Error: Chart.js library is not loaded. Please ensure it\'s included before this script.');
            document.querySelectorAll('[id^="chart-"]').forEach(canvas => {
                const parent = canvas.parentElement;
                if (parent) {
                    parent.innerHTML = '<p style="color: red; text-align: center;">Gagal memuat diagram. Pastikan Chart.js sudah di-load.</p>';
                }
            });
            return; // Hentikan eksekusi skrip jika Chart.js belum ada
        }

        @foreach ($kelas as $index => $k)
        var ctx = document.getElementById("chart-{{ $index }}");

        if (ctx) {
            // Deteksi tema awal saat DOMContentLoaded
            const isDarkModeInitial = document.body.classList.contains('dark-theme');
            const colorsInitial = getChartColors(isDarkModeInitial);

            // Pastikan data persentase adalah angka dan tidak null
            const akademik = parseFloat("{{ $k->persen_akademik ?? 0 }}");
            const latarBelakang = parseFloat("{{ $k->persen_latar_belakang ?? 0 }}");
            const polaBelajar = parseFloat("{{ $k->persen_pola_belajar ?? 0 }}");
            const perkuliahan = parseFloat("{{ $k->persen_perkuliahan ?? 0 }}");

            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Akademik", "Sekolah", "Ekonomi", "Perkuliahan"],
                    datasets: [{
                        data: [
                            akademik,
                            latarBelakang,
                            polaBelajar,
                            perkuliahan
                        ],
                        backgroundColor: isDarkModeInitial ? colorsInitial.darkSegmentColors : colorsInitial.segmentColors, // Pilih warna awal berdasarkan tema
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, /* PENTING: Ini agar chart menyesuaikan ukuran container */
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: colorsInitial.labelColor,
                                font: {
                                    size: 14 // Ukuran font legend
                                }
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
                    },
                }
            });
            window.myChartInstances.push(chart); // Simpan instance chart ke array global
        } else {
            console.warn('Canvas element with ID "chart-{{ $index }}" not found. Skipping chart initialization for this element.');
            // Ini bisa ditambahkan jika Anda ingin pesan error visual di UI
            // const errorParent = document.querySelector(`.col-md-6.mb-4:nth-child({{ $index + 1 }}) .card-diagram .card-body`);
            // if (errorParent) {
            //     errorParent.innerHTML = '<p style="color: red; text-align: center;">Diagram tidak dapat dimuat.</p>';
            // }
        }
        @endforeach

        // Listener untuk perubahan tema. Ini penting jika Anda memiliki toggle tema.
        const themeToggleButton = document.getElementById('theme-toggle-button'); // Ganti dengan ID tombol tema Anda
        if (themeToggleButton) {
            themeToggleButton.addEventListener('click', function() {
                window.updateAllChartsBasedOnTheme();
            });
        }
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class' && mutation.target === document.body) {
                    window.updateAllChartsBasedOnTheme();
                }
            });
        });
        observer.observe(document.body, { attributes: true });
    });
</script>
@endsection
