@extends('layouts.app')

@section('title', 'Upload File Excel')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Upload File Excel</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('upload.xlsx.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Pilih File Excel (.xlsx)</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required>
            @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    @if(session('processedData'))
        <h2 class="mt-5">Data yang Sudah Diproses</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Asal Sekolah</th>
                    <th>Jalur Masuk</th>
                    <th>Akademik Endurance</th>
                    <th>Latar Belakang</th>
                    <th>Pola Belajar</th>
                    <th>Lingkungan Perkuliahan</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('processedData') as $data)
                    <tr>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ $data['asal_sekolah'] }}</td>
                        <td>{{ $data['jalur_masuk'] }}</td>
                        <td>{{ $data['akademik_endurance'] }}</td>
                        <td>{{ $data['latar_belakang'] }}</td>
                        <td>{{ $data['pola_belajar'] }}</td>
                        <td>{{ $data['lingkungan_perkuliahan'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol Download CSV -->
        <a href="{{ route('download.csv') }}" class="btn btn-success mt-3">Download CSV</a>
    @endif
</div>
@endsection