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
    <body class="font-sans antialiased">
        @php($isStudent = auth()->check() && auth()->user()->role === 'student')
        @php($isAdmin = auth()->check() && auth()->user()->role === 'admin')

        @if ($isStudent || $isAdmin)
            <div class="student-shell">
                @if ($isStudent)
                    @include('layouts.student-sidebar')
                @else
                    @include('layouts.admin-sidebar')
                @endif

                <div class="student-main-area">
                    @isset($header)
                        <header class="student-page-header">
                            {{ $header }}
                        </header>
                    @endisset

                    <main class="student-page-main">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        @else
            <div class="min-h-screen bg-gray-100">
                @include('layouts.navigation')

                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>
        @endif

        <div id="confirm-modal" class="confirm-modal" aria-hidden="true">
            <div class="confirm-modal__backdrop" data-confirm-backdrop></div>
            <div class="confirm-modal__panel" role="dialog" aria-modal="true" aria-labelledby="confirm-modal-title">
                <h3 id="confirm-modal-title" class="confirm-modal__title" data-confirm-title>Please Confirm</h3>
                <p class="confirm-modal__message" data-confirm-message>Are you sure you want to continue?</p>
                <div class="confirm-modal__actions">
                    <button type="button" class="confirm-modal__btn confirm-modal__btn--cancel" data-confirm-cancel>Cancel</button>
                    <button type="button" class="confirm-modal__btn confirm-modal__btn--ok" data-confirm-ok>Confirm</button>
                </div>
            </div>
        </div>
    </body>
</html>
