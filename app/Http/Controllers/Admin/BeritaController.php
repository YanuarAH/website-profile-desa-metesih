<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('konten', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'title':
                $query->orderBy('judul', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('tanggal', 'desc');
                break;
        }

        $beritas = $query->paginate(10)->withQueryString();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        $berita = new Berita();
        return view('admin.berita.form', compact('berita'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'image|nullable'
        ]);

        if ($request->filled('cropped_image')) {
            $cropped = $request->input('cropped_image');

            // Ambil data base64 tanpa prefix
            $cropped = preg_replace('#^data:image/\w+;base64,#i', '', $cropped);

            // Decode base64
            $imageData = base64_decode($cropped);

            // Generate nama unik
            $filename = 'gambars/' . uniqid() . '.jpg';

            // Simpan ke storage publik
            Storage::disk('public')->put($filename, $imageData);

            // Simpan ke kolom gambar
            $data['gambar'] = $filename;
        }


        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.form', compact('berita'));
    }

    // app/Http/Controllers/Admin/BeritaController.php

    public function update(Request $request, $id)
    {
        // 1. Validasi semua input terlebih dahulu
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'image|nullable' 
        ]);

        // 2. Ambil hanya data yang pasti diupdate (judul dan konten)
        $data = $request->only(['judul', 'konten']);

        // 3. Proses gambar HANYA JIKA ada gambar baru dari cropper
        if ($request->filled('cropped_image')) {

            // Hapus gambar lama dari storage
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            // Proses dan simpan gambar baru
            $cropped = $request->input('cropped_image');
            $cropped = preg_replace('#^data:image/\w+;base64,#i', '', $cropped);
            $imageData = base64_decode($cropped);
            $filename = 'gambars/' . uniqid() . '.jpg';
            Storage::disk('public')->put($filename, $imageData);

            // 4. Tambahkan nama file gambar baru ke array data
            $data['gambar'] = $filename;
        }

        // 5. Lakukan update dengan data yang sudah disiapkan
        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus');
    }
}
