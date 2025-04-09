<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\DataMahasiswa;

class KelasController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nama_kelas' => 'required|string|max:255',
        'kode_mata_kuliah' => 'required|string|max:20|unique:kelas,kode_mata_kuliah',
    ]);

    $kelas = Kelas::create([

        'dosen_id' => Auth::user()->id,
        'nama_kelas' => $request->nama_kelas,
        'kode_mata_kuliah' => $request->kode_mata_kuliah,
    ]);
    session(['kelas_id' => $kelas->id]);


    // Jika ada file CSV, proses sebagai file
    if ($request->hasFile('csv_file')) {
        $file = $request->file('csv_file');
        $data = array_map('str_getcsv', file($file));
        $header = array_map('strtolower', array_map('trim', $data[0]));
        unset($data[0]);

        foreach ($data as $row) {
            $siswaData = array_combine($header, $row);

            DataMahasiswa::create([
                'kelas_id' => $kelas->id,
                'nama_lengkap' => $row[0],
                'email' => $row[1],
                'jalur_masuk' => $row[2],
                'kesiapan_akademik' => $row[3],
                'kesiapan_ekonomi' => $row[4],
                'endurance_cita-cita' => $row[5],
                'profil_sekolah' => $row[6],
                'profil_ortu' => $row[7],
                'pola_belajar' => $row[8],
                'kemampuan_adaptasi' => $row[9],
            ]);
        }
    } else {
        // Proses data dari form manual (input[] array)
        $nama_lengkap = $request->input('nama_lengkap');
        $asal_sekolah = $request->input('asal_sekolah');
        $gap_year = $request->input('gap_year');
        $bimbel = $request->input('bimbel');

        for ($i = 0; $i < count($nama_lengkap); $i++) {
            DataMahasiswa::create([
                'kelas_id' => $kelas->id,
                'nama_lengkap' => $nama_lengkap[$i],
                'asal_sekolah' => $asal_sekolah[$i],
                'gap_year' => $gap_year[$i],
                'bimbel' => $bimbel[$i],
            ]);
        }
    }

    session(['kelas_id' => $kelas->id]);

    return redirect()->route('kelas.show', $kelas->id);
}


    public function edit($id)
    {
        $kelas = Kelas::with('siswa')->findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        foreach ($kelas->siswa as $index => $siswa) {
            $siswa->update([
                'nama' => $request->nama[$index],
                'email' => $request->email[$index],
                'jalur_masuk' => $request->jalur_masuk[$index],
            ]);
        }

        return redirect()->route('data.kelas')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function index()
    {
        $daftarKelas = Kelas::all();
        return view('kelas.index', compact('daftarKelas'));
    }

    public function show($id)
    {
        $kelas = Kelas::with('mahasiswa')->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    public function generate(Request $request)
{
    dd($request->all());

    $nama_kelas = session('nama_kelas');
    $kode_mata_kuliah = session('kode_mata_kuliah');

    if (!$nama_kelas || !$kode_mata_kuliah) {
        return back()->with('error', 'Data kelas belum lengkap!');
    }
    // Cek dulu datanya ada atau nggak
    if (!$request->filled('nama_kelas') || !$request->filled('kode_mata_kuliah')) {
        return back()->with('error', 'Nama kelas dan kode mata kuliah harus diisi.');
    }

    // Simpan ke tabel `kelas`
    $kelas = Kelas::create([
        'dosen_id' => auth()->id(), // atau bisa pakai: Auth::user()->id
        'nama_kelas' => $request->nama_kelas,
        'kode_mata_kuliah' => $request->kode_mata_kuliah, // <- Pastikan ini masuk
    ]);

    // Simpan ke tabel `data_mahasiswa`
    foreach ($request->nama as $index => $nama) {
        DataMahasiswa::create([
            'kelas_id' => $kelas->id,
            'nama' => $nama,
            'asal_sekolah' => $request->asal_sekolah[$index],
            'gap_year' => $request->gap_year[$index],
            'bimbel' => $request->bimbel[$index],
        ]);
    }

    return redirect()->route('hasil.rekomendasi', ['kelas_id' => $kelas->id]);
}

public function preview(Request $request)
{
    session([
        'summary' => [
            'nama_kelas' => $request->nama_kelas,
            'kode_mata_kuliah' => $request->kode_mata_kuliah,
            'mahasiswa' => $request->mahasiswa // atau array manual dari input[]
        ]
    ]);

    return back();

}

public function generateData(Request $request)
{
    // Ambil data dari request
    $kelas = new Kelas();
    $kelas->dosen_id = auth()->user()->id;
    $kelas->nama_kelas = $request->nama_kelas;
    $kelas->kode_mata_kuliah = $request->kode_mata_kuliah;
    $kelas->save();

    $mahasiswaList = json_decode($request->mahasiswa_data, true);
    foreach ($mahasiswaList as $m) {
        DataMahasiswa::create([
            'kelas_id' => $kelas->id,
            'nama' => $m['nama'],
            'email' => $m['email'],
            'jalur_masuk' => $m['jalur'],
            'kesiapan_akademik' => $m['akademik'],
            'kesiapan_ekonomi' => $m['ekonomi'],
            'endurance_citacita' => $m['endurance'],
            'profil_sekolah' => $m['sekolah'],
            'profil_ortu' => $m['ortu'],
            'pola_belajar' => $m['pola'],
            'adaptasi' => $m['adaptasi'],
        ]);
    }

    return redirect()->route('hasil.rekomendasi', $kelas->id);
}




}
