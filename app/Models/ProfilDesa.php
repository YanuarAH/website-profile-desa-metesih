<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $fillable = [
        'nama_desa',
        'visi_misi',
        'jumlah_penduduk',
        'penduduk_lk',
        'penduduk_pr',
        'jumlah_kk',
        'kk_lk',
        'kk_pr',
        'jumlah_rt',
        'jumlah_rw',
        'luas_wilayah',
        'batas_utara',
        'batas_selatan',
        'batas_timur',
        'batas_barat',
        'gambar',
    ];

    // ProfilDesa.php
    public function dusuns()
    {
        return $this->hasMany(Dusun::class);
    }

    // Accessor untuk persentase gender penduduk
    public function getPersentaseLakiAttribute()
    {
        if ($this->jumlah_penduduk > 0) {
            return round(($this->penduduk_lk / $this->jumlah_penduduk) * 100, 1);
        }
        return 0;
    }

    public function getPersentasePerempuanAttribute()
    {
        if ($this->jumlah_penduduk > 0) {
            return round(($this->penduduk_pr / $this->jumlah_penduduk) * 100, 1);
        }
        return 0;
    }

    // Accessor untuk rata-rata anggota keluarga
    public function getRataAnggotaKeluargaAttribute()
    {
        if ($this->jumlah_kk > 0) {
            return round($this->jumlah_penduduk / $this->jumlah_kk, 1);
        }
        return 0;
    }
    
}
