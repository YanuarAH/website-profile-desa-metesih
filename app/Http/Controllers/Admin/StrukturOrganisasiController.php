<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'foto_original' => 'nullable|image',
            'foto_cropped' => 'nullable|string'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'urutan.required' => 'Urutan harus diisi.',
            'foto_original.image' => 'File harus berupa gambar.',
        ]);

        $data = $request->only(['nama', 'jabatan', 'urutan']);
        $fotoPath = null;

        // Prioritaskan gambar yang dipotong dari Cropper.js
        if ($request->filled('foto_cropped')) {
            $croppedImage = $request->input('foto_cropped');
            // Pastikan data adalah Base64 image
            if (Str::startsWith($croppedImage, 'data:image')) {
                // Pisahkan "data:image/jpeg;base64," dari data Base64
                list($type, $croppedImage) = explode(';', $croppedImage);
                list(, $croppedImage) = explode(',', $croppedImage);

                $croppedImage = base64_decode($croppedImage);
                $extension = explode('/', explode(':', $type)[1])[0]; // Dapatkan ekstensi (jpeg, png, dll)

                $filename = 'struktur/' . Str::uuid() . '.' . $extension; // Nama file unik
                Storage::disk('public')->put($filename, $croppedImage);
                $fotoPath = $filename;
            }
        } elseif ($request->hasFile('foto_original')) {
            // Jika tidak ada gambar yang dipotong, gunakan unggahan file asli
            $fotoPath = $request->file('foto_original')->store('struktur', 'public');
        }

        $data['foto'] = $fotoPath;

        StrukturOrganisasi::create($data);

        return redirect()->route('struktur.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan.');
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
            'foto_original' => 'nullable|image',
            'foto_cropped' => 'nullable|string'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'urutan.required' => 'Urutan harus diisi.',
            'foto_original.image' => 'File harus berupa gambar.',
        ]);

        $data = $request->only(['nama', 'jabatan', 'urutan']);

        $fotoPath = $struktur->foto; // Pertahankan foto yang sudah ada secara default

        // Prioritaskan gambar yang dipotong dari Cropper.js
        if ($request->filled('foto_cropped')) {
            $croppedImage = $request->input('foto_cropped');
            if (Str::startsWith($croppedImage, 'data:image')) {
                // Hapus foto lama jika ada
                if ($struktur->foto && Storage::disk('public')->exists($struktur->foto)) {
                    Storage::disk('public')->delete($struktur->foto);
                }

                list($type, $croppedImage) = explode(';', $croppedImage);
                list(, $croppedImage) = explode(',', $croppedImage);

                $croppedImage = base64_decode($croppedImage);
                $extension = explode('/', explode(':', $type)[1])[0];

                $filename = 'struktur/' . Str::uuid() . '.' . $extension;
                Storage::disk('public')->put($filename, $croppedImage);
                $fotoPath = $filename;
            }
        } elseif ($request->hasFile('foto_original')) {
            // Jika tidak ada gambar yang dipotong, tapi ada unggahan file asli
            // Hapus foto lama jika ada
            if ($struktur->foto && Storage::disk('public')->exists($struktur->foto)) {
                Storage::disk('public')->delete($struktur->foto);
            }
            $fotoPath = $request->file('foto_original')->store('struktur', 'public');
        }
        // Jika tidak ada foto_cropped dan tidak ada foto_original, fotoPath akan tetap foto lama

        $data['foto'] = $fotoPath; // Perbarui path gambar

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
