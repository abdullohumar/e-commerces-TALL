<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles
    </head>
    <body class="antialiased font-brand h-screen overflow-hidden flex">
        <livewire:sidebar-admin/>
        <main class="flex-1 overflow-y-auto bg-gray-900 text-white">
            {{ $slot }}
        </main>

        @livewireScripts
    </body>
</html>
