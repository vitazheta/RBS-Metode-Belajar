@extends('layouts.app')

@section('content')
{{-- Ini adalah blok <style> KHUSUS untuk halaman dynamic_table.blade.php --}}
{{-- Jangan meletakkan CSS GLOBAL (html, body, navbar, footer) di sini karena sudah di app.blade.php --}}
<style>
    /* CSS Umum Halaman Ini (Light Mode Default) */
    .container h2 {
        color: #0E1F4D; /* Warna Navy untuk Data Kelas di light theme */
    }

    #addRowBtn { background-color: #F37AB0; color: #FFFFFF; border: none; }
    #addRowBtn:hover { background-color: #E2A6C1; color: #FFFFFF; border: none; }
    #saveBtn { background-color: #0E1F4D; color: white; border: none; }
    #saveBtn:hover { background-color: #70788F; color: #FFFFFF; border: none; }
    #generateBtn { background-color: #0E1F4D; color: white; border: none; }
    #generateBtn:hover { background-color: #70788F; color: #ffffff; border: none; }

    input::placeholder { font-weight: 300; color: #888; font-style: italic; }

    .card-body-form {
        background-color: #ffffff;
        color: #0E1F4D;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    input[type="file"] { background-color: #ffffff; color: #000000; padding: 6px 12px; border-radius: 4px; }
    input[type="file"]::file-selector-button { background-color: #ffffff; color: #000000; padding: 6px 12px; border-radius: 4px; cursor: pointer; }
    input[type="file"]::file-selector-button:hover { color: #000000; }

    .custom-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    .custom-table thead { background-color: #0E1F4D; color: white; }
    .custom-table th, .custom-table td { padding: 12px 15px; text-align: center; vertical-align: middle; }
    .custom-table tbody tr:nth-child(even) { background-color: #ffffff; }
    .custom-table tbody tr:nth-child(odd) { background-color: #f8f9fa; }

    label[for="nama_kelas"]::after { color: #000000; }
    .form-control { background-color: #ffffff; color: #000000; }
    .form-control:focus { background-color: #ffffff; color: #000000; }
    .form-control:not(:placeholder-shown) { background-color: #ffffff; color: #000000; }

    .custom-table .btn-delete { background-color: #F37AB0; border: none; color: white; padding: 4px 8px; border-radius: 6px; font-size: 12px; }
    .custom-table .btn-delete:hover { background-color: #E2A6C1; }

    /* Ini untuk desktop, tidak perlu diubah */
    #dynamicTable { table-layout: fixed; width: 100%; }
    #dynamicTable th, #dynamicTable td { padding: 12px 6px; word-wrap: break-word; overflow-wrap: break-word; }
    #dynamicTable th:nth-child(1), #dynamicTable td:nth-child(1) { width: 60px; } /* No */
    #dynamicTable th:nth-child(2), #dynamicTable td:nth-child(2) { width: 260px; } /* Nama Lengkap */
    #dynamicTable th:nth-child(3), #dynamicTable td:nth-child(3) { width: 260px; } /* Asal Sekolah */


    .content-wrapper { min-height: calc(100vh - 100px); margin-bottom: 100px; background-color: transparent; }
    .container.content-wrapper { background-color: transparent; box-shadow: none; }

    #toggleBtn { color: #0E1F4D; margin-top: 0px; margin-bottom: 8px; transition: color 0.3s ease; }
    #toggleBtn:hover { color: #70788F; cursor: pointer; }
    .btn-link:hover { color: #70788F; !important; }

    .btn-upload-excel { background-color: #0E1F4D !important; color: #fff !important; border: none !important; }
    .btn-upload-excel:hover { background-color: #70788F !important; color: #fff !important; }

    .summary-card {
        background-color: #ffffff; /* Default light mode */
        border: none;
    }


    /* --- DARK THEME STYLES (KHUSUS UNTUK KOMPONEN DI HALAMAN INI) --- */
    body.dark-theme .container h2 {
        color: #FFFFFF;
    }
    body.dark-theme #toggleBtn {
        color: #CFD3D6;
    }
    body.dark-theme .form-label {
        color: #CFD3D6;
    }
    body.dark-theme .card-body-form {
        background-color: #2D2D2D;
        color: #FFFFFF;
    }
    body.dark-theme .card-body-form p {
        color: #CFD3D6;
    }
    body.dark-theme .form-control {
        background-color: #3A3A3A;
        color: #FFFFFF;
        border-color: #555555;
    }
    body.dark-theme .form-control:focus {
        background-color: #3A3A3A;
        color: #FFFFFF;
        border-color: #888888;
    }
    body.dark-theme .form-control::placeholder {
        color: #A0A0A0;
    }
    body.dark-theme input[type="file"] {
        background-color: #3A3A3A;
        color: #FFFFFF;
        border: 1px solid #555555;
    }
    body.dark-theme input[type="file"]::file-selector-button {
        background-color: #3A3A3A;
        color: #FFFFFF;
        border: 1px solid #555555;
    }
    body.dark-theme input[type="file"]::file-selector-button:hover {
        color: #CFD3D6;
    }
    body.dark-theme .custom-table {
        box-shadow: 0 4px 10px rgba(255, 255, 255, 0.05);
    }
    body.dark-theme .custom-table thead {
        background-color: #1A202C;
        color: #FFFFFF;
    }
    body.dark-theme .custom-table th,
    body.dark-theme .custom-table td {
        color: #CFD3D6;
    }
    body.dark-theme .custom-table tbody tr:nth-child(even) {
        background-color: #2D2D2D;
    }
    body.dark-theme .custom-table tbody tr:nth-child(odd) {
        background-color: #3A3A3A;
    }
    body.dark-theme .custom-table .btn-delete {
        background-color: #F481B4;
    }
    body.dark-theme .custom-table .btn-delete:hover {
        background-color: #E5AFC7;
    }
    body.dark-theme #saveBtn,
    body.dark-theme #generateBtn {
        background-color: #162449 !important;
        color: #FFFFFF !important;
    }
    body.dark-theme #saveBtn:hover,
    body.dark-theme #generateBtn:hover {
        background-color: #777F95 !important;
    }
    body.dark-theme #addRowBtn {
        background-color: #F481B4 !important;
        color: #FFFFFF !important;
    }
    body.dark-theme #addRowBtn:hover {
        background-color: #E5AFC7 !important;
    }
    body.dark-theme .btn-upload-excel {
        background-color: #162449 !important;
        color: #FFFFFF !important;
    }
    body.dark-theme .btn-upload-excel:hover {
        background-color: #777F95 !important;
    }

    /* DARK MODE untuk Ringkasan Data Card */
    body.dark-theme .summary-card {
        background-color: #2D2D2D;
    }
    body.dark-theme .summary-card h4 {
        color: #FFFFFF !important;
    }
    body.dark-theme .summary-card p {
        color: #CFD3D6 !important;
    }
    body.dark-theme .summary-card strong {
        color: #FFFFFF !important;
    }


    /* Media Query untuk Layar Kecil (Mobile) */
    @media (max-width: 767.98px) {
        /* Form input Nama Kelas dan Kode Mata Kuliah */
        .mb-3.d-flex {
            flex-direction: column;
            gap: 15px;
        }
        .mb-3.d-flex .w-50 {
            width: 100% !important;
            margin-right: 0 !important;
        }

        /* Container untuk Tabel Responsif */
        .table-responsive-sm {
            overflow-x: auto; /* Kunci agar tabel bisa di-scroll horizontal */
            -webkit-overflow-scrolling: touch; /* Untuk smooth scrolling di iOS */
            padding-bottom: 15px; /* Beri sedikit ruang agar scrollbar terlihat */
            border: 1px solid #dee2e6; /* Border pada container tabel */
            border-radius: 8px; /* Sudut melengkung pada container tabel */
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); /* Shadow pada container tabel */
            margin-bottom: 20px; /* Jarak bawah container tabel */
        }

        .custom-table {
            /* Pastikan width total tabel lebih besar dari lebar viewport mobile
               agar memicu scroll horizontal.
               Gunakan min-width yang cukup lebar untuk menampung semua kolom. */
            width: 100%; /* Pastikan tabel mengambil 100% dari wrapper-nya */
            min-width: 800px; /* **INI PENTING: Minimal lebar tabel agar memicu scroll** */
            font-size: 13px; /* Sedikit perkecil font untuk tabel di mobile */
            /* Hapus border-radius dan box-shadow dari .custom-table itu sendiri
               karena sudah ada di .table-responsive-sm */
            border-radius: 0;
            box-shadow: none;
        }

        .custom-table th,
        .custom-table td {
            /* Pastikan teks tidak pecah baris untuk menjaga lebar kolom */
            white-space: nowrap;
            padding: 8px 8px; /* Sesuaikan padding di sel tabel agar tidak terlalu sempit */
        }

        .custom-table td input.form-control,
        .custom-table td select.form-control {
            font-size: 13px; /* Perkecil font untuk input di sel tabel */
            padding: 5px; /* Kurangi padding input di sel tabel */
            min-width: 90px; /* Minimal lebar input agar tidak terlalu sempit */
        }

        /* Penyesuaian lebar kolom spesifik di mobile agar lebih rapi.
           Ini akan bekerja dengan `min-width` pada `.custom-table`. */
        #dynamicTable th:nth-child(1), #dynamicTable td:nth-child(1) { width: 50px; } /* No */
        #dynamicTable th:nth-child(2), #dynamicTable td:nth-child(2) { min-width: 160px; max-width: 200px; } /* Nama Lengkap */
        #dynamicTable th:nth-child(3), #dynamicTable td:nth-child(3) { min-width: 160px; max-width: 200px; } /* Asal Sekolah */
        #dynamicTable th:nth-child(4), #dynamicTable td:nth-child(4) { min-width: 120px; } /* Jalur Masuk */
        #dynamicTable th:nth-child(5), #dynamicTable td:nth-child(5) { min-width: 90px; } /* Akademik */
        #dynamicTable th:nth-child(6), #dynamicTable td:nth-child(6) { min-width: 90px; } /* Sekolah */
        #dynamicTable th:nth-child(7), #dynamicTable td:nth-child(7) { min-width: 90px; } /* Ekonomi */
        #dynamicTable th:nth-child(8), #dynamicTable td:nth-child(8) { min-width: 90px; } /* Perkuliahan */
        #dynamicTable th:nth-child(9), #dynamicTable td:nth-child(9) { width: 70px; } /* Aksi */


        /* Tombol di bawah tabel */
        .d-flex.gap-2.mt-3 {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        .d-flex.gap-2.mt-3 button {
            width: 100%;
        }

        /* Summary Card */
        .summary-card {
            border-radius: 8px; /* Border radius untuk summary card */
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); /* Shadow untuk summary card */
        }
        .summary-card p {
            font-size: 13px;
        }
        .summary-card .row.mb-3 {
            flex-direction: column;
            gap: 8px;
        }

        /* Import Excel Section */
        .input-group {
            flex-direction: column;
            gap: 10px;
        }
        .input-group .form-control,
        .input-group .btn {
            width: 100%;
        }

        /* Panduan Pengisian */
        .collapse .card-body-form {
            font-size: 13px;
        }

        /* Dark Theme adjustments for horizontal scroll table */
        body.dark-theme .table-responsive-sm {
            border: 1px solid #444; /* Border dark mode */
            box-shadow: 0 4px 10px rgba(255,255,255,0.05); /* Shadow dark mode */
        }
        body.dark-theme .summary-card {
            box-shadow: 0 4px 10px rgba(255,255,255,0.05);
        }
    }
</style>

<div class="container content-wrapper" style="padding-top: 100px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block">
        Data Kelas
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>

    <button id="toggleBtn" class="btn btn-link p-0 text-decoration-none small d-flex align-items-center"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#tutorialPengisian"
        aria-expanded="false"
        aria-controls="tutorialPengisian">
        <span id="toggleIcon">🔽</span> &nbsp; Lihat panduan pengisian
    </button>

    <div class="collapse mt-2" id="tutorialPengisian">
        <div class="card border-0 shadow-sm" style="font-size: 14px; margin-bottom: 10px;">
            <div class="card-body-form">
                Masukkan nama kelas sesuai format penamaan institusi. Contoh:
                <ul class="mb-1 ps-3">
                    <li><strong>Pendidikan Ilmu Komputer B - 2021</strong></li>
                    <li><strong>Sistem Informasi A - 2022</strong></li>
                </ul>
                <p class="mb-0">Gunakan huruf kapital untuk singkatan jurusan jika perlu, dan tambahkan tahun angkatan untuk mempermudah identifikasi kelas.</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('upload.xlsx.process') }}" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Import dari Excel:</label>
            <div class="input-group">
                <input type="file" name="file" accept=".xlsx,.xls" class="form-control" required>
                <button type="submit" class="btn btn-upload-excel">Upload</button>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('simpan.mahasiswa') }}" id="formKelas">
        @csrf
        <div class="mb-3 d-flex">
            <div class="w-50 me-3">
                <label>Nama Kelas:</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" required placeholder="Contoh: Pendidikan Ilmu Komputer B - 2021">
            </div>
            <div class="w-50">
                <label>Kode Mata Kuliah:</label>
                <input type="text" name="kode_mata_kuliah" id="kode_mata_kuliah" class="form-control" required placeholder="Contoh: IK-303 Sistem Basis Data">
            </div>
        </div>

        {{-- Wrapper ini tetap penting --}}
        <div class="table-responsive-sm">
            <table class="custom-table" id="dynamicTable">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th style="width: 260px;">Nama Lengkap</th>
                        <th style="width: 260px;">Asal Sekolah</th>
                        <th>Jalur Masuk</th>
                        <th>Akademik</th>
                        <th>Sekolah</th>
                        <th>Ekonomi</th>
                        <th>Perkuliahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(session('processedData') && is_array(session('processedData')))
                        @foreach(session('processedData') as $i => $data)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><input type="text" name="mahasiswa[{{ $i }}][nama]" class="form-control" value="{{ $data['nama'] ?? '' }}"></td>
                                <td><input type="text" name="mahasiswa[{{ $i }}][asal_sekolah]" class="form-control" value="{{ $data['asal_sekolah'] ?? '' }}"></td>
                                <td>
                                    <select name="mahasiswa[{{ $i }}][jalur_masuk]" class="form-control">
                                        <option value="">Pilih Jalur</option>
                                        <option value="SNBP" {{ ($data['jalur_masuk'] ?? '')=='SNBP'?'selected':'' }}>SNBP</option>
                                        <option value="SNBT" {{ ($data['jalur_masuk'] ?? '')=='SNBT'?'selected':'' }}>SNBT</option>
                                        <option value="MANDIRI" {{ ($data['jalur_masuk'] ?? '')=='MANDIRI'?'selected':'' }}>MANDIRI</option>
                                    </select>
                                </td>
                                {{-- KOLOM YANG DIVALIDASI --}}
                                <td><input type="text" name="mahasiswa[{{ $i }}][akademik]" class="form-control" value="{{ $data['akademik'] ?? '' }}"></td>
                                <td><input type="text" name="mahasiswa[{{ $i }}][sekolah]" class="form-control" value="{{ $data['sekolah'] ?? '' }}"></td>
                                <td><input type="text" name="mahasiswa[{{ $i }}][ekonomi]" class="form-control" value="{{ $data['ekonomi'] ?? '' }}"></td>
                                <td><input type="text" name="mahasiswa[{{ $i }}][perkuliahan]" class="form-control" value="{{ $data['perkuliahan'] ?? '' }}"></td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>1</td>
                            <td><input type="text" name="mahasiswa[0][nama]" class="form-control"></td>
                            <td><input type="text" name="mahasiswa[0][asal_sekolah]" class="form-control"></td>
                            <td>
                                <select name="mahasiswa[0][jalur_masuk]" class="form-control">
                                    <option value="">Pilih Jalur</option>
                                    <option value="SNBP">SNBP</option>
                                    <option value="SNBT">SNBT</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                </select>
                            </td>
                            {{-- KOLOM YANG DIVALIDASI --}}
                            <td><input type="text" name="mahasiswa[0][akademik]" class="form-control"></td>
                            <td><input type="text" name="mahasiswa[0][sekolah]" class="form-control"></td>
                            <td><input type="text" name="mahasiswa[0][ekonomi]" class="form-control"></td>
                            <td><input type="text" name="mahasiswa[0][perkuliahan]" class="form-control"></td>
                            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div> {{-- End of table-responsive-sm wrapper --}}

        <div class="d-flex gap-2 mt-3">
            <button type="button" id="addRowBtn" class="btn btn-success ms-2">Tambah Baris</button>
            <button type="button" class="btn btn-primary" id="saveBtn">Simpan Data Kelas</button>
        </div>
        <div id="summaryContainer" class="mt-4"></div>
        <button type="submit" id="generateBtn" class="btn btn-success d-none mt-3 mb-3">Generate</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
// Fungsi validasi untuk input angka (termasuk float) dan rentang 0-4
function validateNumberInput(inputElement) {
    let value = inputElement.value;

    // Hapus semua kecuali angka dan titik
    value = value.replace(/[^0-9.]/g, '');

    // Pastikan hanya ada satu titik desimal
    const parts = value.split('.');
    if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('');
    }
    inputElement.value = value; // Update nilai input setelah membersihkan

    // Cek jika input kosong, biarkan kosong tanpa peringatan
    if (value === '') {
        return;
    }

    const numberValue = parseFloat(value);

    // Memeriksa apakah nilai input bukan angka valid atau di luar rentang 1-4
    if (isNaN(numberValue) || numberValue < 1 || numberValue > 4) {
        alert('Kolom ini hanya bisa diisi angka (termasuk desimal) antara 1 hingga 4!');
        inputElement.value = ''; // Kosongkan kolom jika input tidak valid
        inputElement.focus(); // Mengarahkan fokus kembali ke input yang salah
    }
}

// Menambahkan event listener ke input yang sudah ada saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const numericInputs = document.querySelectorAll(
        'input[name*="[akademik]"], ' +
        'input[name*="[sekolah]"], ' +
        'input[name*="[ekonomi]"], ' +
        'input[name*="[perkuliahan]"]'
    );
    numericInputs.forEach(input => {
        input.addEventListener('change', function() {
            validateNumberInput(this);
        });
        // Tambahkan juga event listener untuk input secara real-time agar user langsung melihat efeknya
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '');
        });
    });
});

