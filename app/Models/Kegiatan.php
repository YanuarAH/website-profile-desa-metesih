<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kegiatan extends Model
{

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'gambar',
        'tanggal',
        'lokasi',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    // Accessor untuk status badge color
    public function getStatusColorAttribute()
    {
        return $this->status === 'mendatang' ? 'blue' : 'gray';
    }

    // Accessor untuk status text
    public function getStatusTextAttribute()
    {
        return $this->status === 'mendatang' ? 'Mendatang' : 'Selesai';
    }

    // Scope untuk kegiatan mendatang
    public function scopeMendatang($query)
    {
        return $query->where('status', 'mendatang');
    }

    // Scope untuk kegiatan yang sudah selesai
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    // Boot method untuk auto-update status
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($kegiatan) {
            // Auto-set status berdasarkan tanggal
            $kegiatan->status = Carbon::parse($kegiatan->tanggal)->isFuture() ? 'mendatang' : 'selesai';
        });
    }
}
