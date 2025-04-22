@extends('layouts.app')

@section('title', 'Hasil Rekomendasi Gaya Belajar')

@section('content')

<style>
    @media print {
    .container {
        padding-top: 0 !important; /* Menghilangkan padding-top saat print */
    }
}

    #profilChart {
    max-width: 400px;
    max-height: 400px;
    margin: 0 auto;
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
    <h2 class="mb-2 fw-bold position-relative d-inline-block no-print" style="color: #0E1F4D; padding-top: 70px;">
        Hasil Rekomendasi Gaya Belajar Mahasiswa
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #ffffff;"></span>
    </h2>

    {{-- Informasi Kelas --}}
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title"><strong>📘 Informasi Kelas</strong></h5>
            <p>Nama Kelas:
            <span class="badge bg-success fs-6">{{ $kelas->nama_kelas }}</span>
            </p>

            <p>Kode Mata Kuliah:
                <span class="badge bg-warning text-dark fs-6">{{ $kelas->kode_mata_kuliah }}</span>
            </p>
            <p>Dosen Pengampu:
            <span class="badge bg-success fs-6">{{ auth()->user()->nama }}</span>
            </p>
            <div class="text-end mb-1">
    <button id="exportPDF" class="btn btn-danger no-print">
        <i class="bi bi-file-earmark-pdf"></i> Export as PDF
    </button>
</div>
    </div>
    </div>


    {{-- Tambahkan canvas di atas tabel --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
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

    {{-- Tabel Hasil Rekomendasi --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Asal Sekolah</th>
                    <th>Jalur Masuk</th>
                    <th>Akademik dan Endurance</th>
                    <th>Latar Belakang</th>
                    <th>Pola Belajar</th>
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
                        <td class="text-center">{{ $mhs->akademik_endurance }}</td>
                        <td class="text-center">{{ $mhs->latar_belakang }}</td>
                        <td class="text-center">{{ $mhs->pola_belajar }}</td>
                        <td class="text-center">{{ $mhs->perkuliahan}}</td>
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

{{-- Section: Hasil Rekomendasi --}}
<div class="card p-4 mt-3 shadow-sm">
    <p>
        Berdasarkan data inputan di kelas <strong>{{ $kelas->nama_kelas }}</strong>, 
        dapat diketahui bahwa pembelajaran yang direkomendasikan adalah 
        <strong>{{ $rekomendasi['akademik_endurance'] }}</strong>, 
        dengan memerhatikan <strong>{{ $rekomendasi['latar_belakang'] }}</strong> 
        dan juga menggunakan <strong>{{ $rekomendasi['pola_belajar'] }}</strong>, 
        serta menggunakan <strong>{{ $rekomendasi['perkuliahan'] }}</strong>.
    </p>
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
                        data.akademik_endurance,
                        data.latar_belakang,
                        data.pola_belajar,
                        data.perkuliahan
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

        // Tampilkan header khusus PDF
        pdfHeader.style.display = "block";

        // Sembunyikan elemen-elemen no-print
        noPrintEls.forEach(el => el.style.visibility = "hidden");

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
            });
        }, 500); // cukup 500ms, kalau lambat baru naikin ke 1000ms
    });
</script>







@endpush

@endsection
