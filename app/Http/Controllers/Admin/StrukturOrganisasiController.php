<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = StrukturOrganisasi::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        // Sort functionality
        $sort = $request->get('sort', 'urutan_asc');
        switch ($sort) {
            case 'urutan_desc':
                $query->orderBy('urutan', 'desc');
                break;
            case 'nama_asc':
                $query->orderBy('nama', 'asc');
                break;
            case 'nama_desc':
                $query->orderBy('nama', 'desc');
                break;
            default:
                $query->orderBy('urutan', 'asc');
                break;
        }

        $strukturs = $query->paginate(12)->withQueryString();

        return view('admin.struktur.index', compact('strukturs'));
    }

    public function create()
    {
        return view('admin.struktur.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan' => 'required|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'urutan.required' => 'Urutan harus diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        $data = $request->only(['nama', 'jabatan', 'urutan']);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        StrukturOrganisasi::create($data);

        return redirect()->route('struktur.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function show(StrukturOrganisasi $struktur)
    {
        return view('admin.struktur.show', compact('struktur'));
    }

    public function edit(StrukturOrganisasi $struktur)
    {
        return view('admin.struktur.form', compact('struktur'));
    }

    public function update(Request $request, StrukturOrganisasi $struktur)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan' => 'required|integer|min:1|',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'urutan.required' => 'Urutan harus diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.'
        ]);

        $data = $request->only(['nama', 'jabatan', 'urutan']);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($struktur->foto) {
                Storage::disk('public')->delete($struktur->foto);
            }
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $struktur->update($data);

        return redirect()->route('struktur.index')
            ->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    public function destroy(StrukturOrganisasi $struktur)
    {
        // Delete photo if exists
        if ($struktur->foto) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('struktur.index')
            ->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
