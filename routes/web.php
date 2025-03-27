<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\ImportController;

// Route untuk menampilkan halaman dynamic table
Route::get('/dynamic-table', [ImportController::class, 'showTable'])->name('dynamic.table');

// Route untuk menangani proses import CSV
Route::post('/import', [ImportController::class, 'processImport'])->name('import.process');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register'); // Mengarahkan ke halaman register.blade.php
})->name('register');

Route::get('/dynamic-table', function () {
    return view('dynamic_table');
});

