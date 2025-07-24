<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Desa Maju Jaya') }} @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div class="flex flex-col min-h-screen">
        @include('partials.header')

        <main class="flex-grow py-12">
            @yield('content')
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
            // Mengatur locale ke 'en-GB' agar format waktu menjadi 24-jam (misal: 20:05:49)
            // dan menghilangkan titik pemisah default dari 'id-ID'
            const timeString = now.toLocaleTimeString('en-GB');
            const dateString = now.toLocaleDateString('id-ID', optionsDate);

            const clockElement = document.getElementById('realtime-clock');
            if (clockElement) {
                // Menambahkan format waktu yang lebih umum
                clockElement.textContent = `${dateString} | ${timeString} WIB`;
            }
        }

        document.addEventListener('DOMContentLoaded', updateRealtimeClock);
        setInterval(updateRealtimeClock, 1000);
    </script>
</body>

</html>