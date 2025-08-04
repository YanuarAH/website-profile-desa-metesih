@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Galeri Foto Desa</h1>
                        <p class="text-sm text-gray-600 mt-1">Kelola koleksi foto dan dokumentasi desa</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex space-x-3">
                        <button onclick="toggleBulkActions()" id="bulkActionBtn" class="hidden inline-flex items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Terpilih
                        </button>
                        <a href="{{ route('galeri.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Foto
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="px-6 py-4">
                <form method="GET" action="{{ route('galeri.index') }}" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="sm:w-48">
                        <select name="sort" onchange="this.form.submit()" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul (A-Z)</option>
                            <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Judul (Z-A)</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        @if(request('search') || request('sort') != 'terbaru')
                            <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Stats -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">
                    @if(request('search'))
                        Menampilkan {{ $galeris->total() }} hasil untuk "{{ request('search') }}"
                    @else
                        Total {{ $galeris->total() }} foto
                    @endif
                </span>
            </div>
            <div class="flex items-center space-x-2">
                <label class="flex items-center">
                    <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" onchange="toggleSelectAll()">
                    <span class="ml-2 text-sm text-gray-600">Pilih Semua</span>
                </label>
            </div>
        </div>

        @if ($galeris->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">
                    @if(request('search'))
                        Tidak ada foto ditemukan
                    @else
                        Galeri masih kosong
                    @endif
                </h3>
                <p class="mt-2 text-sm text-gray-500">
                    @if(request('search'))
                        Coba ubah kata kunci pencarian atau hapus filter.
                    @else
                        Mulai dengan menambahkan foto pertama ke galeri desa.
                    @endif
                </p>
                <div class="mt-6">
                    @if(request('search'))
                        <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Lihat Semua
                        </a>
                    @else
                        <a href="{{ route('galeri.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Foto Pertama
                        </a>
                    @endif
                </div>
            </div>
        @else
            <!-- Bulk Actions Form -->
            <form id="bulkForm" action="{{ route('galeri.bulk-delete') }}" method="POST" style="display: none;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto yang dipilih?');">
                @csrf
                @method('DELETE')
            </form>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach ($galeris as $galeri)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow group">
                        <div class="relative">
                            <!-- Checkbox -->
                            <div class="absolute top-2 left-2 z-10">
                                <input type="checkbox" name="selected_items[]" value="{{ $galeri->id }}" class="item-checkbox rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" onchange="updateBulkActions()">
                            </div>
                            
                            <!-- Image -->
                            <div class="aspect-square bg-gray-200 overflow-hidden">
                                <img src="{{ asset('storage/' . $galeri->gambar) }}" 
                                     alt="{{ $galeri->judul ?? 'Foto Galeri' }}" 
                                     class="w-full h-full object-cover cursor-pointer hover:scale-105 transition-transform duration-200"
                                     onclick="openModal('{{ asset('storage/' . $galeri->gambar) }}', '{{ $galeri->judul ?? 'Foto Galeri' }}')">
                            </div>
                            
                            <!-- Actions Overlay -->
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="flex space-x-1">
                                    <a href="{{ route('galeri.edit', $galeri->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-4">
                            <h3 class="text-sm font-medium text-gray-900 truncate">
                                {{ $galeri->judul ?? 'Tanpa Judul' }}
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($galeris->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 rounded-b-lg mt-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            @if ($galeris->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-default">
                                    Sebelumnya
                                </span>
                            @else
                                <a href="{{ $galeris->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Sebelumnya
                                </a>
                            @endif

                            @if ($galeris->hasMorePages())
                                <a href="{{ $galeris->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Selanjutnya
                                </a>
                            @else
                                <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-default">
                                    Selanjutnya
                                </span>
                            @endif
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan
                                    <span class="font-medium">{{ $galeris->firstItem() }}</span>
                                    sampai
                                    <span class="font-medium">{{ $galeris->lastItem() }}</span>
                                    dari
                                    <span class="font-medium">{{ $galeris->total() }}</span>
                                    hasil
                                </p>
                            </div>
                            <div>
                                {{ $galeris->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4" onclick="closeModal()">
    <div class="max-w-4xl max-h-full">
        <img id="modalImage" src="/placeholder.svg" alt="" class="max-w-full max-h-full object-contain">
        <div class="text-center mt-4">
            <h3 id="modalTitle" class="text-white text-lg font-medium"></h3>
            <button onclick="closeModal()" class="mt-2 text-white hover:text-gray-300">
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
function openModal(imageSrc, title) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    const bulkBtn = document.getElementById('bulkActionBtn');
    
    if (checkboxes.length > 0) {
        bulkBtn.classList.remove('hidden');
        bulkBtn.textContent = `Hapus ${checkboxes.length} Terpilih`;
    } else {
        bulkBtn.classList.add('hidden');
    }
}

function toggleBulkActions() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Pilih foto yang ingin dihapus terlebih dahulu.');
        return;
    }
    
    if (confirm(`Apakah Anda yakin ingin menghapus ${checkboxes.length} foto yang dipilih?`)) {
        const form = document.getElementById('bulkForm');
        
        // Add selected items to form
        checkboxes.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_items[]';
            input.value = checkbox.value;
            form.appendChild(input);
        });
        
        form.submit();
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>
@endsection
