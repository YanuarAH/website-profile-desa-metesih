<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            Tambah Struktur Organisasi - Desa Metesih
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('struktur.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="nama" value="Nama" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jabatan" value="Jabatan" />
                            <x-text-input id="jabatan" name="jabatan" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="foto" value="Foto (opsional)" />
                            <x-text-input id="foto" name="foto" type="file" class="mt-1 block w-full" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="urutan" value="Urutan (opsional)" />
                            <x-text-input id="urutan" name="urutan" type="number" min="1" class="mt-1 block w-full" />
                            <small class="text-gray-500">Biarkan kosong untuk urutan otomatis</small>
                        </div>

                        <div class="flex justify-end mt-4">
                            <a href="{{ route('struktur.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
