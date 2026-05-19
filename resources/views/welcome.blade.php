<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UNITE') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg: #f0f8f4;
            --ink: #0e1716;
            --muted: #66726f;
            --green-a: #55c294;
            --green-b: #1f7f63;
            --green-c: #2f9d78;
            --panel: #f4f4f4;
            --card: #ececec;
            --base-width: 768;
            --scale: clamp(1, calc((100vw - 24px) / (var(--base-width) * 1px)), 1.15);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            color: var(--ink);
            background: linear-gradient(145deg, var(--bg) 0%, #e4f3ec 100%);
            min-height: 100vh;
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

        .scene {
            width: min(calc(var(--base-width) * 1px * var(--scale)), calc(100vw - 24px));
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding-top: calc(22px * var(--scale));
            padding-bottom: calc(34px * var(--scale));
            overflow: visible;
        }

        .nav-signin {
            position: fixed;
            top: 14px;
            right: 20px;
            z-index: 100;
            padding: 8px 22px;
            border-radius: 999px;
            background: linear-gradient(120deg, var(--green-a) 0%, #39a885 52%, var(--green-b) 100%);
            color: #f3fffb;
            font-family: 'Manrope', sans-serif;
            font-size: .875rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(34,125,93,0.28);
            transition: opacity .15s;
        }

        .nav-signin:hover { opacity: .88; }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: calc(8px * var(--scale));
            position: fixed;
            top: 18px;
            left: 20px;
            z-index: 100;
            font-size: calc(26px * var(--scale));
            font-weight: 800;
            letter-spacing: -0.01em;
            text-decoration: none;
            color: var(--ink);
        }

        .brand-dot {
            width: calc(16px * var(--scale));
            height: calc(16px * var(--scale));
            border-radius: 999px;
            background: radial-gradient(circle at 28% 30%, #5ed3a0 8%, #2a9b74 70%);
            box-shadow: 0 calc(4px * var(--scale)) calc(12px * var(--scale)) rgba(40, 130, 98, 0.26);
        }

        .hero {
            text-align: center;
            margin-top: calc(80px * var(--scale));
            margin-bottom: 0;
            padding-top: calc(48px * var(--scale));
            padding-bottom: calc(8px * var(--scale));
            position: relative;
            z-index: 2;
        }

        .headline {
            margin: 0 auto;
            font-size: calc(80px * var(--scale));
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.08;
            text-align: center;
            width: max-content;
        }

        .headline .accent {
            color: var(--green-c);
        }

        .sub {
            width: calc(490px * var(--scale));
            max-width: 92%;
            margin: calc(14px * var(--scale)) auto 0;
            font-size: calc(15px * var(--scale));
            line-height: 1.42;
            color: #6f7a77;
            font-weight: 500;
        }

        .cta {
            margin-top: calc(26px * var(--scale));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: calc(34px * var(--scale));
            min-width: calc(248px * var(--scale));
            padding: calc(11px * var(--scale)) calc(28px * var(--scale));
            border-radius: 999px;
            color: #f3fffb;
            text-decoration: none;
            font-size: calc(15px * var(--scale));
            font-weight: 700;
            background: linear-gradient(120deg, var(--green-a) 0%, #39a885 52%, var(--green-b) 100%);
            box-shadow: 0 calc(8px * var(--scale)) calc(18px * var(--scale)) rgba(34, 125, 93, 0.33);
        }

        .cta-arrow {
            display: inline-flex;
            align-items: center;
        }

        .cta-arrow::before { content: none; }

        .organic { display: none; }

        .events-wrap {
            margin-top: calc(80px * var(--scale));
            margin-bottom: calc(60px * var(--scale));
            position: relative;
            z-index: 2;
            width: min(90vw, 1080px);
            margin-left: auto;
            margin-right: auto;
        }

        .events-section-label {
            text-align: center;
            font-size: calc(13px * var(--scale));
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--green-c);
            margin-bottom: calc(18px * var(--scale));
        }

        .events-panel {
            border-radius: calc(38px * var(--scale));
            background: rgba(248, 248, 248, 0.94);
            border: 1px solid rgba(255, 255, 255, .72);
            box-shadow: 0 calc(16px * var(--scale)) calc(34px * var(--scale)) rgba(33, 112, 85, 0.24);
            overflow: hidden;
        }

        .events-header {
            height: calc(58px * var(--scale));
            border-bottom: 1px solid #dbdfdd;
            display: flex;
            align-items: center;
            padding: 0 calc(38px * var(--scale));
            gap: calc(8px * var(--scale));
        }

        .dot {
            width: calc(11px * var(--scale));
            height: calc(11px * var(--scale));
            border-radius: 999px;
            background: #53c194;
        }

        .dot:nth-child(2) { background: #63c79e; opacity: .88; }
        .dot:nth-child(3) { background: #24846a; }

        .events-grid {
            padding: calc(18px * var(--scale)) calc(26px * var(--scale)) calc(20px * var(--scale));
            display: flex;
            flex-direction: row;
            gap: calc(16px * var(--scale));
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(47,157,120,0.35) transparent;
        }

        .events-grid::-webkit-scrollbar { height: 4px; }
        .events-grid::-webkit-scrollbar-thumb { background: rgba(47,157,120,0.35); border-radius: 4px; }

        .event-card {
            border: 2px solid #d8dbd9;
            background: var(--card);
            border-radius: calc(18px * var(--scale));
            padding: calc(10px * var(--scale)) calc(12px * var(--scale)) calc(11px * var(--scale));
            min-height: calc(108px * var(--scale));
            flex: 0 0 calc(220px * var(--scale));
            min-width: calc(180px * var(--scale));
        }

        .event-top {
            display: flex;
            gap: calc(8px * var(--scale));
            align-items: center;
            color: #6f7875;
            font-size: calc(13px * var(--scale));
            font-weight: 600;
        }

        .date-pill {
            width: calc(40px * var(--scale));
            min-width: calc(40px * var(--scale));
            border-radius: calc(11px * var(--scale));
            background: #2a8a6b;
            color: #e9f7f1;
            text-align: center;
            padding: calc(7px * var(--scale)) 4px;
            line-height: 1.05;
            font-weight: 800;
            font-size: calc(8px * var(--scale));
            letter-spacing: 0.01em;
        }

        .event-title {
            margin: calc(9px * var(--scale)) 0 calc(8px * var(--scale));
            font-size: calc(14px * var(--scale));
            font-weight: 800;
            line-height: 1.05;
        }

        .event-progress {
            height: calc(4px * var(--scale));
            width: 100%;
            border-radius: 999px;
            background: #d3ddd8;
            overflow: hidden;
        }

        .event-progress span {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: #2f8e6f;
        }

        .features-wrap {
            position: relative;
            z-index: 2;
            width: min(90vw, 1080px);
            margin-left: auto;
            margin-right: auto;
            margin-top: calc(24px * var(--scale));
            margin-bottom: calc(24px * var(--scale));
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: calc(15px * var(--scale));
        }

        .feature {
            border-radius: calc(20px * var(--scale));
            background: rgba(249, 250, 250, .9);
            border: 1px solid rgba(255, 255, 255, .75);
            box-shadow: 0 calc(12px * var(--scale)) calc(22px * var(--scale)) rgba(44, 113, 88, 0.2);
            padding: calc(18px * var(--scale)) calc(14px * var(--scale));
            text-align: center;
        }

        .feature h3 {
            margin: 0;
            font-size: calc(13px * var(--scale));
            font-weight: 800;
        }

        .feature p {
            margin: calc(16px * var(--scale)) 0 0;
            color: #767f7d;
            font-size: calc(11px * var(--scale));
            line-height: 1.35;
            font-weight: 500;
        }

        .faq-wrap {
            position: relative;
            z-index: 2;
            width: min(90vw, 1080px);
            margin-left: auto;
            margin-right: auto;
            margin-top: calc(32px * var(--scale));
            margin-bottom: calc(48px * var(--scale));
        }

        .faq-label {
            text-align: center;
            font-size: calc(13px * var(--scale));
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--green-c);
            margin-bottom: calc(18px * var(--scale));
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: calc(10px * var(--scale));
        }

        .faq-item {
            border-radius: calc(16px * var(--scale));
            background: rgba(249, 250, 250, .9);
            border: 1px solid rgba(255, 255, 255, .75);
            box-shadow: 0 calc(8px * var(--scale)) calc(18px * var(--scale)) rgba(44, 113, 88, 0.13);
            overflow: hidden;
        }

        .faq-question {
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            padding: calc(16px * var(--scale)) calc(22px * var(--scale));
            font-family: inherit;
            font-size: calc(13px * var(--scale));
            font-weight: 700;
            color: #1e3a2e;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: calc(12px * var(--scale));
        }

        .faq-question .faq-icon {
            flex-shrink: 0;
            width: calc(18px * var(--scale));
            height: calc(18px * var(--scale));
            border-radius: 50%;
            background: #d4efe4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: calc(14px * var(--scale));
            line-height: 1;
            color: #2a8a6b;
            transition: transform 0.25s ease;
        }

        .faq-item.open .faq-icon { transform: rotate(45deg); }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
            padding: 0 calc(22px * var(--scale));
            color: #767f7d;
            font-size: calc(12px * var(--scale));
            line-height: 1.55;
            font-weight: 500;
        }

        .faq-item.open .faq-answer {
            max-height: 200px;
            padding: 0 calc(22px * var(--scale)) calc(16px * var(--scale));
        }

        .site-footer {
            margin-top: calc(42px * var(--scale));
            background: rgba(244, 244, 244, 0.92);
            border-top: 1px solid #dbdbdb;
        }

        .site-footer .inner {
            width: min(calc(var(--base-width) * 1px * var(--scale)), calc(100vw - 24px));
            margin: 0 auto;
            padding: calc(12px * var(--scale)) calc(6px * var(--scale));
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #9ba19f;
            font-size: calc(10px * var(--scale));
            font-weight: 600;
        }

        @media (max-width: 980px) {
            :root {
                --scale: min(1, calc((100vw - 22px) / 760));
            }
        }

        @media (max-width: 860px) {
            .scene {
                width: calc(100vw - 18px);
                padding-top: 16px;
            }

            .brand {
                font-size: 1.6rem;
            }

            .hero {
                margin-top: 18px;
            }

            .headline {
                font-size: clamp(2.2rem, 10vw, 3.6rem);
                max-width: 10.5ch;
            }

            .sub {
                width: min(92%, 680px);
                font-size: clamp(1rem, 2.8vw, 1.24rem);
            }

            .cta {
                min-width: 240px;
                padding: 11px 24px;
                font-size: 1.05rem;
                gap: 16px;
            }

            .cta-arrow::before {
                width: 28px;
                height: 2px;
            }

            .organic {
                top: 255px;
                width: min(92%, 540px);
                height: 94px;
            }

            .events-wrap {
                margin-top: 56px;
            }

            .events-panel {
                border-radius: 28px;
            }

            .events-header {
                height: 48px;
                padding: 0 18px;
                gap: 8px;
            }

            .dot {
                width: 10px;
                height: 10px;
            }

            .events-grid {
                padding: 14px 14px 16px;
                gap: 11px;
            }

            .event-card {
                border-radius: 16px;
                padding: 12px 12px 11px;
                min-height: 108px;
                flex: 0 0 200px;
                min-width: 200px;
            }

            .event-top {
                font-size: .9rem;
            }

            .date-pill {
                width: 44px;
                min-width: 44px;
                font-size: .58rem;
                border-radius: 12px;
                padding: 8px 4px;
            }

            .event-title {
                font-size: 1.08rem;
                margin: 10px 0 9px;
            }

            .event-progress {
                height: 5px;
            }

            .feature-grid {
                margin-top: 20px;
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .feature {
                border-radius: 16px;
                padding: 16px 14px;
            }

            .feature h3 {
                font-size: 1rem;
            }

            .feature p {
                margin-top: 9px;
                font-size: .88rem;
            }

            .site-footer {
                margin-top: 22px;
            }

            .site-footer .inner {
                width: calc(100vw - 18px);
                padding: 10px 4px;
                font-size: .72rem;
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
    <a class="brand" href="{{ url('/') }}" aria-label="UNITE home">
        <span class="brand-dot"></span>
        <span>UNITE</span>
    </a>
    <a class="nav-signin" href="{{ route('login') }}">Sign In</a>

    <div class="scene">
        <section class="hero">
            <h1 class="headline">
                <span style="display:block;white-space:nowrap;">Every campus event,</span>
                <span style="display:block;white-space:nowrap;"><span class="accent">organized</span> in one place.</span>
            </h1>
            <p class="sub">
                A modern platform for faculty to publish events and for students to discover
                and register - without scattered posters or paper sign-ups.
            </p>
            <a class="cta" href="{{ route('login') }}">
                Get Started
                <span class="cta-arrow"><svg width="52" height="18" viewBox="0 0 52 18" fill="none" xmlns="http://www.w3.org/2000/svg"><line x1="0" y1="9" x2="44" y2="9" stroke="rgba(238,252,247,0.9)" stroke-width="2.2" stroke-linecap="round"/><polyline points="36,2 44,9 36,16" stroke="rgba(238,252,247,0.9)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg></span>
            </a>
        </section>

        <div class="organic" aria-hidden="true"></div>
    </div>

    <div class="events-wrap">
        <p class="events-section-label">Upcoming Events</p>
        <section class="events-panel" aria-label="Upcoming events preview">
            <div class="events-header">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
            <div class="events-grid">
                @forelse ($events as $event)
                <article class="event-card">
                    <div class="event-top">
                        <div class="date-pill">{{ strtoupper(\Carbon\Carbon::parse($event->date)->format('M')) }}<br>{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                        <span>{{ $event->venue }}</span>
                    </div>
                    <h3 class="event-title">{{ $event->title }}</h3>
                </article>
                @empty
                <p style="padding: 16px; color: #9ba19f; font-size: .85rem;">No upcoming events.</p>
                @endforelse
            </div>
        </section>
    </div>

    <div class="features-wrap">
        <section class="feature-grid" aria-label="Platform highlights">
            <article class="feature">
                <h3>Admin</h3>
                <p>Create, edit, and cancel events. Track participants and capacity in real time.</p>
            </article>
            <article class="feature">
                <h3>Students</h3>
                <p>Browse upcoming events and register with one click. No duplicate sign-ups.</p>
            </article>
            <article class="feature">
                <h3>Role - Based</h3>
                <p>Separate flows for faculty managers and student attendees, end to end.</p>
            </article>
        </section>
    </div>

    <div class="faq-wrap">
        <p class="faq-label">FAQs</p>
        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Who can use UNITE?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">UNITE is open to all enrolled students and faculty staff of the campus. Students can browse and register for events, while authorized faculty members can create and manage them.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How do I register for an event?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">Sign in with your student account, browse the upcoming events, and click Register on any event you want to join. You'll receive a confirmation and can manage your registrations from your dashboard.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Can I cancel my registration?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">Yes. Visit your dashboard, find the event under My Registrations, and click Cancel. Spots are released immediately so other students can join.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    What happens if an event is full?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">Once an event reaches its capacity limit, registration is automatically closed. Keep an eye on the events panel — new events are added regularly.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    How do admins create an event?
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">Log in with an admin account, go to the Events section of your dashboard, and click Create Event. Fill in the title, date, venue, and capacity, then publish it for students to see.</div>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="inner">
            <span>&copy; UNITE</span>
            <span>School Event Management System</span>
        </div>
    </footer>

    <script>
        function toggleFaq(btn) {
            const item = btn.closest('.faq-item');
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        }
    </script>
</body>
</html>
