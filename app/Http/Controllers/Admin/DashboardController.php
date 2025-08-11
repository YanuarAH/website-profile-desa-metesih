<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\StrukturOrganisasi;
use App\Models\Galeri;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil total data dari masing-masing model
        $totalBerita = Berita::count();
        $totalKegiatan = Kegiatan::count();
        $totalGaleri = Galeri::count();
        $totalStruktur = StrukturOrganisasi::count(); // Ambil total struktur organisasi

        // Ambil kegiatan mendatang terbaru (misal 5 kegiatan)
        $upcomingKegiatans = Kegiatan::mendatang()
                                    ->orderBy('tanggal', 'asc')// Urutkan juga berdasarkan waktu
                                    ->take(5)
                                    ->get();

        return view('admin.dashboard.dashboard', compact(
            'totalBerita',
            'totalKegiatan',
            'totalGaleri',
            'totalStruktur', // Tambahkan ke compact
            'upcomingKegiatans'
        ));
    }
}
