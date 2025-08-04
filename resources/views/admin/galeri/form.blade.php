@extends('layouts.admin')

@section('title', isset($galeri) ? 'Edit Foto Galeri' : 'Tambah Foto Galeri')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ isset($galeri) ? 'Edit Foto Galeri' : 'Tambah Foto Galeri' }}
                        </h1>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ isset($galeri) ? 'Perbarui foto dan informasi galeri' : 'Tambahkan foto baru ke galeri desa' }}
                        </p>
                    </div>
                    <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <form action="{{ isset($galeri) ? route('galeri.update', $galeri->id) : route('galeri.store') }}" 
                  method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @if(isset($galeri))
                    @method('PUT')
                @endif
                
                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Foto
                    </label>
                    <input type="text" name="judul" id="judul" 
                           value="{{ old('judul', isset($galeri) ? $galeri->judul : '') }}" 
                           placeholder="Masukkan judul foto (opsional)"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-300 @enderror">
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">
                        Judul akan membantu pengunjung memahami konteks foto. Jika kosong, akan ditampilkan sebagai "Tanpa Judul".
                    </p>
                </div>

                <!-- Foto -->
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto
                    </label>
                    
                    <!-- Current Photo (only show in edit mode) -->
                    @if(isset($galeri) && $galeri->gambar)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $galeri->gambar) }}" 
                                     alt="{{ $galeri->judul ?? 'Foto Galeri' }}" 
                                     class="h-48 w-auto object-cover rounded-lg border border-gray-300 cursor-pointer hover:opacity-90 transition-opacity"
                                     onclick="openPreviewModal('{{ asset('storage/' . $galeri->gambar) }}', '{{ $galeri->judul ?? 'Foto Galeri' }}')">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 bg-black bg-opacity-50 rounded-lg transition-opacity">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>
                                        @if(isset($galeri) && $galeri->gambar)
                                            Ganti foto
                                        @else
                                            Upload foto
                                        @endif
                                    </span>
                                    <input id="gambar" name="gambar" type="file" accept="image/*" class="sr-only" {{ isset($galeri) ? '' : 'required' }} onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 5MB</p>
                        </div>
                    </div>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-2">
                            @if(isset($galeri) && $galeri->gambar)
                                Preview foto baru:
                            @else
                                Preview:
                            @endif
                        </p>
                        <img id="preview" src="/placeholder.svg?height=200&width=300" alt="Preview" class="h-48 w-auto object-cover rounded-lg border border-gray-300">
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Tips untuk foto yang baik:</h3>
                            <ul class="mt-2 text-sm text-blue-700 list-disc list-inside space-y-1">
                                <li>Gunakan resolusi tinggi untuk hasil terbaik</li>
                                <li>Pastikan pencahayaan cukup dan tidak blur</li>
                                <li>Foto landscape/pemandangan lebih menarik dalam rasio 16:9</li>
                                <li>Hindari foto yang terlalu gelap atau terlalu terang</li>
                                <li>Ukuran file maksimal 5MB</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('galeri.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ isset($galeri) ? 'Perbarui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4" onclick="closePreviewModal()">
    <div class="max-w-4xl max-h-full">
        <img id="previewModalImage" src="/placeholder.svg" alt="" class="max-w-full max-h-full object-contain">
        <div class="text-center mt-4">
            <h3 id="previewModalTitle" class="text-white text-lg font-medium"></h3>
            <button onclick="closePreviewModal()" class="mt-2 text-white hover:text-gray-300">
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function openPreviewModal(imageSrc, title) {
    document.getElementById('previewModalImage').src = imageSrc;
    document.getElementById('previewModalTitle').textContent = title;
    document.getElementById('previewModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePreviewModal() {
    document.getElementById('previewModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePreviewModal();
    }
});
</script>
@endsection
