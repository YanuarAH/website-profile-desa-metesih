@extends('layouts.app')

@section('title', '- ' . $berita->judul)

@section('content')
<div class="max-w-4xl mx-auto">
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

    <!-- Article -->
    <article class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        @if($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" 
                 alt="{{ $berita->judul }}" 
                 class="w-full h-64 md:h-96 object-cover">
        @endif
        
        <div class="p-6 md:p-8">
            <!-- Meta Info -->
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                {{ $berita->tanggal_publikasi ? \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d F Y') : $berita->created_at->format('d F Y') }}
                
                @if(isset($berita->views))
                    <span class="mx-2">•</span>
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ number_format($berita->views) }} kali dibaca
                @endif
            </div>
            
            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ $berita->judul }}</h1>
            
            <!-- Content -->
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! $berita->konten !!}
            </div>
        </div>
    </article>

    <!-- Related Articles -->
    @if($relatedBeritas->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Berita Terkait</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedBeritas as $related)
                    <article class="group">
                        @if($related->gambar)
                            <img src="{{ asset('storage/' . $related->gambar) }}" 
                                 alt="{{ $related->judul }}" 
                                 class="w-full h-32 object-cover rounded-lg mb-3 group-hover:opacity-90 transition-opacity">
                        @else
                            <div class="w-full h-32 bg-gray-200 rounded-lg mb-3 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                        
                        <div class="text-xs text-gray-500 mb-2">
                            {{ $related->tanggal_publikasi ? \Carbon\Carbon::parse($related->tanggal_publikasi)->format('d M Y') : $related->created_at->format('d M Y') }}
                        </div>
                        
                        <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('berita.detail', $related->id) }}">
                                {{ $related->judul }}
                            </a>
                        </h3>
                        
                        <p class="text-sm text-gray-600 line-clamp-2">
                            {{ Str::limit(strip_tags($related->konten), 80) }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('berita') }}" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Kembali ke Berita
        </a>
    </div>
</div>
@endsection
