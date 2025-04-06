@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Data Kelas: {{ $kelas->nama_kelas }} ({{ $kelas->kode_mata_kuliah }})</h2>

    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        @foreach($kelas->siswa as $index => $siswa)
        <div class="card mb-3">
            <div class="card-header">Siswa {{ $index + 1 }}</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Nama</label>
                        <input type="text" name="nama[]" class="form-control" value="{{ $siswa->nama }}">
                    </div>
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" name="email[]" class="form-control" value="{{ $siswa->email }}">
                    </div>
                    <div class="col-md-4">
                        <label>Jalur Masuk</label>
                        <select name="jalur_masuk[]" class="form-control">
                            <option value="SNBP" {{ $siswa->jalur_masuk == 'SNBP' ? 'selected' : '' }}>SNBP</option>
                            <option value="SNBT" {{ $siswa->jalur_masuk == 'SNBT' ? 'selected' : '' }}>SNBT</option>
                            <option value="Mandiri UPI" {{ $siswa->jalur_masuk == 'Mandiri UPI' ? 'selected' : '' }}>Mandiri UPI</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
