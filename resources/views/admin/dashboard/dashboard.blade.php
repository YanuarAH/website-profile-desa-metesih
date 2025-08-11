@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-full mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 sm:p-6">
            <!-- Header Dashboard -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, Admin!</h2>
                    <p class="text-sm text-gray-600 mt-1">Ringkasan data dan aktivitas terbaru desa.</p>
                </div>
            </div>

            <!-- Statistik Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-50 rounded-lg p-4 flex items-center shadow-sm border border-blue-200">
                    <div class="flex-shrink-0 bg-blue-200 p-2 rounded-full">
                        <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-3m-2 0h3v3m-3-3l-3 3m-3 0h3v3m-3-3l-3 3m-3 0h3v3m-3-3l-3 3"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-700">Total Berita</p>
                        <p class="text-2xl font-semibold text-blue-900">{{ number_format($totalBerita) }}</p>
                    </div>
                </div>

                <div class="bg-green-50 rounded-lg p-4 flex items-center shadow-sm border border-green-200">
                    <div class="flex-shrink-0 bg-green-200 p-2 rounded-full">
                        <svg class="h-6 w-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-700">Total Kegiatan</p>
                        <p class="text-2xl font-semibold text-green-900">{{ number_format($totalKegiatan) }}</p>
                    </div>
                </div>

                <div class="bg-purple-50 rounded-lg p-4 flex items-center shadow-sm border border-purple-200">
                    <div class="flex-shrink-0 bg-purple-200 p-2 rounded-full">
                        <svg class="h-6 w-6 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-purple-700">Total Foto Galeri</p>
                        <p class="text-2xl font-semibold text-purple-900">{{ number_format($totalGaleri) }}</p>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-4 flex items-center shadow-sm border border-yellow-200">
                    <div class="flex-shrink-0 bg-yellow-200 p-2 rounded-full">
                        <svg class="h-6 w-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-yellow-700">Total Perangkat Desa</p>
                        <p class="text-2xl font-semibold text-yellow-900">{{ number_format($totalStruktur) }}</p>
                    </div>
                </div>
            </div>

            <!-- Kegiatan Mendatang -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Kegiatan Mendatang</h3>
                @if($upcomingKegiatans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kegiatan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lokasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($upcomingKegiatans as $kegiatan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 line-clamp-1">{{ $kegiatan->nama_kegiatan }}</div>
                                        <div class="text-xs text-gray-500 line-clamp-1">{{ Str::limit(strip_tags($kegiatan->deskripsi), 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $kegiatan->tanggal->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $kegiatan->waktu }} WIB</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $kegiatan->lokasi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('kegiatan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua Kegiatan</a>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <p>Tidak ada kegiatan mendatang.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
