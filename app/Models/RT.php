<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    protected $fillable = [
        'nomor',
        'rw_id'
    ];

    public function rw()
    {
        return $this->belongsTo(RW::class, 'rw_id');
    }
}
