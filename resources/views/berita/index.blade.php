@extends('layouts.app')

@section('title', 'Berita Desa - Desa Maju Jaya')

@section('content')
<div class="container mx-auto px-4 py-8 bg-white shadow-md rounded-lg my-8 sm:px-6 lg:px-8"> {{-- Sesuaikan padding --}}
    <h1 class="text-3xl sm:text-4xl font-bold text-center text-blue-800 mb-8">Berita dan Pengumuman Desa</h1> {{-- Sesuaikan ukuran teks --}}

    @if ($beritas->isEmpty())
        <p class="text-gray-600 text-center">Belum ada berita yang dipublikasikan.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"> {{-- Grid responsif --}}
            @foreach ($beritas as $berita)
                <!-- Kartu Berita -->
                <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' .$berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                    @else
                        <img src="/placeholder.svg?height=200&width=300&text=Gambar Berita" alt="Gambar Placeholder" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2">{{ $berita->judul }}</h3>
                        <p class="text-gray-600 text-xs sm:text-sm mb-4">{{ $berita->created_at->format('d M Y') }}</p>
                        <p class="text-gray-700 mb-4 text-sm">{{ Str::limit(strip_tags($berita->konten), 150) }}</p>
                        <a href="#" class="text-blue-600 hover:underline font-medium text-sm">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $beritas->links() }} {{-- Menampilkan link paginasi --}}
        </div>
    @endif
</div>
@endsection
