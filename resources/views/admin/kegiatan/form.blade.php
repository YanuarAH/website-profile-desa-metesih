@extends('layouts.admin')

@section('title', $kegiatan->id ? 'Edit Kegiatan' : 'Tambah Kegiatan Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 sm:p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $kegiatan->id ? 'Edit Kegiatan' : 'Tambah Kegiatan Baru' }}
                    </h2>
                    @if($kegiatan->id)
                        <p class="text-sm text-gray-600 mt-1">{{ $kegiatan->nama_kegiatan }}</p>
                    @endif
                </div>
                <a href="{{ route('kegiatan.index') }}"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6" role="alert">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <strong class="font-semibold">Ada beberapa masalah dengan input Anda:</strong>
                </div>
                <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                        @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ $kegiatan->id ? route('kegiatan.update', $kegiatan->id) : route('kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if ($kegiatan->id)
                @method('PUT') {{-- Penting untuk metode UPDATE --}}
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <!-- nama kegiatan -->
                        <div>
                            <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}"
                            class="bblock w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama_kegiatan') border-red-300 @enderror"
                            placeholder="Masukkan nama_kegiatan kegiatan..."
                            required>
                            @error('nama_kegiatan')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Tanggal kegiatan -->
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal kegiatan</label>
                            <input type="date" name="tanggal" id="tanggal_publikasi" value="{{ old('tanggal', $kegiatan->tanggal) }}" min="{{ date('Y-m-d') }}"
                                class="relative block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('tanggal') border-red-300 @enderror"
                                required>
                                @error('tanggal')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Tanggal ketika kegiatan ini terjadi atau dipublikasikan</p>
                        </div>

                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Kegiatan</label>
                            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}"
                            class="bblock w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama_kegiatan') border-red-300 @enderror"
                            placeholder="Masukkan lokasi kegiatan..."
                            required>
                            @error('lokasi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi kegiatan</label>
                            <textarea name="deskripsi" id="deskripsi" rows="10"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('deskripsi') border-red-300 @enderror"
                                placeholder="Tulis deskripsi kegiatan di sini...">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-3">Gambar kegiatan</label>

                            @if ($kegiatan->gambar)
                            <div class="mb-4">
                                <p class="text-xs text-gray-600 mb-2">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="Gambar Saat Ini" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                            </div>
                            @endif

                            <input type="file" name="gambar" id="gambar"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('gambar') border-red-300 @enderror">

                            <div class="mt-3">
                                <img id="preview-image" class="w-full max-h-64 object-cover rounded-lg border border-gray-300 hidden">
                            </div>

                            <input type="hidden" name="cropped_image" id="cropped-image">
                            @error('gambar')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB. Rasio 16:9 direkomendasikan.</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="space-y-3">
                                <a href="{{ route('kegiatan.index') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Batal
                                </a>
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ $kegiatan->id ? 'Perbarui kegiatan' : 'Simpan kegiatan' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });
    });
</script>

<script>
    let cropper;
    const imageInput = document.getElementById('gambar');
    const previewImage = document.getElementById('preview-image');
    const croppedInput = document.getElementById('cropped-image');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImage.src = event.target.result;
                previewImage.classList.remove('hidden');

                if (cropper) cropper.destroy();

                cropper = new Cropper(previewImage, {
                    aspectRatio: 16 / 9,
                    viewMode: 1,
                    autoCropArea: 1,
                    cropend() {
                        const canvas = cropper.getCroppedCanvas();
                        croppedInput.value = canvas.toDataURL('image/jpeg');
                    }
                });

                // Simpan hasil crop awal
                reader.onloadend = () => {
                    setTimeout(() => {
                        const canvas = cropper.getCroppedCanvas();
                        croppedInput.value = canvas.toDataURL('image/jpeg');
                    }, 500);
                };
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
        // Enhanced date picker functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('tanggal_publikasi');

            if (dateInput) {
                // Make the entire input clickable
                dateInput.addEventListener('click', function() {
                    this.showPicker();
                });

                // Also trigger on focus
                dateInput.addEventListener('focus', function() {
                    this.showPicker();
                });

                // Set default date to today if empty
                if (!dateInput.value) {
                    const today = new Date();
                    const formattedDate = today.getFullYear() + '-' +
                                        String(today.getMonth() + 1).padStart(2, '0') + '-' +
                                        String(today.getDate()).padStart(2, '0');
                    dateInput.value = formattedDate;
                }
            }
        });
    </script>

<!-- Cropper.js CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
@endsection
