<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Desa-Metesih', 'Desa Metesih | Website Desa') }} @yield('title')</title>

    <!-- Icon  -->
    <link rel="icon" type="image" href="{{ asset('images/logo/Logo_kabupaten_madiun.gif') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div class="flex flex-col min-h-screen">
        @include('partials.header')

        <main class="flex-grow">
            {{-- Ini adalah kontainer untuk semua konten halaman Anda --}}
            {{-- 'container' & 'mx-auto' membatasi lebar dan membuatnya ke tengah --}}
            {{-- 'py-12' & 'px-4' memberinya jarak (padding) --}}
            <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8"> {{-- Sesuaikan padding untuk responsif --}}
                @yield('content')
            </div>
        </main>

        @include('partials.footer')
    </div>

    <script>
        function updateRealtimeClock() {
            const now = new Date();
            const optionsDate = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const timeString = now.toLocaleTimeString('en-GB');
            const dateString = now.toLocaleDateString('id-ID', optionsDate);

            const clockElement = document.getElementById('realtime-clock');
            if (clockElement) {
                clockElement.textContent = `${dateString} | ${timeString} WIB`;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateRealtimeClock();
            setInterval(updateRealtimeClock, 1000);

            // Mobile Menu Toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });

                // Close menu if clicked outside (optional, but good UX)
                document.addEventListener('click', (event) => {
                    if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>
