@extends('layouts.admin')

@section('title', $berita->id ? 'Edit Berita' : 'Tambah Berita Baru')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        {{ $berita->id ? 'Edit Berita: ' . $berita->judul : 'Tambah Berita Baru' }}
    </h2>

    {{-- Tampilkan pesan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $berita->id ? route('berita.update', $berita->id) : route('berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($berita->id)
            @method('PUT') {{-- Penting untuk metode UPDATE --}}
        @endif

        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   required>
            @error('judul')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="konten" class="block text-sm font-medium text-gray-700 mb-1">Isi Berita</label>
            <textarea name="konten" id="konten" rows="10"
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                      >{{ old('konten', $berita->konten) }}</textarea>
            @error('konten')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar Berita (Opsional)</label>
            @if ($berita->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Saat Ini" class="w-32 h-32 object-cover rounded-md border border-gray-200">
                    <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                </div>
            @endif
            <input type="file" name="gambar" id="gambar"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('gambar')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('berita.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ $berita->id ? 'Perbarui Berita' : 'Simpan Berita' }}
            </button>
        </div>
    </form>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#konten'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
