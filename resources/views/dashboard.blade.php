<x-app-layout>
    @if ($isAdmin)
        <x-slot name="header">
            <h2 class="sr-only">Admin Dashboard</h2>
        </x-slot>

        <section class="student-canvas">
            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                <div>
                    <p class="text-sm font-semibold text-[#e7f5ef]">{{ now()->format('l, F d, Y') }}</p>
                    <h2 class="student-title">Event Dashboard</h2>
                    <p class="student-subtitle">Monitor upcoming events, participation, and weekly activity.</p>
                </div>
                <button type="button" data-add-event class="student-pale-btn flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Event
                </button>
            </div>

            @if (session('status'))
                <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 flex items-start gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                <!-- Events This Week Card -->
                <article class="modern-stat-card">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="modern-stat-label">Events This Week</p>
                            <p class="modern-stat-value">{{ $eventsThisWeek }}</p>
                        </div>
                        <div class="stat-icon-large stat-icon-blue">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </article>
                
                <!-- Events This Month Card -->
                <article class="modern-stat-card">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="modern-stat-label">Events This Month</p>
                            <p class="modern-stat-value">{{ $eventsThisMonth }}</p>
                        </div>
                        <div class="stat-icon-large stat-icon-green">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </article>

                <!-- Upcoming Events Card -->
                <article class="modern-stat-card">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="modern-stat-label">Upcoming Events</p>
                            <p class="modern-stat-value">{{ $upcomingEvents->count() }}</p>
                        </div>
                        <div class="stat-icon-large stat-icon-purple">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                </article>

                <!-- Total Attendees Card -->
                <article class="modern-stat-card">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="modern-stat-label">Total Attendees</p>
                            <p class="modern-stat-value">{{ $upcomingEvents->sum('users_count') }}</p>
                        </div>
                        <div class="stat-icon-large stat-icon-orange">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0zM6 20h12v-2a4 4 0 00-8 0v2z" />
                            </svg>
                        </div>
                    </div>
                </article>
            </div>

            @php($nextEvent = $upcomingEvents->first())
            @if ($nextEvent)
                <article class="featured-event-card mt-8">
                    <div class="featured-event-header">
                        <div>
                            <p class="featured-event-label">Featured Event</p>
                            <h3 class="featured-event-title">{{ $nextEvent->title }}</h3>
                            <p class="featured-event-description">{{ $nextEvent->description }}</p>
                        </div>
                        <div class="featured-event-badge">
                            <span class="badge-label">{{ $nextEvent->status }}</span>
                        </div>
                    </div>

                    <div class="featured-event-grid">
                        <div class="featured-event-meta">
                            <div class="meta-icon-wrapper">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="meta-label">Date</p>
                                <p class="meta-value">{{ $nextEvent->date->format('l, F d, Y') }}</p>
                            </div>
                        </div>

                        <div class="featured-event-meta">
                            <div class="meta-icon-wrapper">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="meta-label">Time</p>
                                <p class="meta-value">{{ \Illuminate\Support\Carbon::parse($nextEvent->time)->format('h:i A') }}</p>
                            </div>
                        </div>

                        <div class="featured-event-meta">
                            <div class="meta-icon-wrapper">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="meta-label">Location</p>
                                <p class="meta-value">{{ $nextEvent->venue }}</p>
                            </div>
                        </div>

                        <div class="featured-event-meta">
                            <div class="meta-icon-wrapper">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="meta-label">Attendees</p>
                                <p class="meta-value">{{ $nextEvent->users_count }}/{{ $nextEvent->capacity }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="featured-event-progress">
                        <div class="flex items-center justify-between mb-2">
                            <span class="progress-label">Registration Progress</span>
                            <span class="progress-percentage">{{ $nextEvent->capacity > 0 ? round(($nextEvent->users_count / $nextEvent->capacity) * 100) : 0 }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $nextEvent->capacity > 0 ? ($nextEvent->users_count / $nextEvent->capacity) * 100 : 0 }}%"></div>
                        </div>
                        <p class="progress-hint">{{ $nextEvent->capacity - $nextEvent->users_count }} slots remaining</p>
                    </div>

                    <div class="featured-event-actions">
                        <button type="button"
                            data-view-event
                            data-title="{{ $nextEvent->title }}"
                            data-description="{{ $nextEvent->description }}"
                            data-display-date="{{ $nextEvent->date->format('D, M d, Y') }}"
                            data-display-time="{{ \Illuminate\Support\Carbon::parse($nextEvent->time)->format('h:i A') }}"
                            data-venue="{{ $nextEvent->venue }}"
                            data-capacity="{{ $nextEvent->capacity }}"
                            data-registered="{{ $nextEvent->users_count }}"
                            data-status="{{ $nextEvent->status }}"
                            data-edit-url="{{ route('events.update', $nextEvent) }}"
                            data-edit-date="{{ $nextEvent->date->format('Y-m-d') }}"
                            data-edit-time="{{ \Illuminate\Support\Carbon::parse($nextEvent->time)->format('H:i') }}"
                            class="featured-event-btn featured-event-btn-primary">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View Details
                        </button>
                        <button type="button"
                            data-edit-event
                            data-url="{{ route('events.update', $nextEvent) }}"
                            data-title="{{ $nextEvent->title }}"
                            data-description="{{ $nextEvent->description }}"
                            data-date="{{ $nextEvent->date->format('Y-m-d') }}"
                            data-time="{{ \Illuminate\Support\Carbon::parse($nextEvent->time)->format('H:i') }}"
                            data-venue="{{ $nextEvent->venue }}"
                            data-capacity="{{ $nextEvent->capacity }}"
                            data-status="{{ $nextEvent->status }}"
                            class="featured-event-btn featured-event-btn-secondary">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Event
                        </button>
                    </div>
                </article>
            @endif

            <div class="mt-8">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">All Upcoming Events</h2>
                        <p class="mt-1 text-sm text-white">Manage and monitor all scheduled events</p>
                    </div>
                    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2 text-sm font-semibold text-[#1f4f3f] hover:bg-[#7df7ba] transition">
                        View All Events
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="modern-event-grid">
                    @forelse ($upcomingEvents as $event)
                        <article class="modern-event-card">
                            <div class="event-card-header">
                                <div class="event-date-badge">
                                    <span class="badge-month">{{ $event->date->format('M') }}</span>
                                    <span class="badge-day">{{ $event->date->format('d') }}</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="event-card-title">{{ $event->title }}</h4>
                                    <p class="event-card-subtitle">{{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</p>
                                </div>
                                <button type="button"
                                    data-view-event
                                    data-title="{{ $event->title }}"
                                    data-description="{{ $event->description }}"
                                    data-display-date="{{ $event->date->format('D, M d, Y') }}"
                                    data-display-time="{{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}"
                                    data-venue="{{ $event->venue }}"
                                    data-capacity="{{ $event->capacity }}"
                                    data-registered="{{ $event->users_count }}"
                                    data-status="{{ $event->status }}"
                                    data-edit-url="{{ route('events.update', $event) }}"
                                    data-edit-date="{{ $event->date->format('Y-m-d') }}"
                                    data-edit-time="{{ \Illuminate\Support\Carbon::parse($event->time)->format('H:i') }}"
                                    class="event-card-action">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>

                            <p class="event-card-description">{{ Str::limit($event->description, 85) }}</p>

                            <div class="event-card-meta">
                                <div class="meta-item">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    <span>{{ Str::limit($event->venue, 20) }}</span>
                                </div>
                                <div class="meta-item">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>{{ $event->users_count }}/{{ $event->capacity }}</span>
                                </div>
                            </div>

                            <div class="event-card-progress">
                                <div class="progress-bar-small">
                                    <div class="progress-fill-small" style="width: {{ $event->capacity > 0 ? ($event->users_count / $event->capacity) * 100 : 0 }}%"></div>
                                </div>
                                <p class="progress-text">{{ $event->capacity - $event->users_count }} slots left</p>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-[#b0cfc1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-4 text-sm text-[#5f746d]">No upcoming events scheduled yet.</p>
                            <button type="button" data-add-event class="mt-3 inline-flex items-center gap-2 rounded-lg bg-[#2f9b74] px-4 py-2 text-sm font-semibold text-white hover:bg-[#2a8766] transition">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Create Event
                            </button>
                        </div>
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
                    <p class="text-sm font-semibold text-[#e7f5ef]">{{ now()->format('l, F d, Y') }}</p>
                    <h2 class="student-title">My Event Dashboard</h2>
                    <p class="student-subtitle">Track your next event and discover what is coming up.</p>
                </div>
                <a href="{{ route('events.index') }}" class="student-pale-btn flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Browse Events
                </a>
            </div>

            @if ($nextRegisteredEvent)
                <article class="featured-event-card mt-8">
                    <div class="featured-event-header">
                        <div>
                            <p class="featured-event-label">My Next Event</p>
                            <h3 class="featured-event-title">{{ $nextRegisteredEvent->title }}</h3>
                            <p class="featured-event-description">{{ $nextRegisteredEvent->description }}</p>
                        </div>
                        <div class="featured-event-badge">
                            <span class="badge-label">{{ $nextRegisteredEvent->status }}</span>
                        </div>
                    </div>

                    <div class="featured-event-grid">
                        <div class="featured-event-meta">
                            <div class="meta-icon-wrapper">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="meta-label">Date</p>
                                <p class="meta-value">{{ $nextRegisteredEvent->date->format('l, F d, Y') }}</p>
                            </div>
                        </div>

                        <div class="featured-event-meta">
                            <div class="meta-icon-wrapper">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="meta-label">Time</p>
                                <p class="meta-value">{{ \Illuminate\Support\Carbon::parse($nextRegisteredEvent->time)->format('h:i A') }}</p>
                            </div>
                        </div>

                        <div class="featured-event-meta">
                            <div class="meta-icon-wrapper">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="meta-label">Location</p>
                                <p class="meta-value">{{ $nextRegisteredEvent->venue }}</p>
                            </div>
                        </div>

                        <div class="featured-event-meta">
                            <div class="meta-icon-wrapper">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="meta-label">Attendees</p>
                                <p class="meta-value">{{ $nextRegisteredEvent->users_count }}/{{ $nextRegisteredEvent->capacity }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="featured-event-progress">
                        <div class="flex items-center justify-between mb-2">
                            <span class="progress-label">Registration Progress</span>
                            <span class="progress-percentage">{{ $nextRegisteredEvent->capacity > 0 ? round(($nextRegisteredEvent->users_count / $nextRegisteredEvent->capacity) * 100) : 0 }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $nextRegisteredEvent->capacity > 0 ? ($nextRegisteredEvent->users_count / $nextRegisteredEvent->capacity) * 100 : 0 }}%"></div>
                        </div>
                        <p class="progress-hint">{{ $nextRegisteredEvent->capacity - $nextRegisteredEvent->users_count }} slots remaining</p>
                    </div>

                    <div class="featured-event-actions">
                        <button type="button"
                            data-student-view
                            data-title="{{ $nextRegisteredEvent->title }}"
                            data-description="{{ $nextRegisteredEvent->description }}"
                            data-display-date="{{ $nextRegisteredEvent->date->format('D, M d, Y') }}"
                            data-display-time="{{ \Illuminate\Support\Carbon::parse($nextRegisteredEvent->time)->format('h:i A') }}"
                            data-venue="{{ $nextRegisteredEvent->venue }}"
                            data-capacity="{{ $nextRegisteredEvent->capacity }}"
                            data-registered="{{ $nextRegisteredEvent->users_count }}"
                            data-status="{{ $nextRegisteredEvent->status }}"
                            data-can-register="0"
                            class="featured-event-btn featured-event-btn-primary">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View Details
                        </button>
                    </div>
                </article>
            @endif

            <div class="mt-8">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Upcoming Events</h2>
                        <p class="mt-1 text-sm text-white">Explore and register for events</p>
                    </div>
                    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-200 transition">
                        View All Events
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="modern-event-grid">
                    @forelse ($upcomingEvents as $event)
                        <article class="modern-event-card">
                            <div class="event-card-header">
                                <div class="event-date-badge">
                                    <span class="badge-month">{{ $event->date->format('M') }}</span>
                                    <span class="badge-day">{{ $event->date->format('d') }}</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="event-card-title">{{ $event->title }}</h4>
                                    <p class="event-card-subtitle">{{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</p>
                                </div>
                                <button type="button"
                                    data-student-view
                                    data-title="{{ $event->title }}"
                                    data-description="{{ $event->description }}"
                                    data-display-date="{{ $event->date->format('D, M d, Y') }}"
                                    data-display-time="{{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}"
                                    data-venue="{{ $event->venue }}"
                                    data-capacity="{{ $event->capacity }}"
                                    data-registered="{{ $event->users_count }}"
                                    data-status="{{ $event->status }}"
                                    data-can-register="{{ (!in_array($event->id, $registeredEventIds, true) && !$event->is_full && $event->status === 'scheduled' && !$event->date->isPast()) ? '1' : '0' }}"
                                    data-register-url="{{ route('events.register', $event) }}"
                                    class="event-card-action">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>

                            <p class="event-card-description">{{ Str::limit($event->description, 85) }}</p>

                            <div class="event-card-meta">
                                <div class="meta-item">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    <span>{{ Str::limit($event->venue, 20) }}</span>
                                </div>
                                <div class="meta-item">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>{{ $event->users_count }}/{{ $event->capacity }}</span>
                                </div>
                            </div>

                            <div class="event-card-progress">
                                <div class="progress-bar-small">
                                    <div class="progress-fill-small" style="width: {{ $event->capacity > 0 ? ($event->users_count / $event->capacity) * 100 : 0 }}%"></div>
                                </div>
                                <p class="progress-text">{{ $event->capacity - $event->users_count }} slots left</p>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-[#b0cfc1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-4 text-sm text-[#5f746d]">No upcoming events available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif

    @if ($isAdmin)
    {{-- View Event Modal --}}
    <div id="view-event-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4" aria-modal="true" role="dialog">
        <div class="w-full max-w-xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white p-6 shadow-2xl">
            <div class="mb-4 flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#385e52]">Event Details</p>
                    <h3 id="view-modal-title" class="mt-0.5 text-xl font-extrabold text-[#12221d]"></h3>
                </div>
                <div class="flex shrink-0 items-center gap-2">
                    <span id="view-modal-status" class="rounded-full px-3 py-1 text-xs font-bold"></span>
                    <button type="button" id="close-view-modal" class="rounded-lg p-2 text-[#385e52] hover:bg-[#e8f4ee] transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <p id="view-modal-description" class="mb-5 text-sm text-[#4d655d]"></p>
            <dl class="grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#587068]">Date</dt>
                    <dd id="view-modal-date" class="mt-1 font-semibold text-[#12221d]"></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#587068]">Time</dt>
                    <dd id="view-modal-time" class="mt-1 font-semibold text-[#12221d]"></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#587068]">Venue</dt>
                    <dd id="view-modal-venue" class="mt-1 font-semibold text-[#12221d]"></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#587068]">Registered</dt>
                    <dd id="view-modal-registered" class="mt-1 font-semibold text-[#12221d]"></dd>
                </div>
            </dl>
            <div class="mt-6 flex items-center gap-3">
                <button type="button" id="view-modal-edit-btn" class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Edit Event</button>
                <button type="button" id="cancel-view-modal" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Close</button>
            </div>
        </div>
    </div>

    {{-- Add Event Modal --}}
    <div id="add-event-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4" aria-modal="true" role="dialog"@if($errors->any() && old('_from_add_modal')) data-auto-open="1"@endif>
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white p-6 shadow-2xl">
            <div class="mb-5 flex items-center justify-between">
                <h3 class="text-xl font-extrabold text-[#12221d]">Add Event</h3>
                <button type="button" id="close-add-modal" class="rounded-lg p-2 text-[#385e52] hover:bg-[#e8f4ee] transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('events.store') }}">
                @csrf
                <input type="hidden" name="redirect_to" value="dashboard">
                <input type="hidden" name="_from_add_modal" value="1">
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="form-grid-field md:col-span-2">
                        <label for="add-title" class="block">Title</label>
                        <input id="add-title" name="title" type="text" value="{{ old('title') }}" required>
                        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-grid-field md:col-span-2">
                        <label for="add-description" class="block">Description</label>
                        <textarea id="add-description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-grid-field">
                        <label for="add-date" class="block">Date</label>
                        <input id="add-date" name="date" type="date" value="{{ old('date') }}" required>
                        @error('date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-grid-field">
                        <label for="add-time" class="block">Time</label>
                        <input id="add-time" name="time" type="time" value="{{ old('time') }}" required>
                        @error('time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-grid-field">
                        <label for="add-venue" class="block">Venue</label>
                        <input id="add-venue" name="venue" type="text" value="{{ old('venue') }}" required>
                        @error('venue') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-grid-field">
                        <label for="add-capacity" class="block">Capacity</label>
                        <input id="add-capacity" name="capacity" type="number" min="1" value="{{ old('capacity', 1) }}" required>
                        @error('capacity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-grid-field">
                        <label for="add-status" class="block">Status</label>
                        <select id="add-status" name="status" required>
                            <option value="scheduled" @selected(old('status', 'scheduled') === 'scheduled')>Scheduled</option>
                            <option value="cancelled" @selected(old('status') === 'cancelled')>Cancelled</option>
                        </select>
                        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-6 flex items-center gap-3">
                    <button type="submit" class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Create Event</button>
                    <button type="button" id="cancel-add-modal" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Event Modal --}}
    <div id="edit-event-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4" aria-modal="true" role="dialog">
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white p-6 shadow-2xl">
            <div class="mb-5 flex items-center justify-between">
                <h3 class="text-xl font-extrabold text-[#12221d]">Edit Event</h3>
                <button type="button" id="close-edit-modal" class="rounded-lg p-2 text-[#385e52] hover:bg-[#e8f4ee] transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="edit-event-form" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="redirect_to" value="dashboard">
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="form-grid-field md:col-span-2">
                        <label for="modal-title" class="block">Title</label>
                        <input id="modal-title" name="title" type="text" required>
                    </div>
                    <div class="form-grid-field md:col-span-2">
                        <label for="modal-description" class="block">Description</label>
                        <textarea id="modal-description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-grid-field">
                        <label for="modal-date" class="block">Date</label>
                        <input id="modal-date" name="date" type="date" required>
                    </div>
                    <div class="form-grid-field">
                        <label for="modal-time" class="block">Time</label>
                        <input id="modal-time" name="time" type="time" required>
                    </div>
                    <div class="form-grid-field">
                        <label for="modal-venue" class="block">Venue</label>
                        <input id="modal-venue" name="venue" type="text" required>
                    </div>
                    <div class="form-grid-field">
                        <label for="modal-capacity" class="block">Capacity</label>
                        <input id="modal-capacity" name="capacity" type="number" min="1" required>
                    </div>
                    <div class="form-grid-field">
                        <label for="modal-status" class="block">Status</label>
                        <select id="modal-status" name="status" required>
                            <option value="scheduled">Scheduled</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex items-center gap-3">
                    <button type="submit" class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Update Event</button>
                    <button type="button" id="cancel-edit-modal" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function show(el) { el.classList.remove('hidden'); el.classList.add('flex'); document.body.style.overflow = 'hidden'; }
        function hide(el) { el.classList.add('hidden'); el.classList.remove('flex'); document.body.style.overflow = ''; }

        // ── View modal ──
        const viewModal = document.getElementById('view-event-modal');
        let currentViewSrc = null;
        document.querySelectorAll('[data-view-event]').forEach(btn => {
            btn.addEventListener('click', () => {
                currentViewSrc = btn;
                document.getElementById('view-modal-title').textContent = btn.dataset.title;
                document.getElementById('view-modal-description').textContent = btn.dataset.description;
                document.getElementById('view-modal-date').textContent = btn.dataset.displayDate;
                document.getElementById('view-modal-time').textContent = btn.dataset.displayTime;
                document.getElementById('view-modal-venue').textContent = btn.dataset.venue;
                document.getElementById('view-modal-registered').textContent = btn.dataset.registered + ' / ' + btn.dataset.capacity;
                const badge = document.getElementById('view-modal-status');
                badge.textContent = btn.dataset.status.charAt(0).toUpperCase() + btn.dataset.status.slice(1);
                badge.className = 'rounded-full px-3 py-1 text-xs font-bold ' + (btn.dataset.status === 'scheduled' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700');
                show(viewModal);
            });
        });
        document.getElementById('close-view-modal').addEventListener('click', () => hide(viewModal));
        document.getElementById('cancel-view-modal').addEventListener('click', () => hide(viewModal));
        viewModal.addEventListener('click', e => { if (e.target === viewModal) hide(viewModal); });

        // ── Edit modal ──
        const editModal = document.getElementById('edit-event-modal');
        const editForm = document.getElementById('edit-event-form');
        function openEdit(src) {
            editForm.action = src.dataset.editUrl || src.dataset.url;
            document.getElementById('modal-title').value = src.dataset.title;
            document.getElementById('modal-description').value = src.dataset.description;
            document.getElementById('modal-date').value = src.dataset.editDate || src.dataset.date;
            document.getElementById('modal-time').value = src.dataset.editTime || src.dataset.time;
            document.getElementById('modal-venue').value = src.dataset.venue;
            document.getElementById('modal-capacity').value = src.dataset.capacity;
            document.getElementById('modal-status').value = src.dataset.status;
            show(editModal);
        }
        document.querySelectorAll('[data-edit-event]').forEach(btn => {
            btn.addEventListener('click', () => openEdit(btn));
        });
        document.getElementById('view-modal-edit-btn').addEventListener('click', () => {
            if (!currentViewSrc) return;
            hide(viewModal);
            openEdit(currentViewSrc);
        });
        document.getElementById('close-edit-modal').addEventListener('click', () => hide(editModal));
        document.getElementById('cancel-edit-modal').addEventListener('click', () => hide(editModal));
        editModal.addEventListener('click', e => { if (e.target === editModal) hide(editModal); });

        // ── Add modal ──
        const addModal = document.getElementById('add-event-modal');
        document.querySelectorAll('[data-add-event]').forEach(btn => {
            btn.addEventListener('click', () => show(addModal));
        });
        document.getElementById('close-add-modal').addEventListener('click', () => hide(addModal));
        document.getElementById('cancel-add-modal').addEventListener('click', () => hide(addModal));
        addModal.addEventListener('click', e => { if (e.target === addModal) hide(addModal); });
        if (addModal.dataset.autoOpen) show(addModal);
    });
    </script>
    @endif

    @unless ($isAdmin)
    {{-- Student View Event Modal --}}
    <div id="sv-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4" aria-modal="true" role="dialog">
        <div class="w-full max-w-xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white p-6 shadow-2xl">
            <div class="mb-4 flex items-start justify-between gap-3">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#385e52]">Event Details</p>
                    <h3 id="sv-title" class="mt-0.5 text-xl font-extrabold text-[#12221d]"></h3>
                </div>
                <div class="flex shrink-0 items-center gap-2">
                    <span id="sv-status" class="rounded-full px-3 py-1 text-xs font-bold"></span>
                    <button type="button" id="close-sv-modal" class="rounded-lg p-2 text-[#385e52] hover:bg-[#e8f4ee] transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <p id="sv-description" class="mb-5 text-sm text-[#4d655d]"></p>
            <dl class="grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#587068]">Date</dt>
                    <dd id="sv-date" class="mt-1 font-semibold text-[#12221d]"></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#587068]">Time</dt>
                    <dd id="sv-time" class="mt-1 font-semibold text-[#12221d]"></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#587068]">Venue</dt>
                    <dd id="sv-venue" class="mt-1 font-semibold text-[#12221d]"></dd>
                </div>
                <div>
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#587068]">Registered</dt>
                    <dd id="sv-registered" class="mt-1 font-semibold text-[#12221d]"></dd>
                </div>
            </dl>
            <div class="mt-6 flex items-center gap-3">
                <form id="sv-register-form" method="POST" class="hidden">
                    @csrf
                    <button type="submit" class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Register</button>
                </form>
                <button type="button" id="cancel-sv-modal" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Close</button>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function showSV(el) { el.classList.remove('hidden'); el.classList.add('flex'); document.body.style.overflow = 'hidden'; }
        function hideSV(el) { el.classList.add('hidden'); el.classList.remove('flex'); document.body.style.overflow = ''; }
        const svModal = document.getElementById('sv-modal');
        if (!svModal) return;

        document.querySelectorAll('[data-student-view]').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('sv-title').textContent = btn.dataset.title;
                document.getElementById('sv-description').textContent = btn.dataset.description;
                document.getElementById('sv-date').textContent = btn.dataset.displayDate;
                document.getElementById('sv-time').textContent = btn.dataset.displayTime;
                document.getElementById('sv-venue').textContent = btn.dataset.venue;
                document.getElementById('sv-registered').textContent = btn.dataset.registered + ' / ' + btn.dataset.capacity;
                const badge = document.getElementById('sv-status');
                badge.textContent = btn.dataset.status.charAt(0).toUpperCase() + btn.dataset.status.slice(1);
                badge.className = 'rounded-full px-3 py-1 text-xs font-bold ' + (btn.dataset.status === 'scheduled' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700');
                const regForm = document.getElementById('sv-register-form');
                if (btn.dataset.canRegister === '1' && btn.dataset.registerUrl) {
                    regForm.action = btn.dataset.registerUrl;
                    regForm.classList.remove('hidden');
                } else {
                    regForm.classList.add('hidden');
                }
                showSV(svModal);
            });
        });

        document.getElementById('close-sv-modal').addEventListener('click', () => hideSV(svModal));
        document.getElementById('cancel-sv-modal').addEventListener('click', () => hideSV(svModal));
        svModal.addEventListener('click', e => { if (e.target === svModal) hideSV(svModal); });
    });
    </script>
    @endunless
</x-app-layout>
