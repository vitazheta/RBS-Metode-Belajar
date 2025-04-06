

public function generate(Request $request)
{
    // Simulasi pengambilan data siswa dan perhitungan metode belajar
    $siswa = session('data'); // misalnya data dari session import CSV
    $nama_kelas = $request->input('nama_kelas')[0];
    $kode_mk = $request->input('kode_mata_kuliah')[0];

    $data_kelas = [
        'nama_kelas' => $nama_kelas,
        'kode_mk' => $kode_mk,
        'siswa' => [],
    ];

    foreach ($siswa as $row) {
        $metode = $this->tentukanMetode($row);
        $data_kelas['siswa'][] = [
            'nama' => $row[0],
            'email' => $row[1],
            'jalur_masuk' => $row[2],
            'metode' => $metode,
        ];
    }

    // Simpan ke DB atau session
    session()->push('kelas_tersimpan', $data_kelas);
    return redirect()->route('data.kelas')->with('success', 'Metode berhasil digenerate!');
}

private function tentukanMetode($row)
{
    // Contoh logika sederhana
    if ($row[2] == 'SNBT') return 'Visual';
    if ($row[2] == 'SNBP') return 'Auditori';
    return 'Kinestetik';
}
