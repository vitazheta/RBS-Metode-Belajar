@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 70px;">
    <h2 class="mb-3 fw-bold position-relative d-inline-block" style="color: #0E1F4D;">
        Data Kelas
        <span class="d-block mt-1" style="height: 3px; width: 100%; background-color: #ffffff;"></span>
    </h2>

    <!-- FORM UTAMA -->
    <form method="POST">
        @csrf

        <!-- Info Kelas -->
        <div class="mb-3 d-flex">
            <div class="w-50 me-3">
                <label>Nama Kelas:</label>
                <input type="text" name="nama_kelas" class="form-control" required>
            </div>
            <div class="w-50">
                <label>Kode Mata Kuliah:</label>
                <input type="text" name="kode_mata_kuliah" class="form-control" required>
            </div>
        </div>

        <!-- Tombol Import CSV -->
        <div class="mb-3">
    <label class="form-label">Import dari CSV:</label>
    <div class="input-group">
        <input type="file" id="csvFile" accept=".csv" class="form-control">
        <button type="button" class="btn btn-success" onclick="handleCSVImport()">Import CSV</button>
    </div>
</div>



        <!-- Tabel Input Mahasiswa -->
        <table class="table table-bordered" id="dynamicTable">
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
                    <td><input type="text" name="nama[]" class="form-control"></td>
                    <td><input type="email" name="email[]" class="form-control"></td>
                    <td>
                        <select name="jalur_masuk[]" class="form-control">
                            <option value="">Pilih Jalur</option>
                            <option value="SNBP">SNBP</option>
                            <option value="SNBT">SNBT</option>
                            <option value="Mandiri UPI">Mandiri UPI</option>
                        </select>
                    </td>
                    <td><input type="text" name="kesiapan_akademik[]" class="form-control"></td>
                    <td><input type="text" name="kesiapan_ekonomi[]" class="form-control"></td>
                    <td><input type="text" name="endurance_citacita[]" class="form-control"></td>
                    <td><input type="text" name="profil_sekolah[]" class="form-control"></td>
                    <td><input type="text" name="profil_ortu[]" class="form-control"></td>
                    <td><input type="text" name="pola_belajar[]" class="form-control"></td>
                    <td><input type="text" name="adaptasi[]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                </tr>
            </tbody>
        </table>

        <!-- Tombol Simpan -->
        <button type="button" class="btn btn-primary" id="saveBtn">Save</button>

        <!-- Ringkasan -->
        <div id="summaryContainer" class="mt-4"></div>
        <!-- <div id="summaryContainer" class="mt-4"></div> -->
    </form>
</div>

