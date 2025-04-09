<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DynamicTableController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RekomendasiMetodeController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman dynamic table
// Route yang butuh login sebagai dosen
Route::middleware(['auth:dosen'])->group(function () {
    Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table');
    Route::get('/dashboard-dosen', [DashboardDosenController::class, 'dashboard'])->name('dashboard.dosen');
});

Route::post('/import', [ImportController::class, 'processImport'])->name('import.process');

// Route::post('/dynamic-table', [NamaController::class, 'store'])->name('dynamic-table.store');


// ROute untuk hal dynamic tabel harus loigin dulu
Route::post('/dynamic-table', [DynamicTableController::class, 'store'])->name('dynamic-table.store');

// Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table');

// Route Authentication
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk dashboard dosen (hanya bisa diakses setelah login)
Route::middleware(['auth:dosen'])->group(function() {
    Route::get('/dashboard-dosen', [DashboardDosenController::class, 'dashboard'])->name('dashboard.dosen');
});

//Route untuk data kelas
Route::get('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');

//Route::post('/kelas/generate', [KelasController::class, 'generate'])->name('kelas.generate');

Route::post('/kelas/generate', [KelasController::class, 'generate'])->name('kelas.generate');

Route::post('/import-csv', [MahasiswaController::class, 'importCSV'])->name('import.process');


use App\Http\Controllers\DataMahasiswaController;

Route::post('/generate', [DataMahasiswaController::class, 'generate']);




//Route daftar kelas
//Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
//Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');

//Route rekomendasi metode belajar
//Route::get('/rekomendasi', [RekomendasiMetodeController::class, 'index'])->name('rekomendasi.metode');

