<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class GuestViewController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $latestBeritas = Berita::latest()->take(3)->get();
        return view('home/index', compact('latestBeritas'));
    }


    public function berita()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('berita/index', compact('beritas'));
    }

    public function struktur() {}
}
