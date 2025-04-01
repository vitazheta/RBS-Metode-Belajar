@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg" style="width: 800px; border-radius: 10px; overflow: hidden;">
        <div class="row g-0">
            <!-- Bagian Info dan Sign In -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center bg-success text-white text-center p-5">
                <h2 class="fw-bold">Halo, Dosen!</h2>
                <p>Sudah memiliki akun? Silakan login dengan tombol di bawah</p>
                <!-- Tombol Sign In Dipindah ke Sini -->
                <a href="{{ route('login') }}" class="btn btn-outline-light w-100 rounded-pill py-2">SIGN IN</a>
            </div>

            <!-- Bagian Form Register -->
            <div class="col-md-6 bg-white p-5">
                <h2 class="fw-bold text-center">SIGN UP</h2>
                <p class="text-center">Daftarkan diri Anda dan segera mulai gunakan website ini</p>
                <form action="{{ route('register') }}" method="POST">
    @csrf
    <div class="mb-3">
    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>

        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required value="{{ old('username') }}">
        @error('username') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
        @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-success w-100 rounded-pill py-2">SIGN UP</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>
@endsection
