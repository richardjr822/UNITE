<x-app-layout>
    <x-slot name="header">
        <h2 class="sr-only">My Registrations</h2>
    </x-slot>

    <section class="student-canvas">
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="GET" action="{{ route('events.registrations') }}" class="student-filter-bar">
            <input type="search" name="q" value="{{ $search }}" placeholder="Search event" class="student-search">
            <div class="student-chip-row">
                <button type="submit" name="status" value="all" class="student-chip {{ $statusFilter === 'all' ? 'is-active' : '' }}">All</button>
                <button type="submit" name="status" value="ongoing" class="student-chip {{ $statusFilter === 'ongoing' ? 'is-active' : '' }}">Ongoing</button>
                <button type="submit" name="status" value="upcoming" class="student-chip {{ $statusFilter === 'upcoming' ? 'is-active' : '' }}">Upcoming</button>
                <button type="submit" name="status" value="done" class="student-chip {{ $statusFilter === 'done' ? 'is-active' : '' }}">Done</button>
            </div>
        </form>

        <div class="student-grid">
            @forelse ($registrations as $event)
                <article class="student-mini-card">
                    <p class="student-kicker">{{ strtoupper($event->status === 'scheduled' ? ($event->date->isToday() ? 'ongoing' : ($event->date->isFuture() ? 'upcoming' : 'done')) : 'done') }}</p>
                    <h3 class="student-mini-title">{{ $event->title }}</h3>
                    <p class="student-event-copy">{{ \Illuminate\Support\Str::limit($event->description, 95) }}</p>
                    <p class="student-meta">{{ $event->date->format('D, M d, Y') }} · {{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</p>
                    <p class="student-meta">{{ $event->venue }}</p>
                    <div class="mt-4 flex items-center justify-between gap-3">
                        <form method="POST" action="{{ route('events.unregister', $event) }}" data-confirm-submit data-confirm-title="Cancel Registration" data-confirm-message="Cancel your registration for {{ $event->title }}?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full bg-amber-600 px-5 py-1.5 text-xs font-bold text-white">Unregister</button>
                        </form>
                        <a href="{{ route('events.show', $event) }}" class="text-xs font-bold text-[#155f47]">View Details</a>
                    </div>
                </article>
            @empty
                <p class="text-sm text-white">You have no event registrations yet.</p>
            @endforelse
        </div>
    </section>
</x-app-layout>
