<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');  // Pastikan ada view auth.register
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',  // 'name' harus ada
            'email' => 'required|string|email|max:255|unique:dosen',
            'username' => 'required|string|max:255|unique:dosen',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Dosen::create([
            'nama' => $request->name,  // HARUS MENGAMBIL DARI REQUEST
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
