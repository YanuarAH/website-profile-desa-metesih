<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $fillable = [
        'nama_desa',
        'visi_misi',
        'jumlah_penduduk',
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
    
}
