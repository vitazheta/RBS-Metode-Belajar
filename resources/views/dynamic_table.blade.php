@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Formulir Dinamis</h2>

    <!-- Form Upload CSV -->
    <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data" class="mb-3 d-flex">
        @csrf
        <input type="file" name="csv_file" class="form-control me-2" accept=".csv" required>
        <button type="submit" class="btn btn-sm btn-success">Import CSV</button>
    </form>

    <table class="table table-bordered" id="dynamicTable">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jalur Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @if(session('data'))
        @foreach(session('data') as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td><input type="text" name="nama[]" class="form-control" value="{{ $row[0] }}" oninput="checkAndAddRow()"></td>
            <td><input type="email" name="email[]" class="form-control" value="{{ $row[1] }}" oninput="checkAndAddRow()"></td>
            <td>
                <select name="jalur_masuk[]" class="form-control">
                    <option value="SNBP" {{ $row[2] == 'SNBP' ? 'selected' : '' }}>SNBP</option>
                    <option value="SNBT" {{ $row[2] == 'SNBT' ? 'selected' : '' }}>SNBT</option>
                    <option value="Mandiri UPI" {{ $row[2] == 'Mandiri UPI' ? 'selected' : '' }}>Mandiri UPI</option>
                </select>
            </td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
        </tr>
        @endforeach
            @else
                @for ($i = 1; $i <= 5; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td><input type="text" name="nama[]" class="form-control" oninput="checkLastRow(this)"></td>
                        <td><input type="email" name="email[]" class="form-control" oninput="checkLastRow(this)"></td>
                        <td>
                            <select name="jalur_masuk[]" class="form-control">
                                <option value="">Pilih Jalur</option>
                                <option value="SNBP">SNBP</option>
                                <option value="SNBT">SNBT</option>
                                <option value="Mandiri UPI">Mandiri UPI</option>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                             <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>

                    </tr>
                @endfor
            @endif
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        ensureEmptyRowExists(); // Pastikan ada satu baris kosong setelah data CSV di-load
    });

    function ensureEmptyRowExists() {
        let table = document.getElementById("dynamicTable").getElementsByTagName('tbody')[0];
        let lastRow = table.rows[table.rows.length - 1];

        if (!lastRow || lastRow.querySelectorAll("input").length === 0) {
            addRow(); // Jika tidak ada baris atau baris terakhir kosong, tambahkan satu
            return;
        }

        let isFilled = true;
        lastRow.querySelectorAll("input").forEach(input => {
            if (input.value.trim() === '') {
                isFilled = false;
            }
        });

        if (isFilled) {
            addRow(); // Tambahkan baris baru jika yang terakhir penuh
        }
    }

    function checkAndAddRow() {
        let table = document.getElementById("dynamicTable").getElementsByTagName('tbody')[0];
        let lastRow = table.rows[table.rows.length - 1];
        let inputs = lastRow.querySelectorAll("input");

        let isFilled = true;
        inputs.forEach(input => {
            if (input.value.trim() === '') {
                isFilled = false;
            }
        });

        if (isFilled) {
            addRow();
        }
    }

    function checkLastRow(input) {
        let row = input.closest("tr");
        let nextRow = row.nextElementSibling;

        if (!nextRow && input.value.trim() !== '') {
            addRow();
        }
    }

    function addRow() {
        let table = document.getElementById("dynamicTable").getElementsByTagName('tbody')[0];
        let rowCount = table.rows.length + 1;

        let newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>${rowCount}</td>
            <td><input type="text" name="nama[]" class="form-control" oninput="checkLastRow(this)"></td>
            <td><input type="email" name="email[]" class="form-control" oninput="checkLastRow(this)"></td>
            <td>
                <select name="jalur_masuk[]" class="form-control">
                    <option value="">Pilih Jalur</option>
                    <option value="SNBP">SNBP</option>
                    <option value="SNBT">SNBT</option>
                    <option value="Mandiri UPI">Mandiri UPI</option>
                </select>
            </td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
        `;
        table.appendChild(newRow);
        updateRowNumbers();
    }

    function removeRow(button) {
        let row = button.closest("tr");
        row.remove();
        updateRowNumbers();
    }

    function updateRowNumbers() {
        let rows = document.querySelectorAll("#dynamicTable tbody tr");
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    }
</script>

@endsection
