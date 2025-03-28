@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg" style="width: 800px; border-radius: 10px; overflow: hidden;">
        <div class="row g-0">
            <!-- Bagian Form Login -->
            <div class="col-md-6 bg-white p-5">
                <h2 class="fw-bold text-center">Sign in</h2>
                <p class="text-center">Masuk dengan akun yang telah Anda miliki</p>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email atau username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="text-center">
                        <a href="#" class="text-decoration-none text-muted">Lupa kata sandi anda?</a>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success w-100 w-100 rounded-pill py-2">SIGN IN</button>
                    </div>
                </form>
            </div>

            <!-- Bagian Info dan Sign Up -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center bg-success text-white text-center p-5">
                <h2 class="fw-bold">Halo, Dosen!</h2>
                <p>Daftarkan diri Anda dan segera mulai gunakan website ini</p>
                <a href="{{ route('register') }}" class="btn btn-outline-light w-100 rounded-pill py-2">SIGN UP</a>
            </div>
        </div>
    </div>
</div>
@endsection
