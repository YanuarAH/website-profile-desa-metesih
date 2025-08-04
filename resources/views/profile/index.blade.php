@extends('layouts.app')

@section('title', '- Profil Desa')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-700 to-blue-900 text-white rounded-lg mb-8 overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative z-10 p-8 md:p-12">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-2/3 mb-6 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Profil {{ $profil->nama_desa ?? 'Desa Metesih' }}</h1>
                    <p class="text-xl opacity-90">Desa yang maju, sejahtera, dan berdaya saing tinggi</p>
                </div>
                <div class="md:w-1/3">
                    @if($profil && $profil->gambar)
                        <img src="{{ asset('storage/' . $profil->gambar) }}" 
                             alt="Foto {{ $profil->nama_desa ?? 'Desa Metesih' }}" 
                             class="w-full h-64 object-cover rounded-lg shadow-lg">
                    @else
                        <div class="w-full h-64 bg-blue-500 rounded-lg shadow-lg flex items-center justify-center">
                            <svg class="w-20 h-20 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Demografis -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
            </div>
            <div class="text-3xl font-bold text-green-600 mb-2">
                {{ number_format($profil->jumlah_penduduk ?? (($profil->penduduk_lk ?? 0) + ($profil->penduduk_pr ?? 0))) }}
            </div>
            <div class="text-sm text-gray-600 mb-2">Total Penduduk</div>
            @if($profil && ($profil->penduduk_lk || $profil->penduduk_pr))
            <div class="text-xs text-gray-500">
                L: {{ number_format($profil->penduduk_lk ?? 0) }} | P: {{ number_format($profil->penduduk_pr ?? 0) }}
            </div>
            @endif
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="text-3xl font-bold text-purple-600 mb-2">
                {{ number_format($profil->jumlah_kk ?? (($profil->kk_lk ?? 0) + ($profil->kk_pr ?? 0))) }}
            </div>
            <div class="text-sm text-gray-600 mb-2">Kepala Keluarga</div>
            @if($profil && ($profil->kk_lk || $profil->kk_pr))
            <div class="text-xs text-gray-500">
                L: {{ number_format($profil->kk_lk ?? 0) }} | P: {{ number_format($profil->kk_pr ?? 0) }}
            </div>
            @endif
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="bg-blue -100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div class="text-3xl font-bold text-blue-600 mb-2">
                {{ $profil->jumlah_rt ?? 0 }}
            </div>
            <div class="text-sm text-gray-600">RT</div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div class="text-3xl font-bold text-orange-600 mb-2">
                {{ $profil->jumlah_rw ?? 0 }}
            </div>
            <div class="text-sm text-gray-600">RW</div>
        </div>
    </div>

    <!-- Visi Misi -->
    @if($profil && $profil->visi_misi)
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-6 h-6 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"/>
            </svg>
            Visi & Misi
        </h2>
        <div class="text-gray-600 leading-relaxed">
            {!! nl2br(e($profil->visi_misi)) !!}
        </div>
    </div>
    @endif

    <!-- Informasi Geografis -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
            </svg>
            Informasi Geografis
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                </div>
                <div class="font-semibold text-gray-800 text-lg">{{ $profil->luas_wilayah ?? '-' }}</div>
                <div class="text-sm text-gray-600">Luas Wilayah</div>
            </div>
            
            <div class="text-center">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="font-semibold text-gray-800 text-lg">{{ count($dusuns) }} Dusun</div>
                <div class="text-sm text-gray-600">Jumlah Dusun</div>
            </div>
        </div>
        
        @if($profil && ($profil->batas_utara || $profil->batas_selatan || $profil->batas_timur || $profil->batas_barat))
        <div class="mt-6 pt-6 border-t">
            <h3 class="font-semibold text-gray-800 mb-3 text-center">Batas Wilayah</h3>
            {{-- Bagian Batas Wilayah yang disesuaikan --}}
            <div class="grid grid-cols-2 gap-3">
                <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-200">
                    <svg class="w-5 h-5 mr-2 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    <div>
                        <p class="text-xs text-blue-600 font-medium">Utara</p>
                        <p class="text-sm text-gray-700 font-semibold">{{ $profil->batas_utara }}</p>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-red-50 rounded-lg border border-red-200">
                    <svg class="w-5 h-5 mr-2 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    <div>
                        <p class="text-xs text-red-600 font-medium">Selatan</p>
                        <p class="text-sm text-gray-700 font-semibold">{{ $profil->batas_selatan }}</p>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-200">
                    <svg class="w-5 h-5 mr-2 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    <div>
                        <p class="text-xs text-green-600 font-medium">Timur</p>
                        <p class="text-sm text-gray-700 font-semibold">{{ $profil->batas_timur }}</p>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                    <svg class="w-5 h-5 mr-2 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <div>
                        <p class="text-xs text-yellow-600 font-medium">Barat</p>
                        <p class="text-sm text-gray-700 font-semibold">{{ $profil->batas_barat }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Daftar Dusun -->
    @if($dusuns->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 text-indigo-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4z" clip-rule="evenodd"/>
            </svg>
            Daftar Dusun
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($dusuns as $dusun)
            <div class="bg-indigo-50 rounded-lg p-4 text-center border border-indigo-200">
                <div class="bg-indigo-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-indigo-800">{{ $dusun->nama_dusun }}</h4>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
