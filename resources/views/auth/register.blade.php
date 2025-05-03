<body style="background-color: #EBEDF4;">

@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card" style="
    position: relative;
    z-index: 10;
    width: 800px; 
    border: none; /* Menghilangkan border */
    border-radius: 40px; 
    overflow: visible;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Shadow halus */">
        <div class="row g-0">
            <!-- Bagian Info dan Sign In -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white text-center p-5" 
            style="
            background-color: #0E1F4D;
            border-radius: 20px;
            border-top-right-radius: 0px;  /* Sudut kanan atas melengkung */
            border-bottom-right-radius: 0px; /* Sudut kanan bawah melengkung */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Shadow halus */">
                <h2 class="fw-bold">
                <span style="color: white;">Halo,</span> 
                <span style="color: #F37AB0;">Dosen!</span>
                </h2>
                <p>Sudah memiliki akun? Silakan login dengan tombol di bawah</p>
                <a href="{{ route('login') }}" class="btn btn-outline-light w-100 rounded-pill py-2">SIGN IN</a>
            </div>

            <!-- Bagian Form Register -->
            <div class="col-md-6 bg-white p-5" 
            style="
            border-radius: 20px;
            border-top-left-radius: 0;  /* Sudut kiri atas tetap tajam */
            border-bottom-left-radius: 0;  /* Sudut kiri bawah tetap tajam */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Shadow halus */">
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
        <button type="submit" class="btn text-white w-100 rounded-pill py-2" style="background-color: #0E1F4D;">SIGN UP</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>
@endsection
