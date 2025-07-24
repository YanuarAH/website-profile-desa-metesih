<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $data = StrukturOrganisasi::orderBy('urutan')->get();
        return view('admin.struktur.index', compact('data'));
    }

    public function create()
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png',
            'urutan' => 'required|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        StrukturOrganisasi::create($data);
        return redirect()->route('struktur.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = StrukturOrganisasi::findOrFail($id);
        return view('admin.struktur.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = StrukturOrganisasi::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png',
            'urutan' => 'required|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($item->foto) {
                Storage::delete($item->foto);
            }
            $data['foto'] = $request->file('foto')->store('struktur');
        }

        $item->update($data);
        return redirect()->route('struktur.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = StrukturOrganisasi::findOrFail($id);
        if ($item->foto) {
            Storage::delete($item->foto);
        }
        $item->delete();
        return redirect()->route('struktur.index')->with('success', 'Data berhasil dihapus');
    }
}