<script>
    function importCSV(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const text = e.target.result;
            const rows = text.trim().split('\n').map(r => r.split(','));

            // Lewati baris pertama (header)
            const dataRows = rows.slice(1);

            // Hapus semua baris yang ada sebelumnya
            const tableBody = document.querySelector('#dynamicTable tbody');
            tableBody.innerHTML = '';

            dataRows.forEach((cols, index) => {
                if (cols.length < 10) alert('Format CSV tidak sesuai. Harap cek ulang kolom.');
                return; // Cek cukup kolomnya

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${index + 1}</td>
                    <td><input type="text" name="nama[]" class="form-control" required value="${cols[0]}"></td>
                    <td><input type="email" name="email[]" class="form-control" required value="${cols[1]}"></td>
                    <td>
                        <select name="jalur_masuk[]" class="form-control">
                            <option value="SNBP" ${cols[2] === 'SNBP' ? 'selected' : ''}>SNBP</option>
                            <option value="SNBT" ${cols[2] === 'SNBT' ? 'selected' : ''}>SNBT</option>
                            <option value="Mandiri UPI" ${cols[2] === 'Mandiri UPI' ? 'selected' : ''}>Mandiri UPI</option>
                            <option value="Mandiri" ${cols[2] === 'Mandiri' ? 'selected' : ''}>Mandiri</option>
                        </select>
                    </td>
                    <td><input type="text" name="kesiapan_akademik[]" class="form-control" value="${cols[3]}"></td>
                    <td><input type="text" name="kesiapan_ekonomi[]" class="form-control" value="${cols[4]}"></td>
                    <td><input type="text" name="endurance_citacita[]" class="form-control" value="${cols[5]}"></td>
                    <td><input type="text" name="profil_sekolah[]" class="form-control" value="${cols[6]}"></td>
                    <td><input type="text" name="profil_ortu[]" class="form-control" value="${cols[7]}"></td>
                    <td><input type="text" name="pola_belajar[]" class="form-control" value="${cols[8]}"></td>
                    <td><input type="text" name="adaptasi[]" class="form-control" value="${cols[9]}"></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                `;
                tableBody.appendChild(newRow);
            });

            // Pasang trigger auto-add kalau perlu
            setAutoAddTrigger();
        };
        reader.readAsText(file);
    }
</script>

<script>
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

            const dataRows = rows.slice(1);
            const tableBody = document.querySelector('#dynamicTable tbody');
            tableBody.innerHTML = '';

            dataRows.forEach((cols, index) => {
                if (cols.length < 10) return;

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${index + 1}</td>
                    <td><input type="text" name="nama[]" class="form-control" value="${cols[0]}"></td>
                    <td><input type="email" name="email[]" class="form-control" value="${cols[1]}"></td>
                    <td>
                        <select name="jalur_masuk[]" class="form-control">
                            <option value="SNBP" ${cols[2] === 'SNBP' ? 'selected' : ''}>SNBP</option>
                            <option value="SNBT" ${cols[2] === 'SNBT' ? 'selected' : ''}>SNBT</option>
                            <option value="Mandiri UPI" ${cols[2] === 'Mandiri UPI' ? 'selected' : ''}>Mandiri UPI</option>
                            <option value="Mandiri" ${cols[2] === 'Mandiri' ? 'selected' : ''}>Mandiri</option>
                        </select>
                    </td>
                    <td><input type="text" name="kesiapan_akademik[]" class="form-control" value="${cols[3]}"></td>
                    <td><input type="text" name="kesiapan_ekonomi[]" class="form-control" value="${cols[4]}"></td>
                    <td><input type="text" name="endurance_citacita[]" class="form-control" value="${cols[5]}"></td>
                    <td><input type="text" name="profil_sekolah[]" class="form-control" value="${cols[6]}"></td>
                    <td><input type="text" name="profil_ortu[]" class="form-control" value="${cols[7]}"></td>
                    <td><input type="text" name="pola_belajar[]" class="form-control" value="${cols[8]}"></td>
                    <td><input type="text" name="adaptasi[]" class="form-control" value="${cols[9]}"></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
                `;
                tableBody.appendChild(newRow);
            });

            setAutoAddTrigger();
        };

        reader.readAsText(file);
    }
</script>




<!-- Script -->
 <script>
    function triggerImport() {
        const fileInput = document.getElementById('csvFile');
        const event = new Event('change');
        fileInput.dispatchEvent(event);
    }
</script>

