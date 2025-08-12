{{-- resources/views/partials/footer.blade.php --}}
<footer class="bg-blue-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Kolom 1: Tentang Desa -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo/Logo_kabupaten_madiun.gif') }}" alt="Logo Desa" class="h-12 w-auto p-1 rounded-md">
                    <div>
                        <h3 class="text-lg font-bold text-white">Desa Metesih</h3>
                        <p class="text-sm text-gray-400">Kec. Jiwan, Kab. Madiun</p>
                    </div>
                </div>
                <p class="text-sm">
                    Website resmi Pemerintah Desa Metesih. Sumber informasi terpercaya mengenai kegiatan, berita, dan pemerintahan desa.
                </p>
            </div>

            <!-- Kolom 2: Tautan Cepat -->
            <div class="space-y-4 lg:pl-20">
                <h4 class="text-lg font-semibold text-white">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('profil-desa') }}" class="hover:text-white transition-colors">Profil Desa</a></li>
                    <li><a href="{{ route('pemerintahan-desa') }}" class="hover:text-white transition-colors">Pemerintahan</a></li>
                    <li><a href="{{ route('berita') }}" class="hover:text-white transition-colors">Berita</a></li>
                    <li><a href="{{ route('kegiatan') }}" class="hover:text-white transition-colors">Agenda Kegiatan</a></li>
                    <li><a href="{{ route('galeri-desa') }}" class="hover:text-white transition-colors">Galeri</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Hubungi Kami -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-white">Hubungi Kami</h4>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        <span>Jl. Jend. A. Yani, Gendu, Metesih, Kec. Jiwan, Kab. Madiun, Jawa Timur 63161</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                        <span>(0351) 123-456</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bagian Bawah Footer -->
        <div class="mt-8 pt-8 border-t border-blue-800 text-center text-sm">
            <p>&copy; {{ date('Y') }} Pemerintah Desa Metesih. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>
