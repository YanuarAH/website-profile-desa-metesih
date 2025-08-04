@extends('layouts.admin')
@section('title', isset($profilDesa) ? 'Edit Profil Desa' : 'Tambah Profil Desa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ isset($profilDesa) ? 'Edit Profil Desa' : 'Tambah Profil Desa' }}
        </h2>
        <a href="{{ route('profile.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Display validation errors --}}
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Oops!</strong>
        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
        <ul class="mt-3 list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ isset($profilDesa) ? route('profile.update', $profilDesa) : route('profile.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @if(isset($profilDesa))
            @method('PUT')
        @endif

        <!-- Informasi Dasar Desa -->
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Informasi Dasar Desa</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_desa" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Desa <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama_desa') border-red-500 @enderror"
                           id="nama_desa" name="nama_desa"
                           value="{{ old('nama_desa', isset($profilDesa) ? $profilDesa->nama_desa : '') }}" required>
                    @error('nama_desa')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar Desa</label>
                    @if(isset($profilDesa) && $profilDesa->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $profilDesa->gambar) }}" alt="Current Image" 
                                 class="w-32 h-32 object-cover rounded-md border border-gray-200">
                            <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" 
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('gambar') border-red-500 @enderror"
                           id="gambar" name="gambar" accept="image/*">
                    @error('gambar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="visi_misi" class="block text-sm font-medium text-gray-700 mb-1">
                    Visi & Misi <span class="text-red-500">*</span>
                </label>
                <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('visi_misi') border-red-500 @enderror"
                          id="visi_misi" name="visi_misi" rows="4" required>{{ old('visi_misi', isset($profilDesa) ? $profilDesa->visi_misi : '') }}</textarea>
                @error('visi_misi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Data Demografis -->
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Data Demografis</h3>
            </div>
            
            <!-- Data Penduduk -->
            <div class="mb-6">
                <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    Data Penduduk
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="jumlah_penduduk" class="block text-sm font-medium text-gray-700 mb-1">
                            Total Penduduk <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_penduduk') border-red-500 @enderror"
                               id="jumlah_penduduk" name="jumlah_penduduk"
                               value="{{ old('jumlah_penduduk', isset($profilDesa) ? $profilDesa->jumlah_penduduk : '') }}" required>
                        @error('jumlah_penduduk')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="penduduk_lk" class="block text-sm font-medium text-gray-700 mb-1">
                            Laki-laki <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('penduduk_lk') border-red-500 @enderror"
                               id="penduduk_lk" name="penduduk_lk"
                               value="{{ old('penduduk_lk', isset($profilDesa) ? $profilDesa->penduduk_lk : '') }}" required>
                        @error('penduduk_lk')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="penduduk_pr" class="block text-sm font-medium text-gray-700 mb-1">
                            Perempuan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('penduduk_pr') border-red-500 @enderror"
                               id="penduduk_pr" name="penduduk_pr"
                               value="{{ old('penduduk_pr', isset($profilDesa) ? $profilDesa->penduduk_pr : '') }}" required>
                        @error('penduduk_pr')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Kepala Keluarga -->
            <div class="mb-6">
                <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v0"/>
                    </svg>
                    Data Kepala Keluarga
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="jumlah_kk" class="block text-sm font-medium text-gray-700 mb-1">
                            Total KK <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_kk') border-red-500 @enderror"
                               id="jumlah_kk" name="jumlah_kk"
                               value="{{ old('jumlah_kk', isset($profilDesa) ? $profilDesa->jumlah_kk : '') }}" required>
                        @error('jumlah_kk')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kk_lk" class="block text-sm font-medium text-gray-700 mb-1">
                            KK Laki-laki <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kk_lk') border-red-500 @enderror"
                               id="kk_lk" name="kk_lk"
                               value="{{ old('kk_lk', isset($profilDesa) ? $profilDesa->kk_lk : '') }}" required>
                        @error('kk_lk')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kk_pr" class="block text-sm font-medium text-gray-700 mb-1">
                            KK Perempuan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kk_pr') border-red-500 @enderror"
                               id="kk_pr" name="kk_pr"
                               value="{{ old('kk_pr', isset($profilDesa) ? $profilDesa->kk_pr : '') }}" required>
                        @error('kk_pr')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Data Wilayah -->
            <div>
                <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    Data Wilayah
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="jumlah_rt" class="block text-sm font-medium text-gray-700 mb-1">
                            Jumlah RT <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_rt') border-red-500 @enderror"
                               id="jumlah_rt" name="jumlah_rt"
                               value="{{ old('jumlah_rt', isset($profilDesa) ? $profilDesa->jumlah_rt : '') }}" required>
                        @error('jumlah_rt')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jumlah_rw" class="block text-sm font-medium text-gray-700 mb-1">
                            Jumlah RW <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('jumlah_rw') border-red-500 @enderror"
                               id="jumlah_rw" name="jumlah_rw"
                               value="{{ old('jumlah_rw', isset($profilDesa) ? $profilDesa->jumlah_rw : '') }}" required>
                        @error('jumlah_rw')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="luas_wilayah" class="block text-sm font-medium text-gray-700 mb-1">
                            Luas Wilayah (Ha) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.01" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('luas_wilayah') border-red-500 @enderror"
                               id="luas_wilayah" name="luas_wilayah"
                               value="{{ old('luas_wilayah', isset($profilDesa) ? $profilDesa->luas_wilayah : '') }}" required>
                        @error('luas_wilayah')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Batas Wilayah -->
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Batas Wilayah</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="batas_utara" class="block text-sm font-medium text-gray-700 mb-1">
                        Batas Utara <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('batas_utara') border-red-500 @enderror"
                           id="batas_utara" name="batas_utara"
                           value="{{ old('batas_utara', isset($profilDesa) ? $profilDesa->batas_utara : '') }}" required>
                    @error('batas_utara')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="batas_selatan" class="block text-sm font-medium text-gray-700 mb-1">
                        Batas Selatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('batas_selatan') border-red-500 @enderror"
                           id="batas_selatan" name="batas_selatan"
                           value="{{ old('batas_selatan', isset($profilDesa) ? $profilDesa->batas_selatan : '') }}" required>
                    @error('batas_selatan')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="batas_timur" class="block text-sm font-medium text-gray-700 mb-1">
                        Batas Timur <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('batas_timur') border-red-500 @enderror"
                           id="batas_timur" name="batas_timur"
                           value="{{ old('batas_timur', isset($profilDesa) ? $profilDesa->batas_timur : '') }}" required>
                    @error('batas_timur')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="batas_barat" class="block text-sm font-medium text-gray-700 mb-1">
                        Batas Barat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('batas_barat') border-red-500 @enderror"
                           id="batas_barat" name="batas_barat"
                           value="{{ old('batas_barat', isset($profilDesa) ? $profilDesa->batas_barat : '') }}" required>
                    @error('batas_barat')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Struktur Wilayah -->
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800">Struktur Wilayah</h3>
                </div>
                <button type="button" 
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        onclick="addDusun()">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Dusun
                </button>
            </div>
            
            <div id="dusun-container" class="space-y-4">
                @if(isset($profilDesa) && $profilDesa->dusuns->count() > 0)
                    @foreach($profilDesa->dusuns as $dusunIndex => $dusun)
                        <div class="dusun-item bg-white border border-gray-200 rounded-lg p-4" data-index="{{ $dusunIndex }}">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-md font-medium text-indigo-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $dusun->nama_dusun }}
                                </h4>
                                <button type="button" 
                                        class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="removeDusun(this)">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dusun</label>
                                    <input type="text" 
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           name="dusuns[{{ $dusunIndex }}][nama_dusun]"
                                           value="{{ $dusun->nama_dusun }}"
                                           placeholder="Contoh: Krajan">
                                </div>
                                <div class="lg:col-span-3">
                                    <div class="flex justify-between items-center mb-2">
                                        <label class="block text-sm font-medium text-gray-700">RW & RT</label>
                                        <button type="button" 
                                                class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                onclick="addRw(this)">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Tambah RW
                                        </button>
                                    </div>
                                    
                                    <div class="rw-container space-y-2">
                                        @foreach($dusun->rws as $rwIndex => $rw)
                                            <div class="rw-item bg-gray-50 p-3 rounded border">
                                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 items-center">
                                                    <div class="lg:col-span-2">
                                                        <div class="flex">
                                                            <span class="inline-flex items-center px-2 py-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xs">RW</span>
                                                            <input type="text" 
                                                                   class="flex-1 min-w-0 block w-full px-2 py-1 rounded-none rounded-r-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-xs"
                                                                   name="dusuns[{{ $dusunIndex }}][rws][{{ $rwIndex }}][nomor]"
                                                                   value="{{ $rw->nomor }}">
                                                        </div>
                                                    </div>
                                                    <div class="lg:col-span-9">
                                                        <div class="rt-container">
                                                            <div class="flex flex-wrap gap-1">
                                                                @foreach($rw->rts as $rtIndex => $rt)
                                                                    <div class="rt-item">
                                                                        <div class="flex" style="width: 70px;">
                                                                            <span class="inline-flex items-center px-1 py-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xs">RT</span>
                                                                            <input type="text" 
                                                                                   class="flex-1 min-w-0 block w-full px-1 py-1 rounded-none rounded-r-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-xs"
                                                                                   name="dusuns[{{ $dusunIndex }}][rws][{{ $rwIndex }}][rts][{{ $rtIndex }}][nomor]"
                                                                                   value="{{ $rt->nomor }}">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                                <button type="button" 
                                                                        class="inline-flex items-center px-2 py-1 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                                        onclick="addRt(this)">
                                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lg:col-span-1">
                                                        <button type="button" 
                                                                class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                                onclick="removeRw(this)">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-gray-500 py-8" id="empty-message">
                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <h4 class="text-lg font-medium mb-2">Struktur Wilayah Kosong</h4>
                        <p class="text-sm">Klik <strong>"Tambah Dusun"</strong> untuk menambah dusun pertama</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 pt-6">
            <a href="{{ route('profile.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batal
            </a>
            <button type="submit" 
                    class="inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                {{ isset($profilDesa) ? 'Update Profil Desa' : 'Simpan Profil Desa' }}
            </button>
        </div>
    </form>
