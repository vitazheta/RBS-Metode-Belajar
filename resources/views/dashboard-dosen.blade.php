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
    .btn-custom {
    background-color: #FF6B6B !important; /* Merah muda */
    border: none;
    color: white;
    }
</style>

<div class="container py-0"> <!-- Ubah dari py-5 ke py-3 -->
<h2 class="mb-3 fw-bold position-relative d-inline-block" style="color: #0E1F4D;">
    Dashboard Dosen
<span class="d-block mt-1" style="height: 4px; width: 100%; background-color: #84A7CF;"></span>
</h2>
<p class="text-muted fs-5">Halo, <strong> {{ucwords($dosen->nama)}}!</strong> Berikut daftar kelas yang Anda ampu.</p>

<!-- Section Tambah Kelas (pindah ke atas) -->
<div class="card shadow-sm p-4 mb-5 position-relative" style="border: none; background-color: #ffffff;">
    <div class="card-body">
        <div>
            <h5 class="fw-bold mb-2">Ingin menambahkan kelas?</h5>
            <p class="text-muted mb-3">Klik tombol di bawah ini untuk menambahkan kelas baru ke sistem.</p>
            <!-- Tombol Tambah Kelas -->
            <a href="{{ url('/dynamic-table') }}" class="btn text-white btn-lg px-2 py-1" style="background-color: #F37AB0; font-size: 0.8rem; padding: 6px 12px;">
            <i class="fas fa-plus me-2"></i> Tambah Kelas
            </a>
        </div>
    </div>

    <!-- Gambar kecil kanan dalam -->
    <img src="{{ asset('images/img-dashboard.png') }}" alt="Icon Tambah Kelas"
        style="position: absolute; right: 50px; bottom: 20px; height: 150px;">
</div>

    <div class="row g-6">
        <!-- Kotak Jumlah Kelas -->
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

        <!-- Kotak Metode Dominan -->
        <div class="col-md-4">
            <div class="card shadow-sm text-white mb-3 position-relative"
            style="background-color: #84A7CF; border: none;">
                <div class="card-body">
                    <h5 class="card-title">Metode Dominan</h5>
                    <p class="card-text display-4">{{ $metode_dominan }}</p>
                    <i class="fas fa-chalkboard-teacher position-absolute siluet"></i>
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
                    <p class="mt-2">Persentase Gaya Belajar</p>
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
            type: 'doughnut',
            data: {
                labels: ["Akademik dan Endurance", "Latar Belakang", "Pola Belajar", "Proses Perkuliahan"],
                datasets: [{
                    data: [{{ $k->persen_visual }}, {{ $k->persen_auditori }}, {{ $k->persen_kinestetik }}],
                    backgroundColor: [
    "#1E2E45", // Biru tua untuk Visual
    "#748DAC", // Biru muda untuk Auditori
    "#E0E1DC"  // Cream untuk Kinestetik
]
,
                    hoverOffset: 10 // Efek animasi saat hover
                }]
            },
            options: {
                responsive: true,
                cutout: "70%",
                plugins: {
                    legend: { display: false }
                },
                animation: {
                    animateRotate: true, // Animasi rotasi saat muncul
                    animateScale: true  // Animasi pembesaran saat muncul
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let value = tooltipItem.raw;
                                return value + "%"; // Menampilkan persen di tooltip
                            }
                        }
                    }
                }
            }
        });

        // Tambahkan teks di tengah
        Chart.register({
    id: 'centerText',
    beforeDraw: function(chart) {
        var width = chart.width,
            height = chart.height,
            ctx = chart.ctx;

        ctx.save();
        ctx.font = "bold 20px Poppins, sans-serif"; // Lebih besar & tebal
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";

        let data = chart.data.datasets[0].data;
        let labels = chart.data.labels;

        let maxIndex = data.indexOf(Math.max(...data));
        let dominantMethod = labels[maxIndex]; // Gaya belajar dominan

        // Posisi teks di tengah
        var textX = width / 2;
        var textY = height / 2;

        ctx.fillText(dominantMethod, textX, textY);
        ctx.restore();
    }
});



        chart.update(); // Update chart setelah menambahkan teks tengah
    }
    @endforeach
});
</script>
@endsection
