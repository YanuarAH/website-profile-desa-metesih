<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilDesa;
use App\Models\Dusun;
use App\Models\Galeri;
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
        return view('home.index', compact('latestBeritas', 'profil', 'latestGaleris'));
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


    public function berita()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('berita.index', compact('beritas'));
    }

    public function beritaDetail($id)
    {
        $berita = Berita::findOrFail($id);
        
        $relatedBeritas = Berita::where('id', '!=', $id)
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();
        
        return view('berita.show', compact('berita', 'relatedBeritas'));
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
