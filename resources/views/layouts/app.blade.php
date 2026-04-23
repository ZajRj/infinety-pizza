<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Infinitey Pizza | Fresh, Artisanal, Delivered')</title>
    <meta name="description" content="The best artisanal pizzas in town, delivered fresh to your door. Explore our menu and customize your perfect pie.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Epilogue:wght@700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased font-body bg-white text-gray-800">

    <x-navigation />

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <x-footer />

    @livewireScripts
</body>
</html>
