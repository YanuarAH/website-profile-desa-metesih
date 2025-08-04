@extends('layouts.app')

@section('title', '- Pemerintahan Desa')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white rounded-lg mb-8 p-8 md:p-12 shadow-lg">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Pemerintahan Desa Metesih</h1>
            <p class="text-xl opacity-90">Struktur Organisasi dan Perangkat Desa</p>
        </div>
    </div>

    <!-- Informasi Kantor -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4z" clip-rule="evenodd"/></svg>
                    Kantor Desa
                </h2>
                <div class="space-y-3 text-gray-600">
                    <div class="flex items-start"><svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg><span>Jl. Jend. A. Yani, Gendu, Metesih, Kec. Jiwan, Kabupaten Madiun, Jawa Timur 63161</span></div>
                    <div class="flex items-center"><svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg><span>+62 812-3456-7890</span></div>
                    <div class="flex items-center"><svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg><span>info@desametesih.id</span></div>
                </div>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Jam Pelayanan</h3>
                <div class="bg-gray-50 rounded-lg p-4"><div class="space-y-2 text-gray-600"><div class="flex justify-between"><span>Senin - Jumat</span><span class="font-medium">08:00 - 15:00</span></div><div class="flex justify-between"><span>Sabtu</span><span class="font-medium">08:00 - 12:00</span></div><div class="flex justify-between"><span>Minggu</span><span class="font-medium text-red-600">Tutup</span></div></div></div>
            </div>
        </div>
    </div>

    <!-- Struktur Organisasi -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3v6m-9-9V7a2 2 0 012-2h2m0 16h2a2 2 0 002-2v-3m-2-4h.01M17 13h.01M17 17h.01M17 10h.01M12 13h.01M12 17h.01M12 10h.01M5 13h.01M5 17h.01M5 10h.01" />
            </svg>
            Struktur Organisasi Pemerintah Desa
        </h2>

        @if($kepalaDesa)
            <!-- Kepala Desa -->
            <div class="text-center mb-10">
                <div class="inline-block bg-blue-50 rounded-lg p-6 border-2 border-blue-200 shadow-md">
                    @if($kepalaDesa->foto)
                        <img src="{{ asset('storage/' . $kepalaDesa->foto) }}" alt="{{ $kepalaDesa->nama }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-blue-300">
                    @else
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 bg-blue-200 flex items-center justify-center border-4 border-blue-300"><svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></div>
                    @endif
                    <h3 class="text-xl font-bold text-blue-800">{{ $kepalaDesa->nama }}</h3>
                    <p class="text-blue-600 font-medium">{{ $kepalaDesa->jabatan }}</p>
                </div>
            </div>
        @endif

        @if($sekretaris)
            <!-- Sekretaris Desa -->
            <div class="text-center mb-10">
                <div class="inline-block bg-green-50 rounded-lg p-5 border-2 border-green-200 shadow-md">
                    @if($sekretaris->foto)
                        <img src="{{ asset('storage/' . $sekretaris->foto) }}" alt="{{ $sekretaris->nama }}" class="w-20 h-20 rounded-full mx-auto mb-3 object-cover border-3 border-green-300">
                    @else
                        <div class="w-20 h-20 rounded-full mx-auto mb-3 bg-green-200 flex items-center justify-center border-3 border-green-300"><svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></div>
                    @endif
                    <h4 class="text-lg font-bold text-green-800">{{ $sekretaris->nama }}</h4>
                    <p class="text-green-600 font-medium">{{ $sekretaris->jabatan }}</p>
                </div>
            </div>
        @endif

        @if($kaur && $kaur->count() > 0)
            <!-- Kepala Urusan (Kaur) -->
            <div class="mb-10">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">Kepala Urusan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($kaur as $person)
                    <div class="bg-purple-50 rounded-lg p-4 text-center border border-purple-200 shadow-sm">
                        @if($person->foto)
                            <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}" class="w-16 h-16 rounded-full mx-auto mb-3 object-cover border-2 border-purple-300">
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 bg-purple-200 flex items-center justify-center border-2 border-purple-300"><svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></div>
                        @endif
                        <h4 class="font-semibold text-purple-800">{{ $person->nama }}</h4>
                        <p class="text-purple-600 text-sm">{{ $person->jabatan }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($kasi && $kasi->count() > 0)
            <!-- Kepala Seksi (Kasi) -->
            <div class="mb-10">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">Kepala Seksi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($kasi as $person)
                    <div class="bg-orange-50 rounded-lg p-4 text-center border border-orange-200 shadow-sm">
                        @if($person->foto)
                            <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}" class="w-16 h-16 rounded-full mx-auto mb-3 object-cover border-2 border-orange-300">
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 bg-orange-200 flex items-center justify-center border-2 border-orange-300"><svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></div>
                        @endif
                        <h4 class="font-semibold text-orange-800">{{ $person->nama }}</h4>
                        <p class="text-orange-600 text-sm">{{ $person->jabatan }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($kadus && $kadus->count() > 0)
            <!-- Kepala Dusun (Kadus) -->
            <div class="mb-10">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">Kepala Dusun</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($kadus as $person)
                    <div class="bg-teal-50 rounded-lg p-4 text-center border border-teal-200 shadow-sm">
                        @if($person->foto)
                            <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}" class="w-16 h-16 rounded-full mx-auto mb-3 object-cover border-2 border-teal-300">
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 bg-teal-200 flex items-center justify-center border-2 border-teal-300"><svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></div>
                        @endif
                        <h4 class="font-semibold text-teal-800">{{ $person->nama }}</h4>
                        <p class="text-teal-600 text-sm">{{ $person->jabatan }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($lainnya && $lainnya->count() > 0)
            <!-- Perangkat Lainnya -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">Perangkat Desa Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($lainnya as $person)
                    <div class="bg-gray-100 rounded-lg p-4 text-center border border-gray-200 shadow-sm">
                        @if($person->foto)
                            <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}" class="w-16 h-16 rounded-full mx-auto mb-3 object-cover border-2 border-gray-300">
                        @else
                            <div class="w-16 h-16 rounded-full mx-auto mb-3 bg-gray-200 flex items-center justify-center border-2 border-gray-300"><svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg></div>
                        @endif
                        <h4 class="font-semibold text-gray-800">{{ $person->nama }}</h4>
                        <p class="text-gray-600 text-sm">{{ $person->jabatan }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if(!$kepalaDesa && !$sekretaris && $kaur->isEmpty() && $kasi->isEmpty() && $kadus->isEmpty() && $lainnya->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                <p class="text-gray-500 text-lg">Data struktur organisasi belum tersedia.</p>
            </div>
        @endif
    </div>
</div>
@endsection
