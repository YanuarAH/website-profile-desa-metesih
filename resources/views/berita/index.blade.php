@extends('layouts.app')

@section('title', '- Berita Desa')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white rounded-lg mb-8 p-8 md:p-12">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Berita Desa Metesih</h1>
            <p class="text-xl opacity-90">Informasi terkini dan kegiatan desa</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('berita') }}" class="space-y-4 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
            <!-- Search Input -->
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 sm:text-sm" 
                           placeholder="Cari berita berdasarkan judul atau konten...">
                </div>
            </div>

            <!-- Sort Filter -->
            <div class="flex space-x-2">
                <select name="sort" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul A-Z</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-2">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                @if(request('search') || request('sort'))
                    <a href="{{ route('berita') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results Info -->
    @if($beritas->total() > 0)
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
            <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                Menampilkan {{ $beritas->firstItem() }}-{{ $beritas->lastItem() }} dari {{ $beritas->total() }} berita
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </div>
            
            <!-- View Toggle -->
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-700">Tampilan:</span>
                <div class="flex rounded-md shadow-sm" role="group">
                    <button type="button" 
                            onclick="toggleView('grid')"
                            id="grid-view-btn"
                            class="px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-purple-700 focus:z-10 focus:ring-2 focus:ring-purple-700 focus:text-purple-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button type="button" 
                            onclick="toggleView('list')"
                            id="list-view-btn"
                            class="px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-purple-700 focus:z-10 focus:ring-2 focus:ring-purple-700 focus:text-purple-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18m-9 8h9"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($beritas->isEmpty())
        <!-- Empty State -->
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
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                    </svg>
                    Lihat Semua Berita
                </a>
            @endif
        </div>
    @else
        <!-- Grid View -->
        <div id="grid-view" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach($beritas as $berita)
                <a href="{{ route('berita-detail', $berita->id) }}" class="block">
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                 alt="{{ $berita->judul }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $berita->tanggal_publikasi ? \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d M Y') : $berita->tanggal->format('d M Y') }}
                            </div>
                            
                            <h2 class="text-xl font-semibold text-gray-800 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                                {{ $berita->judul }}
                            </h2>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($berita->konten), 150) }}
                            </p>
                            
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-gray-500">
                                    {{ $berita->tanggal->diffForHumans() }}
                                </div>
                                @if(isset($berita->views))
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ number_format($berita->views) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>
                </a>
            @endforeach
        </div>

        <!-- List View -->
        <div id="list-view" class="hidden space-y-6 mb-8">
            @foreach($beritas as $berita)
                <a href="{{ route('berita-detail', $berita->id) }}" class="block">
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
                                    {{ $berita->tanggal_publikasi ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') : $berita->tanggal->format('d M Y') }}
                                    <span class="mx-2">•</span>
                                    <span>{{ $berita->tanggal->diffForHumans() }}</span>
                                </div>
                                
                                <h2 class="text-2xl font-semibold text-gray-800 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
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

        <!-- Pagination -->
        @if($beritas->hasPages())
            <div class="flex justify-center">
                <div class="bg-white rounded-lg shadow-md p-4">
                    {{ $beritas->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    @endif
</div>

<script>
function toggleView(viewType) {
    const gridView = document.getElementById('grid-view');
    const listView = document.getElementById('list-view');
    const gridBtn = document.getElementById('grid-view-btn');
    const listBtn = document.getElementById('list-view-btn');
    
    if (viewType === 'grid') {
        gridView.classList.remove('hidden');
        listView.classList.add('hidden');
        gridBtn.classList.add('bg-purple-100', 'text-purple-700');
        gridBtn.classList.remove('bg-white', 'text-gray-900');
        listBtn.classList.remove('bg-purple-100', 'text-purple-700');
        listBtn.classList.add('bg-white', 'text-gray-900');
        localStorage.setItem('guest-berita-view', 'grid');
    } else {
        gridView.classList.add('hidden');
        listView.classList.remove('hidden');
        listBtn.classList.add('bg-purple-100', 'text-purple-700');
        listBtn.classList.remove('bg-white', 'text-gray-900');
        gridBtn.classList.remove('bg-purple-100', 'text-purple-700');
        gridBtn.classList.add('bg-white', 'text-gray-900');
        localStorage.setItem('guest-berita-view', 'list');
    }
}

// Load saved view preference
document.addEventListener('DOMContentLoaded', function() {
    const savedView = localStorage.getItem('guest-berita-view') || 'grid';
    toggleView(savedView);
});

// Auto-submit search form on sort change
document.querySelector('select[name="sort"]').addEventListener('change', function() {
    this.form.submit();
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
