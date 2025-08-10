@extends('layouts.admin')

@section('title', isset($struktur) ? 'Edit Struktur Organisasi' : 'Tambah Struktur Organisasi')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ isset($struktur) ? 'Edit Struktur Organisasi' : 'Tambah Struktur Organisasi' }}
                        </h1>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ isset($struktur) ? 'Perbarui informasi anggota struktur organisasi' : 'Tambahkan anggota baru ke struktur organisasi desa' }}
                        </p>
                    </div>
                    <a href="{{ route('struktur.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <form action="{{ isset($struktur) ? route('struktur.update', ['struktur' => $struktur]) : route('struktur.store') }}"
                method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @if(isset($struktur))
                @method('PUT')
                @endif

                {{-- Nama --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama"
                        value="{{ old('nama', isset($struktur) ? $struktur->nama : '') }}"
                        required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-300 @enderror">
                    @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jabatan --}}
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                        Jabatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="jabatan" id="jabatan"
                        value="{{ old('jabatan', isset($struktur) ? $struktur->jabatan : '') }}"
                        required
                        placeholder="Contoh: Kepala Desa, Sekretaris Desa, Kepala Seksi Pemerintahan"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('jabatan') border-red-300 @enderror">
                    @error('jabatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Urutan --}}
                <div>
                    <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                        Urutan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="urutan" id="urutan"
                        value="{{ old('urutan', isset($struktur) ? $struktur->urutan : '') }}"
                        required min="1"
                        placeholder="Masukkan urutan jabatan (1 = tertinggi)"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('urutan') border-red-300 @enderror">
                    @error('urutan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="mt-2 p-3 bg-blue-50 border border-blue-200 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    <strong>Tips Urutan:</strong> Beberapa jabatan bisa memiliki urutan yang sama jika setara.
                                </p>
                                <ul class="mt-2 text-sm text-blue-600 list-disc list-inside">
                                    <li>Urutan 1: Kepala Desa</li>
                                    <li>Urutan 2: Sekretaris Desa</li>
                                    <li>Urutan 3: Bendahara, Kepala Seksi (bisa sama)</li>
                                    <li>Urutan 4: Staf dan lainnya</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Foto --}}
                <div>
                    <label for="foto_original" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto
                    </label>

                    {{-- Current Photo (only show in edit mode) --}}
                    @if(isset($struktur) && $struktur->foto)
                    <div class="mb-4" id="current-image-container">
                        <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $struktur->foto) }}"
                            alt="{{ $struktur->nama }}"
                            class="h-32 w-32 object-cover rounded-lg border border-gray-300"
                            id="current-image-display">
                    </div>
                    @endif

                    {{-- Simplified file input --}}
                    <input type="file" name="foto_original" id="foto_original"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('foto_original') border-red-300 @enderror">

                    {{-- Image Cropper Preview Area (hidden by default) --}}
                    <div id="imageCropperArea" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-2">Preview & Sesuaikan Posisi:</p>
                        <div class="w-full max-w-md mx-auto border border-gray-300 rounded-lg overflow-hidden">
                            <img id="preview-image" src="/placeholder.svg" alt="Preview" class="w-full h-auto max-h-64 object-contain">
                        </div>
                    </div>

                    <input type="hidden" id="cropped-image" name="foto_cropped">
                    @error('foto_original')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB. Rasio 1:1 direkomendasikan.</p>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('struktur.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ isset($struktur) ? 'Perbarui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />
<script>
    let cropper;
    const imageInput = document.getElementById('foto_original'); // ID input file Anda
    const previewImage = document.getElementById('preview-image');
    const croppedInput = document.getElementById('cropped-image');
    const imageCropperArea = document.getElementById('imageCropperArea');
    const currentImageContainer = document.getElementById('current-image-container');

    // Function to initialize Cropper
    function initCropper(imageSrc) {
        // Destroy existing Cropper instance if any
        if (cropper) {
            cropper.destroy();
        }

        // Set the image source for the preview
        previewImage.src = imageSrc;
        // Ensure the image element is visible before initializing Cropper
        previewImage.classList.remove('hidden');
        imageCropperArea.classList.remove('hidden'); // Show the cropper container

        cropper = new Cropper(previewImage, {
            aspectRatio: 1 / 1, // Rasio aspek 1:1 (persegi) untuk foto profil
            viewMode: 1, // Batasi area crop agar tidak melebihi kanvas
            autoCropArea: 1, // Area crop awal mencakup seluruh gambar
            movable: true, // Izinkan gambar digerakkan di dalam area crop
            zoomable: true, // Izinkan gambar di-zoom
            rotatable: false, // Nonaktifkan rotasi jika tidak diperlukan
            scalable: true, // Izinkan gambar diskalakan
            cropend() {
                // This event fires when the crop box is moved or resized
                const canvas = cropper.getCroppedCanvas();
                if (canvas) {
                    croppedInput.value = canvas.toDataURL('image/jpeg', 0.9); // Simpan sebagai JPEG dengan kualitas 90%
                }
            },
            ready() {
                // This event fires when the cropper is ready
                // Perform initial crop to fill the hidden input
                const canvas = cropper.getCroppedCanvas();
                if (canvas) {
                    croppedInput.value = canvas.toDataURL('image/jpeg', 0.9);
                }
            }
        });
    }

    // Event listener for file input change
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Hide current image display if present
                if (currentImageContainer) {
                    currentImageContainer.classList.add('hidden');
                }
                initCropper(event.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            // If no file or invalid file type, hide cropper area and clear input
            if (cropper) {
                cropper.destroy();
            }
            previewImage.src = '';
            previewImage.classList.add('hidden');
            imageCropperArea.classList.add('hidden');
            croppedInput.value = '';
            // Show current image container again if it was hidden
            if (currentImageContainer) {
                currentImageContainer.classList.remove('hidden');
            }
        }
    });

    // Initialize Cropper with existing image on page load (edit mode)
    document.addEventListener('DOMContentLoaded', function() {
        const existingImageSrc = "{{ isset($struktur) && $struktur->foto ? asset('storage/' . $struktur->foto) : '' }}";
        if (existingImageSrc) {
            // Hide current image display immediately
            if (currentImageContainer) {
                currentImageContainer.classList.add('hidden');
            }

            // Create a new Image object to ensure it's fully loaded before setting previewImage.src
            const img = new Image();
            img.crossOrigin = "anonymous"; // Important for canvas operations if image is from different origin
            img.onload = () => {
                // Once the image is loaded, set it to the preview element and initialize Cropper
                initCropper(existingImageSrc); // Initialize cropper with the loaded image
            };
            img.onerror = () => {
                console.error('Failed to load existing image for cropping:', existingImageSrc);
                // Fallback if existing image fails to load
                if (currentImageContainer) {
                    currentImageContainer.classList.remove('hidden'); // Show original container if image fails
                }
                imageCropperArea.classList.add('hidden'); // Hide cropper area
                previewImage.classList.add('hidden'); // Hide preview image
                croppedInput.value = ''; // Clear cropped data
            };
            img.src = existingImageSrc; // Start loading the image
        } else {
            // If no existing image, ensure cropper area and preview are hidden by default
            imageCropperArea.classList.add('hidden');
            previewImage.classList.add('hidden');
        }
    });
</script>
@endsection
