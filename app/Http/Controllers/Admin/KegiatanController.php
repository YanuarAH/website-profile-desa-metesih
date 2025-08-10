<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $this->updateKegiatanStatus();

        $query = Kegiatan::query();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Fungsionalitas pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_kegiatan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('lokasi', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Fungsionalitas pengurutan
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'title':
                $query->orderBy('nama_kegiatan', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('tanggal', 'desc');
                break;
        }

        // Ambil data dengan paginasi dan pertahankan query string
        $kegiatans = $query->paginate(10)->withQueryString();

        // Update status otomatis berdasarkan tanggal
        $this->updateKegiatanStatus();

        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function checkChanges(Request $request)
    {
        // Update status terlebih dahulu
        $updated = $this->updateKegiatanStatus();

        // Generate hash dari data saat ini
        $currentHash = $this->generateDataHash();
        $clientHash = $request->get('hash');

        // Cek apakah ada perubahan
        $hasChanges = $currentHash !== $clientHash;

        return response()->json([
            'hasChanges' => $hasChanges,
            'updated' => $updated,
            'currentHash' => $currentHash,
            'stats' => [
                'total' => Kegiatan::count(),
                'mendatang' => Kegiatan::mendatang()->count(),
                'selesai' => Kegiatan::selesai()->count(),
            ]
        ]);
    }

    // Generate hash untuk deteksi perubahan
    private function generateDataHash()
    {
        // Ambil data yang relevan untuk hash
        $data = [
            'total' => Kegiatan::count(),
            'mendatang' => Kegiatan::mendatang()->count(),
            'selesai' => Kegiatan::selesai()->count(),
            'last_updated' => Kegiatan::max('updated_at'),
            // Tambahkan data kegiatan yang ditampilkan saat ini jika perlu
            'kegiatan_ids' => Kegiatan::pluck('id', 'status')->toArray()
        ];

        return md5(json_encode($data));
    }

    public function create()
    {
        $kegiatan = new Kegiatan();
        return view('admin.kegiatan.form', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'lokasi' => 'required|string|max:255',
            'gambar' => 'nullable|image',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kegiatan', 'public');
            $validated['gambar'] = $gambarPath;
        }

        // Set status berdasarkan tanggal
        $validated['status'] = Carbon::parse($validated['tanggal'])->isFuture() ? 'mendatang' : 'selesai';

        Kegiatan::create($validated);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.form', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'lokasi' => 'required|string|max:255',
            'gambar' => 'nullable|image',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $gambarPath = $request->file('gambar')->store('kegiatan', 'public');
            $validated['gambar'] = $gambarPath;
        }

        // Update status berdasarkan tanggal
        $validated['status'] = Carbon::parse($validated['tanggal'])->isFuture() ? 'mendatang' : 'selesai';

        $kegiatan->update($validated);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    /**
     * Update status kegiatan berdasarkan tanggal
     */
    private function updateKegiatanStatus()
    {
        $updated = 0;

        // Update kegiatan yang sudah lewat tanggalnya menjadi 'selesai'
        $kegiatanSelesai = Kegiatan::where('tanggal', '<', now()->toDateString())
                ->where('status', 'mendatang')
                ->update(['status' => 'selesai']);

        // Update kegiatan yang tanggalnya di masa depan menjadi 'mendatang'
        $kegiatanMendatang = Kegiatan::where('tanggal', '>=', now()->toDateString())
                ->where('status', 'selesai')
                ->update(['status' => 'mendatang']);

        return $kegiatanSelesai + $kegiatanMendatang;
    }
}
