<!-- Bilah Atas -->
<div class="bg-blue-900 text-white text-xs py-2 px-4 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <span id="realtime-clock"></span> {{-- ID untuk skrip JavaScript --}}
    </div>
    <div class="flex items-center space-x-4">
        <a href="mailto:info@desamajujaya.id" class="hover:underline">info@desamajujaya.id</a>
        <span>|</span>
        <a href="tel:+6281234567890" class="hover:underline">+62 812-3456-7890</a>
    </div>
</div>

<!-- Header Utama -->
<header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        {{-- Ganti dengan logo desa Anda --}}
        <img src="{{ asset('images/logo/Logo_kabupaten_madiun.gif') }}" alt="Logo Desa" class="h-10 w-10">
        <div>
            <h1 class="text-lg font-bold text-blue-900">Desa Metesih</h1>
            <p class="text-sm text-gray-600">Jiwan-Madiun</p>
        </div>
    </div>
    <nav>
        <ul class="flex space-x-6 text-gray-700 font-medium items-center">
            <li>
                <a href="{{ route('home') }}"
                   class="hover:text-blue-700 pb-1
                   {{ request()->routeIs('home') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">
                    Beranda
                </a>
            </li>
            <li>
                <a href="#"
                   class="hover:text-blue-700 pb-1
                   {{ request()->routeIs('profil-desa') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">
                    Profil Desa
                </a>
            </li>
            <li>
                <a href="#" {{-- Rute baru --}}
                   class="py-2 px-1 transition-colors duration-200
                   {{ request()->routeIs('pemerintahan-desa') ? 'text-blue-700 font-bold border-b-4 border-blue-700' : 'hover:text-blue-700' }}">
                    Pemerintahan Desa
                </a>
            </li>
            <li>
                <a href="#" {{-- Ganti dengan route('layanan') jika sudah ada --}}
                   class="hover:text-blue-700 pb-1
                   {{ request()->routeIs('layanan') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">
                    Layanan
                </a>
            </li>
            <li>
                <a href="#"
                   class="hover:text-blue-700 pb-1
                   {{ request()->routeIs('berita') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">
                    Berita
                </a>
            </li>
            <li>
                <a href="#"
                   class="hover:text-blue-700 pb-1
                   {{ request()->routeIs('galeri') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">
                    Galeri
                </a>
            </li>
            <li>
                <a href="#" {{-- Ganti dengan route('kontak') jika sudah ada --}}
                   class="hover:text-blue-700 pb-1
                   {{ request()->routeIs('kontak') ? 'text-blue-700 border-b-2 border-blue-700' : '' }}">
                    Kontak
                </a>
            </li>
            {{-- Tautan Login Admin --}}
            <li>
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-sm">
                    Login Admin
                </a>
            </li>
        </ul>
    </nav>
</header>
