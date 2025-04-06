@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">{{ $data['nama_kelas'] }}</h2>

    <!-- Ringkasan -->
    <div class="mb-4 p-3 bg-light rounded shadow-sm">
        <p><strong>Total Mahasiswa:</strong> {{ count($data['siswa']) }}</p>
        <p><strong>Visual:</strong> {{ $data['count']['Visual'] }}</p>
        <p><strong>Auditori:</strong> {{ $data['count']['Auditori'] }}</p>
        <p><strong>Kinestetik:</strong> {{ $data['count']['Kinestetik'] }}</p>
        <p>🎯 <strong>Metode Dominan:</strong> {{ $data['dominant'] }}</p>
    </div>

    <!-- Pie Chart -->
    <div class="mb-4">
        <canvas id="pieChart"></canvas>
    </div>

    <!-- Tabel Siswa -->
    <div class="table-responsive">
        <table class="table table-bordered rounded shadow">
            <thead class="text-white" style="background-color: #0E1F4D;">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jalur Masuk</th>
                    <th>Metode Belajar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['siswa'] as $siswa)
                <tr>
                    <td>{{ $siswa['nama'] }}</td>
                    <td>{{ $siswa['email'] }}</td>
                    <td>{{ $siswa['jalur_masuk'] }}</td>
                    <td>
                        <span class="badge 
                            {{ $siswa['metode'] == 'Visual' ? 'bg-primary' : ($siswa['metode'] == 'Auditori' ? 'bg-success' : 'bg-warning') }}">
                            {{ $siswa['metode'] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tombol Aksi -->
    <div class="d-flex gap-2 mt-3">
        <a href="#" class="btn btn-warning">✏️ Edit Data Kelas</a>
        <a href="#" class="btn btn-danger">🖨️ Export PDF</a>
        <a href="#" class="btn btn-success">📥 Simpan ke Database</a>
        <form method="POST" action="{{ route('generate.metode') }}">
            @csrf
            <button type="submit" class="btn btn-info">🧠 Re-generate Metode</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('pieChart');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Visual', 'Auditori', 'Kinestetik'],
        datasets: [{
            label: 'Distribusi Metode',
            data: [{{ $data['count']['Visual'] }}, {{ $data['count']['Auditori'] }}, {{ $data['count']['Kinestetik'] }}],
            backgroundColor: ['#0d6efd', '#198754', '#ffc107']
        }]
    }
});
</script>
@endsection
