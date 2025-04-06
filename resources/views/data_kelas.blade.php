@foreach(session('kelas_tersimpan', []) as $kelas)
    <div class="card mb-4 p-3">
        <h4>{{ $kelas['nama_kelas'] }} ({{ $kelas['kode_mk'] }})</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jalur</th>
                    <th>Metode Belajar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas['siswa'] as $s)
                    <tr>
                        <td>{{ $s['nama'] }}</td>
                        <td>{{ $s['email'] }}</td>
                        <td>{{ $s['jalur_masuk'] }}</td>
                        <td>{{ $s['metode'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('data.kelas.edit', $loop->index) }}" class="btn btn-warning btn-sm">Edit Kelas</a>
    </div>
@endforeach
