{{--
    File: resources/views/components/berita-list.blade.php
    Variabel yang dibutuhkan: $beritas (collection of Berita)
--}}
@if($beritas && $beritas->count() > 0)
    <div class="space-y-6 mb-8">
        @foreach($beritas as $berita)
            <a href="{{ route('berita-detail', ['judul' => Str::slug($berita->judul), 'id' => $berita->id]) }}" class="block">
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 cursor-pointer">
                    <div class="md:flex">
                        <div class="md:w-1/3">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}"
                                     alt="{{ $berita->judul }}"
                                     class="w-full h-48 md:h-full object-cover">
                            @else
                                <div class="w-full h-48 md:h-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="md:w-2/3 p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $berita->tanggal_publikasi ? \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d M Y') : $berita->tanggal->format('d M Y') }}
                                <span class="mx-2">•</span>
                                <span>{{ $berita->tanggal->diffForHumans() }}</span>
                            </div>

                            <h2 class="text-2xl font-semibold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                {{ $berita->judul }}
                            </h2>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($berita->konten), 200) }}
                            </p>

                            @if(isset($berita->views))
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ number_format($berita->views) }} views
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
            </a>
        @endforeach
    </div>
@else
    {{-- Ini adalah empty state jika tidak ada berita --}}
    <div class="bg-white rounded-lg shadow-md p-12 text-center border-2 border-dashed border-gray-300">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-3"/>
        </svg>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">
            @if(request('search'))
                Tidak ada berita ditemukan
            @else
                Belum ada berita
            @endif
        </h3>
        <p class="text-gray-600 mb-6 max-w-md mx-auto">
            @if(request('search'))
                Tidak ada berita yang cocok dengan pencarian "{{ request('search') }}". Coba kata kunci lain.
            @else
                Belum ada berita yang dipublikasikan. Silakan kembali lagi nanti.
            @endif
        </p>
        @if(request('search'))
            <a href="{{ route('berita') }}"
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                </svg>
                Lihat Semua Berita
            </a>
        @endif
    </div>
@endif
