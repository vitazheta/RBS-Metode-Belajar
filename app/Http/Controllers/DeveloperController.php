<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = [
            [
                'name' => 'Latifah Sahlaa',
                'title' => 'Project Manager & Logic Developer',
                'image' => 'images/developer/CONTOH 1.jpg', // Ganti dengan URL gambar sebenarnya
                'details' => 'Mengatur jalannya proyek dan koordinasi tim, mendesain dan mengimplementasikan algoritma logika dan aturan sistem, melakukan optimasi kinerja sistem dan troubleshooting, membantu pengembangan backend, membantu memberikan solusi dalam permasalahan yang dihadapi tim'
            ],
            [
                'name' => 'Dila Indra Nurdiansyah',
                'title' => 'Database Engineer & Backend Developer',
                'image' => 'images/developer/CONTOH 2.jpg', // Ganti dengan URL gambar sebenarnya
                'details' => 'Mendesain dan mengelola struktur database, mengintegrasikan database dengan backend dan frontend. membantu debugging dan optimasi sistem, membantu membuat kerangka awal pada frontend, membantu memberikan solusi dalam permasalahan yang dihadapi tim'
            ],
            [
                'name' => 'Azzahra Pravita Zheta',
                'title' => 'Frontend Developer & UI/UX Designer',
                'image' => 'images/developer/CONTOH 3.jpg', // Ganti dengan URL gambar sebenarnya
                'details' => 'Mendesain antarmuka pengguna (UI), mendesain logo sistem, mengimplementasikan desain menggunakan HTML, CSS, dan Javascript, menjaga responsivitas dan pengalaman pengguna, membantu memberikan solusi dalam permasalahan yang dihadapi tim'
            ],
            [
                'name' => 'Sania Farhat',
                'title' => 'Testing & Quality Assurance ',
                'image' => 'images/developer/CONTOH 4.jpg', // Ganti dengan URL gambar sebenarnya
                'details' => 'Melakukan pengujian sistem secara menyeluruh, mencatat hasil pengujian untuk evaluasi dan perbaikan, membantu memberikan solusi dalam permasalahan yang dihadapi tim'
            ],
            [
                'name' => 'Naila Nurr Faiza',
                'title' => 'Alumni Data Collector & Technical Writer',
                'image' => 'images/developer/CONTOH 5.jpg', // Ganti dengan URL gambar sebenarnya
                'details' => 'Menghimpun dan menganalisis data alumni sesuai dengan kebutuhan sistem, membuat dokumentasi dan panduan penggunaan sistem, membantu memberikan solusi dalam permasalahan yang dihadapi tim'
            ],
            [
                'name' => 'Deafani Meily Zianillah',
                'title' => 'Student Data Collector & Public Relation',
                'image' => 'images/developer/CONTOH 6.jpg', // Ganti dengan URL gambar sebenarnya
                'details' => 'Menghimpun dan menganalisis data mahasiswa sesuai dengan kebutuhan sistem, mengelola komunikasi dengan pihak luar dan internal, membantu memberikan solusi dalam permasalahan yang dihadapi tim'
            ]
            
        ];

        return view('developer', compact('developers'));
    }
}