<head>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <title>Tambah Kelas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EBEDF4;
        }
    </style>
</head>

@extends('layouts.app')

@section('content')
<style>
html, body {
    height: 100%; /* Pastikan tinggi halaman mencakup seluruh layar */
}

body {
    background-color: #EBEDF4;
    font-family: Poppins, sans-serif;
}

#addRowBtn {
    background-color: #F37AB0;
    color: #FFFFFF; /* teks gelap biar kontras */
    border: none;
}

#addRowBtn:hover {
    background-color: #E2A6C1;
    color: #FFFFFF;
    border: none;
}

#saveBtn {
    background-color: #0E1F4D;
    color: white;
    border: none;
}

#saveBtn:hover {
    background-color: #70788F;
    color: #FFFFFF;
    border: none;
}

#generateBtn {
    background-color: #0E1F4D;
    color: white;
    border: none;
}

#generateBtn:hover {
    background-color: #70788F;
    color: #ffffff;
    border: none;
}

input::placeholder {
    font-weight: 300;
    color: #888;
    font-style: italic;
}

.card-body-form {
    background-color: #ffffff;
    color: #0E1F4D;
    padding: 20px;
    border-radius: 5px;
}

input[type="file"] {
    background-color: #ffffff; /* Ubah latar belakang menjadi #2D2D2D */
    color: #000000; /* Ubah warna teks menjadi putih */
    padding: 6px 12px; /* Sesuaikan padding */
    border-radius: 4px; /* Tambahkan border radius */
}

input[type="file"]::file-selector-button {
    background-color: #ffffff; /* Ubah latar belakang tombol */
    color: #000000; /* Ubah warna teks tombol */
    padding: 6px 12px; /* Sesuaikan padding tombol */
    border-radius: 4px; /* Tambahkan border radius pada tombol */
    cursor: pointer; /* Ubah kursor menjadi pointer */
}

input[type="file"]::file-selector-button:hover {
    color: #000000; 
}

.custom-table {
    border-collapse: collapse;
    width: 100%;
    font-size: 14px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.custom-table thead {
    background-color: #0E1F4D;
    color: white;
}

.custom-table th,
.custom-table td {
    padding: 12px 15px;
    text-align: center;
    vertical-align: middle;
}

.custom-table tbody tr:nth-child(even) {
    background-color: #ffffff;
}

label[for="nama_kelas"]::after {
    color: #000000; /* Ubah warna teks menjadi putih */
}

.form-control {
    background-color: #ffffff; /* Perbaikan dari 'backround-color' */
    color: #000000; /* Tambahkan warna teks agar kontras */
}

.form-control:focus {
    background-color: #ffffff; /* Perbaikan dari 'backround-color' */
    color: #000000; /* Tambahkan warna teks agar kontras */
}

.form-control:not(:placeholder-shown) {
    background-color: #ffffff; /* Ubah latar belakang menjadi #2D2D2D */
    color: #000000; /* Pastikan teks tetap terlihat dengan warna putih */
}

.custom-table .btn-delete {
    background-color: #F37AB0;
    border: none;
    color: white;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
}

.custom-table .btn-delete:hover {
    background-color: #E2A6C1;
}

#dynamicTable {
    table-layout: fixed; /* Biar kolom lebarnya lebih merata */
    width: 100%;
}

#dynamicTable th,
#dynamicTable td {
    padding: 12px 6px; /* Sesuaikan jarak dalam sel */
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.content-wrapper {
    min-height: calc(100vh - 100px); /* Pastikan konten utama memenuhi layar */
    margin-bottom: 100px; /* Tambahkan ruang kosong sebelum footer */
}

#toggleBtn {
        color: #0E1F4D; /* Warna default */
        margin-top: 0px;
        margin-bottom: 8px;
        transition: color 0.3s ease; /* Animasi transisi */
}

#toggleBtn:hover {
    color: #70788F; /* Gunakan !important untuk memaksa aturan ini */
    cursor: pointer;
}

.btn-link:hover {
    color: #70788F; !important;
}

/* Dark Theme */
body.dark-theme {
    background-color: #121212;
    color: #ffffff;
}

body.dark-theme .container h2 {
    color: #ffffff;
}

body.dark-theme #toggleBtn {
        color: #FFFFFF; /* Warna default */
}

body.dark-theme .card-body-form {
    background-color: #2D2D2D;
    color: #FFFFFF;
}

body.dark-theme .custom-table tbody {
    color: #FFFFFF
}

body.dark-theme .custom-table tbody {
    color: #FFFFFF
}

body.dark-theme .custom-table tbody tr:nth-child(even) {
    background-color: #1B1B1B;
}

body.dark-theme .form-control {
    background-color: #2D2D2D; /* Perbaikan dari 'backround-color' */
    color: #FFFFFF; /* Tambahkan warna teks agar kontras */
    border: none;
}

body.dark-theme .form-control:focus {
    background-color: #2D2D2D; /* Perbaikan dari 'backround-color' */
    color: #FFFFFF; /* Tambahkan warna teks agar kontras */
}

body.dark-theme .form-control:not(:placeholder-shown) {
    background-color: #2D2D2D; /* Ubah latar belakang menjadi #2D2D2D */
    color: #ffffff; /* Pastikan teks tetap terlihat dengan warna putih */
}

body.dark-theme input[type="file"] {
    background-color: #2D2D2D; /* Ubah latar belakang menjadi #2D2D2D */
    color: #FFFFFF; /* Ubah warna teks menjadi putih */
    border: 1px solid #444444; /* Tambahkan border agar lebih terlihat */
    padding: 6px 12px; /* Sesuaikan padding */
    border-radius: 4px; /* Tambahkan border radius */
}

