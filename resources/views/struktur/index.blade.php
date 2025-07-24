<x-guest-layout>
    <div class="py-8">
        <h2 class="text-2xl font-bold text-center mb-6">Struktur Organisasi</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
            @foreach ($data as $item)
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    @if ($item->foto && file_exists(public_path('storage/' . $item->foto)))
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="mx-auto mb-4 w-48 h-48 object-cover rounded-full">
                    @else
                        <img src="{{ asset('images/default.png') }}" alt="Default" class="mx-auto mb-4 w-48 h-48 object-cover rounded-full">
                    @endif
                    <h3 class="text-lg font-semibold">{{ $item->nama }}</h3>
                    <p class="text-gray-500">{{ $item->jabatan }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
