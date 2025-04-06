@extends('layouts.app')

@section('content')

<h2>Daftar Kelas</h2>

@foreach ($daftarKelas as $kelas)
    <a href="{{ route('kelas.show', $kelas->id) }}">
        <div style="padding: 10px; background: #e4e4e4; margin: 10px 0;">
            <strong>{{ $kelas->nama_kelas }}</strong><br>
            Kode Mata Kuliah: {{ $kelas->kode_matkul }}
        </div>
    </a>
@endforeach
@endsection