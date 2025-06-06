
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <title>Hasil Rekomendasi Pembelajaran Kelas</title> {{-- Judul halaman diperbarui --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EBEDF4;
        }
        /* ... (CSS Anda yang lain tetap sama) ... */
        @media print {
            .container {
                padding-top: 0 !important;
                min-height: calc(100vh - 100px);
                margin-bottom: 100px;
                margin-top: 0px;
            }
        }

        #profilChart {
            max-width: 400px;
            max-height: 400px;
            margin: 0 auto;
        }
        .pdf-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 2px solid #000;
            margin-bottom: 100px;
        }
        .card-hasil-rekomendasi {
            margin-bottom: 100px;
        }
        .container {
            color: #0E1F4D;
        }
        body {
            background-color: #EBEDF4;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .container-rekomendasi {
            max-width: 100%;
            margin-bottom: 100px;
        }
        .container-rekomendasi .card-hasil-rekomendasi {
            width: 100%;
            margin: 0 auto;
            margin-top: 20px;
        }
        .bg-custom-header {
        background-color: #0E1F4D !important;
        }
        .card-body {
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .card-hasil {
            background-color: #ffffff;
            color: #000000;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table-aspek { /* Gaya ini tidak lagi digunakan untuk menampilkan rekomendasi utama/sorotan jalur, tapi tetap ada jika digunakan di tempat lain */
            margin-bottom: 20px;
        }
        .table-aspek .table-light {
            background-color: #EBEDF4;
            border-color: #6C757D;
            color: #000000;
            text-align: center;
        }
        .table-aspek .kolom-aspek {
            border-radius: 5px;
            overflow: hidden;
            border-color: #6C757D;
            color: #000000;
        }
        .text-center-table {
            background-color: #0E1F4D;
            color: #ffffff;
            text-align: center;
        }
        /* Dark Theme */
        body.dark-theme {
            background-color: #1B1B1B;
        }
        body.dark-theme .container {
            color: #ffffff;
        }
        body.dark-theme .card-first-body {
            color: #ffffff;
        }
        body.dark-theme .card-body {
            background-color: #2D2D2D;
            color: #ffffff;
            border: none;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
        }
        body.dark-theme .text-center-table {
            background-color: #162449;
            color: #ffffff;
            text-align: center;
        }
        body.dark-theme .card-hasil {
            background-color: #2D2D2D;
            color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        body.dark-theme .table-aspek {
            background-color: #2D2D2D;
            color: #ffffff;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        body.dark-theme .table-aspek .table-light {
            background-color: #1B1B1B;
            color: #ffffff;
        }
        body.dark-theme .table-aspek .kolom-aspek {
            background-color: #1B1B1B;
            color: #ffffff;
            margin-bottom: 10px;
        }
    </style>
</head>

@extends('layouts.app')

@section('title', 'Hasil Rekomendasi Pembelajaran Kelas') {{-- Judul section diperbarui --}}

@section('content')

<div class="pdf-header" style="display: none; padding: 20px; border-bottom: 2px solid #000; margin-bottom: 20px;">
    <div style="display: flex; align-items: center;">
        <img src="{{ asset('images/logocetakpdf.png') }}" alt="Logo" width="200" style="margin-right: 20px;">
        <div>
            <h2 class="mb-2 fw-bold position-relative d-inline" style="color: #0E1F4D;">Hasil Rekomendasi Pembelajaran Kelas</h2>
            <p style="margin: 0;">Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>
    </div>
</div>


<div class="container" style="padding-top: 0px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block no-print" style="padding-top: 70px;">
        Hasil Rekomendasi Pembelajaran Kelas {{-- Judul utama halaman diperbarui --}}
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>

    {{-- Informasi Kelas --}}
    <div class="card mb-2" style="border: none; background: none;">
        <div class="card-first-body ">
            <h5 class="card-title"><strong>📘 Informasi Kelas</strong></h5>
            <p>Nama Kelas:
                <span class="badge fs-6" style="background-color: #84A7CF;">{{ $kelas->nama_kelas }}</span>
            </p>
            <p>Kode Mata Kuliah:
                <span class="badge fs-6" style="background-color: #F37AB0;">{{ $kelas->kode_mata_kuliah }}</span>
            </p>
            <p>Dosen Pengampu:
                <span class="badge fs-6" style="background-color: #84A7CF;">{{ auth()->user()->nama }}</span>
            </p>
            <div class="text-end mb-1">
                <button id="exportPDF" class="btn btn-danger no-print">
                    <i class="bi bi-file-earmark-pdf"></i> Export as PDF
                </button>
            </div>
        </div>
    </div>


    {{-- Tambahkan canvas di atas tabel --}}
<<<<<<< HEAD
    <div class="card shadow-sm mb-4" style="border: none;">
        <div class="card-header text-white" style="background-color: #0E1F4D; border: 0px;">
            <h5 class="mb-0">Distribusi Profil Mahasiswa Berdasarkan Jalur Masuk</h5> {{-- Judul chart diubah --}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <canvas id="chartSNBP"></canvas>
                </div>
                <div class="col-md-4">
                    <canvas id="chartSNBT"></canvas>
                </div>
                <div class="col-md-4">
                    <canvas id="chartMandiri"></canvas>
                </div>
=======
<div class="card shadow-sm mb-4" style="border: none;">
    <div class="card-header text-white" style="background-color: #0E1F4D; border: 0px;">
        <h5 class="mb-0">Distribusi Gaya Belajar Mahasiswa</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <canvas id="chartSNBP"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="chartSNBT"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="chartMANDIRI"></canvas>
>>>>>>> ba2edf1 (route export csv + ubah nama mandiri)
            </div>
        </div>
    </div>

    <div class="container-rekomendasi">
        <div class="table-responsive rounded shadow-sm">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center-table" >
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Jalur Masuk</th>
                        <th>Akademik</th>
                        <th>Sekolah</th>
                        <th>Ekonomi</th>
                        <th>Perkuliahan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Menggunakan $students dari controller yang sudah ada atribut _text nya --}}
                    @forelse ($students as $index => $mhs)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $mhs->nama_lengkap }}</td>
                            <td>{{ $mhs->asal_sekolah}}</td>
                            <td class="text-center">{{ $mhs->jalur_masuk }}</td>
                            <td class="text-center">{{ $mhs->akademik_text }}</td>
                            <td class="text-center">{{ $mhs->sekolah_text }}</td>
                            <td class="text-center">{{ $mhs->ekonomi_text }}</td>
                            <td class="text-center">{{ $mhs->perkuliahan_text }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data mahasiswa untuk kelas ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- BAGIAN INI TELAH DIGANTI DENGAN OUTPUT REKOMENDASI KELAS & SOROTAN JALUR YANG BARU --}}
        <div class="mt-4 card shadow-sm card-hasil-rekomendasi">
           <div class="card-header text-white bg-custom-header" >
               <h5 class="mb-0"><i class="fas fa-graduation-cap me-2" ></i> Rekomendasi Pembelajaran untuk Kelas</h5>
           </div>
           <div class="card-body">
               @if ($students->isEmpty())
                   <p class="text-muted"><i class="fas fa-info-circle me-2"></i> Tidak ada mahasiswa di kelas ini. Tidak ada rekomendasi yang dapat dibuat.</p>
               @else
                   <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-lightbulb me-2"></i> Rekomendasi Utama</h6>
                   <p>Berdasarkan analisis profil belajar <strong>{{ count($students) }}</strong> mahasiswa di kelas <strong>{{ $kelas->nama_kelas }}</strong>:</p>
                   <div class="alert alert-info d-flex align-items-center" role="alert">
                       <i class="fas fa-star me-2"></i>
                       <div>
                           Pendekatan pembelajaran yang paling direkomendasikan:
                           <h4 class="alert-heading mb-0">
                               <span class="badge bg-warning text-dark">{{ $mainClassRecommendation }}</span>
                               <small class="text-muted ms-2">({{ number_format($mainClassPercentage, 1) }}% mahasiswa)</small>
                           </h4>
                       </div>
                   </div>

                   <hr class="my-4">

                   <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-chart-bar me-2"></i> Sorotan Rekomendasi per Jalur Masuk</h6>
                   @if (empty($jalurHighlights))
                       <p class="text-muted"><i class="fas fa-exclamation-triangle me-2"></i> Tidak ada data sorotan jalur yang tersedia.</p>
                   @else
                       <div class="row row-cols-1 row-cols-md-2 g-4">
                           @foreach ($jalurHighlights as $jalur => $data)
                               <div class="col">
                                   <div class="card h-100">
                                       <div class="card-body">
                                           <h5 class="card-title"><i class="fas fa-road me-2"></i> Jalur {{ $jalur }}</h5>
                                           @if (!empty($data['recommendation']))
                                               <p class="card-text">Jumlah mahasiswa: <span class="badge bg-secondary">{{ $data['count'] }}</span></p>
                                               <p class="card-text">Rekomendasi dominan:
                                                   <span class="badge bg-success">{{ $data['recommendation'] }}</span>
                                                   <small class="text-muted ms-1">({{ number_format($data['percentage'], 1) }}%)</small>
                                               </p>
                                               @if ($data['recommendation'] == $mainClassRecommendation)
                                                   <p class="card-text text-info small"><i class="fas fa-link me-1"></i> Selaras dengan rekomendasi utama kelas.</p>
                                               @else
                                                   <p class="card-text text-warning small"><i class="fas fa-exclamation-circle me-1"></i> Berbeda dengan rekomendasi utama kelas.</p>
                                               @endif
                                           @else
                                               <p class="card-text text-muted"><i class="fas fa-question-circle me-2"></i> Tidak ada rekomendasi spesifik untuk jalur ini.</p>
                                           @endif
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                       </div>
                   @endif

                   <hr class="my-4">

                   <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-bullseye me-2"></i> Kesimpulan untuk Pengajar</h6>
                   @if ($students->isEmpty())
                       <p class="text-muted"><i class="fas fa-ban me-2"></i> Tidak ada kesimpulan karena tidak ada data mahasiswa.</p>
                   @else
                       <p>Sebagai panduan utama, pertimbangkan untuk mengimplementasikan pendekatan <strong>{{ $mainClassRecommendation }}</strong>.</p>
                       @if (!empty($jalurHighlights))
                           <p class="mb-0">Untuk mengakomodasi keberagaman, perhatikan juga rekomendasi spesifik per jalur:</p>
                           <ul class="list-unstyled">
                               @php
                                   $hasAdditionalRecommendations = false;
                               @endphp
                               @foreach ($jalurHighlights as $jalur => $data)
                                   @if (!empty($data['recommendation']) && $data['recommendation'] != $mainClassRecommendation)
                                       <li><i class="fas fa-arrow-right me-2 text-primary"></i> Jalur {{ $jalur }}: Pertimbangkan pendekatan <span class="fw-bold">{{ $data['recommendation'] }}</span>.</li>
                                       @php $hasAdditionalRecommendations = true; @endphp
                                   @endif
                               @endforeach
                               @if (!$hasAdditionalRecommendations)
                                   <li><i class="fas fa-check me-2 text-success"></i> Tidak ada rekomendasi tambahan signifikan per jalur yang berbeda dari rekomendasi utama.</li>
                               @endif
                           </ul>
                       @endif
                   @endif
               @endif
           </div>
       </div>
        {{-- AKHIR BAGIAN BARU UNTUK REKOMENDASI KELAS & SOROTAN JALUR --}}

    </div>
