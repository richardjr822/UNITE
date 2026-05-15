<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UNITE') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased" style="background:
        radial-gradient(circle at 15% 20%, rgba(122, 201, 164, 0.34) 0 24%, transparent 25%),
        radial-gradient(circle at 85% 78%, rgba(98, 190, 145, 0.28) 0 20%, transparent 21%),
        linear-gradient(145deg, #eaf5ef 0%, #ddefe6 45%, #d2e8de 100%);">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-8">
            <div class="mb-4 text-center">
                <a href="/" class="inline-flex items-center gap-2 text-[#173029] no-underline">
                    <span style="width: 26px; height: 26px; border-radius: 8px; background: linear-gradient(135deg, #66c596 0%, #2f9b74 100%);"></span>
                    <span class="text-2xl font-extrabold tracking-tight">UNITE</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-6 bg-[#f6f9f7] border border-[#d6e4de] shadow-lg overflow-hidden rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
