@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .siluet {
        right: 10px;
        bottom: 10px;
        font-size: 80px;
        opacity: 0.2;
        transform: rotate(-15deg); /* Membuat ikon miring */

    }
</style>

<div class="container py-5">
    <h2 class="mb-4 fw-bold">Dashboard Dosen</h2>
    <div class="row">
        <!-- Kotak Jumlah Kelas -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 position-relative">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Kelas</h5>
                    <p class="card-text display-4">{{ $jumlah_kelas }}</p>
                    <i class="fas fa-school position-absolute siluet"></i>
                </div>
            </div>
        </div>

        <!-- Kotak Total Mahasiswa -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 position-relative">
                <div class="card-body">
                    <h5 class="card-title">Total Mahasiswa</h5>
                    <p class="card-text display-4">{{ $total_mahasiswa }}</p>
                    <i class="fas fa-user-graduate position-absolute siluet"></i>
                </div>
            </div>
        </div>

        <!-- Kotak Metode Dominan -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3 position-relative">
                <div class="card-body">
                    <h5 class="card-title">Metode Dominan</h5>
                    <p class="card-text display-4">{{ $metode_dominan }}</p>
                    <i class="fas fa-chalkboard-teacher position-absolute siluet"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Kelas -->
    <div class="row">
        @foreach ($kelas as $index => $k)
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
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
                labels: ["Visual", "Auditori", "Kinestetik"],
                datasets: [{
                    data: [{{ $k->persen_visual }}, {{ $k->persen_auditori }}, {{ $k->persen_kinestetik }}],
                    backgroundColor: [
    "#3498db", // Biru untuk Visual
    "#f1c40f", // Kuning untuk Auditori
    "#e74c3c"  // Merah untuk Kinestetik
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
