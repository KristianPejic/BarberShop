<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Berik's Barbershop Dashboard</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="font-poppins antialiased">
    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 1500)" 
         class="fixed bottom-4 left-4 bg-orange-500 text-white py-2 px-4 rounded shadow-lg">
        {{ session('success') }}
    </div>
    @endif

    <div class="min-h-screen bg-gray-100">
        @include('layouts.auth-navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <x-flash />
</body>

</html>