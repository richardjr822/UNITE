<x-app-layout>
    @if ($isAdmin)
        <x-slot name="header">
            <h2 class="sr-only">Admin Events</h2>
        </x-slot>

        <section class="student-canvas">
            @if (session('status'))
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="admin-tools-wrap">
                <form method="GET" action="{{ route('events.index') }}" class="student-filter-bar mb-0">
                    <input type="search" name="q" value="{{ $search }}" placeholder="Search event" class="student-search">
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="student-chip-row">
                            <button type="submit" name="status" value="all" class="student-chip {{ $statusFilter === 'all' ? 'is-active' : '' }}">All</button>
                            <button type="submit" name="status" value="ongoing" class="student-chip {{ $statusFilter === 'ongoing' ? 'is-active' : '' }}">Ongoing</button>
                            <button type="submit" name="status" value="upcoming" class="student-chip {{ $statusFilter === 'upcoming' ? 'is-active' : '' }}">Upcoming</button>
                            <button type="submit" name="status" value="done" class="student-chip {{ $statusFilter === 'done' ? 'is-active' : '' }}">Done</button>
                        </div>
                        <a href="{{ route('events.create') }}" class="student-pale-btn">Add Event</a>
                    </div>
                </form>
            </div>

            <div class="admin-empty-board">
                <div class="student-grid">
                    @forelse ($events as $event)
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
                            <div class="mt-4 flex flex-wrap items-center gap-2">
                                <a href="{{ route('events.show', $event) }}" class="student-mini-btn">View</a>
                                <a href="{{ route('events.edit', $event) }}" class="rounded-full bg-[#dff2ea] px-4 py-1.5 text-xs font-bold text-[#1b6b50]">Edit</a>
                                <form method="POST" action="{{ route('events.destroy', $event) }}" data-confirm-submit data-confirm-title="Delete Event" data-confirm-message="Delete {{ $event->title }}? This action cannot be undone.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-full bg-[#f9dfdf] px-4 py-1.5 text-xs font-bold text-[#8d2d2d]">Delete</button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <p class="text-sm text-[#385e52]">No events matched your filters.</p>
                    @endforelse
                </div>
            </div>
        </section>
    @else
        <x-slot name="header">
            <h2 class="sr-only">Student Events</h2>
        </x-slot>

        <section class="student-canvas">
            @if (session('status'))
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->has('registration'))
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first('registration') }}
                </div>
            @endif

            <form method="GET" action="{{ route('events.index') }}" class="student-filter-bar">
                <input type="search" name="q" value="{{ $search }}" placeholder="Search event" class="student-search">
                <div class="student-chip-row">
                    <button type="submit" name="status" value="all" class="student-chip {{ $statusFilter === 'all' ? 'is-active' : '' }}">All</button>
                    <button type="submit" name="status" value="ongoing" class="student-chip {{ $statusFilter === 'ongoing' ? 'is-active' : '' }}">Ongoing</button>
                    <button type="submit" name="status" value="upcoming" class="student-chip {{ $statusFilter === 'upcoming' ? 'is-active' : '' }}">Upcoming</button>
                    <button type="submit" name="status" value="done" class="student-chip {{ $statusFilter === 'done' ? 'is-active' : '' }}">Done</button>
                </div>
            </form>

            <div class="student-grid">
                @forelse ($events as $event)
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
                        <div class="mt-4 flex items-center gap-3">
                            @if (in_array($event->id, $registeredEventIds, true))
                                <span class="student-registered">Registered</span>
                            @elseif ($event->is_full || $event->status !== 'scheduled' || $event->date->isPast())
                                <span class="rounded-full bg-gray-200 px-5 py-1.5 text-xs font-bold text-gray-600">Unavailable</span>
                            @else
                                <form method="POST" action="{{ route('events.register', $event) }}">
                                    @csrf
                                    <button type="submit" class="student-mini-btn">Register</button>
                                </form>
                            @endif

                            <a href="{{ route('events.show', $event) }}" class="student-mini-btn">View Details</a>
                        </div>
                    </article>
                @empty
                    <p class="text-sm text-white">No events matched your filters.</p>
                @endforelse
            </div>
        </section>
    @endif
</x-app-layout>
