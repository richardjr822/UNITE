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
                    <div class="flex items-center gap-4">
                        <div class="stat-icon-wrapper stat-icon-week">
                            <svg class="dashboard-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="admin-stat-label">Events This Week</p>
                            <p class="admin-stat-value">{{ $eventsThisWeek }}</p>
                        </div>
                    </div>
                </article>
                
                <article class="admin-stat-card">
                    <div class="flex items-center gap-4">
                        <div class="stat-icon-wrapper stat-icon-month">
                            <svg class="dashboard-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="admin-stat-label">Events This Month</p>
                            <p class="admin-stat-value">{{ $eventsThisMonth }}</p>
                        </div>
                    </div>
                </article>
                
                <article class="admin-stat-card">
                    <div class="flex items-center gap-4">
                        <div class="stat-icon-wrapper stat-icon-upcoming">
                            <svg class="dashboard-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="admin-stat-label">Scheduled Upcoming</p>
                            <p class="admin-stat-value">{{ $upcomingEvents->count() }}</p>
                        </div>
                    </div>
                </article>
            </div>

            @php($nextEvent = $upcomingEvents->first())
            @if ($nextEvent)
                <article class="student-card mt-6">
                    <p class="student-kicker">Next Up</p>
                    <h3 class="student-event-title">{{ $nextEvent->title }}</h3>
                    <p class="student-event-copy">{{ $nextEvent->description }}</p>
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $nextEvent->date->format('D, M d, Y') }}</span>
                    </div>
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ \Illuminate\Support\Carbon::parse($nextEvent->time)->format('h:i A') }}</span>
                    </div>
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <span>{{ $nextEvent->venue }}</span>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('events.show', $nextEvent) }}" class="student-event-action">View Details</a>
                        <a href="{{ route('events.edit', $nextEvent) }}" class="rounded-full bg-[#2d8f6a] mt-3 px-6 py-2 text-sm font-bold text-white shadow">Edit Event</a>
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
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('events.show', $event) }}" class="student-mini-btn">View</a>
                                    <a href="{{ route('events.edit', $event) }}" class="rounded-full bg-[#dff2ea] px-4 py-1.5 text-xs font-bold text-[#1b6b50]">Edit</a>
                                </div>
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
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $nextRegisteredEvent->date->format('D, M d, Y') }}</span>
                    </div>
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ \Illuminate\Support\Carbon::parse($nextRegisteredEvent->time)->format('h:i A') }}</span>
                    </div>
                    <div class="event-meta-item">
                        <svg class="event-meta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <span>{{ $nextRegisteredEvent->venue }}</span>
                    </div>
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
                                <a href="{{ route('events.show', $event) }}" class="student-mini-btn w-full text-center">View Event</a>
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
