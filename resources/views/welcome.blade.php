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
            --bg: #d7e8e2;
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
            background:
                radial-gradient(circle at 8% 13%, #b4dfc5 0 18%, transparent 19%),
                radial-gradient(circle at 82% 15%, #b1ddc1 0 17%, transparent 18%),
                radial-gradient(circle at 62% 63%, rgba(98, 193, 145, 0.32) 0 16.5%, transparent 17%),
                radial-gradient(circle at 96% 83%, #b5e1c8 0 15%, transparent 16%),
                linear-gradient(145deg, var(--bg) 0%, #d2e6de 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .scene {
            width: min(calc(var(--base-width) * 1px * var(--scale)), calc(100vw - 24px));
            margin: 0 auto;
            position: relative;
            padding-top: calc(22px * var(--scale));
            padding-bottom: calc(34px * var(--scale));
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: calc(8px * var(--scale));
            margin-left: calc(16px * var(--scale));
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
            margin-top: calc(44px * var(--scale));
            position: relative;
            z-index: 2;
        }

        .headline {
            margin: 0;
            font-size: calc(60px * var(--scale));
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.08;
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
            gap: calc(8px * var(--scale));
            font-size: calc(16px * var(--scale));
            line-height: 1;
        }

        .cta-arrow::before {
            content: '';
            width: calc(42px * var(--scale));
            height: calc(2px * var(--scale));
            background: rgba(238, 252, 247, 0.92);
            border-radius: 99px;
        }

        .organic {
            position: absolute;
            left: 50%;
            top: calc(253px * var(--scale));
            transform: translateX(-50%);
            width: calc(470px * var(--scale));
            height: calc(126px * var(--scale));
            background: rgba(235, 247, 242, 0.85);
            border-radius: 56% 44% 54% 46% / 58% 42% 58% 42%;
            filter: blur(calc(0.2px * var(--scale)));
            z-index: 1;
        }

        .events-wrap {
            margin-top: calc(80px * var(--scale));
            position: relative;
            z-index: 2;
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
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: calc(16px * var(--scale));
        }

        .event-card {
            border: 2px solid #d8dbd9;
            background: var(--card);
            border-radius: calc(18px * var(--scale));
            padding: calc(10px * var(--scale)) calc(12px * var(--scale)) calc(11px * var(--scale));
            min-height: calc(108px * var(--scale));
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

        .feature-grid {
            margin-top: calc(40px * var(--scale));
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
                margin-left: 6px;
                font-size: 2rem;
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
                grid-template-columns: 1fr;
                padding: 14px 14px 16px;
                gap: 11px;
            }

            .event-card {
                border-radius: 16px;
                padding: 12px 12px 11px;
                min-height: 108px;
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
    <div class="scene">
        <a class="brand" href="{{ url('/') }}" aria-label="UNITE home">
            <span class="brand-dot"></span>
            <span>UNITE</span>
        </a>

        <section class="hero">
            <h1 class="headline">
                Every campus event,<br>
                <span class="accent">organized</span> in one place.
            </h1>
            <p class="sub">
                A modern platform for faculty to publish events and for students to discover
                and register - without scattered posters or paper sign-ups.
            </p>
            <a class="cta" href="{{ route('login') }}">
                Get Started
                <span class="cta-arrow">&#8594;</span>
            </a>
        </section>

        <div class="organic" aria-hidden="true"></div>

        <div class="events-wrap">
            <section class="events-panel" aria-label="Upcoming events preview">
                <div class="events-header">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <div class="events-grid">
                    <article class="event-card">
                        <div class="event-top">
                            <div class="date-pill">MAY<br>20</div>
                            <span>Function Hall</span>
                        </div>
                        <h3 class="event-title">Inter-College Hackathon</h3>
                        <div class="event-progress"><span style="width: 61%"></span></div>
                    </article>

                    <article class="event-card">
                        <div class="event-top">
                            <div class="date-pill">MAY<br>21</div>
                            <span>PE Hall</span>
                        </div>
                        <h3 class="event-title">Annual Science Fair</h3>
                        <div class="event-progress"><span style="width: 30%"></span></div>
                    </article>

                    <article class="event-card">
                        <div class="event-top">
                            <div class="date-pill">MAY<br>22</div>
                            <span>Room 518</span>
                        </div>
                        <h3 class="event-title">Cultural Night</h3>
                        <div class="event-progress"><span style="width: 81%"></span></div>
                    </article>
                </div>
            </section>
        </div>

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

    <footer class="site-footer">
        <div class="inner">
            <span>&copy; UNITE</span>
            <span>School Event Management System</span>
        </div>
    </footer>
</body>
</html>
