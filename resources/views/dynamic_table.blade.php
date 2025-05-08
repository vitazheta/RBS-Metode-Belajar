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
</style>


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

    <!-- FORM UTAMA -->
    <form method="POST" action="{{ route('simpan.mahasiswa') }}">

        @csrf
        <input type="hidden" name="mahasiswa" id="mahasiswaJSON">

        <!-- Info Kelas -->
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

        <!-- Tombol Import CSV -->
    <div class="mb-3">
        <label class="form-label">Import dari CSV:</label>
    <div class="input-group">
        <input type="file" id="csvFile" accept=".csv" class="form-control form-control-m rounded-start">
        <!-- <button type="button" class="btn btn-success" onclick="handleCSVImport()">Import CSV</button> -->
    </div>

    <!-- Tombol Import CSV (Estetik dan Minimalis) -->
<!-- <div class="mb-3">
    <div class="input-group">
        <input type="file" id="csvFile" accept=".csv" class="form-control form-control-sm border-end-0 rounded-start">
        <button type="button" class="btn btn-success btn-sm" onclick="handleCSVImport()">Import</button>
    </div>
</div> -->

</div>


        <!-- Tabel Input Mahasiswa -->
        <table class="custom-table" id="dynamicTable">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Asal Sekolah</th>
                    <th>Jalur Masuk</th>
                    <th>Akademik dan Endurance</th>
                    <th>Latar Belakang</th>
                    <th>Pola Belajar</th>
                    <th>Perkuliahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="mahasiswa[0][nama]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][asal_sekolah]" class="form-control"></td>
                    <td>
                        <select name="mahasiswa[0][jalur_masuk]" class="form-control">
                            <option value="">Pilih Jalur</option>
                            <option value="SNBP">SNBP</option>
                            <option value="SNBT">SNBT</option>
                            <option value="Mandiri UPI">Mandiri UPI</option>
                        </select>
                    </td>
                    <td><input type="text" name="mahasiswa[0][akademik_endurance]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][latar_belakang]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][pola_belajar]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][perkuliahan]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                </tr>
            </tbody>
        </table>

        <!-- Tombol Simpan -->
        <div class="d-flex gap-2 mt-3">
        <button type="button" id="addRowBtn" class="btn btn-success ms-2">Tambah Baris</button>
        <button type="button" class="btn btn-primary" id="saveBtn">Simpan Data Kelas</button>
        </div>


        <!-- Ringkasan -->
        <div id="summaryContainer" class="mt-4"></div>
        <!-- <div id="summaryContainer" class="mt-4"></div> -->

        <button type="submit" id="generateBtn" class="btn btn-success d-none mt-3 mb-3">Generate</button>



    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('addRowBtn')?.addEventListener('click', addRow);

    const csrfToken = '{{ csrf_token() }}';

    // ================= CSV IMPORT ===================
    function handleCSVImport() {
        const fileInput = document.getElementById('csvFile');
        const file = fileInput.files[0];

        if (!file) {
            alert("Pilih file CSV terlebih dahulu.");
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const text = e.target.result;
            const rows = text.trim().split('\n').map(r => r.split(','));
            const dataRows = rows.slice(0); // Ambil semua baris
            const tableBody = document.querySelector('#dynamicTable tbody');
            tableBody.innerHTML = '';

            dataRows.forEach((cols, index) => {
                if (cols.length < 7) return;

                // Hapus tanda kutip dari setiap elemen data
                const cleanedCols = cols.map(col => col.replace(/"/g, ''));

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${index + 1}</td>
                    <td><input type="text" name="mahasiswa[${index}][nama]" class="form-control" value="${cleanedCols[0]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][asal_sekolah]" class="form-control" value="${cleanedCols[1]}"></td>
                    <td>
                        <select name="mahasiswa[${index}][jalur_masuk]" class="form-control">
                            <option value="SNBP" ${cleanedCols[2] === 'SNBP' ? 'selected' : ''}>SNBP</option>
                            <option value="SNBT" ${cleanedCols[2] === 'SNBT' ? 'selected' : ''}>SNBT</option>
                            <option value="Mandiri UPI" ${cleanedCols[2] === 'Mandiri UPI' ? 'selected' : ''}>Mandiri UPI</option>
                            <option value="Mandiri" ${cleanedCols[2] === 'Mandiri' ? 'selected' : ''}>Mandiri</option>
                        </select>
                    </td>
                    <td><input type="text" name="mahasiswa[${index}][akademik_endurance]" class="form-control" value="${cleanedCols[3]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][latar_belakang]" class="form-control" value="${cleanedCols[4]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][pola_belajar]" class="form-control" value="${cleanedCols[5]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][perkuliahan]" class="form-control" value="${cleanedCols[6]}"></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                `;
                tableBody.appendChild(newRow);
            });

            setAutoAddTrigger();
        };

        reader.readAsText(file);
    }

    document.getElementById('csvFile')?.addEventListener('change', handleCSVImport);

    // Trigger paksa untuk import CSV
    function triggerImport() {
        const fileInput = document.getElementById('csvFile');
        const event = new Event('change');
        fileInput.dispatchEvent(event);
    }

    // ============= Auto Tambah Baris ===============
    function autoAddRowIfNeeded() {
        const rows = document.querySelectorAll('#dynamicTable tbody tr');
        const lastRow = rows[rows.length - 1];
        const inputs = lastRow.querySelectorAll('input, select');

        let filled = false;
        inputs.forEach(input => {
            if (input.value.trim() !== '') filled = true;
        });

        if (filled) addRow();
    }

    function setAutoAddTrigger() {
        const lastRow = document.querySelector('#dynamicTable tbody tr:last-child');
        if (!lastRow) return;

        const inputs = lastRow.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.removeEventListener('input', autoAddRowIfNeeded);
            input.addEventListener('input', autoAddRowIfNeeded);
        });
    }

    function addRow() {
        const table = document.querySelector('#dynamicTable tbody');
        const rowCount = table.rows.length + 1;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${rowCount}</td>
            <td><input type="text" name="mahasiswa[${rowCount}][nama]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][asal_sekolah]" class="form-control"></td>
            <td>
                <select name="mahasiswa[${rowCount}][jalur_masuk]" class="form-control">
                    <option value="">Pilih Jalur</option>
                    <option value="SNBP">SNBP</option>
                    <option value="SNBT">SNBT</option>
                    <option value="Mandiri UPI">Mandiri UPI</option>
                </select>
            </td>
            <td><input type="text" name="mahasiswa[${rowCount}][akademik_endurance]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][latar_belakang]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][pola_belajar]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][perkuliahan]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
        `;
        table.appendChild(newRow);
        updateRowNumbers();
        setAutoAddTrigger();
    }



    function updateRowNumbers() {
        const rows = document.querySelectorAll('#dynamicTable tbody tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    }

    setAutoAddTrigger(); // jalankan saat awal

    // ============ Save & Ringkasan ============
    const saveBtn = document.getElementById('saveBtn');
    if (saveBtn) {
        saveBtn.addEventListener('click', function () {

            const namaKelas = document.querySelector('input[name="nama_kelas"]').value.trim();
        const kodeMK = document.querySelector('input[name="kode_mata_kuliah"]').value.trim();

        if (!namaKelas || !kodeMK) {
            alert("Nama Kelas dan Kode Mata Kuliah wajib diisi sebelum menyimpan data.");
            return;
        }

    const rows = document.querySelectorAll('#dynamicTable tbody tr');
    const data = [];
    let valid = true; // Flag untuk cek validitas

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
        else if (name.includes('[asal_sekolah]')) rowData.sekolah = value;
        else if (name.includes('[jalur_masuk]')) rowData.jalur = value;
        else if (name.includes('[akademik_endurance]')) rowData.akademik = value;
        else if (name.includes('[latar_belakang]')) rowData.latar = value;
        else if (name.includes('[pola_belajar]')) rowData.pola = value;
        else if (name.includes('[perkuliahan]')) rowData.kuliah = value;
    });

    // Jika semua kolom kosong, skip aja
if (filledCount === 0) return;

// Kalau sebagian isi sebagian kosong, tolak
if (filledCount > 0 && emptyCount > 0) {
    alert(`Baris ke-${index + 1} belum lengkap. Silakan lengkapi semua kolom sebelum menyimpan.`);
    valid = false;
    return;
}
data.push(rowData);
// Kalau semua kolom terisi, baru push ke array
// if (filledCount > 0 && emptyCount === 0) {
//     data.push(rowData);
// }

});


    // Kalau ada baris yang gak valid, hentikan proses
    if (!valid) return;

    document.getElementById('mahasiswaJSON').value = JSON.stringify(data);

//     const namaKelas = document.getElementById('nama_kelas')?.value || '-';
// const kodeMK = document.getElementById('kode_mata_kuliah')?.value || '-';

//Scrool saat Klik save 
setTimeout(() => {
    const summary = document.getElementById('summaryContainer');
    if (summary) {
        const offset = summary.offsetTop - 80; // 100px margin biar ga ketutupan header
        window.scrollTo({
            top: offset,
            behavior: 'smooth'
        });
    }
}, 500);
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
        <th>Nama</th><th>Asal Sekolah</th><th>Jalur</th><th>Akademik</th><th>Latar Belakang</th><th>Pola Belajar</th>
        <th>Perkuliahan</th>
        </tr></thead><tbody>`;

    data.forEach(item => {
        summaryHTML += `<tr>
            <td>${item.nama}</td><td>${item.sekolah}</td><td>${item.jalur}</td><td>${item.akademik}</td>
            <td>${item.latar}</td><td>${item.pola}</td><td>${item.kuliah}</td>
        </tr>`;
    });

    summaryHTML += `</tbody></table>`;
    document.getElementById('summaryContainer').innerHTML = summaryHTML;
    document.getElementById('generateBtn')?.classList.remove('d-none');

    // Simpan data ke input hidden
    document.getElementById('mahasiswaData').value = JSON.stringify(data);

    //Scroll kebawah after klik button save
    setTimeout(() => {
        document.getElementById('summaryContainer')?.scrollIntoView({ behavior: 'smooth' });
    }, 300);

});
    }



    // =========== Generate Button ============
    const generateBtn = document.getElementById('generateBtn');
if (generateBtn) {
    generateBtn.addEventListener('click', function (e) {
        // e.preventDefault();

        const namaKelas = document.querySelector('input[name="nama_kelas"]').value;
        const kodeMatkul = document.querySelector('input[name="kode_mata_kuliah"]').value;

        const mahasiswa = [];
        const rows = document.querySelectorAll('#dynamicTable tbody tr');
        rows.forEach((row) => {
            const inputs = row.querySelectorAll('input, select');
            const data = {};
            inputs.forEach(input => {
                const keyMatch = input.name.match(/\[(.*?)\]/);
                if (keyMatch && keyMatch[1]) {
                    data[keyMatch[1]] = input.value;
                }
            });
            mahasiswa.push(data);
        });

        document.querySelector('input[name="nama_kelas"]').value = namaKelas;
        document.querySelector('input[name="kode_mata_kuliah"]').value = kodeMatkul;
        document.getElementById('mahasiswaJSON').value = JSON.stringify(mahasiswa);

        generateBtn.closest('form').submit();
    });
    }

});



</script>


<script>
     function removeRow(button) {
        button.closest('tr').remove();
        updateRowNumbers();
        setAutoAddTrigger();
    }
    </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const collapseEl = document.getElementById('tutorialPengisian');
  const toggleIcon = document.getElementById('toggleIcon');

  collapseEl.addEventListener('show.bs.collapse', function () {
    toggleIcon.textContent = '🔼'; // Saat terbuka
  });

  collapseEl.addEventListener('hide.bs.collapse', function () {
    toggleIcon.textContent = '🔽'; // Saat tertutup
  });
</script>


@endsection
