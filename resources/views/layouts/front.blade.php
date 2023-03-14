@props(['pageTitle'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/front/app.css', 'resources/js/front/app.js'])
</head>

<body>
    <div x-data="mainState" class="font-sans antialiased" id="top" x-cloak>
        <!-- Stars rating and overlay -->
        <div id="reviews" class="modal"></div>
        <div id="overlay" class="overlay"></div>
        <a href="#top" id="btn-back-to-top" class="btn-back-to-top">
            <i class="fa-solid fa-chevron-up"></i>
        </a>

        <x-navigation />
        <x-sidebar-front />

        <main>
            {{ $slot }}
        </main>
        <x-footer-customer />
    </div>
</body>

</html>
