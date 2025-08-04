<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use App\Models\Dusun;
use App\Models\RW;
use App\Models\RT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $profilDesa = ProfilDesa::with(['dusuns.rws.rts'])->first();
        return view('admin.profile.index', compact('profilDesa'));
    }

    public function create()
    {
        return view('admin.profile.form');
    }

    public function store(Request $request)
    {

        // Validasi
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'visi_misi' => 'required|string',
            'jumlah_penduduk' => 'required|integer|min:0',
            'penduduk_lk' => 'required|integer|min:0',
            'penduduk_pr' => 'required|integer|min:0',
            'jumlah_kk' => 'required|integer|min:0',
            'kk_lk' => 'required|integer|min:0',
            'kk_pr' => 'required|integer|min:0',
            'jumlah_rt' => 'required|integer|min:0',
            'jumlah_rw' => 'required|integer|min:0',
            'luas_wilayah' => 'required|numeric|min:0',
            'batas_utara' => 'required|string|max:255',
            'batas_selatan' => 'required|string|max:255',
            'batas_timur' => 'required|string|max:255',
            'batas_barat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dusuns' => 'nullable|array',
            'dusuns.*.nama_dusun' => 'nullable|string|max:255',
            'dusuns.*.rws' => 'nullable|array',
            'dusuns.*.rws.*.nomor' => 'nullable|string|max:10',
            'dusuns.*.rws.*.rts' => 'nullable|array',
            'dusuns.*.rws.*.rts.*.nomor' => 'nullable|string|max:10',
        ], [
            'nama_desa.required' => 'Nama desa wajib diisi',
            'visi_misi.required' => 'Visi dan misi wajib diisi',
            'jumlah_penduduk.required' => 'Jumlah penduduk wajib diisi',
            'penduduk_lk.required' => 'Jumlah penduduk laki-laki wajib diisi',
            'penduduk_pr.required' => 'Jumlah penduduk perempuan wajib diisi',
            'jumlah_kk.required' => 'Jumlah kepala keluarga wajib diisi',
            'kk_lk.required' => 'Jumlah kepala keluarga laki-laki wajib diisi',
            'kk_pr.required' => 'Jumlah kepala keluarga perempuan wajib diisi',
            'jumlah_rt.required' => 'Jumlah RT wajib diisi',
            'jumlah_rw.required' => 'Jumlah RW wajib diisi',
            'luas_wilayah.required' => 'Luas wilayah wajib diisi',
            'batas_utara.required' => 'Batas utara wajib diisi',
            'batas_selatan.required' => 'Batas selatan wajib diisi',
            'batas_timur.required' => 'Batas timur wajib diisi',
            'batas_barat.required' => 'Batas barat wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        DB::beginTransaction();
        
        try {
            // Siapkan data untuk disimpan
            $data = [
                'nama_desa' => $validated['nama_desa'],
                'visi_misi' => $validated['visi_misi'],
                'jumlah_penduduk' => $validated['jumlah_penduduk'],
                'penduduk_lk' => $validated['penduduk_lk'],
                'penduduk_pr' => $validated['penduduk_pr'],
                'jumlah_kk' => $validated['jumlah_kk'],
                'kk_lk' => $validated['kk_lk'],
                'kk_pr' => $validated['kk_pr'],
                'jumlah_rt' => $validated['jumlah_rt'],
                'jumlah_rw' => $validated['jumlah_rw'],
                'luas_wilayah' => $validated['luas_wilayah'],
                'batas_utara' => $validated['batas_utara'],
                'batas_selatan' => $validated['batas_selatan'],
                'batas_timur' => $validated['batas_timur'],
                'batas_barat' => $validated['batas_barat'],
            ];
            
            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $data['gambar'] = $request->file('gambar')->store('profil-desa', 'public');
            }

            // Simpan profil desa
            $profilDesa = ProfilDesa::create($data);

            // Simpan struktur wilayah
            $this->saveStrukturWilayah($request, $profilDesa);

            DB::commit();
            
            return redirect()->route('profile.index')
                            ->with('success', 'Profil desa berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saving profile:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $profilDesa = ProfilDesa::with(['dusuns.rws.rts'])->findOrFail($id);
        return view('admin.profile.form', compact('profilDesa'));
    }

    public function update(Request $request, $id)
    {
        $profilDesa = ProfilDesa::findOrFail($id);

        // Validasi
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'visi_misi' => 'required|string',
            'jumlah_penduduk' => 'required|integer|min:0',
            'penduduk_lk' => 'required|integer|min:0',
            'penduduk_pr' => 'required|integer|min:0',
            'jumlah_kk' => 'required|integer|min:0',
            'kk_lk' => 'required|integer|min:0',
            'kk_pr' => 'required|integer|min:0',
            'jumlah_rt' => 'required|integer|min:0',
            'jumlah_rw' => 'required|integer|min:0',
            'luas_wilayah' => 'required|numeric|min:0',
            'batas_utara' => 'required|string|max:255',
            'batas_selatan' => 'required|string|max:255',
            'batas_timur' => 'required|string|max:255',
            'batas_barat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dusuns' => 'nullable|array',
            'dusuns.*.nama_dusun' => 'nullable|string|max:255',
            'dusuns.*.rws' => 'nullable|array',
            'dusuns.*.rws.*.nomor' => 'nullable|string|max:10',
            'dusuns.*.rws.*.rts' => 'nullable|array',
            'dusuns.*.rws.*.rts.*.nomor' => 'nullable|string|max:10',
        ], [
            'nama_desa.required' => 'Nama desa wajib diisi',
            'visi_misi.required' => 'Visi dan misi wajib diisi',
            'jumlah_penduduk.required' => 'Jumlah penduduk wajib diisi',
            'penduduk_lk.required' => 'Jumlah penduduk laki-laki wajib diisi',
            'penduduk_pr.required' => 'Jumlah penduduk perempuan wajib diisi',
            'jumlah_kk.required' => 'Jumlah kepala keluarga wajib diisi',
            'kk_lk.required' => 'Jumlah kepala keluarga laki-laki wajib diisi',
            'kk_pr.required' => 'Jumlah kepala keluarga perempuan wajib diisi',
            'jumlah_rt.required' => 'Jumlah RT wajib diisi',
            'jumlah_rw.required' => 'Jumlah RW wajib diisi',
            'luas_wilayah.required' => 'Luas wilayah wajib diisi',
            'batas_utara.required' => 'Batas utara wajib diisi',
            'batas_selatan.required' => 'Batas selatan wajib diisi',
            'batas_timur.required' => 'Batas timur wajib diisi',
            'batas_barat.required' => 'Batas barat wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        DB::beginTransaction();
        
        try {
            // Siapkan data untuk diupdate
            $data = [
                'nama_desa' => $validated['nama_desa'],
                'visi_misi' => $validated['visi_misi'],
                'jumlah_penduduk' => $validated['jumlah_penduduk'],
                'penduduk_lk' => $validated['penduduk_lk'],
                'penduduk_pr' => $validated['penduduk_pr'],
                'jumlah_kk' => $validated['jumlah_kk'],
                'kk_lk' => $validated['jumlah_kk_lk'],
                'kk_pr' => $validated['jumlah_kk_pr'],
                'jumlah_rt' => $validated['jumlah_rt'],
                'jumlah_rw' => $validated['jumlah_rw'],
                'luas_wilayah' => $validated['luas_wilayah'],
                'batas_utara' => $validated['batas_utara'],
                'batas_selatan' => $validated['batas_selatan'],
                'batas_timur' => $validated['batas_timur'],
                'batas_barat' => $validated['batas_barat'],
            ];
            
            // Upload gambar baru jika ada
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($profilDesa->gambar) {
                    Storage::disk('public')->delete($profilDesa->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('profil-desa', 'public');
            }

            // Update profil desa
            $profilDesa->update($data);

            // Update struktur wilayah
            $this->updateStrukturWilayah($request, $profilDesa);

            DB::commit();
            
            Log::info('Profile updated successfully');
            
            return redirect()->route('profile.index')
                            ->with('success', 'Profil desa berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating profile:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $profilDesa = ProfilDesa::findOrFail($id);
            
            // Hapus gambar jika ada
            if ($profilDesa->gambar) {
                Storage::disk('public')->delete($profilDesa->gambar);
            }
            
            // Hapus profil desa (akan menghapus dusun, rw, rt secara cascade)
            $profilDesa->delete();

            return redirect()->route('profile.index')
                            ->with('success', 'Profil desa berhasil dihapus');

        } catch (\Exception $e) {
            Log::error('Error deleting profile:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function saveStrukturWilayah(Request $request, ProfilDesa $profilDesa)
    {

        // Cek apakah ada data dusun
        if ($request->has('dusuns') && is_array($request->dusuns)) {
            foreach ($request->dusuns as $index => $dusunData) {
                // Skip jika nama dusun kosong
                if (empty($dusunData['nama_dusun'])) {
                    Log::info("Skipping dusun at index {$index}: empty nama_dusun");
                    continue;
                }
                
                Log::info("Creating dusun: {$dusunData['nama_dusun']}");
                
                // Buat dusun baru
                $dusun = $profilDesa->dusuns()->create([
                    'nama_dusun' => $dusunData['nama_dusun']
                ]);
                
                // Simpan RW jika ada
                if (isset($dusunData['rws']) && is_array($dusunData['rws'])) {
                    foreach ($dusunData['rws'] as $rwIndex => $rwData) {
                        // Skip jika nomor RW kosong
                        if (empty($rwData['nomor'])) {
                            Log::info("Skipping RW at index {$rwIndex}: empty nomor");
                            continue;
                        }
                        
                        Log::info("Creating RW: {$rwData['nomor']} for dusun: {$dusun->nama_dusun}");
                        
                        // Buat RW baru
                        $rw = $dusun->rws()->create([
                            'nomor' => $rwData['nomor']
                        ]);
                        
                        // Simpan RT jika ada
                        if (isset($rwData['rts']) && is_array($rwData['rts'])) {
                            foreach ($rwData['rts'] as $rtIndex => $rtData) {
                                // Skip jika nomor RT kosong
                                if (empty($rtData['nomor'])) {
                                    Log::info("Skipping RT at index {$rtIndex}: empty nomor");
                                    continue;
                                }
                                
                                Log::info("Creating RT: {$rtData['nomor']} for RW: {$rw->nomor}");
                                
                                // Buat RT baru
                                $rw->rts()->create([
                                    'nomor' => $rtData['nomor']
                                ]);
                            }
                        }
                    }
                }
            }
        } else {
            Log::info('No dusuns data found in request');
        }
    }

    private function updateStrukturWilayah(Request $request, ProfilDesa $profilDesa)
    {
        Log::info('Updating struktur wilayah for profile ID: ' . $profilDesa->id);
        
        // Hapus semua data struktur wilayah lama
        $profilDesa->dusuns()->delete();
        
        // Simpan data struktur wilayah baru
        $this->saveStrukturWilayah($request, $profilDesa);
    }
}
