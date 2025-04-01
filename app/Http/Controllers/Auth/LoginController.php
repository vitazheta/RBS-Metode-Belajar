<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen; // Pastikan menggunakan model yang sesuai

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function redirectTo()
{
    return route('dashboard.dosen'); // Pastikan route ini benar
}


public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to log the user in
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Redirect ke dashboard setelah login berhasil
        return redirect()->route('dashboard.dosen');
    }

    // Jika login gagal, kirimkan pesan error dan kembali ke halaman login
    return back()->with('login_error', 'Email atau password salah');
}



    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
