<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateStatusKegiatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kegiatan:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbarui status kegiatan yang sudah lewat menjadi "selesai"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Update kegiatan yang sudah lewat menjadi 'selesai'
        $kegiatanKadaluwarsa = Kegiatan::where('status', 'mendatang')
                                      ->where('tanggal', '<', $today) // Perbaiki field name
                                      ->get();

        // Update kegiatan yang tanggalnya di masa depan menjadi 'mendatang' (jika ada yang salah)
        $kegiatanMendatang = Kegiatan::where('status', 'selesai')
                                    ->where('tanggal', '>=', $today)
                                    ->get();

        $totalUpdated = 0;

        if (!$kegiatanKadaluwarsa->isEmpty()) {
            foreach ($kegiatanKadaluwarsa as $kegiatan) {
                $kegiatan->status = 'selesai';
                $kegiatan->save();
                $totalUpdated++;
                $this->line("✓ {$kegiatan->nama_kegiatan} → selesai");
            }
        }

        if (!$kegiatanMendatang->isEmpty()) {
            foreach ($kegiatanMendatang as $kegiatan) {
                $kegiatan->status = 'mendatang';
                $kegiatan->save();
                $totalUpdated++;
                $this->line("✓ {$kegiatan->nama_kegiatan} → mendatang");
            }
        }

        if ($totalUpdated === 0) {
            $this->info('Tidak ada kegiatan yang perlu diperbarui statusnya.');
            return;
        }

        $this->info("Proses selesai. Status {$totalUpdated} kegiatan telah diperbarui.");
        Log::info("{$totalUpdated} status kegiatan telah diperbarui secara otomatis.");
    }
}
