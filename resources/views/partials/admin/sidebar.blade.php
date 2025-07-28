<!-- Overlay untuk mobile sidebar -->
<div id="admin-sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

<!-- Sidebar -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 w-64 bg-blue-900 text-white flex flex-col z-40
              transform -translate-x-full md:relative md:translate-x-0 md:h-screen md:sticky md:top-0 transition-transform duration-300 ease-in-out">
    <div class="p-6 text-2xl font-bold border-b border-blue-800 flex justify-between items-center">
        Admin Desa
        <button id="admin-sidebar-close" class="md:hidden text-white focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <nav class="flex-grow p-4 space-y-2 overflow-y-auto"> {{-- Tambahkan overflow-y-auto --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-4 py-2 rounded-md transition-colors duration-200
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2 2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>
        <a href="{{ route('profile.index') }}" {{-- Ganti dengan route('admin.profil-desa.index') --}}
           class="flex items-center px-4 py-2 rounded-md transition-colors duration-200
           {{ request()->routeIs('profile.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V8m-2 0V6m0 0H10m0 0a2 2 0 110-4h4a2 2 0 110 4m-2 4h.01M17 13h.01M17 17h.01M17 10h.01M12 13h.01M12 17h.01M12 10h.01M5 13h.01M5 17h.01M5 10h.01" />
            </svg>
            Kelola Profil Desa
        </a>
        <a href="{{ route('berita.index') }}"
           class="flex items-center px-4 py-2 rounded-md transition-colors duration-200
           {{ request()->routeIs('berita.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-3m-2 0h3v3m-3-3l-3 3m-3 0h3v3m-3-3l-3 3m-3 0h3v3m-3-3l-3 3" />
            </svg>
            Kelola Berita
        </a>
        <a href="#"
           class="flex items-center px-4 py-2 rounded-md transition-colors duration-200
           {{ request()->routeIs('admin.perangkat-desa.*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3v6m-9-9V7a2 2 0 012-2h2m0 16h2a2 2 0 002-2v-3m-2-4h.01M17 13h.01M17 17h.01M17 10h.01M12 13h.01M12 17h.01M12 10h.01M5 13h.01M5 17h.01M5 10h.01" />
            </svg>
            Kelola Perangkat Desa
        </a>
        {{-- Tambahkan menu admin lainnya di sini --}}
    </nav>
    <div class="p-4 border-t border-blue-800">
        <form method="POST" action="{{ route('logout') }}"> {{-- Ganti dengan route logout Anda --}}
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2 rounded-md text-left transition-colors duration-200 hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>
