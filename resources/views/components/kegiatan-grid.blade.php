{{--
    File: resources/views/components/_kegiatan-grid.blade.php
    Variabel yang dibutuhkan: $kegiatans (collection of Kegiatan)
--}}
@if($kegiatans && $kegiatans->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($kegiatans as $kegiatan)
            @include('components.kegiatan-card', ['kegiatan' => $kegiatan])
        @endforeach
    </div>
@else
    <div class="col-span-full text-center py-12 bg-white rounded-lg shadow-md">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/>
        </svg>
        <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Kegiatan Mendatang</h3>
        <p class="text-gray-500">Informasi kegiatan yang akan datang akan ditampilkan di sini.</p>
    </div>
@endif
