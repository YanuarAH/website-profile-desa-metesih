@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 px-6 py-6">Selamat Datang di Dashboard Admin!</h2>
    <p class="text-gray-600 mb-8 px-6">Gunakan menu di samping kiri untuk mengelola konten website desa Anda.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-6 my-10">
        <!-- Kartu Statistik/Ringkasan -->
        <div class="bg-blue-50 rounded-lg p-6 shadow-sm border border-blue-200">
            <h3 class="text-xl font-semibold text-blue-800 mb-2">Total Berita</h3>
            <p class="text-4xl font-bold text-blue-600">{{ $totalBerita }}</p>
            <p class="text-sm text-gray-600 mt-2">Berita aktif yang dipublikasikan.</p>
        </div>
        <div class="bg-green-50 rounded-lg p-6 shadow-sm border border-green-200">
            <h3 class="text-xl font-semibold text-green-800 mb-2">Perangkat Desa</h3>
            <p class="text-4xl font-bold text-green-600">/</p>
            <p class="text-sm text-gray-600 mt-2">Jumlah perangkat desa terdaftar.</p>
        </div>
        <div class="bg-purple-50 rounded-lg p-6 shadow-sm border border-purple-200">
            <h3 class="text-xl font-semibold text-purple-800 mb-2">Pengunjung Hari Ini</h3>
            <p class="text-4xl font-bold text-purple-600">123</p> {{-- Ini masih statis, perlu implementasi tracking --}}
            <p class="text-sm text-gray-600 mt-2">Jumlah pengunjung unik hari ini.</p>
        </div>
    </div>

    <div class="mt-10 px-6 py-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Aksi Cepat</h3>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('berita.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200">
                Tambah Berita Baru
            </a>
            <a href="#" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200">
                Edit Profil Desa
            </a>
            <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200">
                Kelola Perangkat Desa
            </a>
            {{-- Anda bisa menambahkan lebih banyak tautan aksi cepat di sini --}}
        </div>
    </div>
</div>
@endsection
