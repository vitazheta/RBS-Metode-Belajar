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
        .text-center-table-header {
            background-color: #0E1F4D;
            color: #ffffff;
            text-align: center;
        }

        .highlight-card {
            background-color: #f8f9fa;
            border-left: 6px solid;
            padding: 20px;
            border-radius: 12px;
            width: 100%;
        }

        .border-snbp {
            border-left-color: #0E1F4D !important;
        }

        .border-snbt {
            border-left-color: #27548A !important;
        }

        .border-mandiri {
            border-left-color: #578FCA !important;
        }

        .border-kondisi {
            border-left-color: #F481B4 !important;
        }

        btn .btn-kolaborasi {
            background-color: #0E1F4D;
            color:rgb(63, 71, 224);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        btn .btn-kolaborasi:hover {
            background-color: #162449;
            color: #ffffff;
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

        body.dark-theme .highlight-card {
            background-color: #373737;
            color: #ffffff;
        }
        
        body.dark-theme .card-body-highlight {
            background-color: #373737;
            color: #ffffff;
        }

        body.dark-theme .card-subtitle {
            color: #ffffff !important;
        }

        body.dark-theme #btnKolaborasi .kolaborasi-text,
        body.dark-theme #btnKolaborasi .kolaborasi-icon {
            color: #FFFFFF !important;
        }

        body.dark-theme #btnKolaborasi:hover .kolaborasi-text,
        body.dark-theme #btnKolaborasi:hover .kolaborasi-icon {
            color: #777F95 !important;
        }
    </style>
</head>

{{-- resources/views/hasil_rekomendasi.blade.php --}}
@extends('layouts.app')

@section('title', 'Hasil Rekomendasi Pembelajaran Kelas')

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

<div class="container" style="padding-top: 50px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block no-print" style="padding-top: 70px;">
        Hasil Rekomendasi Pembelajaran Kelas 
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>

    {{-- Informasi Kelas --}}
    <div style="margin-top: 20px;"></div> <!-- Tambahkan jarak ekstra -->
    <div class="card mb-3" style="border: none; background: none;">
        <div class="card-first-body ">
            <h5 class="card-title"><strong>📘 Informasi Kelas</strong></h5>
            <div class="mb-3">
            <span>Nama Kelas:</span>
            <span class="badge fs-6 ms-2" style="background-color: #84A7CF;">{{ $kelas->nama_kelas }}</span>
            </div>
            <div class="mb-3">
            <span>Kode Mata Kuliah:</span>
            <span class="badge fs-6 ms-2" style="background-color: #F37AB0;">{{ $kelas->kode_mata_kuliah }}</span>
            </div>
            <div class="mb-2">
            <span>Dosen Pengampu:</span>
            <span class="badge fs-6 ms-2" style="background-color: #84A7CF;">{{ auth()->user()->nama }}</span>
            </div>
<div class="text-end mb-1">
    <a href="{{ route('hasil-rekomendasi.exportPdf', $kelas->id) }}" target="_blank" class="btn btn-danger no-print">
        <i class="bi bi-file-earmark-pdf"></i> Export as PDF
    </a>
