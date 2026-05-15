<x-app-layout>
    @if ($isAdmin)
        <x-slot name="header">
            <h2 class="sr-only">Admin Dashboard</h2>
        </x-slot>

        <section class="student-canvas">
            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                <div>
                    <p class="text-sm font-semibold text-[#e7f5ef]">{{ now()->format('M d, Y') }}</p>
                    <h2 class="student-title">WELCOME, ADMIN!</h2>
                    <p class="student-subtitle">Here is what is happening across your campus events.</p>
                </div>
                <a href="{{ route('events.create') }}" class="student-pale-btn">Add Event</a>
            </div>

            @if (session('status'))
                <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-6 grid gap-4 md:grid-cols-3">
                <article class="admin-stat-card">
                    <p class="admin-stat-label">Events This Week</p>
                    <p class="admin-stat-value">{{ $eventsThisWeek }}</p>
                </article>
                <article class="admin-stat-card">
                    <p class="admin-stat-label">Events This Month</p>
                    <p class="admin-stat-value">{{ $eventsThisMonth }}</p>
                </article>
                <article class="admin-stat-card">
                    <p class="admin-stat-label">Scheduled Upcoming</p>
                    <p class="admin-stat-value">{{ $upcomingEvents->count() }}</p>
                </article>
            </div>

            @php($nextEvent = $upcomingEvents->first())
            @if ($nextEvent)
                <article class="student-card mt-6">
                    <p class="student-kicker">Next Up</p>
                    <h3 class="student-event-title">{{ $nextEvent->title }}</h3>
                    <p class="student-event-copy">{{ $nextEvent->description }}</p>
                    <p class="student-meta">{{ $nextEvent->date->format('D, M d, Y') }} · {{ \Illuminate\Support\Carbon::parse($nextEvent->time)->format('h:i A') }}</p>
                    <p class="student-meta">{{ $nextEvent->venue }}</p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="{{ route('events.show', $nextEvent) }}" class="student-event-action">View Details</a>
                        <a href="{{ route('events.edit', $nextEvent) }}" class="rounded-full bg-[#2d8f6a] px-6 py-2 text-sm font-bold text-white shadow">Edit Event</a>
                    </div>
                </article>
            @endif

            <div class="mt-6">
                <p class="text-xs font-bold uppercase tracking-[0.08em] text-[#e6f6ef]">Upcoming Events</p>
                <div class="student-grid mt-3">
                    @forelse ($upcomingEvents->take(4) as $event)
                        <article class="student-mini-card">
                            <h4 class="student-mini-title">{{ $event->title }}</h4>
                            <p class="student-event-copy">{{ \Illuminate\Support\Str::limit($event->description, 90) }}</p>
                            <p class="student-meta">{{ $event->date->format('D, M d, Y') }} · {{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</p>
                            <p class="student-meta">{{ $event->venue }}</p>
                            <p class="mt-2 text-xs font-semibold text-[#2d6d58]">{{ $event->users_count }} / {{ $event->capacity }} Registered</p>
                            <div class="mt-3 flex items-center gap-3">
                                <a href="{{ route('events.show', $event) }}" class="student-mini-btn">View</a>
                                <a href="{{ route('events.edit', $event) }}" class="rounded-full bg-[#dff2ea] px-4 py-1.5 text-xs font-bold text-[#1b6b50]">Edit</a>
                            </div>
                        </article>
                    @empty
                        <p class="text-sm text-white">No upcoming events available.</p>
                    @endforelse
                </div>
            </div>
        </section>
    @else
        <x-slot name="header">
            <h2 class="sr-only">Student Dashboard</h2>
        </x-slot>

        <section class="student-canvas">
            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                <div>
                    <p class="text-sm font-semibold text-[#e7f5ef]">{{ now()->format('M d, Y') }}</p>
                    <h2 class="student-title">WELCOME, {{ strtoupper(auth()->user()->name) }}!</h2>
                    <p class="student-subtitle">Discover what is coming up and grab your spot.</p>
                </div>
                <a href="{{ route('events.index') }}" class="student-pale-btn">Browse Events</a>
            </div>

            @if ($nextRegisteredEvent)
                <article class="student-card mt-6">
                    <p class="student-kicker">Next Up</p>
                    <h3 class="student-event-title">{{ $nextRegisteredEvent->title }}</h3>
                    <p class="student-event-copy">{{ $nextRegisteredEvent->description }}</p>
                    <p class="student-meta">{{ $nextRegisteredEvent->date->format('D, M d, Y') }} · {{ \Illuminate\Support\Carbon::parse($nextRegisteredEvent->time)->format('h:i A') }}</p>
                    <p class="student-meta">{{ $nextRegisteredEvent->venue }}</p>
                    <a href="{{ route('events.show', $nextRegisteredEvent) }}" class="student-event-action">View Details</a>
                </article>
            @endif

            <div class="mt-6">
                <p class="text-xs font-bold uppercase tracking-[0.08em] text-[#e6f6ef]">Upcoming Events</p>
                <div class="student-grid mt-3">
                    @forelse ($upcomingEvents->take(4) as $event)
                        <article class="student-mini-card">
                            <h4 class="student-mini-title">{{ $event->title }}</h4>
                            <p class="student-event-copy">{{ \Illuminate\Support\Str::limit($event->description, 90) }}</p>
                            <p class="student-meta">{{ $event->date->format('D, M d, Y') }} · {{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</p>
                            <p class="student-meta">{{ $event->venue }}</p>
                            <div class="mt-3 flex items-center justify-between gap-3">
                                <span class="text-xs font-semibold text-[#2d6d58]">{{ $event->users_count }} / {{ $event->capacity }} Registered</span>
                                <a href="{{ route('events.show', $event) }}" class="student-mini-btn">View</a>
                            </div>
                        </article>
                    @empty
                        <p class="text-sm text-white">No upcoming events available.</p>
                    @endforelse
                </div>
            </div>
        </section>
    @endif
</x-app-layout>
