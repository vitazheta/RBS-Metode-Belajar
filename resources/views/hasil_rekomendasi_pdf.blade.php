{{-- resources/views/hasil_rekomendasi_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Rekomendasi Pembelajaran Kelas</title>
    <style>
        /* CSS Reset and Base Styles */
        @page {
            margin: 1.5cm;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
        }

        /* --- Typography --- */
        .header-title {
            font-size: 20pt;
            font-weight: 700;
            color: #102452;
        }

        .section-block-title {
            font-size: 14pt;
            font-weight: bold;
            color: #102452;
            margin-bottom: 12px;
        }

        .card-title {
            font-weight: bold;
            color: #102452;
            margin-bottom: 12px;
            font-size: 17pt;
        }

        /* --- Header --- */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #102452;
            padding-bottom: 10px;
            margin-bottom: 24px;
        }
        .header-logo {
            width: 55px;
            margin-right: 15px;
        }
        .header-date {
            font-size: 10pt;
            color: #555;
            text-align: right;
        }

        /* --- Unified Card System --- */
        .card {
            width: 100%;
            padding: 0; /* REMOVE HORIZONTAL PADDING FROM THE CARD ITSELF */
            border-radius: 8px;
            margin-bottom: 20px;
            box-sizing: border-box;
            page-break-inside: avoid;
        }

        /* Modifier classes for card colors */
        .info-box {
            background-color: #eaf2fb;
            border: 1px solid #cddcf0;
            page-break-after: auto;
        }
        .dominant-box {
            background-color: #f3f6fa;
            border: 1px solid #d1d9e6;
        }
        .recommendation-box {
            background-color: #e3f4fa;
            border: 1px solid #b1ddec;
        }

        /* NEW: Add an inner div for card content padding */
        .card-content-inner {
            padding: 16px 14px; /* Apply desired padding here */
        }

        /* Table for aligning info in the first card */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .info-table td:first-child {
            width: 140px;
            font-weight: bold;
            color: #102452;
        }
        .info-table td:nth-child(2) {
            width: 15px;
        }

        /* --- Main Content Sections --- */
        .section-block {
            border: 1px solid #102452;
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
            box-sizing: border-box;
            page-break-inside: avoid;
        }
        .section-block-header {
            background-color: #102452;
            color: #ffffff;
            padding: 8px 14px; /* Keep padding here, as this header is part of the border */
            font-size: 12pt;
            font-weight: bold;
        }
        .section-block-content {
            padding: 14px; /* Keep padding here, or adjust as needed for internal content */
        }

        /* --- Data Table Styles --- */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 15px;
            page-break-inside: auto;
        }
        .data-table th, .data-table td {
            border: 1px solid #b0c4de;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
        }
        .data-table th {
            background-color: #eaf2fb;
            color: #102452;
            font-weight: bold;
            text-align: center;
        }
        .data-table td { padding: 7px; }
        .data-table .text-center { text-align: center; }
        .data-table tbody tr:nth-child(even) { background-color: #f8fafd; }

        .data-table tr, .data-table td, .data-table th {
            page-break-inside: avoid !important;
        }
        .data-table tr {
            page-break-after: auto;
        }

        /* --- Specific Page Breaking Rules --- */
        .section-block:nth-of-type(2) {
            page-break-inside: auto;
            margin-bottom: 0;
        }

        .card.dominant-box {
            page-break-before: always;
        }

        .section-block:not(:nth-of-type(1)):not(:nth-of-type(2)) {
             page-break-before: auto;
             page-break-inside: avoid;
        }

        .card.recommendation-box {
            page-break-before: auto;
        }

        /* --- Utilities & Badges --- */
        .badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 12px;
            font-size: 9pt;
            font-weight: 500;
            color: #fff;
        }
        .badge-navy { background-color: #102452; }
        ul { margin: 0; padding-left: 20px; }
        li { margin-bottom: 5px; }
        .text-muted { color: #777; }

        /* --- General Page Break Helpers --- */
        h3 {
            page-break-after: avoid;
        }

    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div style="display: flex; align-items: center;">
            <img src="{{ public_path('images/logocetakpdf.png') }}" alt="Logo" class="header-logo">
            <div class="header-title">Hasil Rekomendasi Kelas</div>
        </div>
        <div class="header-date">
            Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}
        </div>
    </div>

    {{-- Informasi Kelas --}}
    <div class="card info-box">
        <div class="card-content-inner"> <div class="card-title">Informasi Kelas</div>
            <table class="info-table">
                <tr>
                    <td>Nama Kelas</td>
                    <td>:</td>
                    <td>{{ $kelas->nama_kelas }}</td>
                </tr>
                <tr>
                    <td>Mata Kuliah</td>
                    <td>:</td>
                    <td>{{ $kelas->kode_mata_kuliah }}</td>
                </tr>
                <tr>
                    <td>Dosen Pengampu</td>
                    <td>:</td>
                    <td>{{ $dosen_nama ?? (auth()->user()->nama ?? '-') }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Daftar Mahasiswa --}}
        <div class="section-block-header">Daftar Mahasiswa</div>
        <div class="section-block-content" style="padding: 0; ">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:7%;">No</th>
                        <th style="width:15%;">Nama</th>
                        <th style="width:15%;">Asal Sekolah</th>
                        <th style="width:14%;">Jalur Masuk</th>
                        <th style="width:17%;">Akademik</th>
                        <th style="width:17%;">Sekolah</th>
                        <th style="width:17%;">Ekonomi</th>
                        <th style="width:18%;">Perkuliahan</th>
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

    {{-- These will now reliably start on the second page --}}
    <div class="card dominant-box">
        <div class="card-content-inner"> <div class="card-title">Kondisi Dominan Kelas</div>
            {!! $KondisiDominan['kondisi'] ?? '<span class="text-muted">Belum ada data kondisi dominan.</span>' !!}
        </div>
    </div>

    <div class="card recommendation-box">
        <div class="card-content-inner"> <div class="card-title">Rekomendasi Utama</div>
            {!! $KondisiDominan['rekomendasi'] ?? '<span class="text-muted">Belum ada rekomendasi utama.</span>' !!}
        </div>
    </div>

    {{-- Sorotan Jalur Masuk --}}
    <div class="section-block">
        <div class="section-block-header">Sorotan Rekomendasi per Jalur Masuk</div>
        <div class="section-block-content">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 15%;">Jalur</th>
                        <th style="width: 15%;">Jumlah</th>
                        <th style="width: 37.5%;">Pendekatan</th>
                        <th style="width: 37.5%;">Evaluasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(['SNBP', 'SNBT', 'MANDIRI'] as $jalur)
                        <tr>
                            <td class="text-center"><span class="badge badge-navy">{{ $jalur }}</span></td>
                            <td class="text-center">{{ $students->where('jalur_masuk', $jalur)->count() }}</td>
                            <td>
                                @if(!empty($persentaseKecocokanJalur[$jalur]['pendekatan']))
                                    <ul>
                                        @foreach($persentaseKecocokanJalur[$jalur]['pendekatan'] as $kataKunci => $persen)
                                            <li><b>{{ $kataKunci }}:</b> {{ $persen }}%</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($persentaseKecocokanJalur[$jalur]['evaluasi']))
                                    <ul>
                                        @foreach($persentaseKecocokanJalur[$jalur]['evaluasi'] as $kataKunci => $persen)
                                            <li><b>{{ $kataKunci }}:</b> {{ $persen }}%</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Hasil Analisis Kolaborasi --}}
    <div class="section-block">
        <div class="section-block-header">Hasil Analisis Kebutuhan Kolaborasi Kelas</div>
        <div class="section-block-content">
            @php
                $rekom = strip_tags($KondisiDominan['rekomendasi'] ?? '');
            @endphp

            @if(stripos($rekom, 'diskusi kelompok aktif') !== false)
                <p>
                    <b>Rekomendasi yang diberikan sebelumnya sudah memiliki aspek kolaboratif, namun aspek kolaboratifnya perlu dikaji lebih dalam. Berikut ini ada rekomendasi kegiatan kolaborasi yang dapat diterapkan:</b>
                </p>
                <div>
                    {!! $hasilKolaborasi ?? '<span class="text-muted">Belum ada data hasil kolaborasi.</span>' !!}
                </div>
            @else
                <p>
                    <b>Rekomendasi yang diberikan sebelumnya belum memiliki aspek kolaboratif. Untuk itu tambahkan rekomendasi pembelajaran yang dapat mendukung kemampuan kolaborasi sesuai kebutuhan dunia kerja.</b>
                </p>
                <div>
                    {!! $hasilKolaborasi ?? '<span class="text-muted">Belum ada data hasil kolaborasi.</span>' !!}
                </div>
            @endif
        </div>
    </div>

</body>
</html>