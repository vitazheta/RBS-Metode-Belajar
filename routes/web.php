<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DynamicTableController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MetodeController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman dynamic table
Route::middleware(['auth'])->group(function() {
    Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table');

});
Route::post('/import', [ImportController::class, 'processImport'])->name('import.process');
// ROute untuk hal dynamic tabel harus loigin dulu

Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table');

// Route Authentication
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk dashboard dosen (hanya bisa diakses setelah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-dosen', [DashboardDosenController::class, 'dashboard'])->name('dashboard.dosen');
});

//Route untuk data kelas
//use App\Http\Controllers\KelasController;
Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');

//Route untuk controller generate
Route::post('/generate-metode', [MetodeController::class, 'generate'])->name('generate.metode');
Route::get('/data-kelas', [MetodeController::class, 'showDataKelas'])->name('data.kelas');

//Route untuk proses generate dan tampilkan data kelas
Route::post('/generate-metode', [App\Http\Controllers\KelasController::class, 'generateMetode'])->name('generate.metode');
Route::get('/data-kelas', [App\Http\Controllers\KelasController::class, 'dataKelas'])->name('data.kelas');

