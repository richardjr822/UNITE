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
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $event->date->format('D, M d, Y') }}</span>
                    </div>
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</span>
                    </div>
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <span class="truncate">{{ $event->venue }}</span>
                    </div>
                    <div class="mt-4">
                        <div class="capacity-display">
                            <svg class="capacity-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>{{ $event->users_count }} / {{ $event->capacity }} Registered</span>
                        </div>
                        <div class="event-capacity-bar">
                            <div class="event-capacity-fill" style="width: {{ ($event->users_count / $event->capacity) * 100 }}%"></div>
                        </div>
                    </div>
                    <div class="mini-card-footer">
                        <div class="mt-4 flex items-center gap-3">
                            <form method="POST" action="{{ route('events.unregister', $event) }}" data-confirm-submit data-confirm-title="Cancel Registration" data-confirm-message="Cancel your registration for {{ $event->title }}?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full bg-amber-600 px-5 py-1.5 text-xs font-bold text-white">Unregister</button>
                            </form>
                            <a href="{{ route('events.show', $event) }}" class="student-mini-btn">View Details</a>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-sm text-white">You have no event registrations yet.</p>
            @endforelse
        </div>
    </section>
</x-app-layout>
