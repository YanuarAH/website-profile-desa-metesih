@extends('layouts.app')

@section('title', '- Kegiatan Desa')

@section('content')
<div class="max-w-7xl mx-auto">

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white rounded-lg mb-8 p-8 md:p-12">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Agenda Kegiatan</h1>
            <p class="text-xl opacity-90">Desa Metesih - Kecamatan Jiwan</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-6 sm:mb-8">
        <form method="GET" action="{{ route('kegiatan') }}" class="space-y-4 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
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
                           placeholder="Cari kegiatan berdasarkan nama, deskripsi, atau lokasi...">
                </div>
            </div>

            <!-- Sort Filter -->
            <div class="flex space-x-2">
                <select name="sort" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Nama Kegiatan A-Z</option>
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
                    <a href="{{ route('kegiatan') }}"
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

    <!-- Results Info -->
    @if($kegiatans->total() > 0)
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
            <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                Menampilkan {{ $kegiatans->firstItem() }}-{{ $kegiatans->lastItem() }} dari {{ $kegiatans->total() }} kegiatan mendatang
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
            </div>
        </div>
    @endif

    @include('components.kegiatan-grid', ['kegiatans' => $kegiatans])

    <!-- Pagination -->
    @if($kegiatans->hasPages())
        <div class="flex justify-center">
            <div class="bg-white rounded-lg shadow-md p-4">
                {{ $kegiatans->appends(request()->query())->links() }}
            </div>
        </div>
    @endif
</div>

<script>
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
