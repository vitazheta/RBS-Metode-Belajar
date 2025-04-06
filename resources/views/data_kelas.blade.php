@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Kelas</h2>

    @if(session('kelas_tersimpan') && is_array(session('kelas_tersimpan')))
        @foreach(session('kelas_tersimpan') as $index => $kelas)
            <div class="card mb-5 shadow rounded">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0">{{ $kelas['nama_kelas'] }} - {{ $kelas['kode_mk'] }}</h5>
                </div>
                <div class="card-body">
                    <!-- Ringkasan -->
                    <div class="mb-3">
                        <p>Total Mahasiswa: {{ count($kelas['siswa']) }}</p>
                        <p>Visual: {{ collect($kelas['siswa'])->where('metode', 'Visual')->count() }}</p>
                        <p>Auditori: {{ collect($kelas['siswa'])->where('metode', 'Auditori')->count() }}</p>
                        <p>Kinestetik: {{ collect($kelas['siswa'])->where('metode', 'Kinestetik')->count() }}</p>
                        <p class="fw-bold">🎯 Metode Dominan: 
                            {{
                                collect($kelas['siswa'])
                                    ->groupBy('metode')
                                    ->sortByDesc(fn($g) => count($g))
                                    ->keys()
                                    ->first() ?? '-'
                            }}
                        </p>
                    </div>

                    <!-- Tabel Detail Siswa -->
                    <div class="table-responsive">
                        <table class="table table-bordered rounded overflow-hidden">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jalur Masuk</th>
                                    <th>Metode Belajar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kelas['siswa'] as $siswa)
                                    <tr>
                                        <td>{{ $siswa['nama'] }}</td>
                                        <td>{{ $siswa['email'] }}</td>
                                        <td>{{ $siswa['jalur_masuk'] }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($siswa['metode'] == 'Visual') bg-info 
                                                @elseif($siswa['metode'] == 'Auditori') bg-success 
                                                @else bg-warning text-dark @endif">
                                                {{ $siswa['metode'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-3 d-flex flex-wrap gap-2">
                        <a href="#" class="btn btn-sm btn-secondary">✏️ Edit Data Kelas</a>
                        <a href="#" class="btn btn-sm btn-info text-white">🖨️ Export PDF</a>
                        <a href="#" class="btn btn-sm btn-success">📥 Simpan ke Database</a>
                        <a href="#" class="btn btn-sm btn-warning">🧠 Re-generate Metode</a>
                    </div>

                    <!-- Pie Chart -->
                    <div class="mt-4">
                        <canvas id="chart-{{ $index }}"></canvas>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Belum ada data kelas yang tersimpan.</p>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(session('kelas_tersimpan'))
        @foreach(session('kelas_tersimpan') as $index => $kelas)
            const ctx{{ $index }} = document.getElementById('chart-{{ $index }}').getContext('2d');
            new Chart(ctx{{ $index }}, {
                type: 'pie',
                data: {
                    labels: ['Visual', 'Auditori', 'Kinestetik'],
                    datasets: [{
                        data: [
                            {{ collect($kelas['siswa'])->where('metode', 'Visual')->count() }},
                            {{ collect($kelas['siswa'])->where('metode', 'Auditori')->count() }},
                            {{ collect($kelas['siswa'])->where('metode', 'Kinestetik')->count() }}
                        ],
                        backgroundColor: ['#0dcaf0', '#198754', '#ffc107']
                    }]
                }
            });
        @endforeach
    @endif
</script>
@endsection
