<body style="background-image: url('{{ asset('images/bg2.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg" style="
    position: relative;
    z-index: 10;
    width: 800px; 
    border: none; /* Menghilangkan border */
    border-radius: 30px; 
    overflow: visible;
    box-shadow: 0px 10px 40px 10px #84A7CF inset; /* Shadow biru tebal */">
        <div class="row g-0">
            <!-- Bagian Form Login -->
            <div class="col-md-6 bg-white p-5" style="
            box-shadow: -15px 0px 50px #35455C; 
            border-radius: 20px; 
            border-top-right-radius: 0px;  /* Sudut kanan atas melengkung */
            border-bottom-right-radius: 0px; /* Sudut kanan bawah melengkung */">
                <h2 class="fw-bold text-center">Sign in</h2>
                <p class="text-center">Masuk dengan akun yang telah Anda miliki</p>

                @if (session('login_error'))
                    <div class="alert alert-danger">
                        {{ session('login_error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="username" name="username" class="form-control" placeholder="Username" required>
    </div>
    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="text-center">
        <a href="#" class="text-decoration-none text-muted">Lupa kata sandi anda?</a>
    </div>
    <div class="text-center mt-3">
        <button type="submit" class="btn text-white w-100 rounded-pill py-2" style="background-color: #0E1F4D;">SIGN IN</button>
    </div>
</form>

            </div>

            <!-- Bagian Info dan Sign Up -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white text-center p-5" 
            style="
            background-color: #0E1F4D; 
            box-shadow: 15px 0px 50px #0E1F4D; 
            border-radius: 20px; 
            border-top-left-radius: 0;  /* Sudut kiri atas tetap tajam */
            border-bottom-left-radius: 0;  /* Sudut kiri bawah tetap tajam */">
                <h2 class="fw-bold">
                <span style="color: white;">Halo,</span> 
                <span style="color: #F37AB0;">Dosen!</span>
                </h2>
                <p>Daftarkan diri Anda dan segera mulai gunakan website ini</p>
                <a href="{{ route('register') }}" class="btn btn-outline-light w-100 rounded-pill py-2">SIGN UP</a>
            </div>
        </div>
    </div>
</div>
@endsection
