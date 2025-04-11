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
        'username' => 'required|string',
        'password' => 'required',
    ]);

    //Cek username terdaftar
    $user = Dosen::where('username', $request->username)->first();

    if (!$user) {
        return redirect()->back()->with('login_error', 'Akun Anda belum terdaftar!');
    }

    // Attempt to log the user in
    if (Auth::guard('dosen')->attempt(['username' => $request->username, 'password' => $request->password])) {
        // Redirect ke dashboard setelah login berhasil
        return redirect()->route('dashboard.dosen');
    }

    // Jika login gagal, kirimkan pesan error dan kembali ke halaman login
    return back()->with('login_error', 'Username atau password salah');
}

public function logout()
{
    Auth::guard('dosen')->logout();
    return redirect()->route('login');
}

}
