<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UNITE') }} | Sign In</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --mint-050: #ecf8f3;
            --mint-100: #d9f0e6;
            --mint-200: #bfe5d6;
            --mint-400: #58b88c;
            --mint-500: #2f9c75;
            --mint-600: #207c5b;
            --ink-900: #0a1512;
            --ink-700: #45534d;
            --card-bg: #f6f7f6;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            color: var(--ink-900);
            background: linear-gradient(145deg, #f0f8f4 0%, #e4f3ec 100%);
            overflow-x: hidden;
        }

        .bg-circles {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.55;
            filter: blur(8px);
        }

        .bg-circle-1 {
            width: 38vw; height: 38vw;
            left: -8vw; top: -6vw;
            background: radial-gradient(circle at 40% 40%, #b4dfc5, #c8ead7);
            animation: floatA 9s ease-in-out infinite;
        }

        .bg-circle-2 {
            width: 34vw; height: 34vw;
            right: -6vw; top: -4vw;
            background: radial-gradient(circle at 60% 40%, #b1ddc1, #c5e8d3);
            animation: floatB 11s ease-in-out infinite;
        }

        .bg-circle-3 {
            width: 28vw; height: 28vw;
            left: 50vw; top: 45vw;
            background: radial-gradient(circle at 50% 50%, rgba(98,193,145,0.55), transparent);
            animation: floatC 13s ease-in-out infinite;
        }

        .bg-circle-4 {
            width: 26vw; height: 26vw;
            right: -4vw; bottom: -4vw;
            background: radial-gradient(circle at 60% 60%, #b5e1c8, #c8ead7);
            animation: floatA 10s ease-in-out infinite reverse;
        }

        @keyframes floatA {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(8%, 10%) scale(1.06); }
            66%       { transform: translate(-6%, 5%) scale(0.95); }
        }

        @keyframes floatB {
            0%, 100% { transform: translate(0, 0) scale(1); }
            40%       { transform: translate(-10%, 8%) scale(1.07); }
            70%       { transform: translate(6%, -6%) scale(0.94); }
        }

        @keyframes floatC {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(-8%, -10%) scale(1.08); }
        }

        .login-shell {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 28px;
        }

        .login-layout {
            width: min(1120px, 100%);
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 52px;
            align-items: center;
        }

        .brand-block {
            animation: rise-in 0.65s ease-out both;
        }

        .brand-row {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 34px;
        }

        .brand-dot {
            width: 23px;
            height: 23px;
            border-radius: 999px;
            background: radial-gradient(circle at 30% 30%, #64d4a1 10%, #2f9c75 72%);
            box-shadow: 0 8px 18px rgba(33, 132, 96, 0.35);
        }

        .brand-title {
            margin: 0;
            font-size: clamp(1.45rem, 2.1vw, 1.95rem);
            letter-spacing: 0.02em;
            font-weight: 800;
        }

        .hero-title {
            margin: 0;
            max-width: 12ch;
            font-size: clamp(2.1rem, 5vw, 3.8rem);
            line-height: 1.08;
            letter-spacing: -0.04em;
            font-weight: 800;
        }

        .hero-sub {
            margin-top: 18px;
            max-width: 35ch;
            font-size: clamp(0.92rem, 1.5vw, 1.1rem);
            line-height: 1.6;
            color: var(--ink-700);
            font-weight: 500;
        }

        .pager-dots {
            margin-top: 54px;
            display: flex;
            gap: 9px;
        }

        .pager-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: rgba(32, 124, 91, 0.35);
        }

        .pager-dot.is-active {
            width: 23px;
            background: #3aa172;
        }

        .login-card {
            background: color-mix(in srgb, var(--card-bg) 86%, white 14%);
            border-radius: 40px;
            padding: clamp(28px, 4vw, 46px);
            box-shadow: 0 26px 50px rgba(24, 93, 66, 0.17);
            border: 1px solid rgba(255, 255, 255, 0.62);
            animation: rise-in 0.75s ease-out 0.07s both;
            backdrop-filter: blur(6px);
        }

        .card-title {
            text-align: center;
            margin: 2px 0 26px;
            font-size: clamp(1.5rem, 2.4vw, 2.1rem);
            letter-spacing: -0.03em;
            font-weight: 700;
        }

        .field-wrap + .field-wrap {
            margin-top: 12px;
        }

        .field {
            width: 100%;
            border-radius: 999px;
            border: 1.4px solid rgba(31, 40, 36, 0.28);
            background: rgba(255, 255, 255, 0.88);
            padding: 13px 18px;
            font-size: 0.95rem;
            font-family: inherit;
            color: var(--ink-900);
            font-weight: 500;
            transition: border-color 180ms ease, box-shadow 180ms ease;
        }

        .field::placeholder {
            color: rgba(68, 81, 74, 0.8);
        }

        .field:focus {
            outline: none;
            border-color: var(--mint-500);
            box-shadow: 0 0 0 4px rgba(58, 161, 114, 0.16);
        }

        .inline-link {
            margin-top: 10px;
            display: inline-block;
            font-size: 0.78rem;
            color: #2f3f38;
            text-decoration: none;
        }

        .inline-link:hover {
            color: var(--mint-600);
            text-decoration: underline;
        }

        .submit-wrap {
            display: flex;
            justify-content: center;
            margin-top: 18px;
        }

        .submit-btn {
            border: 0;
            border-radius: 999px;
            background: linear-gradient(120deg, #42af7c 0%, #2a906b 100%);
            color: #fff;
            min-width: 124px;
            padding: 12px 26px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: inherit;
            letter-spacing: 0.01em;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(35, 132, 96, 0.35);
            transition: transform 160ms ease, box-shadow 160ms ease;
        }

        .submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 24px rgba(35, 132, 96, 0.4);
        }

        .register-row {
            margin-top: 20px;
            text-align: center;
            font-size: 0.93rem;
            color: #53635b;
        }

        .register-row a {
            color: var(--mint-500);
            font-weight: 600;
            text-decoration: none;
        }

        .register-row a:hover {
            text-decoration: underline;
        }

        .status,
        .error-list {
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 0.84rem;
            margin-bottom: 12px;
        }

        .status {
            background: rgba(58, 161, 114, 0.14);
            color: #1d6c4f;
        }

        .error-list {
            background: rgba(192, 46, 46, 0.11);
            color: #9d1f1f;
            line-height: 1.45;
        }

        .error-list ul {
            margin: 0;
            padding-left: 1rem;
        }

        @keyframes rise-in {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .login-layout {
                gap: 30px;
            }

            .hero-title {
                max-width: 15ch;
            }
        }

        @media (max-width: 860px) {
            .login-layout {
                grid-template-columns: 1fr;
                align-items: start;
                gap: 18px;
            }

            .brand-block {
                text-align: left;
            }

            .hero-title {
                max-width: 18ch;
            }

            .pager-dots {
                margin-top: 24px;
            }

            .login-card {
                border-radius: 28px;
            }
        }
    </style>
</head>
<body>
<div class="bg-circles" aria-hidden="true">
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
    <div class="bg-circle bg-circle-4"></div>
</div>
@php($currentRole = $role ?? 'student')
<main class="login-shell">
    <section class="login-layout">
        <div class="brand-block" aria-hidden="true">
            <div class="brand-row">
                <span class="brand-dot"></span>
                <a href="{{ route('home') }}" style="text-decoration:none;color:inherit;"><h1 class="brand-title">UNITE</h1></a>
            </div>

            <h2 class="hero-title">Welcome to your campus events hub.</h2>
            <p class="hero-sub">Manage events, track registrations, and keep your campus organized.</p>

            <div class="pager-dots">
                <span class="pager-dot is-active"></span>
                <span class="pager-dot"></span>
                <span class="pager-dot"></span>
            </div>
        </div>

        <div class="login-card">
            <h3 class="card-title">Sign In</h3>

            <div style="display:flex;gap:8px;justify-content:center;margin-bottom:14px;">
                <button type="button" id="tab-student" onclick="switchRole('student')" style="padding:6px 12px;border-radius:999px;border:1px solid {{ $currentRole === 'student' ? '#2f9c75' : '#9ca3af' }};background:{{ $currentRole === 'student' ? 'rgba(58,161,114,.12)' : 'transparent' }};color:#1f2937;font-size:.8rem;font-weight:600;cursor:pointer;">Student</button>
                <button type="button" id="tab-admin" onclick="switchRole('admin')" style="padding:6px 12px;border-radius:999px;border:1px solid {{ $currentRole === 'admin' ? '#2f9c75' : '#9ca3af' }};background:{{ $currentRole === 'admin' ? 'rgba(58,161,114,.12)' : 'transparent' }};color:#1f2937;font-size:.8rem;font-weight:600;cursor:pointer;">Admin</button>
            </div>

            @if (session('status'))
                <div class="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="error-list">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="login-form" method="POST" action="{{ route('login.role.store', $currentRole) }}">
                @csrf

                <div class="field-wrap">
                    <input
                        id="email"
                        class="field"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="email"
                        required
                        autofocus
                        autocomplete="username"
                    >
                </div>

                <div class="field-wrap" style="position:relative;">
                    <input
                        id="password"
                        class="field"
                        type="password"
                        name="password"
                        placeholder="password"
                        required
                        autocomplete="current-password"
                        style="padding-right:48px;"
                    >
                    <button type="button" onclick="togglePassword()" style="position:absolute;right:16px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#4d7a6a;padding:0;" aria-label="Toggle password visibility">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>

                <div class="submit-wrap">
                    <button class="submit-btn" type="submit">Continue</button>
                </div>
            </form>
        </div>
    </section>
</main>
<script>
    const routes = {
        student: {
            store: '{{ route('login.role.store', 'student') }}'
        },
        admin: {
            store: '{{ route('login.role.store', 'admin') }}'
        }
    };

    function switchRole(role) {
        const other = role === 'student' ? 'admin' : 'student';
        const active = { border: '1px solid #2f9c75', background: 'rgba(58,161,114,.12)' };
        const inactive = { border: '1px solid #9ca3af', background: 'transparent' };

        const tabActive = document.getElementById('tab-' + role);
        const tabInactive = document.getElementById('tab-' + other);

        Object.assign(tabActive.style, active);
        Object.assign(tabInactive.style, inactive);

        document.getElementById('login-form').action = routes[role].store;
    }

    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
        }
    }
</script>
</body>
</html>
