@extends('layouts.admin')
@section('title', 'Kelola Kegiatan')

@section('content')
<div class="max-w-full">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 sm:p-6">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Informasi Kegiatan</h2>
                    <p class="text-sm text-gray-600 mt-1">Kelola semua kegiatan desa</p>
                    <!-- Status Update Indicator -->
                    <div id="status-indicator" class="hidden mt-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <span id="status-text">Mendeteksi perubahan...</span>
                        </span>
                    </div>
                    <!-- Change Detection Info -->
                    <div id="change-info" class="hidden mt-1">
                        <span class="text-xs text-gray-500">
                            Terakhir dicek: <span id="last-check">-</span>
                        </span>
                    </div>
                </div>
                <a href="{{ route('kegiatan.create') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Kegiatan Baru
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

            <!-- Change Detection Notification -->
            <div id="change-notification" class="hidden bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-6" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span id="change-message">Perubahan terdeteksi! Data sedang diperbarui...</span>
                    </div>
                    <button onclick="hideChangeNotification()" class="ml-4 text-blue-600 hover:text-blue-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <form method="GET" action="{{ route('kegiatan.index') }}" class="space-y-4 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
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
                        @if(request('search') || request('sort') || request('status'))
                            <a href="{{ route('kegiatan.index') }}"
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

            <!-- Quick Status Filter Buttons -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2">
                    <h3 class="text-sm font-medium text-gray-700 mr-4 flex items-center">STATUS:</h3>
                    <button onclick="filterByStatus('')"
                            class="status-filter-btn px-3 py-1 rounded-full text-sm font-medium transition-colors duration-200 {{ !request('status') ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                            data-status="">
                        Semua (<span id="quick-total-count">{{ \App\Models\Kegiatan::count() }}</span>)
                    </button>
                    <button onclick="filterByStatus('mendatang')"
                            class="status-filter-btn px-3 py-1 rounded-full text-sm font-medium transition-colors duration-200 {{ request('status') == 'mendatang' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-700 hover:bg-blue-200' }}"
                            data-status="mendatang">
                        Mendatang (<span id="quick-mendatang-count">{{ \App\Models\Kegiatan::mendatang()->count() }}</span>)
                    </button>
                    <button onclick="filterByStatus('selesai')"
                            class="status-filter-btn px-3 py-1 rounded-full text-sm font-medium transition-colors duration-200 {{ request('status') == 'selesai' ? 'bg-gray-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                            data-status="selesai">
                        Selesai (<span id="quick-selesai-count">{{ \App\Models\Kegiatan::selesai()->count() }}</span>)
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6" id="stats-cards">
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-blue-600">Total Kegiatan</p>
                            <p class="text-2xl font-semibold text-blue-900" id="total-count">{{ \App\Models\Kegiatan::count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-green-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-600">Mendatang</p>
                            <p class="text-2xl font-semibold text-green-900" id="mendatang-count">{{ \App\Models\Kegiatan::mendatang()->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600">Selesai</p>
                            <p class="text-2xl font-semibold text-gray-900" id="selesai-count">{{ \App\Models\Kegiatan::selesai()->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area with Smart Reload -->
            <div id="content-area">
                @if ($kegiatans->isEmpty())
                    <!-- Empty State -->
                    <div class="bg-gray-50 rounded-lg p-12 text-center border-2 border-dashed border-gray-300">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">
                            @if(request('search') || request('status'))
                                Tidak ada kegiatan ditemukan
                            @else
                                Belum ada kegiatan
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            @if(request('search') || request('status'))
                                Tidak ada kegiatan yang cocok dengan filter yang dipilih. Coba ubah filter atau kata kunci pencarian.
                            @else
                                Belum ada kegiatan yang ditambahkan. Mulai dengan menambahkan kegiatan pertama.
                            @endif
                        </p>
                        @if(!request('search') && !request('status'))
                            <a href="{{ route('kegiatan.create') }}"
                               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Kegiatan Pertama
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
                                        <th class="py-4 px-6 text-left font-medium">Kegiatan</th>
                                        <th class="py-4 px-6 text-left font-medium">Gambar</th>
                                        <th class="py-4 px-6 text-left font-medium">Tanggal</th>
                                        <th class="py-4 px-6 text-left font-medium">Lokasi</th>
                                        <th class="py-4 px-6 text-center font-medium">Status</th>
                                        <th class="py-4 px-6 text-center font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 text-sm">
                                    @foreach ($kegiatans as $kegiatan)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                            <td class="py-4 px-6">
                                                <div class="flex flex-col">
                                                    <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $kegiatan->nama_kegiatan }}</h3>
                                                    <p class="text-gray-600 text-xs line-clamp-2">{{ Str::limit(strip_tags($kegiatan->deskripsi), 100) }}</p>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                @if ($kegiatan->gambar)
                                                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}"
                                                         alt="{{ $kegiatan->nama_kegiatan }}"
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
                                                    <span class="font-medium">{{ $kegiatan->tanggal->format('d M Y') }}</span>
                                                    <span class="text-xs text-gray-500 mt-1">{{ $kegiatan->tanggal->diffForHumans() }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="font-medium">{{ $kegiatan->lokasi }}</span>
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $kegiatan->status === 'mendatang' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $kegiatan->status_text }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                                                       class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition-colors duration-200"
                                                       title="Edit">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="w-8 h-8 flex items-center justify-center rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-colors duration-200"
                                                                title="Hapus"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
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

                    <!-- Pagination -->
                    @if($kegiatans->hasPages())
                        <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-lg">
                            <div class="flex flex-1 justify-between sm:hidden">
                                @if ($kegiatans->onFirstPage())
                                    <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500">Sebelumnya</span>
                                @else
                                    <a href="{{ $kegiatans->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Sebelumnya</a>
                                @endif

                                @if ($kegiatans->hasMorePages())
                                    <a href="{{ $kegiatans->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Selanjutnya</a>
                                @else
                                    <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500">Selanjutnya</span>
                                @endif
                            </div>
                            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Menampilkan <span class="font-medium">{{ $kegiatans->firstItem() }}</span> sampai <span class="font-medium">{{ $kegiatans->lastItem() }}</span> dari <span class="font-medium">{{ $kegiatans->total() }}</span> kegiatan
                                    </p>
                                </div>
                                <div>
                                    {{ $kegiatans->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Smart Change Detection System
let changeDetectionInterval;
let currentDataHash = null;
let isChecking = false;
let isUpdating = false;

// Initialize change detection
function initChangeDetection() {
    // Set initial hash (generate from current data)
    currentDataHash = generateInitialHash();

    // Start checking for changes every 10 seconds
    changeDetectionInterval = setInterval(checkForChanges, 10000);

    // Show change detection info
    document.getElementById('change-info').classList.remove('hidden');
    updateLastCheckTime();
}

// Generate initial hash from current page data
function generateInitialHash() {
    const stats = {
        total: parseInt(document.getElementById('total-count').textContent),
        mendatang: parseInt(document.getElementById('mendatang-count').textContent),
        selesai: parseInt(document.getElementById('selesai-count').textContent)
    };
    return btoa(JSON.stringify(stats)); // Simple hash using base64
}

// Check for changes in database
function checkForChanges() {
    if (isChecking || isUpdating) return;

    isChecking = true;
    showStatusIndicator('Mendeteksi perubahan...');

    fetch('{{ route("kegiatan.check-changes") }}?hash=' + encodeURIComponent(currentDataHash), {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        isChecking = false;
        hideStatusIndicator();
        updateLastCheckTime();

        if (data.hasChanges) {
            console.log('Perubahan terdeteksi! Memperbarui data...');
            showChangeNotification(`${data.updated} kegiatan berubah status. Memperbarui tampilan...`);

            // Update hash
            currentDataHash = data.currentHash;

            // Update counts immediately
            updateAllCounts(data.stats);

            // Reload table data
            reloadTableData();
        }
    })
    .catch(error => {
        console.error('Error checking changes:', error);
        isChecking = false;
        hideStatusIndicator();
        updateLastCheckTime();
    });
}

// Force check for changes (manual)
function forceCheckChanges() {
    if (isChecking || isUpdating) return;

    // Reset hash to force check
    currentDataHash = null;
    checkForChanges();
}

// Reload table data when changes detected
function reloadTableData() {
    if (isUpdating) return;

    isUpdating = true;
    showStatusIndicator('Memperbarui data...');

    // Get current URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('reload_data', '1');

    fetch('{{ route("kegiatan.index") }}?' + urlParams.toString(), {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Update content with smooth transition
        const contentArea = document.getElementById('content-area');
        contentArea.style.opacity = '0.5';

        setTimeout(() => {
            contentArea.innerHTML = data.html;
            contentArea.style.opacity = '1';

            // Update hash
            currentDataHash = data.hash;

            // Update all counts
            updateAllCounts(data.stats);

            isUpdating = false;
            hideStatusIndicator();

            // Show success notification
            showChangeNotification('Data berhasil diperbarui!', 'success');
        }, 300);
    })
    .catch(error => {
        console.error('Error reloading data:', error);
        isUpdating = false;
        hideStatusIndicator();
        showChangeNotification('Gagal memperbarui data', 'error');
    });
}

// Update all count displays
function updateAllCounts(stats) {
    // Update stats cards with animation
    animateCountChange('total-count', stats.total);
    animateCountChange('mendatang-count', stats.mendatang);
    animateCountChange('selesai-count', stats.selesai);

    // Update quick filter buttons
    animateCountChange('quick-total-count', stats.total);
    animateCountChange('quick-mendatang-count', stats.mendatang);
    animateCountChange('quick-selesai-count', stats.selesai);

    // Update dropdown filter options
    const statusFilter = document.getElementById('status-filter');
    if (statusFilter) {
        const currentValue = statusFilter.value;
        statusFilter.innerHTML = `
            <option value="">Semua Status</option>
            <option value="mendatang" ${currentValue === 'mendatang' ? 'selected' : ''}>
                Mendatang (${stats.mendatang})
            </option>
            <option value="selesai" ${currentValue === 'selesai' ? 'selected' : ''}>
                Selesai (${stats.selesai})
            </option>
        `;
    }
}

// Animate count changes
function animateCountChange(elementId, newValue) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const currentValue = parseInt(element.textContent);
    if (currentValue !== newValue) {
        element.style.transform = 'scale(1.1)';
        element.style.color = '#10B981'; // Green color for change

        setTimeout(() => {
            element.textContent = newValue;
            element.style.transform = 'scale(1)';
            element.style.color = '';
        }, 200);
    }
}

// Show status indicator
function showStatusIndicator(message) {
    const indicator = document.getElementById('status-indicator');
    const statusText = document.getElementById('status-text');

    statusText.textContent = message;
    indicator.classList.remove('hidden');
}

// Hide status indicator
function hideStatusIndicator() {
    const indicator = document.getElementById('status-indicator');
    indicator.classList.add('hidden');
}

// Show change notification
function showChangeNotification(message, type = 'info') {
    const notification = document.getElementById('change-notification');
    const messageElement = document.getElementById('change-message');

    messageElement.textContent = message;

    // Change color based on type
    if (type === 'success') {
        notification.className = notification.className.replace('bg-blue-100 border-blue-400 text-blue-700', 'bg-green-100 border-green-400 text-green-700');
    } else if (type === 'error') {
        notification.className = notification.className.replace('bg-blue-100 border-blue-400 text-blue-700', 'bg-red-100 border-red-400 text-red-700');
    }

    notification.classList.remove('hidden');

    // Auto-hide after 5 seconds
    setTimeout(() => {
        notification.classList.add('hidden');
        // Reset to default color
        notification.className = notification.className.replace(/bg-(green|red)-100 border-(green|red)-400 text-(green|red)-700/g, 'bg-blue-100 border-blue-400 text-blue-700');
    }, 5000);
}

// Hide change notification
function hideChangeNotification() {
    document.getElementById('change-notification').classList.add('hidden');
}

// Update last check time
function updateLastCheckTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID');
    document.getElementById('last-check').textContent = timeString;
}

// Filter by status
function filterByStatus(status) {
    const currentUrl = new URL(window.location.href);

    if (status === '') {
        currentUrl.searchParams.delete('status');
    } else {
        currentUrl.searchParams.set('status', status);
    }

    // Reset to first page when filtering
    currentUrl.searchParams.delete('page');

    window.location.href = currentUrl.toString();
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Start change detection after 2 seconds
    setTimeout(initChangeDetection, 2000);
});

// Stop change detection when page is about to unload
window.addEventListener('beforeunload', function() {
    if (changeDetectionInterval) {
        clearInterval(changeDetectionInterval);
    }
});

// Resume change detection when page becomes visible
document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'visible') {
        if (changeDetectionInterval) {
            clearInterval(changeDetectionInterval);
        }
        initChangeDetection();
    } else {
        if (changeDetectionInterval) {
            clearInterval(changeDetectionInterval);
        }
    }
});

// Auto-submit search form on filter change
document.querySelector('select[name="status"]').addEventListener('change', function() {
    this.form.submit();
});

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

.status-filter-btn {
    transition: all 0.2s ease-in-out;
}

.status-filter-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

#content-area {
    transition: opacity 0.3s ease-in-out;
}

@keyframes bounce {
    0%, 20%, 53%, 80%, 100% { transform: translateY(0); }
    40%, 43% { transform: translateY(-10px); }
    70% { transform: translateY(-5px); }
    90% { transform: translateY(-2px); }
}

.animate-bounce {
    animation: bounce 1s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
@endsection
