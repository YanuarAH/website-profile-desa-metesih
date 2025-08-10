 <!-- Admin Header Bar -->
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center z-20 sticky top-0">
                <div class="flex items-center">
                    {{-- Tombol Hamburger untuk Sidebar Mobile --}}
                    <button id="admin-sidebar-toggle" class="md:hidden text-gray-700 focus:outline-none mr-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                </div>
            </header>