<script>
    // Tambahkan baris otomatis
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
            <td><input type="text" name="nama[]" class="form-control"></td>
            <td><input type="email" name="email[]" class="form-control"></td>
            <td>
                <select name="jalur_masuk[]" class="form-control">
                    <option value="">Pilih Jalur</option>
                    <option value="SNBP">SNBP</option>
                    <option value="SNBT">SNBT</option>
                    <option value="Mandiri UPI">Mandiri UPI</option>
                </select>
            </td>
            <td><input type="text" name="kesiapan_akademik[]" class="form-control"></td>
            <td><input type="text" name="kesiapan_ekonomi[]" class="form-control"></td>
            <td><input type="text" name="endurance_citacita[]" class="form-control"></td>
            <td><input type="text" name="profil_sekolah[]" class="form-control"></td>
            <td><input type="text" name="profil_ortu[]" class="form-control"></td>
            <td><input type="text" name="pola_belajar[]" class="form-control"></td>
            <td><input type="text" name="adaptasi[]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
        `;
        table.appendChild(newRow);
        updateRowNumbers();
        setAutoAddTrigger();
    }

    function removeRow(button) {
        button.closest('tr').remove();
        updateRowNumbers();
        setAutoAddTrigger();
    }

    function updateRowNumbers() {
        const rows = document.querySelectorAll('#dynamicTable tbody tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    }

    // Inisialisasi saat halaman pertama kali load
    window.onload = setAutoAddTrigger;
</script>
<script>
document.getElementById('saveBtn').addEventListener('click', function () {
    const namaKelas = document.querySelector('input[name="nama_kelas"]').value;
    const kodeMK = document.querySelector('input[name="kode_mata_kuliah"]').value;

    const rows = document.querySelectorAll('#dynamicTable tbody tr');
    let mahasiswa = [];

    rows.forEach(row => {
        const inputs = row.querySelectorAll('input, select');
        const values = Array.from(inputs).map(i => i.value.trim());
        const filled = values.some(val => val !== '');

        if (filled) {
            mahasiswa.push({
                nama: values[0],
                email: values[1],
                jalur: values[2],
                akademik: values[3],
                ekonomi: values[4],
                endurance: values[5],
                sekolah: values[6],
                ortu: values[7],
                pola: values[8],
                adaptasi: values[9]
            });
        }
    });

    if (!namaKelas || !kodeMK || mahasiswa.length === 0) {
        alert("Mohon lengkapi data kelas dan setidaknya 1 data mahasiswa.");
        return;
    }

    let html = `
        <div class="card p-3 shadow-sm">
            <h5 class="fw-bold mb-2">Ringkasan Data</h5>
            <p><strong>Nama Kelas:</strong> ${namaKelas}</p>
            <p><strong>Kode Mata Kuliah:</strong> ${kodeMK}</p>
            <div class="table-responsive">
                <table class="table table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jalur</th>
                            <th>Akademik</th>
                            <th>Ekonomi</th>
                            <th>Endurance</th>
                            <th>Sekolah</th>
                            <th>Ortu</th>
                            <th>Pola</th>
                            <th>Adaptasi</th>
                        </tr>
                    </thead>
                    <tbody>
    `;

    mahasiswa.forEach((mhs, i) => {
        html += `
            <tr>
                <td>${i + 1}</td>
                <td>${mhs.nama}</td>
                <td>${mhs.email}</td>
                <td>${mhs.jalur}</td>
                <td>${mhs.akademik}</td>
                <td>${mhs.ekonomi}</td>
                <td>${mhs.endurance}</td>
                <td>${mhs.sekolah}</td>
                <td>${mhs.ortu}</td>
                <td>${mhs.pola}</td>
                <td>${mhs.adaptasi}</td>
            </tr>
        `;
    });

    html += `
                    </tbody>
                </table>
            <div class="mt-3 text-end">
            <form method="POST" action="{{ route('kelas.generate') }}">
                @csrf
                <input type="hidden" name="nama_kelas" value="${namaKelas}">
                <input type="hidden" name="kode_mata_kuliah" value="${kodeMK}">
                <input type="hidden" name="mahasiswa_data" value='${JSON.stringify(mahasiswa)}'>
                <button type="submit" class="btn btn-success">Generate</button>
            </form>
        </div>
        </div>
    `;

    document.getElementById('summaryContainer').innerHTML = html;

    // Tampilkan ringkasan dan isi hidden input untuk generate
    document.getElementById('ringkasan').style.display = 'block';
    document.getElementById('hiddenNamaKelas').value = namaKelas;
    document.getElementById('hiddenKodeMK').value = kodeMK;
    document.getElementById('hiddenMahasiswaData').value = JSON.stringify(mahasiswa);
});
</script>



@endsection
