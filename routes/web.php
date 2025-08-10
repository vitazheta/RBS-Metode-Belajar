<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DynamicTableController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RekomendasiMetodeController; // Tidak terlihat dipakai di sini
use App\Http\Controllers\HasilRekomendasiController;
use Dflydev\DotAccessData\Data; // Ini tidak digunakan, bisa dihapus jika mau
use App\Http\Controllers\InfoController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\DeveloperController;


// TAMBAHAN: Import Controller untuk Password Reset
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk Lupa Password (Password Reset Routes) - TAMBAHAN
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// Rute Halaman Umum (Tidak memerlukan login)
Route::get('/pelajari-lebih-lanjut', [InfoController::class, 'showPelajari'])->name('pelajari.lanjut'); // Nama rute yang lebih spesifik
Route::get('/pelajari', function () {
    return view('info.pelajari');
})->name('pelajari'); 

Route::get('/tutorial', [InfoController::class, 'showTutorial'])->name('tutorial');

Route::get('/', function () {
    return view('welcome');
});

// Route Authentication
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- Rute yang hanya bisa diakses setelah login sebagai dosen ---
Route::middleware(['auth:dosen'])->group(function () {

    // Dashboard Dosen
    Route::get('/dashboard-dosen', [DashboardDosenController::class, 'dashboard'])->name('dashboard.dosen');

    // Halaman Data Kelas (Dynamic Table, Upload Excel, Simpan Mahasiswa) - Bagian ini duplikat di bawah, sebaiknya disatukan
    // Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table'); // Ini duplikat
    // Route::get('/dynamic-table', [FileUploadController::class, 'showUploadForm'])->name('dynamic.table'); // Ini duplikat
    Route::post('/upload-excel', [FileUploadController::class, 'processUpload'])->name('upload.xlsx.process');
    Route::post('/simpan-mahasiswa', [DataMahasiswaController::class, 'simpan'])->name('simpan.mahasiswa');


    // Daftar Kelas
    Route::get('/daftar-kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // Rute Hasil Rekomendasi
    Route::get('/hasil-rekomendasi/{id}', [HasilRekomendasiController::class, 'show'])->name('hasil.rekomendasi');
    Route::get('/cek-kolaborasi/{id}', [HasilRekomendasiController::class, 'cekKolaborasi'])->name('cek.kolaborasi'); // Dari bagian paling bawah


    // Rute untuk proses generate data dan penyimpanan kelas (jika masih dipakai)
    // PERHATIAN: Banyak rute POST di bawah yang duplikat atau memiliki nama yang sama dengan fungsi berbeda.
    // Mohon periksa kembali kegunaannya agar tidak ada konflik rute.
    // Contoh: 'kelas.store' muncul 2x. 'generate' muncul 2x.
    Route::post('/kelas/store', [KelasController::class, 'generate'])->name('kelas.store');
    Route::post('/kelas/generate', [KelasController::class, 'generate'])->name('kelas.generate'); // Duplikasi jika kelas.store juga generate
    Route::post('/generate-data', [KelasController::class, 'generateData'])->name('kelas.generateData');
    Route::post('/generate', [DataMahasiswaController::class, 'generate'])->name('mahasiswa.generate'); // Beri nama untuk mencegah konflik
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store.another'); // Jika ini beda dari kelas.store di atas
    // Route::post('/import-csv', [DataMahasiswaController::class, 'import'])->name('import.csv'); // Sudah ada di luar middleware sebelumnya

});

// Rute ini harus ada di dalam middleware 'auth:dosen' jika hanya dosen yang bisa mengaksesnya
// Atau di luar jika bisa diakses publik (jarang untuk import/process)
Route::post('/import', [ImportController::class, 'processImport'])->name('import.process'); // Ini terpisah dari middleware.

// PERHATIAN: Ada DUPLIKASI RUTE DENGAN PATH YANG SAMA DI BAWAH.
// Laravel akan mengambil rute terakhir yang didefinisikan untuk path yang sama.
// Ini perlu DIBERSIHKAN agar tidak ada perilaku yang tidak terduga.
// Contoh:
// Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table');
// Route::get('/dynamic-table', [FileUploadController::class, 'showUploadForm'])->name('dynamic.table');
// Route::post('/dynamic-table', [DynamicTableController::class, 'store'])->name('dynamic-table.store');

// Sebaiknya satukan definisi rute yang sama ke satu tempat yang logis.
// Misalnya, semua rute terkait '/dynamic-table' dalam satu blok atau satu middleware group.

// Contoh bagaimana mengelola rute '/dynamic-table' yang duplikat:
// PENTING: Pilih HANYA SATU dari yang duplikat ini sesuai kebutuhan Anda.
// Jika FileUploadController yang bertanggung jawab, hapus yang DynamicTableController.
// Jika DynamicTableController yang bertanggung jawab, hapus yang FileUploadController.

Route::middleware(['auth:dosen'])->group(function () {
    // Rute untuk halaman Tambah Kelas (Dynamic Table)
    // Pilih SATU dari dua baris di bawah ini, atau sesuaikan jika keduanya punya fungsi berbeda
    Route::get('/dynamic-table', [FileUploadController::class, 'showUploadForm'])->name('dynamic.table'); // Ini yang kita bicarakan sebelumnya
    // Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table'); // Ini adalah rute lain dengan nama yang sama, akan menimpa

    // Rute POST untuk '/dynamic-table'
    Route::post('/dynamic-table', [DynamicTableController::class, 'store'])->name('dynamic-table.store');

    // Rute POST untuk upload Excel
    Route::post('/upload-excel', [FileUploadController::class, 'processUpload'])->name('upload.xlsx.process'); // Duplikasi dari atas, satukan!

    // Rute POST untuk simpan mahasiswa
    Route::post('/simpan-mahasiswa', [DataMahasiswaController::class, 'simpan'])->name('simpan.mahasiswa'); // Duplikasi dari atas, satukan!

    // Rute GET untuk hasil rekomendasi (duplikasi lagi)
    Route::get('/hasil-rekomendasi/{id}', [HasilRekomendasiController::class, 'show'])->name('hasil.rekomendasi'); // Duplikasi dari atas, satukan!
});

// Route POST yang tidak dalam middleware 'auth:dosen' jika memang untuk publik
Route::post('/import-csv', [DataMahasiswaController::class, 'import'])->name('import.csv'); // Ini juga muncul di dalam middleware group di atas, duplikasi!

Route::get('/hasil-rekomendasi/{id}/export-pdf', [HasilRekomendasiController::class, 'exportPdf'])->name('hasil-rekomendasi.exportPdf');

Route::get('/developer', [DeveloperController::class, 'index'])->name('developer.page');


// REKOMENDASI PENTING UNTUK MENGHINDARI DUPLIKASI DAN KONFLIK RUTE DI MASA DEPAN:
// Satukan semua rute yang terkait ke dalam satu group middleware jika aksesnya sama.
// Hapus semua definisi rute yang duplikat.
// Contoh struktur yang lebih bersih:
/*
Route::middleware(['auth:dosen'])->group(function () {
    // Dashboard
    Route::get('/dashboard-dosen', [DashboardDosenController::class, 'dashboard'])->name('dashboard.dosen');

    // Halaman Tambah Kelas (Dynamic Table) & Prosesnya
    Route::get('/dynamic-table', [FileUploadController::class, 'showUploadForm'])->name('dynamic.table');
    // Jika Anda ingin DynamicTableController@index merender '/dynamic-table' juga,
    // maka FileUploadController@showUploadForm harus dipindahkan atau diganti.
    // Route::get('/dynamic-table', [DynamicTableController::class, 'index'])->name('dynamic.table');
    Route::post('/upload-excel', [FileUploadController::class, 'processUpload'])->name('upload.xlsx.process');
    Route::post('/simpan-mahasiswa', [DataMahasiswaController::class, 'simpan'])->name('simpan.mahasiswa');
    Route::post('/dynamic-table-store', [DynamicTableController::class, 'store'])->name('dynamic-table.store'); // Ubah nama rute POST agar jelas

    // Daftar Kelas
    Route::get('/daftar-kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // Hasil Rekomendasi
    Route::get('/hasil-rekomendasi/{id}', [HasilRekomendasiController::class, 'show'])->name('hasil.rekomendasi');
    Route::get('/cek-kolaborasi/{id}', [HasilRekomendasiController::class, 'cekKolaborasi'])->name('cek.kolaborasi');

    // Proses Generate/Store Data Kelas (periksa duplikasi dengan rute di atas)
    Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store'); // Contoh nama yang lebih jelas untuk 'store'
    Route::post('/kelas/generate-pdf', [KelasController::class, 'generate'])->name('kelas.generate.pdf'); // Contoh nama yang lebih jelas untuk 'generate'
    Route::post('/data-mahasiswa/generate', [KelasController::class, 'generateData'])->name('kelas.generateData'); // Nama yang sudah ada

});
*/
