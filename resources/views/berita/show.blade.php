@extends('layouts.app')

@section('title', '- ' . $berita->judul)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('berita') }}" class="hover:text-blue-600">Berita</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800">{{ Str::limit($berita->judul, 50) }}</li>
        </ol>
    </nav>

    <!-- Main Content Area: Article and Related News -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Article Column (2/3 width on medium screens and up) -->
        <div class="md:col-span-2">
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                         alt="{{ $berita->judul }}"
                         class="w-full h-64 md:h-96 object-cover">
                @else
                    <div class="w-full h-64 md:h-96 bg-gray-200 flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                @endif
                <div class="p-6 md:p-8">
                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $berita->judul }}</h1>
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        {{ $berita->tanggal_publikasi ? \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d F Y') : $berita->created_at->format('d F Y') }}
                    </div>
                    <!-- Content -->
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed ck-konten">
                        {!! $berita->konten !!}
                    </div>
                </div>
            </article>
        </div>

        <!-- Related Articles Column (1/3 width on medium screens and up) -->
        <div class="md:col-span-1">
            @if($relatedBeritas->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Berita Terakhir</h2>
                    <div class="space-y-4">
                        @foreach($relatedBeritas as $related)
                            <article class="group flex items-center gap-4">
                                <a href="{{ route('berita-detail', $related->id) }}" class="block">
                                    <div class="flex items-center gap-4">
                                        @if($related->gambar)
                                            <img src="{{ asset('storage/' . $related->gambar) }}"
                                                 alt="{{ $related->judul }}"
                                                 class="w-20 h-20 object-cover rounded-lg flex-shrink-0 group-hover:opacity-90 transition-opacity">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-semibold text-gray-800 mb-1 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                                {{ $related->judul }}
                                            </h3>
                                            <div class="text-xs text-gray-500">
                                                <svg class="w-3 h-3 mr-1 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $related->tanggal_publikasi ? \Carbon\Carbon::parse($related->tanggal_publikasi)->format('M d, Y') : $related->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