body.dark-theme input[type="file"]::file-selector-button {
    background-color: #2D2D2D; /* Ubah latar belakang tombol */
    color: #FFFFFF; /* Ubah warna teks tombol */
    border: 1px solid #444444; /* Tambahkan border pada tombol */
    padding: 6px 12px; /* Sesuaikan padding tombol */
    border-radius: 4px; /* Tambahkan border radius pada tombol */
    cursor: pointer; /* Ubah kursor menjadi pointer */
}

body.dark-theme input[type="file"]::file-selector-button:hover {
    color: #000000; 
}

body.dark-theme #toggleBtn {
        color: #FFFFFF; /* Warna default */
        margin-top: 0px;
        margin-bottom: 8px;
        transition: color 0.3s ease; /* Animasi transisi */
}

body.dark-theme #toggleBtn:hover {
    color: #777F95; /* Gunakan !important untuk memaksa aturan ini */
    cursor: pointer;
}

.btn-upload-excel {
    background-color: #0E1F4D !important;
    color: #fff !important;
    border: none !important;
}
.btn-upload-excel:hover {
    background-color: #70788F !important;
    color: #fff !important;
}
</style>

@section('content')
<div class="container content-wrapper" style="padding-top: 70px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block">
        Data Kelas
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #84A7CF;"></span>
    </h2>

<!-- Tombol Toggle -->
<button id="toggleBtn" class="btn btn-link p-0 text-decoration-none small d-flex align-items-center"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#tutorialPengisian"
        aria-expanded="false"
        aria-controls="tutorialPengisian">
    <span id="toggleIcon">🔽</span> &nbsp; Lihat panduan pengisian
</button>

<!-- Konten Collapse -->
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

       <!-- Form Upload Excel -->
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

    <!-- Form Dynamic Table -->
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
                                    <option value="SNBP" {{ ($data['jalur_masuk'] ?? '')=='SNBP'?'selected':'' }}>SNBP</option>
                                    <option value="SNBT" {{ ($data['jalur_masuk'] ?? '')=='SNBT'?'selected':'' }}>SNBT</option>
                                    <option value="MANDIRI" {{ ($data['jalur_masuk'] ?? '')=='MANDIRI'?'selected':'' }}>MANDIRI</option>
                                </select>
                            </td>
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
                        <td><input type="text" name="mahasiswa[0][akademik]" class="form-control"></td>
                        <td><input type="text" name="mahasiswa[0][sekolah]" class="form-control"></td>
                        <td><input type="text" name="mahasiswa[0][ekonomi]" class="form-control"></td>
                        <td><input type="text" name="mahasiswa[0][perkuliahan]" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                    </tr>
                @endif
            </tbody>
        </table>
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
// Tambah baris baru
function addRow() {
    const table = document.querySelector('#dynamicTable tbody');
    const rowCount = table.rows.length;
    let newRow = `<tr>
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
    table.insertAdjacentHTML('beforeend', newRow);
    updateRowNumbers();
}
function removeRow(button) {
    button.closest('tr').remove();
    updateRowNumbers();
}
function updateRowNumbers() {
    const rows = document.querySelectorAll('#dynamicTable tbody tr');
    rows.forEach((row, index) => {
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
            if (value !== '') filledCount++;
            else emptyCount++;
            const name = input.name;
            if (name.includes('[nama]')) rowData.nama = value;
            else if (name.includes('[asal_sekolah]')) rowData.asal_sekolah = value;
            else if (name.includes('[jalur_masuk]')) rowData.jalur_masuk = value;
            else if (name.includes('[akademik]')) rowData.akademik = value;
            else if (name.includes('[sekolah]')) rowData.sekolah = value;
            else if (name.includes('[ekonomi]')) rowData.ekonomi = value;
            else if (name.includes('[perkuliahan]')) rowData.perkuliahan = value;
        });
        if (filledCount === 0) return;
        if (filledCount > 0 && emptyCount > 0) {
            alert(`Baris ke-${index + 1} belum lengkap. Silakan lengkapi semua kolom sebelum menyimpan.`);
            valid = false;
            return;
        }
        data.push(rowData);
    });
    if (!valid) return;
    // Ringkasan
    let summaryHTML = `
     <div class="card mt-4 p-4 shadow-sm" style="background-color: #ffffff; border-0;">
    <h4 class="mb-2 fw-bold" style="color: #0E1F4D;">Ringkasan Data</h4>
        <p class="mb-4 text-muted" style="font-size: 14px;">
        Berikut ringkasan data yang telah Anda input. Silakan cek kembali sebelum menekan tombol <strong>Generate</strong>.
        </p>
    <div class="row mb-3">
    <div class="col-md-6">        <strong>Nama Kelas:</strong> ${namaKelas}
    </div>
    <div class="col-md-6">
        <strong>Kode Mata Kuliah:</strong> ${kodeMK}
    </div>
</div>
        <table class="custom-table"><thead><tr>
        <th>Nama</th><th>Asal Sekolah</th><th>Jalur</th><th>Akademik</th><th>Sekolah</th><th>Ekonomi</th><th>Perkuliahan</th>
        </tr></thead><tbody>`;
    data.forEach(item => {
        summaryHTML += `<tr>
            <td>${item.nama}</td><td>${item.asal_sekolah}</td><td>${item.jalur_masuk}</td><td>${item.akademik}</td>
            <td>${item.sekolah}</td><td>${item.ekonomi}</td><td>${item.perkuliahan}</td>
        </tr>`;
    });
    summaryHTML += `</tbody></table>`;
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
