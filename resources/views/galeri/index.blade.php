@extends('layouts.app')

@section('title', '- Galeri Foto')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white rounded-lg mb-8 p-8 md:p-12 text-center">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">Galeri Foto Desa Metesih</h1>
        <p class="text-lg md:text-xl opacity-90">Kumpulan foto kegiatan dan keindahan desa</p>
    </div>

    @if($galeris->count() > 0)
        <!-- Stats -->
        <div class="mb-6">
            <p class="text-sm text-gray-600">Menampilkan {{ $galeris->count() }} dari total {{ $galeris->total() }} foto</p>
        </div>

        <!-- Grid Galeri (Menggunakan Komponen) -->
        <div class="mb-8">
            @include('components.galeri-grid', ['galeris' => $galeris, 'isGalleryPage' => true])
        </div>

        <!-- Pagination -->
        @if($galeris->hasPages())
        <div class="flex justify-center">
            {{ $galeris->links() }}
        </div>
        @endif

    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-lg shadow-md">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Galeri Kosong</h3>
            <p class="text-gray-500">Belum ada foto yang tersedia saat ini.</p>
        </div>
    @endif
</div>

<!-- Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full w-full">
        <button onclick="closeModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300 z-10"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        <div class="bg-white rounded-lg overflow-hidden">
            <div id="modalLoading" class="hidden absolute inset-0 bg-white flex items-center justify-center z-10"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div></div>
            <div class="flex items-center justify-center bg-gray-100 min-h-[60vh]">
                <img id="modalImage" src="" alt="" class="max-w-full max-h-[70vh] object-contain">
            </div>
            <div class="p-6 text-center">
                <h3 id="modalTitle" class="text-xl font-semibold text-gray-900 mb-2"></h3>
                <p id="modalDate" class="text-sm text-gray-500"></p>
            </div>
        </div>
    </div>
</div>

<style>
.aspect-square { aspect-ratio: 1 / 1; }
</style>

<script>
function openModal(imageSrc, title, date) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDate = document.getElementById('modalDate');
    const modalLoading = document.getElementById('modalLoading');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    modalLoading.classList.remove('hidden');
    
    modalTitle.textContent = title;
    modalDate.textContent = date;
    
    const img = new Image();
    img.onload = function() {
        modalImage.src = imageSrc;
        modalImage.alt = title;
        modalLoading.classList.add('hidden');
    };
    img.onerror = function() {
        modalImage.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZmlsbD0iIzZiNzI4MCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkdhbWJhciB0aWRhayBkYXBhdCBkaW11YXQ8L3RleHQ+PC9zdmc+';
        modalLoading.classList.add('hidden');
    };
    img.src = imageSrc;
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

document.getElementById('imageModal').addEventListener('click', function(e) { if (e.target === this) { closeModal(); } });
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeModal(); } });
</script>
@endsection
