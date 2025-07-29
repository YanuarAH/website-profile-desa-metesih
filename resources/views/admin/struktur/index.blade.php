@extends('layouts.admin')

@section('title', 'Kelola Struktur Organisasi')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Struktur Organisasi Desa</h1>
                        <p class="text-sm text-gray-600 mt-1">Kelola struktur organisasi dan pejabat desa</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('struktur.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Anggota
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="px-6 py-4">
                <form method="GET" action="{{ route('struktur.index') }}" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau jabatan..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="sm:w-48">
                        <select name="sort" onchange="this.form.submit()" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="urutan_asc" {{ request('sort') == 'urutan_asc' ? 'selected' : '' }}>Urutan (1-9)</option>
                            <option value="urutan_desc" {{ request('sort') == 'urutan_desc' ? 'selected' : '' }}>Urutan (9-1)</option>
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        @if(request('search') || request('sort') != 'urutan_asc')
                        <a href="{{ route('struktur.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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

        <!-- View Toggle -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">
                    @if(request('search'))
                    Menampilkan {{ $strukturs->total() }} hasil untuk "{{ request('search') }}"
                    @else
                    Total {{ $strukturs->total() }} anggota
                    @endif
                </span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-600">Tampilan:</span>
                <div class="flex rounded-md shadow-sm" role="group">
                    <button type="button" onclick="toggleView('table')" id="tableViewBtn" class="px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                    </button>
                    <button type="button" onclick="toggleView('grid')" id="gridViewBtn" class="px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        @if ($strukturs->isEmpty())
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">
                @if(request('search'))
                Tidak ada hasil ditemukan
                @else
                Belum ada struktur organisasi
                @endif
            </h3>
            <p class="mt-2 text-sm text-gray-500">
                @if(request('search'))
                Coba ubah kata kunci pencarian atau hapus filter.
                @else
                Mulai dengan menambahkan anggota struktur organisasi desa.
                @endif
            </p>
            <div class="mt-6">
                @if(request('search'))
                <a href="{{ route('struktur.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Lihat Semua
                </a>
                @else
                <a href="{{ route('struktur.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Anggota Pertama
                </a>
                @endif
            </div>
        </div>
        @else
        <!-- Table View -->
        <div id="tableView" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama & Jabatan</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($strukturs as $struktur)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 text-sm font-medium">
                                    {{ $struktur->urutan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($struktur->foto)
                                <img src="{{ asset('storage/' . $struktur->foto) }}" alt="{{ $struktur->nama }}" class="h-12 w-12 rounded-full object-cover border-2 border-gray-200">
                                @else
                                <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $struktur->nama }}</div>
                                <div class="text-sm text-gray-500">{{ $struktur->jabatan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('struktur.edit', $struktur->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('struktur.destroy', $struktur->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $struktur->nama }} dari struktur organisasi?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Grid View -->
        <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 hidden">
            @foreach ($strukturs as $struktur)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 text-sm font-medium">
                            {{ $struktur->urutan }}
                        </span>
                        <div class="flex space-x-2">
                            <a href="{{ route('struktur.edit', $struktur->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('struktur.destroy', $struktur->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $struktur->nama }} dari struktur organisasi?');">
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
                    <div class="text-center">
                        @if ($struktur->foto)
                        <img src="{{ asset('storage/' . $struktur->foto) }}" alt="{{ $struktur->nama }}" class="mx-auto h-20 w-20 rounded-full object-cover border-2 border-gray-200 mb-4">
                        @else
                        <div class="mx-auto h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        @endif
                        <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $struktur->nama }}</h3>
                        <p class="text-sm text-gray-500">{{ $struktur->jabatan }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($strukturs->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 rounded-b-lg">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($strukturs->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-default">
                        Sebelumnya
                    </span>
                    @else
                    <a href="{{ $strukturs->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Sebelumnya
                    </a>
                    @endif

                    @if ($strukturs->hasMorePages())
                    <a href="{{ $strukturs->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
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
                            <span class="font-medium">{{ $strukturs->firstItem() }}</span>
                            sampai
                            <span class="font-medium">{{ $strukturs->lastItem() }}</span>
                            dari
                            <span class="font-medium">{{ $strukturs->total() }}</span>
                            hasil
                        </p>
                    </div>
                    <div>
                        {{ $strukturs->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif
    </div>
</div>

<script>
    function toggleView(viewType) {
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        const tableBtn = document.getElementById('tableViewBtn');
        const gridBtn = document.getElementById('gridViewBtn');

        if (viewType === 'table') {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            tableBtn.classList.add('bg-blue-100', 'text-blue-700');
            tableBtn.classList.remove('bg-white', 'text-gray-900');
            gridBtn.classList.remove('bg-blue-100', 'text-blue-700');
            gridBtn.classList.add('bg-white', 'text-gray-900');
            localStorage.setItem('strukturView', 'table');
        } else {
            tableView.classList.add('hidden');
            gridView.classList.remove('hidden');
            gridBtn.classList.add('bg-blue-100', 'text-blue-700');
            gridBtn.classList.remove('bg-white', 'text-gray-900');
            tableBtn.classList.remove('bg-blue-100', 'text-blue-700');
            tableBtn.classList.add('bg-white', 'text-gray-900');
            localStorage.setItem('strukturView', 'grid');
        }
    }

    // Load saved view preference
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('strukturView') || 'table';
        toggleView(savedView);
    });
</script>
@endsection