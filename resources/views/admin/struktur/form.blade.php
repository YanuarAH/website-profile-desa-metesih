@extends('layouts.admin')

@section('title', isset($struktur) ? 'Edit Struktur Organisasi' : 'Tambah Struktur Organisasi')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
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

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <form action="{{ isset($struktur) ? route('struktur.update', ['struktur' => $struktur]) : route('struktur.store') }}"
                method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @if(isset($struktur))
                @method('PUT')
                @endif

                <!-- Nama -->
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

                <!-- Jabatan -->
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

                <!-- Urutan -->
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

                <!-- Foto -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto
                    </label>

                    <!-- Current Photo (only show in edit mode) -->
                    @if(isset($struktur) && $struktur->foto)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $struktur->foto) }}"
                            alt="{{ $struktur->nama }}"
                            class="h-32 w-32 object-cover rounded-lg border border-gray-300">
                    </div>
                    @endif

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>
                                        @if(isset($struktur) && $struktur->foto)
                                        Ganti foto
                                        @else
                                        Upload foto
                                        @endif
                                    </span>
                                    <input id="foto" name="foto" type="file" accept="image/*" class="sr-only" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                        </div>
                    </div>
                    @error('foto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-2">
                            @if(isset($struktur) && $struktur->foto)
                            Preview foto baru:
                            @else
                            Preview:
                            @endif
                        </p>
                        <img id="preview" src="/placeholder.svg?height=128&width=128" alt="Preview" class="h-32 w-32 object-cover rounded-lg border border-gray-300">
                    </div>
                </div>

                <!-- Submit Buttons -->
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
</script>
@endsection