</div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="card shadow-sm mb-4" style="border: none;">
        <div class="card-header text-white" style="background-color: #0E1F4D; border: 0px; padding: 16px 24px;">
            <h5 class="mb-0">Distribusi Diagram Strategi Belajar</h5>
        </div>
        <div class="card-body" style="padding: 16px 24px;">
            <div class="row">
                <div class="col-md-4">
                    <canvas id="chartSNBP"></canvas>
                </div>
                <div class="col-md-4">
                    <canvas id="chartSNBT"></canvas>
                </div>
                <div class="col-md-4">
                    <canvas id="chartMANDIRI"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Mahasiswa --}}
    <div class="container-rekomendasi">
        <div class="card-header text-white" style="background-color: #0E1F4D; border-radius: 5px 5px 0px 0px; padding: 16px 24px;">
            <h5 class="mb-0">Data Kelas</h5>
        </div>
        <div class="table-responsive rounded shadow-sm">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center-table-header">
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
                    @forelse ($students as $index => $mhs)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $mhs->nama_lengkap }}</td>
                            <td>{{ $mhs->asal_sekolah }}</td>
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

        {{-- Rekomendasi Utama --}}
        <div class="mt-4 card shadow-sm card-hasil-rekomendasi" style="height:auto; min-height:unset; border: none;">
            <div class="card-header text-white bg-custom-header" style="padding: 16px 24px;">
            <h5 class="mb-0">
                Rekomendasi Pembelajaran untuk Kelas
            </h5>
            </div>
            <div class="card-body px-4" style="padding-left: 24px; padding-right: 24px; padding-top: 24px">
                <p>Berdasarkan analisis profil belajar <strong>{{ count($students) }}</strong> mahasiswa di kelas <strong>{{ $kelas->nama_kelas }}</strong> maka dapat diketahui bahwa:</p>
            <div class="row g-3 align-items-stretch" style="margin-top: -18px;">
                <div class="col-md-4 d-flex">
                <div class="highlight-card border-4 border-kondisi">
                    <h6 class="mb-3">
                        <i class="fas fa-chart-bar me-2" style="color: #F481B4;"></i> <b>Kondisi Dominan Kelas</b>
                    </h6>
                    @if(!empty($KondisiDominan['kondisi']) && $KondisiDominan['kondisi'] != '-')
                        {!! $KondisiDominan['kondisi'] !!}
                    @else
                        <span class="text-dark">Belum ada data kondisi dominan.</span>
                    @endif
                </div>
                </div>
                <div class="col-md-8 d-flex">
                <div class="alert flex-fill" style="background-color: #D4EBF8; color: #000; margin-bottom: 0;">
                    <h6 class="mb-3" style="color: #000;">
                    <i class="fas fa-lightbulb me-2"></i> <b>Rekomendasi Utama</b>
                    </h6>
                    @if(!empty($KondisiDominan['rekomendasi']) && $KondisiDominan['rekomendasi'] != '-')
                        {!! $KondisiDominan['rekomendasi'] !!}
                    @else
                        <span class="text-dark">Belum ada rekomendasi utama.</span>
                    @endif
                </div>
                </div>
            </div>
            {{-- Tambahan: Sorotan per Jalur Masuk --}}
            <div class="row g-3 mt-1" style="margin: 40px 0px !important;"> {{-- Ubah margin-top agar lebih jauh --}}
                <div class="col-12">
                    <h6 class="card-subtitle" style="margin-top: -10px; margin-bottom: 12px; color: #000; font-weight: bold;">
                        <i class="fas fa-chart-bar me-2"></i> Sorotan Rekomendasi per Jalur Masuk
                    </h6>
                </div>

                {{-- Sorotan SNBP --}}
                <div class="col-md-4 d-flex" style="margin-top: 5px; margin-bottom: 5px;">
                    <div class="highlight-card border-4 border-snbp">
                        <div class="card-body-highlight">
                            <div class="fw-semibold mb-3"><i class="bi bi-person-badge-fill" style="color: #0E1F4D;"></i> Sorotan SNBP</div>
                            <p class="mb-2">
                                <span class="badge" style="background-color: #0E1F4D; color: #fff;">
                                    Jumlah Mahasiswa: {{ $students->where('jalur_masuk', 'SNBP')->count() }}
                                </span>
                            </p>

                            {{-- Persentase kecocokan rekomendasi SNBP --}}
                            @if(!empty($persentaseKecocokanJalur['SNBP']))
                                <div class="mt-3">
                                    <h6 class="fw mb-1">Persentase Kecocokan:</h6>
                                    <div>
                                        <ul class="mb-1">
                                            @foreach($persentaseKecocokanJalur['SNBP']['pendekatan'] as $kataKunci => $persen)
                                                <li>
                                                    <b>{{ $kataKunci }}</b>: {{ $persen }}% dari seluruh mahasiswa jalur SNBP
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul>
                                            @foreach($persentaseKecocokanJalur['SNBP']['evaluasi'] as $kataKunci => $persen)
                                                <li>
                                                    <b>{{ $kataKunci }}</b>: {{ $persen }}% dari seluruh mahasiswa jalur SNBP
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Sorotan SNBT --}}
                <div class="col-md-4 d-flex" style="margin-top: 5px; margin-bottom: 5px;">
                    <div class="highlight-card border-4 border-snbt">
                        <div class="card-body-highlight">
                            <div class="fw-semibold mb-3"><i class="bi bi-person-badge-fill" style="color: #27548A;"></i> Sorotan SNBT</div></span>
                            <p class="mb-2">
                                <span class="badge" style="background-color: #27548A; color: #fff;">
                                    Jumlah Mahasiswa: {{ $students->where('jalur_masuk', 'SNBT')->count() }}
                                </span>
                            </p>

                            @if(!empty($persentaseKecocokanJalur['SNBT']))
                                <div class="mt-3">
                                    <h6 class="fw mb-1">Persentase Kecocokan:</h6>
                                    <div>
                                        <ul class="mb-1">
                                            @foreach($persentaseKecocokanJalur['SNBT']['pendekatan'] as $kataKunci => $persen)
                                                <li>
                                                    <b>{{ $kataKunci }}</b>: {{ $persen }}% dari seluruh mahasiswa jalur SNBT
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul>
                                            @foreach($persentaseKecocokanJalur['SNBT']['evaluasi'] as $kataKunci => $persen)
                                                <li>
                                                    <b>{{ $kataKunci }}</b>: {{ $persen }}% dari seluruh mahasiswa jalur SNBT
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Sorotan Mandiri --}}
                <div class="col-md-4 d-flex" style="margin-top: 5px; margin-bottom: 5px;">
                    <div class="highlight-card border-4 border-mandiri">
                        <div class="card-body-highlight">
                            <div class="fw-semibold mb-3"><i class="bi bi-person-badge-fill" style="color: #578FCA;"></i> Sorotan MANDIRI</div>
                            <p class="mb-2">
                                <span class="badge" style="background-color: #578FCA; color: #fff;">
                                    Jumlah Mahasiswa: {{ $students->where('jalur_masuk', 'MANDIRI')->count() }}
                                </span>
                            </p>

                            @if(!empty($persentaseKecocokanJalur['MANDIRI']))
                                <div class="mt-3">
                                    <h6 class="fw mb-1">Persentase Kecocokan:</h6>
                                    <div>
                                        <ul class="mb-1">
                                            @foreach($persentaseKecocokanJalur['MANDIRI']['pendekatan'] as $kataKunci => $persen)
                                                <li>
                                                    <b>{{ $kataKunci }}</b>: {{ $persen }}% dari seluruh mahasiswa jalur Mandiri
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul>
                                            @foreach($persentaseKecocokanJalur['MANDIRI']['evaluasi'] as $kataKunci => $persen)
                                                <li>
                                                    <b>{{ $kataKunci }}</b>: {{ $persen }}% dari seluruh mahasiswa jalur Mandiri
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center no-print" style="margin-bottom: 20px;">
                    <button id="btnKolaborasi" class="btn btn-kolaborasi" style="font-size: 1rem; border: none;">
                        <i class="fas fa-users kolaborasi-icon"></i> 
                        <span class="kolaborasi-text">Cek Kebutuhan Kolaborasi</span>
                    </button>
                </div>
                <style>
                    #btnKolaborasi .kolaborasi-text,
                    #btnKolaborasi .kolaborasi-icon {
                        transition: color 0.2s;
                    }
                    #btnKolaborasi:hover .kolaborasi-text,
                    #btnKolaborasi:hover .kolaborasi-icon {
                        color: #6C757D !important;
                    }
                    #btnKolaborasi:hover {
                        border: none !important;
                    }

                </style>

                <div class="row g-3 align-items-stretch mt-2 shadow-sm" id="hasilKolaborasi" style="display: none; background-color: #f8f9fa;  ">
                    <div class="col-md-12 d-flex px-4">
                        <div class="alert flex-fill" style="background-color: #f8f9fa; color: #0E1F4D; border-radius: 10px; font-size: 1rem;">
                            <h5 class="mb-2 fw-bold" style="font-size: 1.25rem;">
                                <i class="fas fa-users me-2"></i> Analisis Kebutuhan Kolaborasi
                            </h5>
                            @php
                                $rekom = strip_tags($KondisiDominan['rekomendasi'] ?? '');
                            @endphp
                            @if(stripos($rekom, 'diskusi kelompok aktif') !== false)
                                <div class="mb-2 mt-3" style="font-size: 1rem;">
                                    Berdasarkan hasil generate pembelajaran adaptif sesuai dengan karakteristik mahasiswa, kelas <strong>{{ $kelas->nama_kelas }}</strong> memiliki strategi yang mencakup diskusi kelompok aktif. Oleh karena itu, upaya penguatan kolaborasi dapat difokuskan pada peningkatan kualitas interaksi, pertukaran ide, serta kemampuan menyelesaikan masalah secara tim. Berikut beberapa strategi lanjutan yang bisa diterapkan:
                                </div>
                                @if(!empty($hasilKolaborasi))
                                    <div class="mb-2" style="font-size: 1rem;">
                                        {!! $hasilKolaborasi !!}
                                    </div>
                                @endif
                            @else
                                <div class="mb-2" style="font-size: 1rem;">
                                    Berdasarkan hasil generate pembelajaran adaptif, dapat diketahui bahwa kelas <strong>{{ $kelas->nama_kelas }}</strong> belum mencakup diskusi kelompok aktif dalam strategi yang diterapkan. Untuk itu, diperlukan langkah tambahan yang bertujuan membangun keterampilan kolaboratif mahasiswa secara bertahap dan kontekstual. Berikut adalah strategi yang dapat diterapkan untuk membentuk kemampuan kolaborasi yang lebih baik:
                                </div>
                                @if(!empty($hasilKolaborasi))
                                    <div class="mb-2" style="font-size: 1rem;">
                                        {!! $hasilKolaborasi !!}
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>


            </div>

            </div>


                
            </div>

            
        </div>
    </div>

 

@push('scripts')
{{-- Perbaikan: cdn.jsdelivr1.com menjadi cdn.jsdelivr.net --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartData = @json($chartData);

    const translateValue = (aspect, value) => {
        value = parseFloat(value);
        if (aspect === 'akademik') {
            if (value <= 2.5) return 'Perlu Penguatan';
            if (value <= 4) return 'Siap';
            return 'Siap'; // Nilai di atas 4 tetap 'Siap'
        } else if (aspect === 'sekolah') {
            if (value <= 2.5) return 'Kurang Mendukung';
            if (value <= 4) return 'Mendukung';
            return 'Mendukung';
        } else if (aspect === 'ekonomi') {
            if (value <= 2.5) return 'Kurang Mencukupi';
            if (value <= 4) return 'Mencukupi';
            return 'Mencukupi';
        } else if (aspect === 'perkuliahan') {
            if (value <= 2.5) return 'Kurang Baik';
            if (value <= 4) return 'Baik';
            return 'Baik';
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

<script>
    document.getElementById('btnKolaborasi').onclick = function() {
        document.getElementById('hasilKolaborasi').scrollIntoView({ behavior: 'smooth' });
        document.getElementById('hasilKolaborasi').style.display = 'block';
    };
</script>

@endpush

@endsection