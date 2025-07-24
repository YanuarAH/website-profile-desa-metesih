<!-- @extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-semibold mb-4">Profil Desa</h1>

        @if ($profilDesa)
            <div class="mb-4">
                <p><strong>Nama Desa:</strong> {{ $profilDesa->nama_desa }}</p>
                <p><strong>Kecamatan:</strong> {{ $profilDesa->kecamatan }}</p>
                <p><strong>Kabupaten:</strong> {{ $profilDesa->kabupaten }}</p>
                <p><strong>Visi:</strong> {{ $profilDesa->visi }}</p>
                <p><strong>Misi:</strong> {{ $profilDesa->misi }}</p>
                <p><strong>Sejarah:</strong> {{ $profilDesa->sejarah }}</p>
                <p><strong>Luas Wilayah:</strong> {{ $profilDesa->luas_wilayah }}</p>
                <p><strong>Batas Wilayah:</strong> {{ $profilDesa->batas_wilayah }}</p>
                <p><strong>Jumlah Penduduk:</strong> {{ $profilDesa->jumlah_penduduk }}</p>
                <p><strong>Mata Pencaharian:</strong> {{ $profilDesa->mata_pencaharian }}</p>
            </div>

            <a href="{{ route('admin.profil-desa.edit', $profilDesa->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Edit Profil</a>
        @else
            <p>Belum ada profil desa yang dibuat.</p>
            <a href="{{ route('admin.profil-desa.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Tambah Profil</a>
        @endif
    </div>
@endsection -->
