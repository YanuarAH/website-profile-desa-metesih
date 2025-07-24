@extends('layouts.app')

@section('content')
    <!-- Bagian Hero -->
    <section class="relative h-[500px] bg-cover bg-center flex items-center justify-center text-white"
        style="background-image: url('{{ asset('images/home/unnamed.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center space-y-4">
            <h2 class="text-5xl font-bold">Selamat Datang di Desa Metesih</h2>
            <p class="text-lg">Sumber informasi terbaru tentang pemerintahan di Desa Metesih</p>
        </div>
    </section>

    <!-- Bagian Berita Terkini -->
    <section class="py-12 px-4 md:px-6 lg:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-8">
                <h3 class="text-blue-600 text-lg font-semibold mb-2">Informasi Terbaru</h3>
                <h2 class="text-4xl font-bold text-gray-800">Berita Terkini Desa</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($latestBeritas as $berita)
                    <!-- Kartu Berita -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if ($berita->gambar)
                            <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                        @else
                            <img src="/placeholder.svg?height=200&width=300&text=Gambar Berita" alt="Gambar Placeholder" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $berita->judul }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $berita->created_at->format('d M Y') }}</p>
                            {{-- Tampilkan sebagian kecil konten, atau ringkasan --}}
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($berita->konten), 100) }}</p>
                            <a href="#" class="text-blue-600 hover:underline font-medium">Baca Selengkapnya &rarr;</a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-600">Belum ada berita terbaru.</p>
                @endforelse
            </div>
            @if ($latestBeritas->count() > 0)
                <div class="mt-12 text-center">
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg">
                        Lihat Semua Berita
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
