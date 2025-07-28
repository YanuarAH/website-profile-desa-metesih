<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\GuestViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestViewController::class, 'index'])->name('home');
Route::get('/berita', [GuestViewController::class, 'berita'])->name('berita');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('profile', ProfileController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('struktur', StrukturOrganisasiController::class);
});

require __DIR__.'/auth.php';
