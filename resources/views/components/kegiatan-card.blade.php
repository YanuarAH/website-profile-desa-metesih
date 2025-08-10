{{--
    File: resources/views/components/_kegiatan-card.blade.php
    Variabel yang dibutuhkan: $kegiatan
--}}
<a href="{{ route('kegiatan-detail', $kegiatan->id) }}" class="block group">
    <article class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        @if($kegiatan->gambar)
            <img src="{{ asset('storage/' . $kegiatan->gambar) }}"
                 alt="{{ $kegiatan->nama_kegiatan }}"
                 class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                </svg>
            </div>
        @endif

        <div class="p-6 flex flex-col flex-grow">
            <!-- Date & Time Block -->
            <div class="flex items-center text-sm text-teal-700 font-semibold mb-2">
                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span>{{ $kegiatan->tanggal->translatedFormat('d F Y') }}</span>
            </div>

            <h2 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors flex-grow">
                {{ $kegiatan->nama_kegiatan }}
            </h2>

            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                {{ Str::limit(strip_tags($kegiatan->deskripsi), 150) }}
            </p>

            <div class="flex items-center text-sm text-gray-500 mt-auto"> {{-- mt-auto untuk push ke bawah --}}
                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                </svg>
                <span class="truncate">{{ $kegiatan->lokasi }}</span>
            </div>
        </div>
    </article>
</a>
