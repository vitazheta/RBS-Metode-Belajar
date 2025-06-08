<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DynamicTableController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RekomendasiMetodeController;
use App\Http\Controllers\HasilRekomendasiController;
use Dflydev\DotAccessData\Data;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\DataMahasiswaController;



/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
*/

Route::get('/pelajari-lebih-lanjut', [InfoController::class, 'showPelajari'])->name('pelajari');

Route::get('/tutorial', [InfoController::class, 'showTutorial'])->name('tutorial');

Route::get('/pelajari', function () {
    return view('info.pelajari');
})->name('pelajari');

Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman dynamic table
// Route yang butuh login sebagai dosen
Route::middleware(['auth:dosen'])->group(function () {
    Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table');
    Route::get('/dashboard-dosen', [DashboardDosenController::class, 'dashboard'])->name('dashboard.dosen');
    Route::get('/hasil-rekomendasi/{id}', [HasilRekomendasiController::class, 'show'])->name('hasil.rekomendasi');
    Route::get('/daftar-kelas', [KelasController::class, 'index'])->name('kelas.index');

});

Route::post('/import', [ImportController::class, 'processImport'])->name('import.process');



// ROute untuk hal dynamic tabel harus loigin dulu
Route::post('/dynamic-table', [DynamicTableController::class, 'store'])->name('dynamic-table.store');

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
Route::post('/kelas/store', [KelasController::class, 'generate'])->name('kelas.store');

Route::post('/kelas/generate', [KelasController::class, 'generate'])->name('kelas.generate');

Route::post('/generate-data', [KelasController::class, 'generateData'])->name('kelas.generateData');

Route::post('/generate', [DataMahasiswaController::class, 'generate']);

Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');

Route::post('/simpan-mahasiswa', [DataMahasiswaController::class, 'simpan'])->name('simpan.mahasiswa');

Route::post('/import-csv', [DataMahasiswaController::class, 'import'])->name('import.csv');

Route::get('/hasil-rekomendasi/{id}', [HasilRekomendasiController::class, 'show'])->name('hasil.rekomendasi');

Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

// Halaman dynamic table (input kelas, upload excel, dynamic table)
Route::middleware(['auth:dosen'])->group(function () {
    Route::get('/dynamic-table', [FileUploadController::class, 'showUploadForm'])->name('dynamic.table');
    Route::post('/upload-excel', [FileUploadController::class, 'processUpload'])->name('upload.xlsx.process');
    Route::post('/simpan-mahasiswa', [DataMahasiswaController::class, 'simpan'])->name('simpan.mahasiswa');
    Route::get('/hasil-rekomendasi/{id}', [HasilRekomendasiController::class, 'show'])->name('hasil.rekomendasi');
});

Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table');
Route::get('/dynamic-table', [FileUploadController::class, 'showUploadForm'])->name('dynamic.table');