</div>

<script>
let dusunIndex = {{ isset($profilDesa) ? $profilDesa->dusuns->count() : 0 }};

function addDusun() {
    const container = document.getElementById('dusun-container');
    const emptyMessage = document.getElementById('empty-message');
    if (emptyMessage) {
        emptyMessage.remove();
    }
    
    const dusunHtml = `
        <div class="dusun-item bg-white border border-gray-200 rounded-lg p-4" data-index="${dusunIndex}">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-md font-medium text-indigo-600 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Dusun Baru
                </h4>
                <button type="button" 
                        class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        onclick="removeDusun(this)">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dusun</label>
                    <input type="text" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           name="dusuns[${dusunIndex}][nama_dusun]"
                           placeholder="Contoh: Krajan">
                </div>
                <div class="lg:col-span-3">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium text-gray-700">RW & RT</label>
                        <button type="button" 
                                class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                onclick="addRw(this)">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah RW
                        </button>
                    </div>
                    
                    <div class="rw-container space-y-2">
                        <div class="text-center text-gray-500 py-4">
                            <p class="text-sm">Klik "Tambah RW" untuk menambah RW pertama</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', dusunHtml);
    dusunIndex++;
}

function removeDusun(button) {
    if (confirm('Yakin ingin menghapus dusun ini?')) {
        button.closest('.dusun-item').remove();
        
        const container = document.getElementById('dusun-container');
        if (container.children.length === 0) {
            container.innerHTML = `
                <div class="text-center text-gray-500 py-8" id="empty-message">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h4 class="text-lg font-medium mb-2">Struktur Wilayah Kosong</h4>
                    <p class="text-sm">Klik <strong>"Tambah Dusun"</strong> untuk menambah dusun pertama</p>
                </div>
            `;
        }
    }
}

function addRw(button) {
    const dusunItem = button.closest('.dusun-item');
    const dusunIdx = dusunItem.dataset.index;
    const rwContainer = dusunItem.querySelector('.rw-container');
    
    const emptyMsg = rwContainer.querySelector('.text-center.text-gray-500');
    if (emptyMsg) {
        emptyMsg.remove();
    }
    
    const rwCount = rwContainer.children.length;
    
    const rwHtml = `
        <div class="rw-item bg-gray-50 p-3 rounded border">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 items-center">
                <div class="lg:col-span-2">
                    <div class="flex">
                        <span class="inline-flex items-center px-2 py-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xs">RW</span>
                        <input type="text" 
                               class="flex-1 min-w-0 block w-full px-2 py-1 rounded-none rounded-r-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-xs"
                               name="dusuns[${dusunIdx}][rws][${rwCount}][nomor]">
                    </div>
                </div>
                <div class="lg:col-span-9">
                    <div class="rt-container">
                        <div class="flex flex-wrap gap-1">
                            <button type="button" 
                                    class="inline-flex items-center px-2 py-1 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    onclick="addRt(this)">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                RT
                            </button>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-1">
                    <button type="button" 
                            class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            onclick="removeRw(this)">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    `;
    
    rwContainer.insertAdjacentHTML('beforeend', rwHtml);
}

function removeRw(button) {
    if (confirm('Yakin ingin menghapus RW ini?')) {
        const rwContainer = button.closest('.rw-container');
        button.closest('.rw-item').remove();
        
        if (rwContainer.children.length === 0) {
            rwContainer.innerHTML = `
                <div class="text-center text-gray-500 py-4">
                    <p class="text-sm">Klik "Tambah RW" untuk menambah RW pertama</p>
                </div>
            `;
        }
    }
}

function addRt(button) {
    const rwItem = button.closest('.rw-item');
    const dusunItem = button.closest('.dusun-item');
    const dusunIdx = dusunItem.dataset.index;
    const rwIdx = Array.from(dusunItem.querySelectorAll('.rw-item')).indexOf(rwItem);
    const rtContainer = rwItem.querySelector('.rt-container .flex');
    const rtCount = rtContainer.querySelectorAll('.rt-item').length;
    
    const rtHtml = `
        <div class="rt-item">
            <div class="flex" style="width: 70px;">
                <span class="inline-flex items-center px-1 py-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xs">RT</span>
                <input type="text" 
                       class="flex-1 min-w-0 block w-full px-1 py-1 rounded-none rounded-r-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-xs"
                       name="dusuns[${dusunIdx}][rws][${rwIdx}][rts][${rtCount}][nomor]">
            </div>
        </div>
    `;
    
    button.insertAdjacentHTML('beforebegin', rtHtml);
}

// Auto-calculate total penduduk
document.addEventListener('DOMContentLoaded', function() {
    const pendudukLaki = document.getElementById('penduduk_lk');
    const pendudukPerempuan = document.getElementById('penduduk_pr');
    const jumlahPenduduk = document.getElementById('jumlah_penduduk');
    
    const kkLaki = document.getElementById('kk_lk');
    const kkPerempuan = document.getElementById('kk_pr');
    const jumlahKk = document.getElementById('jumlah_kk');
    
    function calculateTotalPenduduk() {
        const laki = parseInt(pendudukLaki.value) || 0;
        const perempuan = parseInt(pendudukPerempuan.value) || 0;
        jumlahPenduduk.value = laki + perempuan;
    }
    
    function calculateTotalKk() {
        const laki = parseInt(kkLaki.value) || 0;
        const perempuan = parseInt(kkPerempuan.value) || 0;
        jumlahKk.value = laki + perempuan;
    }
    
    pendudukLaki.addEventListener('input', calculateTotalPenduduk);
    pendudukPerempuan.addEventListener('input', calculateTotalPenduduk);
    
    kkLaki.addEventListener('input', calculateTotalKk);
    kkPerempuan.addEventListener('input', calculateTotalKk);
});
</script>
@endsection
