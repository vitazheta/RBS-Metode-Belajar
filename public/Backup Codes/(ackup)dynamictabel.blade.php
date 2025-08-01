<head>
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <title>Tambah Kelas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        /* Hapus definisi body di sini karena sudah di app.blade.php */
        /* body {
            font-family: 'Poppins', sans-serif;
            background-color: #EBEDF4;
        } */
    </style>
</head>

@extends('layouts.app')

@section('content')
<style>
/* Hapus definisi html, body di sini, karena sudah di app.blade.php */
/* html, body {
    height: 100%;
    background-color: #EBEDF4;
    font-family: Poppins, sans-serif;
} */

/* Warna Data Kelas untuk Light Theme - Ini TETAP di sini */
.container h2 {
    color: #0E1F4D; /* Warna Navy untuk Data Kelas di light theme */
}

#addRowBtn {
    background-color: #F37AB0;
    color: #FFFFFF;
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

/* KEMBALIKAN background putih dan box-shadow untuk card-body-form */
.card-body-form {
    background-color: #ffffff;
    color: #0E1F4D;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

input[type="file"] {
    background-color: #ffffff;
    color: #000000;
    padding: 6px 12px;
    border-radius: 4px;
}

input[type="file"]::file-selector-button {
    background-color: #ffffff;
    color: #000000;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
}

input[type="file"]::file-selector-button:hover {
    color: #000000;
}

/* KEMBALIKAN background putih dan box-shadow untuk custom-table */
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

/* KEMBALIKAN background putih untuk baris tabel */
.custom-table tbody tr:nth-child(even) {
    background-color: #ffffff;
}
.custom-table tbody tr:nth-child(odd) {
    background-color: #f8f9fa; /* Opsional: sedikit abu-abu untuk baris ganjil jika ingin stripe */
}


label[for="nama_kelas"]::after {
    color: #000000;
}

.form-control {
    background-color: #ffffff;
    color: #000000;
}

.form-control:focus {
    background-color: #ffffff;
    color: #000000;
}

.form-control:not(:placeholder-shown) {
    background-color: #ffffff;
    color: #000000;
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
    table-layout: fixed;
    width: 100%;
}

#dynamicTable th,
#dynamicTable td {
    padding: 12px 6px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Pastikan content-wrapper dan container.content-wrapper transparan */
/* Ini penting agar background body abu-abu terlihat di samping kartu putih */
.content-wrapper {
    min-height: calc(100vh - 100px);
    margin-bottom: 100px;
    background-color: transparent; /* Pastikan ini transparent */
}

.container.content-wrapper {
    background-color: transparent; /* Pastikan ini transparent */
    box-shadow: none; /* Pastikan tidak ada box-shadow di sini */
}


#toggleBtn {
    color: #0E1F4D;
    margin-top: 0px;
    margin-bottom: 8px;
    transition: color 0.3s ease;
}

#toggleBtn:hover {
    color: #70788F;
    cursor: pointer;
}

.btn-link:hover {
    color: #70788F; !important;
}

/* Hapus semua definisi dark-theme dari sini, karena sudah di app.blade.php */
/* body.dark-theme { ... } */
/* body.dark-theme .container h2 { ... } */
/* ... semua dark-theme rules dari sini ke bawah harus dihapus ... */

/* Hanya sisakan CSS yang khusus untuk view ini di light theme */

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

    // Memeriksa apakah nilai input bukan angka valid atau di luar rentang 0-4
    if (isNaN(numberValue) || numberValue < 0 || numberValue > 4) {
        alert('Kolom ini hanya bisa diisi angka (termasuk desimal) antara 0 hingga 4!');
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

            // Lakukan validasi khusus untuk kolom angka
            if (name.includes('[akademik]') || name.includes('[sekolah]') || name.includes('[ekonomi]') || name.includes('[perkuliahan]')) {
                // Jangan validasi jika kosong, karena sudah ditangani oleh cek kelengkapan baris
                if (value !== '') {
                    const numberValue = parseFloat(value);
                    if (isNaN(numberValue) || numberValue < 0 || numberValue > 4) {
                        alert(`Kolom ${name.split('[')[2].replace(']', '')} pada baris ke-${index + 1} harus berupa angka (termasuk desimal) antara 0 hingga 4!`);
                        valid = false;
                        return; // Hentikan validasi untuk baris ini
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

        if (!valid) return; // Hentikan proses jika ada validasi yang gagal di dalam loop inputs

        if (filledCount === 0) return; // Lewati baris yang kosong seluruhnya
        if (filledCount > 0 && emptyCount > 0) {
            alert(`Baris ke-${index + 1} belum lengkap. Silakan lengkapi semua kolom sebelum menyimpan.`);
            valid = false;
            return;
        }
        data.push(rowData);
    });
    if (!valid) return; // Hentikan jika ada validasi yang gagal di dalam loop rows

    // Ringkasan
    let summaryHTML = `
        <div class="card mt-4 p-4 shadow-sm" style="background-color: #ffffff; border-0;">
      <h4 class="mb-2 fw-bold" style="color: #0E1F4D;">Ringkasan Data</h4>
          <p class="mb-4 text-muted" style="font-size: 14px;">
          Berikut ringkasan data yang telah Anda input. Silakan cek kembali sebelum menekan tombol <strong>Generate</strong>.
          </p>
      <div class="row mb-3">
      <div class="col-md-6">          <strong>Nama Kelas:</strong> ${namaKelas}
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
