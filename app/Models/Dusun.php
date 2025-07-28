<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    protected $fillable = [
        'nama_dusun',
    ];

    public function profilDesa()
    {
        return $this->belongsTo(ProfilDesa::class);
    }
    public function rws()
    {
        return $this->hasMany(Rw::class);
    }
}
