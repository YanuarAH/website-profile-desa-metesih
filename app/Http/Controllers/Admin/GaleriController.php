<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%");
        }

        // Sort functionality
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'judul_asc':
                $query->orderBy('judul', 'asc');
                break;
            case 'judul_desc':
                $query->orderBy('judul', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $galeris = $query->paginate(12)->withQueryString();

        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ], [
            'gambar.required' => 'Gambar harus dipilih.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar maksimal 5MB.'
        ]);

        $data = $request->only(['judul']);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        Galeri::create($data);

        return redirect()->route('galeri.index')
                        ->with('success', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.form', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ], [
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar maksimal 5MB.'
        ]);

        $data = $request->only(['judul']);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')
                        ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        // Delete image if exists
        if ($galeri->gambar) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')
                        ->with('success', 'Foto berhasil dihapus dari galeri.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'selected_items' => 'required|array',
            'selected_items.*' => 'exists:galeris,id'
        ]);

        $galeris = Galeri::whereIn('id', $request->selected_items)->get();
        
        foreach ($galeris as $galeri) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $galeri->delete();
        }

        return redirect()->route('galeri.index')
                        ->with('success', count($request->selected_items) . ' foto berhasil dihapus.');
    }
}