// Tambah baris baru
function addRow() {
    const table = document.querySelector('#dynamicTable tbody');
    const rowCount = table.rows.length;
    let newRowHTML = `<tr>
        <td>${rowCount + 1}</td>
        <td><input type="text" name="mahasiswa[${rowCount}][nama]" class="form-control"></td>
        <td><input type="text" name="mahasiswa[${rowCount}][asal_sekolah]" class="form-control"></td>
        <td>
            <select name="mahasiswa[${rowCount}][jalur_masuk]" class="form-control">
                <option value="">Pilih Jalur</option>
                <option value="SNBP">SNBP</option>
                <option value="SNBT">SNBT</option>
                <option value="MANDIRI">MANDIRI</option>
            </select>
        </td>
        <td><input type="text" name="mahasiswa[${rowCount}][akademik]" class="form-control"></td>
        <td><input type="text" name="mahasiswa[${rowCount}][sekolah]" class="form-control"></td>
        <td><input type="text" name="mahasiswa[${rowCount}][ekonomi]" class="form-control"></td>
        <td><input type="text" name="mahasiswa[${rowCount}][perkuliahan]" class="form-control"></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
    </tr>`;
    table.insertAdjacentHTML('beforeend', newRowHTML);
    updateRowNumbers();

    // Dapatkan elemen input yang baru ditambahkan dan tambahkan event listener
    const newRow = table.lastElementChild;
    const numericInputsNewRow = newRow.querySelectorAll(
        'input[name*="[akademik]"], ' +
        'input[name*="[sekolah]"], ' +
        'input[name*="[ekonomi]"], ' +
        'input[name*="[perkuliahan]"]'
    );
    numericInputsNewRow.forEach(input => {
        input.addEventListener('change', function() {
            validateNumberInput(this);
        });
        // Tambahkan juga event listener untuk input secara real-time
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '');
        });
    });
}

