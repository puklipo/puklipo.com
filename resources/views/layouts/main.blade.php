<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <x-feed-links />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-white dark:bg-gray-900">
    @auth
        @include('layouts.navigation')
    @endauth

        <div class="min-h-screen p-6 mx-auto grid grid-cols-1 sm:grid-cols-3 gap-2">
            <!-- Page Content -->
            <main class="prose prose-indigo dark:prose-invert prose-md sm:col-span-2">
                @include('layouts.header')

                {{ $slot }}
            </main>

            <aside class="sm:col-span-1">
                @include('side.side')
            </aside>
        </div>

        @livewireScripts
    </body>
</html>
