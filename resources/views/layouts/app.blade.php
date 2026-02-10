<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Marketplace') }}</title>

    {{-- Vite / Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire Styles --}}
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased">

    {{-- NAVIGATION --}}
    @include('layouts.navigation')

    {{-- PAGE CONTENT --}}
    <main class="p-6 max-w-7xl mx-auto">

        {{-- For Livewire full-page components --}}
        {{ $slot ?? '' }}

        {{-- For Blade pages --}}
        @yield('content')

    </main>

    {{-- Livewire Scripts --}}
    @livewireScripts

</body>
</html>
