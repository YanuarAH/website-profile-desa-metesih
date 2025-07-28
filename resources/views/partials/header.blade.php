<!-- Bilah Atas -->
<div class="bg-blue-900 text-white text-xs py-2 px-4 flex flex-col sm:flex-row justify-between items-center sm:space-x-4">
    <div class="flex items-center space-x-4 mb-2 sm:mb-0">
        <span id="realtime-clock"></span> {{-- ID untuk skrip JavaScript --}}
    </div>
    <div class="flex items-center space-x-4">
        <a href="mailto:info@desamajujaya.id" class="hover:underline">info@desamajujaya.id</a>
        <span class="hidden sm:inline">|</span>
        <a href="tel:+6281234567890" class="hover:underline">+62 812-3456-7890</a>
    </div>
</div>

<!-- Header Utama -->
<header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center relative z-20 sticky top-0">
    <a href="{{ route('home') }}" class="flex items-center space-x-4">
        {{-- Ganti dengan logo desa Anda --}}
        <img src="{{ asset('images/logo/Logo_kabupaten_madiun.gif') }}" alt="Logo Desa" class="h-10 w-10">
        <div>
            <h1 class="text-lg font-bold text-blue-900">Desa Maju Jaya</h1>
            <p class="text-sm text-gray-600">Pemerintah Desa</p>
        </div>
    </a>

    {{-- Tombol Hamburger untuk Mobile --}}
    <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    {{-- Navigasi Desktop --}}
    <nav class="hidden md:block">
        <ul class="flex space-x-6 text-gray-700 font-medium items-center">
            <li>
                <a href="{{ route('home') }}"
                   class="py-2 px-1 transition-colors duration-200
                   {{ request()->routeIs('home') ? 'text-blue-700 font-bold border-b-4 border-blue-700' : 'hover:text-blue-700' }}">
                    Beranda
                </a>
            </li>
            <li>
                <a href="#"
                   class="py-2 px-1 transition-colors duration-200
                   {{ request()->routeIs('profil-desa') ? 'text-blue-700 font-bold border-b-4 border-blue-700' : 'hover:text-blue-700' }}">
                    Profil Desa
                </a>
            </li>
            <li>
                <a href="#"
                   class="py-2 px-1 transition-colors duration-200
                   {{ request()->routeIs('pemerintahan-desa') ? 'text-blue-700 font-bold border-b-4 border-blue-700' : 'hover:text-blue-700' }}">
                    Pemerintahan Desa
                </a>
            </li>
            <li>
                <a href="#"
                   class="py-2 px-1 transition-colors duration-200
                   {{ request()->routeIs('layanan') ? 'text-blue-700 font-bold border-b-4 border-blue-700' : 'hover:text-blue-700' }}">
                    Layanan
                </a>
            </li>
            <li>
                <a href="{{ route('berita') }}"
                   class="py-2 px-1 transition-colors duration-200
                   {{ request()->routeIs('berita') ? 'text-blue-700 font-bold border-b-4 border-blue-700' : 'hover:text-blue-700' }}">
                    Berita
                </a>
            </li>
            <li>
                <a href="#"
                   class="py-2 px-1 transition-colors duration-200
                   {{ request()->routeIs('galeri') ? 'text-blue-700 font-bold border-b-4 border-blue-700' : 'hover:text-blue-700' }}">
                    Galeri
                </a>
            </li>
            <li>
                <a href="#"
                   class="py-2 px-1 transition-colors duration-200
                   {{ request()->routeIs('kontak') ? 'text-blue-700 font-bold border-b-4 border-blue-700' : 'hover:text-blue-700' }}">
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

    {{-- Navigasi Mobile (Hidden by default, shown by JS) --}}
    <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-white shadow-lg py-4 z-10">
        <ul class="flex flex-col space-y-4 text-gray-700 font-medium px-6">
            <li><a href="{{ route('home') }}" class="block py-2 hover:text-blue-700">Beranda</a></li>
            <li><a href="#" class="block py-2 hover:text-blue-700">Profil Desa</a></li>
            <li><a href="#" class="block py-2 hover:text-blue-700">Pemerintahan Desa</a></li>
            <li><a href="#" class="block py-2 hover:text-blue-700">Layanan</a></li>
            <li><a href="#" class="block py-2 hover:text-blue-700">Berita</a></li>
            <li><a href="#" class="block py-2 hover:text-blue-700">Galeri</a></li>
            <li><a href="#" class="block py-2 hover:text-blue-700">Kontak</a></li>
            <li><a href="{{ route('login') }}" class="block py-2 bg-blue-600 text-white text-center rounded-md hover:bg-blue-700">Login Admin</a></li>
        </ul>
    </div>
</header>
