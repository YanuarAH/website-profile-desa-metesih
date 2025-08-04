{{-- resources/views/partials/footer.blade.php --}}
<footer class="bg-blue-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
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
                    Website resmi Pemerintah Desa Metesih. Sumber informasi terpercaya mengenai kegiatan, layanan, dan potensi desa.
                </p>
            </div>

            <!-- Kolom 2: Tautan Cepat -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-white">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('profil-desa') }}" class="hover:text-white transition-colors">Profil Desa</a></li>
                    <li><a href="{{ route('pemerintahan-desa') }}" class="hover:text-white transition-colors">Pemerintahan</a></li>
                    <li><a href="{{ route('berita') }}" class="hover:text-white transition-colors">Berita</a></li>
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
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                        <span>kontak@metesih.desa.id</span>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Media Sosial -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-white">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/" class="text-gray-400 hover:text-white transition-colors" title="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v2.385z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/" class="text-gray-400 hover:text-white transition-colors" title="Instagram">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.584.069-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44 1.441-.645 1.441-1.44-.645-1.44-1.441-1.44z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/" class="text-gray-400 hover:text-white transition-colors" title="YouTube">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- Bagian Bawah Footer -->
        <div class="mt-8 pt-8 border-t border-blue-800 text-center text-sm">
            <p>&copy; {{ date('Y') }} Pemerintah Desa Metesih. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>
