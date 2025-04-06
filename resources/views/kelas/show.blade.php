@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $kelas->nama_kelas }}</h2>
    <p>Kode Mata Kuliah: {{ $kelas->kode_matkul }}</p>

    <table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jalur Masuk</th>
            <th>Akademik</th>
            <th>Ekonomi</th>
            <th>Endurance</th>
            <th>Profil Sekolah</th>
            <th>Profil Ortu</th>
            <th>Pola Belajar</th>
            <th>Adaptasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kelas->mahasiswa as $index => $mahasiswa)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->email }}</td>
            <td>{{ $siswa->jalur_masuk }}</td>
            <td>{{ $siswa->akademik }}</td>
            <td>{{ $siswa->ekonomi }}</td>
            <td>{{ $siswa->endurance }}</td>
            <td>{{ $siswa->profil_sekolah }}</td>
            <td>{{ $siswa->profil_ortu }}</td>
            <td>{{ $siswa->pola_belajar }}</td>
            <td>{{ $siswa->adaptasi }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection