<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        @isset($description)<meta name="description" content="{{ $description }}">
            <x-ogp :title="$title ?? null" :description="$description"></x-ogp>
        @endisset

        <x-feed-links />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=M+PLUS+Rounded+1c:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

        @includeIf('layouts.ga')
    </head>
    <body class="font-sans antialiased bg-white dark:bg-gray-900 relative">
    @auth
        @include('layouts.navigation')
    @endauth

        <div class="min-h-screen max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-3 sm:divide-x">
            <!-- Page Content -->
            <main class="prose prose-indigo dark:prose-invert prose-md max-w-none sm:col-span-2">
                @include('layouts.header')

                {{ $slot }}
            </main>

            <aside class="sm:col-span-1">
                @include('side.side')
            </aside>
        </div>

        @include('layouts.footer')

        <div class="pcs:back-to-top">
            <a href="#" class="pcs:back-to-top-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5m-15 6l7.5-7.5 7.5 7.5" />
                </svg>
            </a>
        </div>

        @livewireScripts
    </body>
</html>
