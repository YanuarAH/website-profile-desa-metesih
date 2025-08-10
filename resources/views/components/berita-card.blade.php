{{--
    File: resources/views//_berita-card.blade.php
    Variabel yang dibutuhkan: $berita
--}}
<a href="{{ route('berita-detail', $berita->id) }}" class="block group">
    <article
        class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        @if ($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        @endif

        <div class="p-6 flex flex-col flex-grow">
            <div class="flex items-center text-sm text-gray-500 mb-3">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd" />
                </svg>
                {{-- Menggunakan tanggal_publikasi jika ada, jika tidak pakai created_at --}}
                {{ $berita->tanggal_publikasi ? \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') : $berita->tanggal->translatedFormat('d F Y') }}
            </div>

            <h2
                class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors flex-grow">
                {{ $berita->judul }}
            </h2>

            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                {{ Str::limit(strip_tags($berita->konten), 150) }}
            </p>

            <div class="flex justify-between items-center">
                <div class="text-xs text-gray-500">
                    {{ $berita->tanggal->diffForHumans() }}
                </div>
            </div>
        </div>
    </article>
</a>
