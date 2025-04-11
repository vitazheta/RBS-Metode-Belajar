@extends('layouts.app')

@section('content')
<style>
#addRowBtn {
  background-color: #f2c84b;
  border-color: #f2c84b;
  color: #0e1e4b; /* teks gelap biar kontras */
}

#addRowBtn:hover {
  background-color: #d4ac30;
  border-color: #d4ac30;
}

#saveBtn {
  background-color: #2b4c7e;
  border-color: #2b4c7e;
  color: white;
}

#saveBtn:hover {
  background-color: #355c99;
  border-color: #355c99;
}

#generateBtn {
  background-color: #2b4c7e;
  border-color: #2b4c7e;
  color: white;
}

#generateBtn:hover {
  background-color: #355c99;
  border-color: #355c99;
}

input::placeholder {
    font-weight: 300;
    color: #888;
    font-style: italic;
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
        background-color: #0e1e4b;
        color: white;
    }

    .custom-table th,
    .custom-table td {
        padding: 12px 15px;
        text-align: center;
        vertical-align: middle;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f0f4fa;
    }

    .custom-table tbody tr:hover {
        background-color: #e6f0fa;
        transition: all 0.2s ease-in-out;
    }

    .custom-table .btn-delete {
        background-color: #f27aaf;
        border: none;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
    }

    .custom-table .btn-delete:hover {
        background-color: #e06498;
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

</style>


<div class="container" style="padding-top: 70px;">
    <h2 class="mb-2 fw-bold position-relative d-inline-block" style="color: #0E1F4D;">
        Data Kelas
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #ffffff;"></span>
    </h2>
<!-- Tombol Toggle -->
<button class="btn btn-link p-0 text-decoration-none small d-flex align-items-center"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#tutorialPengisian"
        aria-expanded="false"
        aria-controls="tutorialPengisian"
        id="toggleBtn"
        style="color: #0e1e4b; margin-top: 0px; margin-bottom: 8px;">
  <span id="toggleIcon">📘</span> &nbsp; Lihat panduan pengisian
</button>


<!-- Konten Collapse -->
<div class="collapse mt-2" id="tutorialPengisian">
  <div class="card border-0 shadow-sm" style="background-color: #fdf9ed; font-size: 0.9rem; color: #0e1e4b; margin-bottom: 10px;">
    <div class="card-body">
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
                    <th>Email</th>
                    <th>Jalur Masuk</th>
                    <th>Akademik</th>
                    <th>Ekonomi</th>
                    <th>Endurance</th>
                    <th>Sekolah</th>
                    <th>Ortu</th>
                    <th>Pola</th>
                    <th>Adaptasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="mahasiswa[0][nama]"                    class="form-control"></td>
                    <td><input type="email" name="mahasiswa[0][email]" class="form-control"></td>
                    <td>
                        <select name="mahasiswa[0][jalur_masuk]" class="form-control">
                            <option value="">Pilih Jalur</option>
                            <option value="SNBP">SNBP</option>
                            <option value="SNBT">SNBT</option>
                            <option value="Mandiri UPI">Mandiri UPI</option>
                        </select>
                    </td>
                    <td><input type="text" name="mahasiswa[0][kesiapan_akademik]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][kesiapan_ekonomi]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][endurance_cita_cita]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][profil_sekolah]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][profil_ortu]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][pola_belajar]" class="form-control"></td>
                    <td><input type="text" name="mahasiswa[0][adaptasi]" class="form-control"></td>
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
            const dataRows = rows.slice(0);
            const tableBody = document.querySelector('#dynamicTable tbody');
            tableBody.innerHTML = '';

            dataRows.forEach((cols, index) => {
                if (cols.length < 10) return;

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${index + 1}</td>
                    <td><input type="text" name="mahasiswa[${index}][nama]" class="form-control" value="${cols[0]}"></td>
                    <td><input type="email" name="mahasiswa[${index}][email]" class="form-control" value="${cols[1]}"></td>
                    <td>
                        <select name="mahasiswa[${index}][jalur_masuk]" class="form-control">
                            <option value="SNBP" ${cols[2] === 'SNBP' ? 'selected' : ''}>SNBP</option>
                            <option value="SNBT" ${cols[2] === 'SNBT' ? 'selected' : ''}>SNBT</option>
                            <option value="Mandiri UPI" ${cols[2] === 'Mandiri UPI' ? 'selected' : ''}>Mandiri UPI</option>
                            <option value="Mandiri" ${cols[2] === 'Mandiri' ? 'selected' : ''}>Mandiri</option>
                        </select>
                    </td>
                    <td><input type="text" name="mahasiswa[${index}][kesiapan_akademik]" class="form-control" value="${cols[3]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][kesiapan_ekonomi]" class="form-control" value="${cols[4]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][endurance_cita_cita]" class="form-control" value="${cols[5]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][profil_sekolah]" class="form-control" value="${cols[6]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][profil_ortu]" class="form-control" value="${cols[7]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][pola_belajar]" class="form-control" value="${cols[8]}"></td>
                    <td><input type="text" name="mahasiswa[${index}][adaptasi]" class="form-control" value="${cols[9]}"></td>
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
            <td><input type="email" name="mahasiswa[${rowCount}][email]" class="form-control"></td>
            <td>
                <select name="mahasiswa[${rowCount}][jalur_masuk]" class="form-control">
                    <option value="">Pilih Jalur</option>
                    <option value="SNBP">SNBP</option>
                    <option value="SNBT">SNBT</option>
                    <option value="Mandiri UPI">Mandiri UPI</option>
                </select>
            </td>
            <td><input type="text" name="mahasiswa[${rowCount}][kesiapan_akademik]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][kesiapan_ekonomi]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][endurance_cita_cita]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][profil_sekolah]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][profil_ortu]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][pola_belajar]" class="form-control"></td>
            <td><input type="text" name="mahasiswa[${rowCount}][adaptasi]" class="form-control"></td>
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
        else if (name.includes('[email]')) rowData.email = value;
        else if (name.includes('[jalur_masuk]')) rowData.jalur = value;
        else if (name.includes('[kesiapan_akademik]')) rowData.akademik = value;
        else if (name.includes('[kesiapan_ekonomi]')) rowData.ekonomi = value;
        else if (name.includes('[endurance_cita_cita]')) rowData.endurance = value;
        else if (name.includes('[profil_sekolah]')) rowData.sekolah = value;
        else if (name.includes('[profil_ortu]')) rowData.ortu = value;
        else if (name.includes('[pola_belajar]')) rowData.pola = value;
        else if (name.includes('[adaptasi]')) rowData.adaptasi = value;
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

    let summaryHTML = `
     <div class="card mt-4 p-4 shadow-sm" style="background-color: #f8f9fa;">
    <h4 class="mb-2 fw-bold" style="color: #0E1F4D;">Ringkasan Data</h4>
        <p class="mb-4 text-muted" style="font-size: 14px;">
        Berikut ringkasan data yang telah Anda input. Silakan cek kembali sebelum menekan tombol <strong>Generate</strong>.
        </p>
    <div class="row mb-3">
    <div class="col-md-6">
        <strong>Nama Kelas:</strong> ${namaKelas}
    </div>
    <div class="col-md-6">
        <strong>Kode Mata Kuliah:</strong> ${kodeMK}
    </div>
</div>


        <table class="custom-table"><thead><tr>
        <th>Nama</th><th>Email</th><th>Jalur</th><th>Akademik</th><th>Ekonomi</th><th>Endurance</th>
        <th>Sekolah</th><th>Ortu</th><th>Pola</th><th>Adaptasi</th>
        </tr></thead><tbody>`;

    data.forEach(item => {
        summaryHTML += `<tr>
            <td>${item.nama}</td><td>${item.email}</td><td>${item.jalur}</td><td>${item.akademik}</td>
            <td>${item.ekonomi}</td><td>${item.endurance}</td><td>${item.sekolah}</td>
            <td>${item.ortu}</td><td>${item.pola}</td><td>${item.adaptasi}</td>
        </tr>`;
    });

    summaryHTML += `</tbody></table>`;
    document.getElementById('summaryContainer').innerHTML = summaryHTML;
    document.getElementById('generateBtn')?.classList.remove('d-none');

    // Simpan data ke input hidden
    document.getElementById('mahasiswaData').value = JSON.stringify(data);


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
    toggleIcon.textContent = '📘'; // Saat tertutup
  });
</script>


@endsection
