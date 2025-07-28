@extends('layouts.admin')
@section('title', isset($profilDesa) ? 'Edit Profil Desa' : 'Tambah Profil Desa')

@section('content')
<div class="max-w-full">
    <div class="bg-white rounded-lg shadow-md overflow-hidden"> {{-- Tambahkan overflow-hidden --}}
        <div class="p-4 sm:p-6"> {{-- Responsive padding --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ isset($profilDesa) ? 'Edit Profil Desa' : 'Tambah Profil Desa' }}
                </h2>
                <a href="{{ route('profile.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
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

            {{-- Success message --}}
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            {{-- Error message --}}
            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <form action="{{ isset($profilDesa) ? route('profile.update', $profilDesa) : route('profile.store') }}"
                method="POST" enctype="multipart/form-data" class="space-y-6 sm:space-y-8" id="profileForm">
                @csrf
                @if(isset($profilDesa))
                @method('PUT')
                @endif

                <!-- Rest of the form content remains the same but with responsive classes -->
                <!-- Informasi Dasar Desa -->
                <div class="bg-gray-50 rounded-lg p-4 sm:p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Dasar Desa</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
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
                                <img src="{{ Storage::url($profilDesa->gambar) }}" alt="Current Image"
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

                <!-- Data Statistik -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Data Statistik Desa</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <label for="jumlah_penduduk" class="block text-sm font-medium text-gray-700 mb-1">
                                Jumlah Penduduk <span class="text-red-500">*</span>
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

                <!-- Batas Wilayah -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800">Struktur Wilayah</h3>
                        </div>
                        <button type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                            onclick="addDusun()">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $dusun->nama_dusun }}
                                </h4>
                                <button type="button"
                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    onclick="removeDusun(this)">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
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
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
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
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h4 class="text-lg font-medium mb-2">Struktur Wilayah Kosong</h4>
                            <p class="text-sm">Klik <strong>"Tambah Dusun"</strong> untuk menambah dusun pertama</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6">
                    <a href="{{ route('profile.index') }}"
                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        id="submitBtn">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        <span id="submitText">{{ isset($profilDesa) ? 'Update Profil Desa' : 'Simpan Profil Desa' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Initialize dusun index
    let dusunIndex = {
        {
            isset($profilDesa) ? $profilDesa - > dusuns - > count() : 0
        }
    };

    console.log('Initial dusunIndex:', dusunIndex);

    function addDusun() {
        console.log('Adding dusun with index:', dusunIndex);

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

        console.log('Dusun added, new index:', dusunIndex);
    }

    function removeDusun(button) {
        if (confirm('Yakin ingin menghapus dusun ini?')) {
            const dusunItem = button.closest('.dusun-item');
            dusunItem.remove();

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
        console.log('Adding RW');

        const dusunItem = button.closest('.dusun-item');
        const dusunIdx = dusunItem.dataset.index;
        const rwContainer = dusunItem.querySelector('.rw-container');

        // Remove empty message if exists
        const emptyMsg = rwContainer.querySelector('.text-center.text-gray-500');
        if (emptyMsg) {
            emptyMsg.remove();
        }

        const rwCount = rwContainer.querySelectorAll('.rw-item').length;

        console.log('Dusun index:', dusunIdx, 'RW count:', rwCount);

        const rwHtml = `
        <div class="rw-item bg-gray-50 p-3 rounded border">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 items-center">
                <div class="lg:col-span-2">
                    <div class="flex">
                        <span class="inline-flex items-center px-2 py-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xs">RW</span>
                        <input type="text" 
                               class="flex-1 min-w-0 block w-full px-2 py-1 rounded-none rounded-r-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-xs"
                               name="dusuns[${dusunIdx}][rws][${rwCount}][nomor]"
                               placeholder="01">
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
            const rwItem = button.closest('.rw-item');

            rwItem.remove();

            if (rwContainer.querySelectorAll('.rw-item').length === 0) {
                rwContainer.innerHTML = `
                <div class="text-center text-gray-500 py-4">
                    <p class="text-sm">Klik "Tambah RW" untuk menambah RW pertama</p>
                </div>
            `;
            }
        }
    }

    function addRt(button) {
        console.log('Adding RT');

        const rwItem = button.closest('.rw-item');
        const dusunItem = button.closest('.dusun-item');
        const dusunIdx = dusunItem.dataset.index;

        // Find RW index
        const allRwItems = dusunItem.querySelectorAll('.rw-item');
        const rwIdx = Array.from(allRwItems).indexOf(rwItem);

        const rtContainer = rwItem.querySelector('.rt-container .flex');
        const rtCount = rtContainer.querySelectorAll('.rt-item').length;

        const rtHtml = `
        <div class="rt-item">
            <div class="flex" style="width: 70px;">
                <span class="inline-flex items-center px-1 py-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-xs">RT</span>
                <input type="text" 
                       class="flex-1 min-w-0 block w-full px-1 py-1 rounded-none rounded-r-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-xs"
                       name="dusuns[${dusunIdx}][rws][${rwIdx}][rts][${rtCount}][nomor]"
                       placeholder="01">
            </div>
        </div>
    `;

        button.insertAdjacentHTML('beforebegin', rtHtml);
    }

    // Form submission handling
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        console.log('Form is being submitted...');

        // Change button text to show loading
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');

        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';

        // Log form data for debugging
        const formData = new FormData(this);
        console.log('Form data:');
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }
    });

    // Debug: Log when page loads
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Page loaded, dusunIndex:', dusunIndex);
        console.log('Existing dusun items:', document.querySelectorAll('.dusun-item').length);
    });
</script>
@endsection