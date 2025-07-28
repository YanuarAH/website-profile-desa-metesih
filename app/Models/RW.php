<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    protected $fillable = [
        'nomor',
    ];

    public function dusun()
    {
        return $this->belongsTo(Dusun::class);
    }
    public function rts()
    {
        return $this->hasMany(RT::class);
    }
}
