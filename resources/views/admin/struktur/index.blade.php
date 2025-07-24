<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            Kelola Struktur Organisasi - Desa Metesih
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <a href="{{ route('struktur.create') }}">
                        <x-primary-button>Tambah Anggota</x-primary-button>
                    </a>

                    <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                        <table class="w-full text-left table-auto">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2">Foto</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Jabatan</th>
                                    <th class="px-4 py-2">Urutan</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $struktur)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">
                                            @if($struktur->foto)
                                                <img src="{{ asset('storage/' . $struktur->foto) }}" alt="Foto" class="w-16 h-16 object-cover rounded-full">
                                            @else
                                                <span class="text-gray-400 italic">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">{{ $struktur->nama }}</td>
                                        <td class="px-4 py-2">{{ $struktur->jabatan }}</td>
                                        <td class="px-4 py-2">{{ $struktur->urutan }}</td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <a href="{{ route('struktur.edit', $struktur->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                            <form action="{{ route('struktur.destroy', $struktur->id) }}" method="POST" onsubmit="return confirm('Yakin hapus anggota ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
