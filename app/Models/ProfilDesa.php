<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa'; // Nama tabel
    protected $fillable = [
        'nama_desa',
        'visi',
        'misi',
        'geografis',
        'demografis',
        'gambar',
    ];
}
