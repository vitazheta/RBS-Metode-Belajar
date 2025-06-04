<head>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <title>Hasil Rekomendasi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EBEDF4;
        }
    </style>
</head>

@extends('layouts.app')

@section('title', 'Hasil Rekomendasi Gaya Belajar')

@section('content')

<style>
    @media print {
    .container {
        padding-top: 0 !important; /* Menghilangkan padding-top saat print */
        min-height: calc(100vh - 100px); /* Pastikan konten utama memenuhi layar */
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
        margin-bottom: 100px; /* Tambahkan jarak sebelum footer */
    }

    .container {
    color: #0E1F4D;
    }

    body {
    background-color: #EBEDF4; /* Warna latar belakang */
    font-family: 'Poppins', sans-serif; /* Pastikan font tetap konsisten */
    margin: 0;
    padding: 0;
    }

    .table-responsive {
    border-radius: 10px; /* Membuat sudut membulat */
    overflow: hidden; /* Memastikan konten tidak keluar dari sudut */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Menambahkan shadow */
    background-color: #ffffff; /* Warna latar belakang */
}

.container-rekomendasi {
    max-width: 100%; /* Pastikan lebar penuh */
    margin-bottom: 100px;
}

.container-rekomendasi .card-hasil-rekomendasi {
    width: 100%; /* Sesuaikan dengan lebar tabel */
    margin: 0 auto; /* Pusatkan jika diperlukan */
    margin-top: 20px; /* Jarak antara tabel dan section hasil rekomendasi */
}

.card-body {
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
}


.card-hasil {
    background-color: #ffffff; /* Warna latar belakang */
    color: #000000; /* Warna teks */
    border-radius: 10px; /* Membuat sudut membulat */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Menambahkan shadow */
}

.table-aspek {
    margin-bottom: 20px;
}

.table-aspek .table-light {
    background-color: #EBEDF4;
    border-color: #6C757D;
    color: #000000;
    text-align: center;
}

.table-aspek .kolom-aspek {
    border-radius: 5px; /* Membuat sudut membulat */
    overflow: hidden; /* Memastikan konten tidak keluar dari sudut */
    border-color: #6C757D;
    color: #000000;
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
    background-color:  #162449;
    color: #ffffff;
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

<div class="pdf-header" style="display: none; padding: 20px; border-bottom: 2px solid #000; margin-bottom: 20px;">
    <div style="display: flex; align-items: center;">
        <img src="{{ asset('images/logocetakpdf.png') }}" alt="Logo" width="200" style="margin-right: 20px;">
        <div>
        <h2 class="mb-2 fw-bold position-relative d-inline" style="color: #0E1F4D;">Hasil Rekomendasi Gaya Belajar Mahasiswa</h2>
            <p style="margin: 0;">Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>
    </div>
</div>


<div class="container" style="padding-top: 0px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block no-print" style="padding-top: 70px;">
        Hasil Rekomendasi Gaya Belajar Mahasiswa
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>

    {{-- Informasi Kelas --}}
    <div class="card mb-2" style="border: none; background: none;">
        <div class="card-first-body">
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
                <canvas id="chartMandiri"></canvas>
            </div>
        </div>
    </div>
</div>

    <div class="container-rekomendasi">
        <div class="table-responsive rounded shadow-sm">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center-table" style="background-color: #162449;">
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
                    @forelse ($kelas->mahasiswa as $index => $mhs)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $mhs->nama_lengkap }}</td>
                            <td>{{ $mhs->asal_sekolah}}</td>
                            <td class="text-center">{{ $mhs->jalur_masuk }}</td>
                            <td class="text-center">{{ $mhs->akademik_total}}</td>
                            <td class="text-center">{{ $mhs->sekolah_total}}</td>
                            <td class="text-center">{{ $mhs->ekonomi_total}}</td>
                            <td class="text-center">{{ $mhs->perkuliahan_total}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Belum ada data hasil rekomendasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-hasil p-4 mt-3 shadow-sm card-hasil-rekomendasi">
            <p>Berdasarkan data inputan di kelas <strong>{{ $kelas->nama_kelas }}</strong>, berikut ringkasan rekomendasi pembelajaran yang dapat kami berikan:</p>

            <table class="table-aspek table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Aspek</th>
                        <th>Alasan</th>
                    </tr>
                </thead>
                <tbody class="kolom-aspek">
                    <tr>
                        <td>Akademik dan Endurance</td>
                        <td>{{ $alasan['akademik_endurance'] }}</td>
                    </tr>
                    <tr>
                        <td>Latar Belakang</td>
                        <td>{{ $alasan['latar_belakang'] }}</td>
                    </tr>
                    <tr>
                        <td>Pola Belajar</td>
                        <td>{{ $alasan['pola_belajar'] }}</td>
                    </tr>
                    <tr>
                        <td>Perkuliahan</td>
                        <td>{{ $alasan['perkuliahan'] }}</td>
                    </tr>
                </tbody>
            </table>

            <p>Dengan demikian pembelajaran terbaik yang direkomendasikan adalah <strong>{{ $rekomendasi['akademik_endurance'] }}</strong>
            dengan tetap memperhatikan <strong>{{ $rekomendasi['latar_belakang'] }}</strong>,
            <strong>{{ $rekomendasi['pola_belajar'] }}</strong>,
            serta <strong>{{ $rekomendasi['perkuliahan'] }}</strong>.</p>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartData = @json($chartData);

    const createChart = (ctxId, label, data) => {
        const ctx = document.getElementById(ctxId).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Akademik', 'Latar Belakang', 'Pola Belajar', 'Perkuliahan'],
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
                        max: 3
                    }
                }
            }
        });
    };
    createChart('chartSNBP', 'Mahasiswa SNBP', chartData.SNBP);
    createChart('chartSNBT', 'Mahasiswa SNBT', chartData.SNBT);
    createChart('chartMandiri', 'Mahasiswa Mandiri', chartData.Mandiri);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    document.getElementById("exportPDF").addEventListener("click", function () {
        const element = document.querySelector(".container");
        const noPrintEls = document.querySelectorAll(".no-print");
        const pdfHeader = document.querySelector(".pdf-header");
        const body = document.body; // Ambil elemen body
        const isDarkTheme = body.classList.contains("dark-theme"); // Cek apakah dark theme aktif

        // Tampilkan header khusus PDF
        pdfHeader.style.display = "block";

        // Sembunyikan elemen-elemen no-print
        noPrintEls.forEach(el => el.style.visibility = "hidden");

        // Hapus class dark-theme sementara
        if (isDarkTheme) {
            body.classList.remove("dark-theme");
        }

        // Jeda untuk memastikan perubahan DOM diterapkan
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

                // Balikin tampilan seperti semula
                noPrintEls.forEach(el => el.style.visibility = "visible");
                pdfHeader.style.display = "none";

                // Tambahkan kembali class dark-theme jika sebelumnya aktif
                if (isDarkTheme) {
                    body.classList.add("dark-theme");
                }
            });
        }, 500); // cukup 500ms, kalau lambat baru naikin ke 1000ms
    });
