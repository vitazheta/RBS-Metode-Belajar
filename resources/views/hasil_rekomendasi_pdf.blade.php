{{-- resources/views/hasil_rekomendasi_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Rekomendasi Pembelajaran Kelas</title>
    <style>
        @page { margin: 1.5cm 1.5cm 1.5cm 1.5cm; }
        body, table, th, td {
            font-family: 'poppins', sans-serif;
        }
        .header {
            margin-bottom: 18px;
            border-bottom: 2px solid #102452;
            padding-bottom: 8px;
        }
        .header-logo {
            float: left;
            margin-right: 18px;
        }
        .header-title {
            font-size: 1.5em;
            font-weight: bold;
            color: #102452;
            margin-bottom: 2px;
        }
        .header-date {
            font-size: 0.95em;
            color: #444;
        }
        .info-box {
            background: #f3f6fa;
            border-radius: 8px;
            padding: 12px 18px;
            margin-bottom: 18px;
        }
        .info-label {
            font-weight: bold;
            color: #102452;
        }
        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 6px;
            font-size: 1em;
            color: #fff;
            margin-left: 4px;
        }
        .badge-blue { background: #7ea6d8; }
        .badge-pink { background: #f37ab0; }
        .badge-navy { background: #102452; }
        .section-title {
            background: #102452;
            color: #fff;
            padding: 8px 16px;
            border-radius: 8px 8px 0 0;
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 0;
        }
        .section {
            border: 1.5px solid #102452;
            border-radius: 8px;
            margin-bottom: 18px;
            background: #fff;
        }
        .section-content {
            padding: 14px 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-bottom: 10px;
            table-layout: fixed;
            word-break: break-word;
        }
        th, td {
            border: 1px solid #102452;
            padding: 5px 4px;
            text-align: left;
        }
        th {
            background: #102452;
            color: #fff;
            font-weight: bold;
        }
        tr, td, th { page-break-inside: avoid !important; }
        ul { margin: 0 0 0 1.2em; }
        .two-col {
            width: 100%;
            margin-bottom: 18px;
        }
        .two-col td {
            vertical-align: top;
            padding: 0 8px;
        }
        .box {
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 0;
        }
        .box-dominan {
            background: #f3f6fa;
            border: 1.5px solid #102452;
        }
        .box-rekom {
            background: #e3f4fa;
            border: 1.5px solid #7ea6d8;
        }
        .subtitle {
            font-weight: bold;
            color: #102452;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <img src="{{ public_path('images/logocetakpdf.png') }}" alt="Logo" width="70" class="header-logo">
        <div>
            <div class="header-title">Hasil Rekomendasi Pembelajaran Kelas</div>
            <div class="header-date">Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</div>
        </div>
        <div style="clear:both;"></div>
    </div>

    {{-- Informasi Kelas --}}
    <div class="info-box">
        <span class="info-label">? Informasi Kelas</span><br>
        Nama Kelas:
        <span class="badge badge-blue">{{ $kelas->nama_kelas }}</span><br>
        Kode Mata Kuliah:
        <span class="badge badge-pink">{{ $kelas->kode_mata_kuliah }}</span><br>
        Dosen Pengampu:
        <span class="badge badge-blue">{{ $dosen_nama ?? (auth()->user()->nama ?? '-') }}</span>
    </div>

    {{-- Daftar Mahasiswa --}}
    <div class="section">
        <div class="section-title">Daftar Mahasiswa</div>
        <div class="section-content">
            <table>
                <thead>
                    <tr>
                        <th style="width: 28px;">No</th>
                        <th style="width: 120px;">Nama</th>
                        <th style="width: 90px;">Asal Sekolah</th>
                        <th style="width: 55px;">Jalur Masuk</th>
                        <th style="width: 60px;">Akademik</th>
                        <th style="width: 60px;">Sekolah</th>
                        <th style="width: 60px;">Ekonomi</th>
                        <th style="width: 70px;">Perkuliahan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $index => $mhs)
                        <tr>
                            <td style="text-align:center;">{{ $index + 1 }}</td>
                            <td>{{ $mhs->nama_lengkap }}</td>
                            <td>{{ $mhs->asal_sekolah }}</td>
                            <td style="text-align:center;">{{ $mhs->jalur_masuk }}</td>
                            <td style="text-align:center;">{{ $mhs->akademik_text }}</td>
                            <td style="text-align:center;">{{ $mhs->sekolah_text }}</td>
                            <td style="text-align:center;">{{ $mhs->ekonomi_text }}</td>
                            <td style="text-align:center;">{{ $mhs->perkuliahan_text }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center; color:#888;">Belum ada data mahasiswa untuk kelas ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Dua Kolom: Kondisi Dominan & Rekomendasi Utama --}}
    <table class="two-col">
        <tr>
            <td style="width: 40%;">
                <div class="box box-dominan">
                    <div class="subtitle">&#128202; Kondisi Dominan Kelas</div>
                    {!! $KondisiDominan['kondisi'] ?? '<span class="text-dark">Belum ada data kondisi dominan.</span>' !!}
                </div>
            </td>
            <td style="width: 60%;">
                <div class="box box-rekom">
                    <div class="subtitle">&#128161; Rekomendasi Utama</div>
                    {!! $KondisiDominan['rekomendasi'] ?? '<span class="text-dark">Belum ada rekomendasi utama.</span>' !!}
                </div>
            </td>
        </tr>
    </table>

    {{-- Sorotan Rekomendasi per Jalur Masuk --}}
    <div class="section">
        <div class="section-title">Sorotan Rekomendasi per Jalur Masuk</div>
        <div class="section-content">
            <table>
                <thead>
                    <tr>
                        <th style="width: 70px;">Jalur</th>
                        <th style="width: 60px;">Jumlah</th>
                        <th>Pendekatan</th>
                        <th>Evaluasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(['SNBP', 'SNBT', 'MANDIRI'] as $jalur)
                        <tr>
                            <td style="text-align:center;">
                                <span class="badge badge-navy">{{ $jalur }}</span>
                            </td>
                            <td style="text-align:center;">
                                {{ $students->where('jalur_masuk', $jalur)->count() }}
                            </td>
                            <td>
                                @if(!empty($persentaseKecocokanJalur[$jalur]['pendekatan']))
                                    <ul>
                                        @foreach($persentaseKecocokanJalur[$jalur]['pendekatan'] as $kataKunci => $persen)
                                            <li><b>{{ $kataKunci }}</b>: {{ $persen }}%</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span style="color:#888;">-</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($persentaseKecocokanJalur[$jalur]['evaluasi']))
                                    <ul>
                                        @foreach($persentaseKecocokanJalur[$jalur]['evaluasi'] as $kataKunci => $persen)
                                            <li><b>{{ $kataKunci }}</b>: {{ $persen }}%</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span style="color:#888;">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Hasil Analisis Kebutuhan Kolaborasi --}}
    <div class="section">
        <div class="section-title">Hasil Analisis Kebutuhan Kolaborasi Kelas</div>
        <div class="section-content">
            @php
                $rekom = strip_tags($KondisiDominan['rekomendasi'] ?? '');
            @endphp
            @if(stripos($rekom, 'diskusi kelompok aktif') !== false)
                <div style="margin-bottom: 8px;">
                    <b>Rekomendasi yang diberikan sebelumnya sudah memiliki aspek kolaboratif, namun aspek kolaboratifnya perlu dikaji lebih dalam. Berikut ini ada rekomendasi kegiatan kolaborasi yang dapat diterapkan:</b>
                </div>
                @if(!empty($hasilKolaborasi))
                    <div>
                        {!! $hasilKolaborasi !!}
                    </div>
                @endif
            @else
                <div style="margin-bottom: 8px;">
                    <b>Rekomendasi yang diberikan sebelumnya belum memiliki aspek kolaboratif. Untuk itu tambahkan rekomendasi pembelajaran yang dapat mendukung kemampuan kolaborasi sesuai kebutuhan dunia kerja.</b>
                </div>
                @if(!empty($hasilKolaborasi))
                    <div>
                        {!! $hasilKolaborasi !!}
                    </div>
                @endif
            @endif
        </div>
    </div>
</body>
</html>