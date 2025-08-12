<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilDesa;
use App\Models\Dusun;
use App\Models\Galeri;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class GuestViewController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $profil = ProfilDesa::first();
        $latestGaleris = Galeri::latest()
                            ->take(6)
                            ->get();
        $latestBeritas = Berita::latest('tanggal')
                              ->take(6)
                              ->get();
        $latestKegiatans = Kegiatan::mendatang()
                                ->orderBy('tanggal', 'asc') // Urutkan berdasarkan tanggal terdekat
                                ->take(6)
                                ->get();
        return view('home.index', compact('latestBeritas', 'profil', 'latestGaleris', 'latestKegiatans'));
    }

    public function profile()
    {
        $profil = ProfilDesa::first();

        // Ambil daftar dusun
        $dusuns = collect();
        if ($profil) {
            $dusuns = Dusun::where('profil_desa_id', $profil->id)->get();
        }



        return view('profile.index', compact('profil', 'dusuns'));
    }


    public function berita(Request $request) // Tambahkan Request $request
    {
        $query = Berita::query(); // Mulai dengan query dasar

        // Filter by search
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('konten', 'like', '%' . $search . '%');
            });
        }

        // Sort
        $sort = $request->input('sort', 'newest'); // Default sort by newest
        if ($sort === 'oldest') {
            $query->orderBy('tanggal', 'asc');
        } elseif ($sort === 'title') {
            $query->orderBy('judul', 'asc');
        } else { // 'newest' or any other value
            $query->orderBy('tanggal', 'desc');
        }

        $beritas = $query->paginate(9); // 9 items per page

        return view('berita.index', compact('beritas'));
    }

    public function beritaDetail($judul, $id)
    {
        $berita = Berita::findOrFail($id);

        $relatedBeritas = Berita::where('id', '!=', $id)
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();

        return view('berita.show', compact('berita', 'relatedBeritas'));
    }

    public function kegiatan(Request $request)
    {
        $query = Kegiatan::mendatang(); // Hanya ambil kegiatan mendatang

        // Filter by search
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kegiatan', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%');
            });
        }

        // Sort
        $sort = $request->input('sort', 'newest');
        if ($sort === 'oldest') {
            $query->orderBy('tanggal', 'asc');
        } elseif ($sort === 'title') {
            $query->orderBy('nama_kegiatan', 'asc');
        } else { // newest
            $query->orderBy('tanggal', 'desc');
        }

        $kegiatans = $query->paginate(9); // 9 items per page

        return view('kegiatan.index', compact('kegiatans'));
    }

    public function kegiatanDetail($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('kegiatan.show', compact('kegiatan'));
    }

    public function pemerintahan()
    {
        $semuaPerangkat = StrukturOrganisasi::orderBy('urutan', 'asc')->get();

        // Memfilter data berdasarkan jabatan
        $kepalaDesa = $semuaPerangkat->firstWhere('jabatan', 'Kepala Desa');
        $sekretaris = $semuaPerangkat->firstWhere('jabatan', 'Sekretaris Desa');

        $kaur = $semuaPerangkat->filter(function($item) {
            return str_contains($item->jabatan, 'Kaur');
        });

        $kasi = $semuaPerangkat->filter(function($item) {
            return str_contains($item->jabatan, 'Kasi');
        });

        $kadus = $semuaPerangkat->filter(function($item) {
            $jabatan = strtolower($item->jabatan);
            return str_contains($jabatan, 'kadus') || str_contains($jabatan, 'kepala dusun');
        });

        // Mengambil data yang tidak termasuk dalam kategori di atas
        $lainnya = $semuaPerangkat->reject(function($item) use ($kepalaDesa, $sekretaris, $kaur, $kasi, $kadus) {
            if ($kepalaDesa && $item->id === $kepalaDesa->id) return true;
            if ($sekretaris && $item->id === $sekretaris->id) return true;
            if ($kaur->contains('id', $item->id)) return true;
            if ($kasi->contains('id', $item->id)) return true;
            if ($kadus->contains('id', $item->id)) return true;
            return false;
        });

        // Mengirim data yang sudah dikelompokkan ke view
        return view('struktur.index', compact(
            'kepalaDesa',
            'sekretaris',
            'kaur',
            'kasi',
            'kadus',
            'lainnya'
        ));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->paginate(12);

        // Mengirim data 'galeris' ke view 'galeri.index'
        return view('galeri.index', compact('galeris'));
    }
}
