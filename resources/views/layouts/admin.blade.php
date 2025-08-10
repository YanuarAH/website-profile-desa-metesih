<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - Desa Metesih</title>

    <!-- Icon  -->
    <link rel="icon" type="image" href="{{ asset('images/logo/Logo_kabupaten_madiun.gif') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen"> {{-- Ubah flex-col ke flex-row pada md ke atas --}}
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <!-- Main Content Area -->
        <div class="flex-grow flex flex-col">
            @include('partials.admin.header')
            <!-- Page Content -->
            <main class="flex-grow p-4 md:p-6 bg-gray-100"> {{-- Sesuaikan padding --}}
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const adminSidebarToggle = document.getElementById('admin-sidebar-toggle');
            const adminSidebar = document.getElementById('admin-sidebar');
            const adminSidebarOverlay = document.getElementById('admin-sidebar-overlay');
            const adminSidebarClose = document.getElementById('admin-sidebar-close');

            if (adminSidebarToggle && adminSidebar && adminSidebarOverlay && adminSidebarClose) {
                adminSidebarToggle.addEventListener('click', () => {
                    adminSidebar.classList.remove('-translate-x-full');
                    adminSidebarOverlay.classList.remove('hidden');
                });

                adminSidebarOverlay.addEventListener('click', () => {
                    adminSidebar.classList.add('-translate-x-full');
                    adminSidebarOverlay.classList.add('hidden');
                });

                adminSidebarClose.addEventListener('click', () => {
                    adminSidebar.classList.add('-translate-x-full');
                    adminSidebarOverlay.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