</script>

@endpush

@endsection



===================================================================================================================================================























<head>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <title>Hasil Rekomendasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EBEDF4;
        }
    </style>
</head>

@extends('layouts.app')

@section('title', 'Hasil Rekomendasi Gaya Belajar')

@section('content')

<style>
    @media print {
    .container {
        padding-top: 0 !important; /* Menghilangkan padding-top saat print */
        min-height: calc(100vh - 100px); /* Pastikan konten utama memenuhi layar */
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
        margin-bottom: 100px; /* Tambahkan jarak sebelum footer */
    }

    .container {
    color: #0E1F4D;
    }

    body {
    background-color: #EBEDF4; /* Warna latar belakang */
    font-family: 'Poppins', sans-serif; /* Pastikan font tetap konsisten */
    margin: 0;
    padding: 0;
    }

    .table-responsive {
    border-radius: 10px; /* Membuat sudut membulat */
    overflow: hidden; /* Memastikan konten tidak keluar dari sudut */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Menambahkan shadow */
    background-color: #ffffff; /* Warna latar belakang */
}

.container-rekomendasi {
    max-width: 100%; /* Pastikan lebar penuh */
    margin-bottom: 100px;
}

.container-rekomendasi .card-hasil-rekomendasi {
    width: 100%; /* Sesuaikan dengan lebar tabel */
    margin: 0 auto; /* Pusatkan jika diperlukan */
    margin-top: 20px; /* Jarak antara tabel dan section hasil rekomendasi */
}

.card-body {
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
}


.card-hasil {
    background-color: #ffffff; /* Warna latar belakang */
    color: #000000; /* Warna teks */
    border-radius: 10px; /* Membuat sudut membulat */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Menambahkan shadow */
}

.table-aspek {
    margin-bottom: 20px;
}

.table-aspek .table-light {
    background-color: #EBEDF4;
    border-color: #6C757D;
    color: #000000;
    text-align: center;
}

.table-aspek .kolom-aspek {
    border-radius: 5px; /* Membuat sudut membulat */
    overflow: hidden; /* Memastikan konten tidak keluar dari sudut */
    border-color: #6C757D;
    color: #000000;
}

.text-center-table {
    background-color:  #162449;
    color: #ffffff;
    text-align: center; /* Tambahkan baris ini untuk Nama asal sekolah jalur masuk akademik sekolah rata tengah*/
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
    background-color:  #162449;
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

<div class="pdf-header" style="display: none; padding: 20px; border-bottom: 2px solid #000; margin-bottom: 20px;">
    <div style="display: flex; align-items: center;">
        <img src="{{ asset('images/logocetakpdf.png') }}" alt="Logo" width="200" style="margin-right: 20px;">
        <div>
        <h2 class="mb-2 fw-bold position-relative d-inline" style="color: #0E1F4D;">Hasil Rekomendasi Gaya Belajar Mahasiswa</h2>
            <p style="margin: 0;">Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>
    </div>
</div>


<div class="container" style="padding-top: 0px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block no-print" style="padding-top: 70px;">
        Hasil Rekomendasi Gaya Belajar Mahasiswa
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>

    {{-- Informasi Kelas --}}
    <div class="card mb-2" style="border: none; background: none;">
        <div class="card-first-body">
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
                <canvas id="chartMandiri"></canvas>
            </div>
        </div>
    </div>
</div>

    <div class="container-rekomendasi">
        <div class="table-responsive rounded shadow-sm">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center-table" style="background-color: #162449;">
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
                    @forelse ($kelas->mahasiswa as $index => $mhs)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $mhs->nama_lengkap }}</td>
                            <td>{{ $mhs->asal_sekolah}}</td>
                            <td class="text-center">{{ $mhs->jalur_masuk }}</td>
                            {{-- Akademik (menggunakan atribut _text baru dari controller) --}}
                            <td class="text-center">{{ $mhs->akademik_text }}</td>
                            {{-- Sekolah (menggunakan atribut _text baru dari controller) --}}
                            <td class="text-center">{{ $mhs->sekolah_text }}</td>
                            {{-- Ekonomi (menggunakan atribut _text baru dari controller) --}}
                            <td class="text-center">{{ $mhs->ekonomi_text }}</td>
                            {{-- Perkuliahan (menggunakan atribut _text baru dari controller) --}}
                            <td class="text-center">{{ $mhs->perkuliahan_text }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">Belum ada data hasil rekomendasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-hasil p-4 mt-3 shadow-sm card-hasil-rekomendasi">
            <p>Berdasarkan data inputan di kelas <strong>{{ $kelas->nama_kelas }}</strong>, berikut ringkasan rekomendasi pembelajaran yang dapat kami berikan:</p>

            <table class="table-aspek table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Aspek</th>
                        <th>Alasan</th>
                    </tr>
                </thead>
                <tbody class="kolom-aspek">
                    <tr>
                        <td>Akademik dan Endurance</td>
                        <td>{{ $alasan['akademik_endurance'] }}</td>
                    </tr>
                    <tr>
                        <td>Latar Belakang</td>
                        <td>{{ $alasan['latar_belakang'] }}</td>
                    </tr>
                    <tr>
                        <td>Pola Belajar</td>
                        <td>{{ $alasan['pola_belajar'] }}</td>
                    </tr>
                    <tr>
                        <td>Perkuliahan</td>
                        <td>{{ $alasan['perkuliahan'] }}</td>
                    </tr>
                </tbody>
            </table>

            <p>Dengan demikian pembelajaran terbaik yang direkomendasikan adalah <strong>{{ $rekomendasi['akademik_endurance'] }}</strong>
            dengan tetap memperhatikan <strong>{{ $rekomendasi['latar_belakang'] }}</strong>,
            <strong>{{ $rekomendasi['pola_belajar'] }}</strong>,
            serta <strong>{{ $rekomendasi['perkuliahan'] }}</strong>.</p>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartData = @json($chartData);

    // Fungsi translateValue TIDAK LAGI DIGUNAKAN UNTUK TABEL KARENA SUDAH DI PHP,
    // tapi tetap ada di sini jika Anda butuh untuk logika frontend lain di masa depan.
    const translateValue = (aspect, value) => {
        value = parseFloat(value);
        if (aspect === 'akademik') {
            if (value <= 2) return 'RENDAH';
            if (value <= 3) return 'SEDANG';
            return 'TINGGI'; // Ini akan terjangkau jika nilai > 3, sesuaikan jika 3 sudah dianggap TINGGI
        } else if (aspect === 'sekolah') {
            if (value <= 2) return 'KURANG MENDUKUNG';
            if (value <= 3) return 'MENDUKUNG';
            return 'SANGAT MENDUKUNG';
        } else if (aspect === 'ekonomi') {
            if (value <= 2) return 'KURANG MENCUKUPI';
            if (value <= 3) return 'MENCUKUPI';
            return 'SANGAT MENCUKUPI';
        } else if (aspect === 'perkuliahan') {
            if (value <= 2) return 'KURANG BAIK';
            if (value <= 3) return 'BAIK';
            return 'SANGAT BAIK';
        }
        return value;
    };

    const createChart = (ctxId, label, data) => {
        const ctx = document.getElementById(ctxId).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Akademik', 'Latar Belakang', 'Pola Belajar', 'Perkuliahan'],
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
                        max: 3
                    }
                }
            }
        });
    };
    createChart('chartSNBP', 'Mahasiswa SNBP', chartData.SNBP);
    createChart('chartSNBT', 'Mahasiswa SNBT', chartData.SNBT);
    createChart('chartMandiri', 'Mahasiswa Mandiri', chartData.Mandiri);
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

        // Tampilkan header khusus PDF
        pdfHeader.style.display = "block";

        // Sembunyikan elemen-elemen no-print
        noPrintEls.forEach(el => el.style.visibility = "hidden");

        // Hapus class dark-theme sementara
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

                // Balikin tampilan seperti semula
                noPrintEls.forEach(el => el.style.visibility = "visible");
                pdfHeader.style.display = "none";

                // Tambahkan kembali class dark-theme jika sebelumnya aktif
                if (isDarkTheme) {
                    body.classList.add("dark-theme");
                }
            });
        }, 500);
    });
</script>

@endpush

@endsection
