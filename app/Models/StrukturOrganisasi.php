<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $fillable = [
        'nama', 
        'jabatan', 
        'foto', 
        'urutan'
    ];
}
