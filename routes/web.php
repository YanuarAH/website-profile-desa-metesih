<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\GuestViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestViewController::class, 'index'])->name('home');
Route::get('/berita', [GuestViewController::class, 'berita'])->name('berita');
Route::get('/berita-detail/{id}', [GuestViewController::class, 'beritaDetail'])->name('berita-detail');
Route::get('/profile-desa', [GuestViewController::class, 'profile'])->name('profil-desa');
Route::get('/pemerintahan-desa', [GuestViewController::class, 'pemerintahan'])->name('pemerintahan-desa');
Route::get('/galeri', [GuestViewController::class, 'galeri'])->name('galeri-desa');
Route::get('/galeri-detail', [GuestViewController::class, 'galeriShow'])->name('galeri-detail');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('profile', ProfileController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('struktur', StrukturOrganisasiController::class);
    Route::delete('galeri/bulk-delete', [GaleriController::class, 'bulkDelete'])->name('galeri.bulk-delete');
    Route::resource('galeri', GaleriController::class);
});

require __DIR__.'/auth.php';
