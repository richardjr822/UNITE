@extends('layouts.guest')

@section('content')

{{-- 2-column grid: left = brand panel, right = form --}}
<div class="grid grid-cols-1 md:grid-cols-2">

    {{-- ── LEFT: Brand / info panel ─────────────────────────────────────── --}}
    <div class="hidden md:flex flex-col justify-center bg-[#2FA084] p-10 gap-0">

        {{-- App name --}}
        <h1 class="text-6xl font-black text-white tracking-widest leading-none">UNITE</h1>

        {{-- Mint accent divider --}}
        <div class="w-16 h-1 bg-[#6FCF97] rounded my-5"></div>

        {{-- Full tagline --}}
        <p class="text-white text-lg font-medium leading-snug">
            School Event Management System
        </p>

        {{-- Short description --}}
        <p class="text-[#6FCF97] text-sm mt-2 leading-relaxed">
            A centralized platform for managing and joining school events.
        </p>

        {{-- Feature bullet points --}}
        <ul class="mt-8 space-y-3">
            @foreach ([
                'Browse upcoming school events',
                'Register with one click',
                'Admins manage everything in one place',
            ] as $point)
                <li class="flex items-start gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#6FCF97] mt-1.5 shrink-0"></span>
                    <span class="text-white text-sm">{{ $point }}</span>
                </li>
            @endforeach
        </ul>

    </div>

    {{-- ── RIGHT: Login form ─────────────────────────────────────────────── --}}
    <div class="flex flex-col justify-center bg-[#EEEEEE] p-10">

        {{-- Heading --}}
        <h2 class="text-2xl font-bold text-gray-800">Welcome back</h2>
        <p class="text-sm text-gray-500 mb-8 mt-1">Sign in to your account</p>

        {{-- Global validation error alert --}}
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm p-3">
                <ul class="space-y-0.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Session status --}}
        @if (session('status'))
            <div class="mb-4 rounded-lg border text-sm p-3"
                 style="background:#d1f5ea; border-color:#6FCF97; color:#1F6F5F;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email address
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required autofocus
                    autocomplete="username"
                    placeholder="you@school.edu"
                    class="w-full px-4 py-3 rounded-lg border bg-white text-sm text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-[#2FA084] focus:border-[#2FA084] transition
                           {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                >
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password with Alpine.js show/hide --}}
            <div x-data="{ show: false }">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <div class="relative">
                    <input
                        id="password"
                        :type="show ? 'text' : 'password'"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 pr-12 rounded-lg border bg-white text-sm text-gray-900 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-[#2FA084] focus:border-[#2FA084] transition
                               {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                    >
                    {{-- Toggle button — vertically centred inside input --}}
                    <button
                        type="button"
                        @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                        :aria-label="show ? 'Hide password' : 'Show password'"
                    >
                        {{-- Eye (password hidden) --}}
                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{-- Eye-off (password visible) --}}
                        <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember me --}}
            <div class="flex items-center gap-2">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="w-4 h-4 rounded border-gray-300 accent-[#2FA084] cursor-pointer"
                >
                <label for="remember_me" class="text-sm text-gray-600 cursor-pointer select-none">
                    Remember me
                </label>
            </div>

            {{-- Login button --}}
            <button
                type="submit"
                class="w-full py-3 mt-6 rounded-lg bg-[#2FA084] text-white font-semibold text-sm
                       hover:bg-[#1F6F5F] active:scale-95 transition-all duration-150
                       focus:outline-none focus:ring-2 focus:ring-[#2FA084] focus:ring-offset-2"
            >
                Sign in
            </button>

        </form>

        {{-- Bottom note --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            Only school accounts are authorized to access this system.
        </p>

    </div>

</div>

@endsection
