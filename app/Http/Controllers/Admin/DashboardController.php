<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalStruktur = StrukturOrganisasi::count();
        // $profilDesa = ProfilDesa::first();

        return view('admin.dashboard.dashboard', compact('totalBerita', 'totalStruktur'));
    }
}
