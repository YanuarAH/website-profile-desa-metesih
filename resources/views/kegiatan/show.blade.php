@extends('layouts.app')

@section('title', '- Detail Kegiatan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">

    <!-- Breadcrumb -->
    <nav class="mb-6 p-6 sm:p-8 lg:p-10">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('kegiatan') }}" class="hover:text-blue-600">Kegiatan</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800">{{ Str::limit($kegiatan->nama_kegiatan, 50) }}</li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-md overflow-hidden p-6 sm:p-8 lg:p-10">
        <!-- Kegiatan Image -->
        @if($kegiatan->gambar)
            <div class="mb-6 md:mb-8">
                <img src="{{ asset('storage/' . $kegiatan->gambar) }}"
                     alt="{{ $kegiatan->nama_kegiatan }}"
                     class="w-full h-64 sm:h-80 md:h-96 object-cover rounded-lg shadow-sm">
            </div>
        @else
            <div class="mb-6 md:mb-8 w-full h-64 sm:h-80 md:h-96 bg-gray-200 flex items-center justify-center rounded-lg shadow-sm">
                <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                </svg>
            </div>
        @endif

        <!-- Kegiatan Title -->
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            {{ $kegiatan->nama_kegiatan }}
        </h1>

        <!-- Meta Info: Date, Time, Location -->
        <div class="flex flex-wrap items-center text-gray-600 text-sm sm:text-base mb-6 border-b pb-4">
            <div class="flex items-center mr-4 mb-2 sm:mb-0">
                <svg class="w-4 h-4 mr-2 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $kegiatan->tanggal->format('d F Y') }}</span>
            </div>
            @if($kegiatan->waktu)
            <div class="flex items-center mr-4 mb-2 sm:mb-0">
                <svg class="w-4 h-4 mr-2 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v4.25H6.5a.75.75 0 000 1.5h3.75a.75.75 0 00.75-.75V5.75z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $kegiatan->waktu }} WIB</span>
            </div>
            @endif
            <div class="flex items-center mb-2 sm:mb-0">
                <svg class="w-4 h-4 mr-2 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $kegiatan->lokasi }}</span>
            </div>
        </div>

        <!-- Kegiatan Description -->
        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
            {!! $kegiatan->deskripsi !!}
        </div>
    </div>
</div>
@endsection
