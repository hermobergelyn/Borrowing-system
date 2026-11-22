<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'School Sports Equipment Borrowing Logbook System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-purple-50/40 text-slate-800 selection:bg-purple-200 selection:text-purple-950">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Sidebar Navigation -->
        @include('layouts.navigation')

        <!-- Right Main Content Area -->
        <div class="flex-1 min-w-0 flex flex-col bg-gradient-to-b from-purple-50/60 via-white to-white">
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>