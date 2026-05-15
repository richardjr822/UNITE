<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UNITE — School Event Management System</title>

    <!-- Inter font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen flex items-center justify-center px-4 py-10 relative"
      style="font-family: 'Inter', sans-serif;
             background-image: url('{{ asset('app-bg.jpg') }}');
             background-size: cover;
             background-position: center;
             background-repeat: no-repeat;">

    {{-- Dark teal overlay over background photo --}}
    <div class="absolute inset-0 backdrop-blur-sm"
         style="background: linear-gradient(135deg, rgba(10,40,35,0.92) 0%, rgba(31,111,95,0.80) 100%);"></div>

    {{-- 2-column auth card — floats above overlay --}}
    <div class="relative z-10 w-full max-w-4xl mx-auto rounded-2xl shadow-2xl overflow-hidden">
        @yield('content')
    </div>

    @livewireScripts
</body>
</html>
