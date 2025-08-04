@extends('layouts.admin')
@section('title', 'Kelola Berita')

@section('content')
<div class="max-w-full">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 sm:p-6">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Berita</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola semua berita dan artikel desa</p>
                </div>
                <a href="{{ route('berita.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Berita Baru
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Search and Filter Section -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <form method="GET" action="{{ route('berita.index') }}" class="space-y-4 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
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
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                   placeholder="Cari berita berdasarkan judul atau konten...">
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="flex space-x-2">
                        <select name="sort" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul A-Z</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari
                        </button>
                        @if(request('search') || request('sort'))
                            <a href="{{ route('berita.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- View Toggle -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-700">Tampilan:</span>
                    <div class="flex rounded-md shadow-sm" role="group">
                        <button type="button" 
                                onclick="toggleView('table')"
                                id="table-view-btn"
                                class="px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18m-9 8h9"/>
                            </svg>
                        </button>
                        <button type="button" 
                                onclick="toggleView('grid')"
                                id="grid-view-btn"
                                class="px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                @if($beritas->total() > 0)
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $beritas->firstItem() }}-{{ $beritas->lastItem() }} dari {{ $beritas->total() }} berita
                        @if(request('search'))
                            untuk "<strong>{{ request('search') }}</strong>"
                        @endif
                    </div>
                @endif
            </div>

            @if ($beritas->isEmpty())
                <!-- Empty State -->
                <div class="bg-gray-50 rounded-lg p-12 text-center border-2 border-dashed border-gray-300">
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
                            Belum ada berita yang ditambahkan. Mulai dengan menambahkan berita pertama.
                        @endif
                    </p>
                    @if(!request('search'))
                        <a href="{{ route('berita.create') }}" 
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Tambah Berita Pertama
                        </a>
                    @endif
                </div>
            @else
                <!-- Table View -->
                <div id="table-view" class="overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-4 px-6 text-left font-medium">Berita</th>
                                    <th class="py-4 px-6 text-left font-medium">Gambar</th>
                                    <th class="py-4 px-6 text-left font-medium">Tanggal</th>
                                    <th class="py-4 px-6 text-center font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-sm">
                                @foreach ($beritas as $berita)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $berita->judul }}</h3>
                                                <p class="text-gray-600 text-xs line-clamp-2">{{ Str::limit(strip_tags($berita->konten), 100) }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if ($berita->gambar)
                                                <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                                     alt="{{ $berita->judul }}" 
                                                     class="w-20 h-16 object-cover rounded-lg shadow-sm border border-gray-200">
                                            @else
                                                <div class="w-20 h-16 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex flex-col">
                                                <span class="font-medium">{{ $berita->tanggal->format('d M Y') }}</span>
                                                <span class="text-xs text-gray-500 mt-1">{{ $berita->tanggal->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center justify-center space-x-2">
                                                <a href="{{ route('berita.edit', $berita->id) }}" 
                                                   class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition-colors duration-200" 
                                                   title="Edit">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="w-8 h-8 flex items-center justify-center rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-colors duration-200" 
                                                            title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Grid View -->
                <div id="grid-view" class="hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($beritas as $berita)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                                <!-- Image -->
                                <div class="aspect-w-16 aspect-h-9">
                                    @if ($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                             alt="{{ $berita->judul }}" 
                                             class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content -->
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs text-gray-500">{{ $berita->tanggal->format('d M Y') }}</span>
                                        <span class="text-xs text-gray-500">{{ $berita->tanggal->diffForHumans() }}</span>
                                    </div>
                                    
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $berita->judul }}</h3>
                                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ Str::limit(strip_tags($berita->konten), 120) }}</p>
                                    
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('berita.edit', $berita->id) }}" 
                                           class="w-7 h-7 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition-colors duration-200" 
                                           title="Edit">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-7 h-7 flex items-center justify-center rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-colors duration-200" 
                                                    title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                @if($beritas->hasPages())
                    <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-lg">
                        <div class="flex flex-1 justify-between sm:hidden">
                            @if ($beritas->onFirstPage())
                                <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500">Previous</span>
                            @else
                                <a href="{{ $beritas->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                            @endif

                            @if ($beritas->hasMorePages())
                                <a href="{{ $beritas->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                            @else
                                <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500">Next</span>
                            @endif
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing <span class="font-medium">{{ $beritas->firstItem() }}</span> to <span class="font-medium">{{ $beritas->lastItem() }}</span> of <span class="font-medium">{{ $beritas->total() }}</span> results
                                </p>
                            </div>
                            <div>
                                {{ $beritas->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

<script>
function toggleView(viewType) {
    const tableView = document.getElementById('table-view');
    const gridView = document.getElementById('grid-view');
    const tableBtn = document.getElementById('table-view-btn');
    const gridBtn = document.getElementById('grid-view-btn');
    
    if (viewType === 'table') {
        tableView.classList.remove('hidden');
        gridView.classList.add('hidden');
        tableBtn.classList.add('bg-blue-100', 'text-blue-700');
        tableBtn.classList.remove('bg-white', 'text-gray-900');
        gridBtn.classList.remove('bg-blue-100', 'text-blue-700');
        gridBtn.classList.add('bg-white', 'text-gray-900');
        localStorage.setItem('berita-view', 'table');
    } else {
        tableView.classList.add('hidden');
        gridView.classList.remove('hidden');
        gridBtn.classList.add('bg-blue-100', 'text-blue-700');
        gridBtn.classList.remove('bg-white', 'text-gray-900');
        tableBtn.classList.remove('bg-blue-100', 'text-blue-700');
        tableBtn.classList.add('bg-white', 'text-gray-900');
        localStorage.setItem('berita-view', 'grid');
    }
}

// Load saved view preference
document.addEventListener('DOMContentLoaded', function() {
    const savedView = localStorage.getItem('berita-view') || 'table';
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

.aspect-w-16 {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
}

.aspect-w-16 > * {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
</style>
@endsection
