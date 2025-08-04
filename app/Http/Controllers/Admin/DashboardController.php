<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\StrukturOrganisasi;
use App\Models\Galeri;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalPerangkatDesa = StrukturOrganisasi::count();
        $totalGaleri = Galeri::count();

        return view('admin.dashboard.dashboard', compact('totalBerita', 'totalPerangkatDesa', 'totalGaleri'));
    }
}
