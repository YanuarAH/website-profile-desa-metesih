@extends('layouts.admin')
@section('title', 'Kelola Profil Desa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Profil Desa</h2>
        @if(!$profilDesa)
            <a href="{{ route('profile.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Profil Desa
            </a>
        @endif
    </div>

    @if($profilDesa)
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
            <!-- Main Information -->
            <div class="xl:col-span-2 order-2 xl:order-1">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <div class="bg-blue-600 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Informasi Desa {{ $profilDesa->nama_desa }}</h3>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('profile.edit', $profilDesa) }}" 
                               class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('profile.destroy', $profilDesa) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="return confirm('Yakin ingin menghapus profil desa ini?')">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Enhanced Statistics Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 mb-6">
                        <!-- Total Penduduk -->
                        <div class="bg-white p-3 sm:p-4 rounded-lg shadow-sm border">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs sm:text-sm text-gray-600 mb-1">Total Penduduk</p>
                                    <p class="text-sm sm:text-lg font-semibold text-gray-800 break-words">{{ number_format($profilDesa->jumlah_penduduk) }}</p>
                                    <div class="flex text-xs text-gray-500 mt-1">
                                        <span class="mr-2">♂ {{ number_format($profilDesa->penduduk_lk) }}</span>
                                        <span>♀ {{ number_format($profilDesa->penduduk_pr) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total KK -->
                        <div class="bg-white p-3 sm:p-4 rounded-lg shadow-sm border">
                            <div class="flex items-center">
                                <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v0"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs sm:text-sm text-gray-600 mb-1">Kepala Keluarga</p>
                                    <p class="text-sm sm:text-lg font-semibold text-gray-800 break-words">{{ number_format($profilDesa->jumlah_kk) }}</p>
                                    <div class="flex text-xs text-gray-500 mt-1">
                                        <span class="mr-2">♂ {{ number_format($profilDesa->kk_lk) }}</span>
                                        <span>♀ {{ number_format($profilDesa->kk_pr) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Luas Wilayah -->
                        <div class="bg-white p-3 sm:p-4 rounded-lg shadow-sm border">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs sm:text-sm text-gray-600 mb-1">Luas Wilayah</p>
                                    <p class="text-sm sm:text-lg font-semibold text-gray-800 break-words">{{ $profilDesa->luas_wilayah }} Ha</p>
                                </div>
                            </div>
                        </div>

                        <!-- RT -->
                        <div class="bg-white p-3 sm:p-4 rounded-lg shadow-sm border">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs sm:text-sm text-gray-600 mb-1">RT</p>
                                    <p class="text-sm sm:text-lg font-semibold text-gray-800 break-words">{{ $profilDesa->jumlah_rt }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- RW -->
                        <div class="bg-white p-3 sm:p-4 rounded-lg shadow-sm border">
                            <div class="flex items-center">
                                <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs sm:text-sm text-gray-600 mb-1">RW</p>
                                    <p class="text-sm sm:text-lg font-semibold text-gray-800 break-words">{{ $profilDesa->jumlah_rw }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Dusun -->
                        <div class="bg-white p-3 sm:p-4 rounded-lg shadow-sm border">
                            <div class="flex items-center">
                                <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs sm:text-sm text-gray-600 mb-1">Dusun</p>
                                    <p class="text-sm sm:text-lg font-semibold text-gray-800 break-words">{{ $profilDesa->dusuns->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Demographic Analysis -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border mb-4">
                        <h4 class="text-md font-semibold text-gray-800 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Analisis Demografis
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="text-center p-3 bg-blue-50 rounded-lg">
                                <p class="text-xs text-blue-600 font-medium">Rasio Gender</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $profilDesa->persentase_laki }}% : {{ $profilDesa->persentase_perempuan }}%</p>
                                <p class="text-xs text-gray-500">Laki-laki : Perempuan</p>
                            </div>
                            <div class="text-center p-3 bg-green-50 rounded-lg">
                                <p class="text-xs text-green-600 font-medium">Rata-rata Anggota Keluarga</p>
                                <p class="text-sm font-semibold text-gray-800">{{ $profilDesa->rata_anggota_keluarga }} orang</p>
                                <p class="text-xs text-gray-500">per Kepala Keluarga</p>
                            </div>
                            <div class="text-center p-3 bg-purple-50 rounded-lg">
                                <p class="text-xs text-purple-600 font-medium">Kepadatan Penduduk</p>
                                <p class="text-sm font-semibold text-gray-800">{{ round($profilDesa->jumlah_penduduk / $profilDesa->luas_wilayah, 1) }}</p>
                                <p class="text-xs text-gray-500">jiwa per Ha</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vision & Mission -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border">
                        <h4 class="text-md font-semibold text-gray-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Visi & Misi
                        </h4>
                        <div class="max-h-32 overflow-y-auto"> {{-- Tambahkan scroll untuk teks panjang --}}
                            <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $profilDesa->visi_misi }}</p>
                        </div>
                    </div>

                    <!-- Boundaries -->
                    <div class="bg-white p-4 rounded-lg shadow-sm border mt-4">
                        <h4 class="text-md font-semibold text-gray-800 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            Batas Wilayah
                        </h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center p-2 bg-blue-50 rounded-lg">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-blue-600 font-medium">Utara</p>
                                    <p class="text-sm text-gray-700">{{ $profilDesa->batas_utara }}</p>
                                </div>
                            </div>
                            <div class="flex items-center p-2 bg-red-50 rounded-lg">
                                <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-red-600 font-medium">Selatan</p>
                                    <p class="text-sm text-gray-700">{{ $profilDesa->batas_selatan }}</p>
                                </div>
                            </div>
                            <div class="flex items-center p-2 bg-green-50 rounded-lg">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-green-600 font-medium">Timur</p>
                                    <p class="text-sm text-gray-700">{{ $profilDesa->batas_timur }}</p>
                                </div>
                            </div>
                            <div class="flex items-center p-2 bg-yellow-50 rounded-lg">
                                <svg class="w-4 h-4 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-yellow-600 font-medium">Barat</p>
                                    <p class="text-sm text-gray-700">{{ $profilDesa->batas_barat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Village Image -->
            <div class="xl:col-span-1 order-1 xl:order-2">
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 h-fit">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Gambar Desa</h3>
                    </div>
                    <div class="text-center">
                        @if($profilDesa->gambar)
                            <img src="{{ Storage::url($profilDesa->gambar) }}"
                                 alt="Gambar Desa" 
                                 class="w-full h-40 sm:h-48 object-cover rounded-lg shadow-sm border border-gray-200">
                        @else
                            <div class="bg-gray-100 p-8 rounded-lg border-2 border-dashed border-gray-300">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Village Structure -->
        @if($profilDesa->dusuns->count() > 0)
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <div class="flex items-center mb-6">
                    <div class="bg-indigo-600 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Struktur Wilayah</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($profilDesa->dusuns as $dusun)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-3">
                                <h4 class="text-white font-semibold flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Dusun {{ $dusun->nama_dusun }}
                                </h4>
                            </div>
                            <div class="p-4">
                                @if($dusun->rws->count() > 0)
                                    <div class="space-y-3">
                                        @foreach($dusun->rws as $rw)
                                            <div class="border border-gray-200 rounded-lg p-3 bg-gray-50">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                        </svg>
                                                        RW {{ $rw->nomor }}
                                                    </span>
                                                    <span class="text-xs text-gray-500">{{ $rw->rts->count() }} RT</span>
                                                </div>
                                                @if($rw->rts->count() > 0)
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($rw->rts as $rt)
                                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                                RT {{ $rt->nomor }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <svg class="w-8 h-8 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-gray-500 text-sm">Belum ada RW yang terdaftar</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-gray-50 rounded-lg p-12 text-center border-2 border-dashed border-gray-300">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Profil Desa</h3>
            <p class="text-gray-600 mb-6 max-w-md mx-auto">
                Silakan tambahkan profil desa terlebih dahulu untuk mengelola informasi desa dan struktur wilayah.
            </p>
            <a href="{{ route('profile.create') }}" 
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Profil Desa
            </a>
        </div>
    @endif
</div>
@endsection
