{{--
    File: resources/views/components/galeri-grid.blade.php
    Komponen ini menampilkan grid galeri dan sudah termasuk modal pop-up.
    Variabel yang dibutuhkan: $galeris (collection of galeri)
--}}

@if($galeris && $galeris->count() > 0)
    <!-- Grid Galeri -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($galeris as $galeri)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer group"
             onclick="openModal('{{ asset('storage/' . $galeri->gambar) }}', '{{ e($galeri->judul) ?? 'Foto Desa' }}')">

            <div class="aspect-square overflow-hidden rounded-t-lg relative">
                <img src="{{ asset('storage/' . $galeri->gambar) }}"
                     alt="{{ $galeri->judul ?? 'Foto Desa' }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            @if($galeri->judul)
            <div class="p-3">
                <h3 class="text-sm font-medium text-gray-900 truncate" title="{{ $galeri->judul }}">{{ $galeri->judul }}</h3>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Modal untuk preview gambar (digabungkan di sini) -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4 transition-opacity duration-300" onclick="closeModal()">
        <div class="relative bg-white rounded-lg shadow-2xl max-w-4xl max-h-[90vh] w-full" onclick="event.stopPropagation()">
            <!-- Tombol Tutup -->
            <button onclick="closeModal()" class="absolute -top-4 -right-4 text-white bg-red-600 rounded-full p-2 hover:bg-red-700 focus:outline-none z-10">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>

            <!-- Konten Modal -->
            <div id="modalLoading" class="hidden absolute inset-0 bg-white/80 flex items-center justify-center z-20 rounded-lg"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600"></div></div>
            <img id="modalImage" src="" alt="Preview Gambar" class="w-full h-auto object-contain rounded-t-lg max-h-[calc(90vh-5rem)]">
            <div class="p-4 text-center bg-gray-50 rounded-b-lg">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900"></h3>
                <p id="modalDate" class="text-sm text-gray-500"></p>
            </div>
        </div>
    </div>

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

        // Pastikan event listener hanya ditambahkan sekali
        if (!window.escListenerAdded) {
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !document.getElementById('imageModal').classList.contains('hidden')) {
                    closeModal();
                }
            });
            window.escListenerAdded = true;
        }
    </script>

@else
    <div class="col-span-full text-center py-12 bg-white rounded-lg shadow-md">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <h3 class="text-xl font-medium text-gray-900 mb-2">Galeri Kosong</h3>
        <p class="text-gray-500">Foto-foto kegiatan desa akan ditampilkan disini.</p>
    </div>
@endif

<style>
.aspect-square { aspect-ratio: 1 / 1; }
</style>
