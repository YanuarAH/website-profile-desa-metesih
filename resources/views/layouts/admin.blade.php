<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - Desa Maju Jaya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Admin Header Bar (Opsional, bisa disederhanakan) -->
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Halo, Admin!</span>
                    {{-- Anda bisa menambahkan dropdown profil admin di sini --}}
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-gray-100">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