</div>

@push('scripts')
{{-- Perbaikan: cdn.jsdelivr1.com menjadi cdn.jsdelivr.net --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Pastikan variabel chartData dikirimkan dari Controller dengan benar
    const chartData = @json($chartData);

    // Fungsi translateValue di JS TIDAK LAGI DIGUNAKAN UNTUK TABEL KARENA SUDAH DI PHP.
    // Ini tetap ada di sini jika Anda butuh untuk logika frontend lain di masa depan.
    // Namun, pastikan ini konsisten jika digunakan.
    const translateValue = (aspect, value) => {
        value = parseFloat(value);
        if (aspect === 'akademik') {
            if (value <= 2) return 'Rendah'; // Sesuaikan casing
            if (value <= 3) return 'Sedang'; // Sesuaikan casing
            return 'Tinggi';                 // Sesuaikan casing
        } else if (aspect === 'sekolah') {
            if (value <= 2) return 'Kurang Mendukung'; // Sesuaikan casing
            if (value <= 3) return 'Mendukung';      // Sesuaikan casing
            return 'Sangat Mendukung';             // Sesuaikan casing
        } else if (aspect === 'ekonomi') {
            if (value <= 2) return 'Kurang Mencukupi'; // Sesuaikan casing
            if (value <= 3) return 'Mencukupi';      // Sesuaikan casing
            return 'Sangat Mencukupi';             // Sesuaikan casing
        } else if (aspect === 'perkuliahan') {
            if (value <= 2) return 'Kurang Baik'; // Sesuaikan casing
            if (value <= 3) return 'Baik';      // Sesuaikan casing
            return 'Sangat Baik';             // Sesuaikan casing
        }
        return value;
    };

    const createChart = (ctxId, label, data) => {
        const ctx = document.getElementById(ctxId).getContext('2d');
        // Pastikan data yang masuk ke chart sesuai format yang diinginkan Chart.js
        // data.akademik_total, data.sekolah_total, dst. adalah rata-rata nilai numerik
        new Chart(ctx, {
            type: 'bar', // Bisa diganti 'radar' atau jenis lain jika lebih cocok untuk profil
            data: {
                labels: ['Akademik', 'Sekolah', 'Ekonomi', 'Perkuliahan'], // Nama aspek yang sesuai
                datasets: [{
                    label: label,
                    data: [
                        data.akademik_total,
                        data.sekolah_total,
                        data.ekonomi_total,
                        data.perkuliahan_total
                    ],
                    backgroundColor: ['#0E1F4D', '#27548A', '#578FCA', '#D4EBF8']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5 // Sesuaikan max scale dengan range nilai Anda (0-5)
                    }
                }
            }
        });
    };
    createChart('chartSNBP', 'Mahasiswa SNBP', chartData.SNBP);
    createChart('chartSNBT', 'Mahasiswa SNBT', chartData.SNBT);
    createChart('chartMANDIRI', 'Mahasiswa MANDIRI', chartData.MANDIRI);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    document.getElementById("exportPDF").addEventListener("click", function () {
        const element = document.querySelector(".container");
        const noPrintEls = document.querySelectorAll(".no-print");
        const pdfHeader = document.querySelector(".pdf-header");
        const body = document.body;
        const isDarkTheme = body.classList.contains("dark-theme");

        pdfHeader.style.display = "block";
        noPrintEls.forEach(el => el.style.visibility = "hidden");
        if (isDarkTheme) {
            body.classList.remove("dark-theme");
        }

        setTimeout(() => {
            html2canvas(element, { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                const pdfWidth = pdf.internal.pageSize.getWidth() - 20;
                const pdfHeight = pdf.internal.pageSize.getHeight();

                const imgProps = pdf.getImageProperties(imgData);
                const imgWidth = pdfWidth;
                const imgHeight = (imgProps.height * imgWidth) / imgProps.width;

                let heightLeft = imgHeight;
                let position = 10;

                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pdfHeight;

                while (heightLeft > 0) {
                    position -= pdfHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pdfHeight;
                }

                pdf.save("hasil-rekomendasi.pdf");

                noPrintEls.forEach(el => el.style.visibility = "visible");
                pdfHeader.style.display = "none";
                if (isDarkTheme) {
                    body.classList.add("dark-theme");
                }
            });
        }, 500);
    });
</script>

@endpush

@endsection