function removeRow(button) {
    button.closest('tr').remove();
    updateRowNumbers();
}

function updateRowNumbers() {
    const rows = document.querySelectorAll('#dynamicTable tbody tr');
    rows.forEach((row, index) => {
        // Kolom 'No' tetap ada, jadi update textContent-nya
        row.cells[0].textContent = index + 1;
    });
}
document.getElementById('addRowBtn')?.addEventListener('click', addRow);

// Simpan Data Kelas (tampilkan ringkasan & tombol generate)
document.getElementById('saveBtn')?.addEventListener('click', function () {
    const namaKelas = document.querySelector('input[name="nama_kelas"]').value.trim();
    const kodeMK = document.querySelector('input[name="kode_mata_kuliah"]').value.trim();
    if (!namaKelas || !kodeMK) {
        alert("Nama Kelas dan Kode Mata Kuliah wajib diisi sebelum menyimpan data.");
        return;
    }
    const rows = document.querySelectorAll('#dynamicTable tbody tr');
    const data = [];
    let valid = true;
    rows.forEach((row, index) => {
        const inputs = row.querySelectorAll('input, select');
        const rowData = {};
        let filledCount = 0;
        let emptyCount = 0;
        inputs.forEach(input => {
            const value = input.value.trim();
            const name = input.name;

            if (name.includes('[akademik]') || name.includes('[sekolah]') || name.includes('[ekonomi]') || name.includes('[perkuliahan]')) {
                if (value !== '') {
                    const numberValue = parseFloat(value);
                    if (isNaN(numberValue) || numberValue < 1 || numberValue > 4) {
                        alert(`Kolom ${name.split('[')[2].replace(']', '')} pada baris ke-${index + 1} harus berupa angka (termasuk desimal) antara 1 hingga 4!`);
                        valid = false;
                        return;
                    }
                }
            }
            if (value !== '') filledCount++;
            else emptyCount++;
            if (name.includes('[nama]')) rowData.nama = value;
            else if (name.includes('[asal_sekolah]')) rowData.asal_sekolah = value;
            else if (name.includes('[jalur_masuk]')) rowData.jalur_masuk = value;
            else if (name.includes('[akademik]')) rowData.akademik = value;
            else if (name.includes('[sekolah]')) rowData.sekolah = value;
            else if (name.includes('[ekonomi]')) rowData.ekonomi = value;
            else if (name.includes('[perkuliahan]')) rowData.perkuliahan = value;
        });
        if (!valid) return;
        if (filledCount === 0) return;
        if (filledCount > 0 && emptyCount > 0) {
            alert(`Baris ke-${index + 1} belum lengkap. Silakan lengkapi semua kolom sebelum menyimpan.`);
            valid = false;
            return;
        }
        data.push(rowData);
    });
    if (!valid) return;

    let summaryHTML = `
        <div class="card mt-4 p-4 shadow-sm summary-card">
        <h4 class="mb-2 fw-bold" style="color: #0E1F4D;">Ringkasan Data</h4>
            <p class="mb-4 text-muted" style="font-size: 14px;">
            Berikut ringkasan data yang telah Anda input. Silakan cek kembali sebelum menekan tombol <strong>Generate</strong>.
            </p>
           <div class="row mb-3">
         <div class="col-md-6">           <strong>Nama Kelas:</strong> <strong>${namaKelas}</strong>
         </div>
         <div class="col-md-6">
         <strong>Kode Mata Kuliah:</strong> <strong>${kodeMK}</strong>
    </div>
    </div>
        <div class="table-responsive-sm">
        <table class="custom-table"><thead><tr>
        <th>Nama</th><th>Asal Sekolah</th><th>Jalur</th><th>Akademik</th><th>Sekolah</th><th>Ekonomi</th><th>Perkuliahan</th>
        </tr></thead><tbody>`;
    data.forEach(item => {
        summaryHTML += `<tr>
            <td>${item.nama}</td>
            <td>${item.asal_sekolah}</td>
            <td>${item.jalur_masuk}</td>
            <td>${item.akademik}</td>
            <td>${item.sekolah}</td>
            <td>${item.ekonomi}</td>
            <td>${item.perkuliahan}</td>
        </tr>`;
    });
    summaryHTML += `</tbody></table></div>`; // Tutup table-responsive-sm div
    document.getElementById('summaryContainer').innerHTML = summaryHTML;
    document.getElementById('generateBtn')?.classList.remove('d-none');
    setTimeout(() => {
        document.getElementById('summaryContainer')?.scrollIntoView({ behavior: 'smooth' });
    }, 300);
});

// Generate (submit form)
document.getElementById('generateBtn')?.addEventListener('click', function () {
    document.getElementById('formKelas').submit();
});
</script>
@endsection
