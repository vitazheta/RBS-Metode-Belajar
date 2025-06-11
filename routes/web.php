<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DynamicTableController; // Perlu diklarifikasi apakah ini masih dipakai
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RekomendasiMetodeController; // Tidak terlihat dipakai di sini
use App\Http\Controllers\HasilRekomendasiController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\FileUploadController; // Ini untuk upload Excel
use App\Http\Controllers\DataMahasiswaController; // Ini untuk simpan mahasiswa
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
*/

// Rute untuk Lupa Password (Password Reset Routes) - Ini sudah benar
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Rute Halaman Umum (Tidak memerlukan login)
// Pilih salah satu untuk 'pelajari'. Saya sarankan '/pelajari' agar lebih singkat.
Route::get('/pelajari', [InfoController::class, 'showPelajari'])->name('pelajari');
// Jika '/pelajari-lebih-lanjut' juga dibutuhkan, beri nama unik atau hapus:
// Route::get('/pelajari-lebih-lanjut', [InfoController::class, 'showPelajariLanjut'])->name('pelajari.lanjut'); // Contoh nama unik
Route::get('/tutorial', [InfoController::class, 'showTutorial'])->name('tutorial');

Route::get('/', function () {
    return view('welcome');
});

// Route Authentication - Ini sudah benar
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- Rute yang hanya bisa diakses setelah login sebagai dosen ---
Route::middleware(['auth:dosen'])->group(function () {

    // Dashboard Dosen
    Route::get('/dashboard-dosen', [DashboardDosenController::class, 'dashboard'])->name('dashboard.dosen');

    // Halaman Data Kelas (Dynamic Table, Upload Excel, Simpan Mahasiswa)
    Route::get('/dynamic-table', [FileUploadController::class, 'showUploadForm'])->name('dynamic.table');
    Route::post('/upload-excel', [FileUploadController::class, 'processUpload'])->name('upload.xlsx.process');
    Route::post('/simpan-mahasiswa', [DataMahasiswaController::class, 'simpan'])->name('simpan.mahasiswa');

    // Daftar Kelas
    Route::get('/daftar-kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // Rute Hasil Rekomendasi
    // Hanya perlu satu definisi untuk ini
    Route::get('/hasil-rekomendasi/{id}', [HasilRekomendasiController::class, 'show'])->name('hasil.rekomendasi');


    // Rute Kelas (jika ini untuk manipulasi kelas setelah import atau generate)
    Route::post('/kelas/store', [KelasController::class, 'generate'])->name('kelas.store'); // Nama ini mungkin membingungkan, 'generate' atau 'store'?
    Route::post('/kelas/generate', [KelasController::class, 'generate'])->name('kelas.generate'); // Duplikasi jika kelas.store juga generate
    Route::post('/generate-data', [KelasController::class, 'generateData'])->name('kelas.generateData'); // Sepertinya ini fungsi utama generate
    // Route::post('/generate', [DataMahasiswaController::class, 'generate']); // Ini tidak punya nama, dan fungsinya sama dengan kelas.generateData?
    // Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store'); // Duplikasi lagi dengan kelas/store di atas?

    // PENTING: Perlu klarifikasi fungsi dari rute-rute di bawah ini agar tidak ada duplikasi atau rute mati
    // Jika 'kelas.store' dan 'kelas.generate' serta '/generate-data' melakukan hal serupa, pilih satu atau beri nama yang sangat jelas.
    // Misal:
    // Route::post('/kelas/simpan-kelas-master', [KelasController::class, 'store'])->name('kelas.store.master');
    // Route::post('/kelas/generate-rekomendasi', [KelasController::class, 'generate'])->name('kelas.generate.rekomendasi');
    // Route::post('/data-mahasiswa/generate-from-form', [DataMahasiswaController::class, 'generate'])->name('mahasiswa.generate.form');

});

// Rute Import CSV (jika ini bukan bagian dari dynamic.table, letakkan di luar middleware dosen jika bisa diakses non-dosen)
// Jika ini bagian dari alur dosen, pindahkan ke dalam group middleware di atas
// Route::post('/import-csv', [DataMahasiswaController::class, 'import'])->name('import.csv');
