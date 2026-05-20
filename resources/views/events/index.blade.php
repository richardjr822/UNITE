<x-app-layout>
    @if ($isAdmin)
        <x-slot name="header">
            <h2 class="sr-only">Admin Events</h2>
        </x-slot>

        <section class="student-canvas">
            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between mb-6">
                <div>
                    <p class="text-sm font-semibold text-[#e7f5ef]">{{ now()->format('l, F d, Y') }}</p>
                    <h2 class="student-title">Events Management</h2>
                    <p class="student-subtitle">View, create, and manage all events in your system.</p>
                </div>
                <button type="button" data-add-event class="student-pale-btn flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Event
                </button>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 flex items-start gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            <div class="admin-tools-wrap mb-6">
                <form method="GET" action="{{ route('events.index') }}" class="student-filter-bar mb-0">
                    <div class="flex-1">
                        <input type="search" name="q" value="{{ $search }}" placeholder="Search by event name..." class="student-search w-full">
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="student-chip-row">
                            <button type="submit" name="status" value="all" class="student-chip {{ $statusFilter === 'all' ? 'is-active' : '' }}">All</button>
                            <button type="submit" name="status" value="ongoing" class="student-chip {{ $statusFilter === 'ongoing' ? 'is-active' : '' }}">Ongoing</button>
                            <button type="submit" name="status" value="upcoming" class="student-chip {{ $statusFilter === 'upcoming' ? 'is-active' : '' }}">Upcoming</button>
                            <button type="submit" name="status" value="done" class="student-chip {{ $statusFilter === 'done' ? 'is-active' : '' }}">Done</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="overflow-hidden rounded-2xl border border-[#d6e5df] bg-white shadow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#e8f4ee]">
                        <thead>
                            <tr class="bg-[#f3faf6]">
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#385e52]">Event</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#385e52]">Date & Time</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#385e52]">Venue</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#385e52]">Attendees</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-[#385e52]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e8f4ee]">
                            @forelse ($events as $event)
                                <tr class="hover:bg-[#f8fdfb] transition-colors">
                                    <td class="px-6 py-4">
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
                                            class="text-left font-semibold text-[#2f9b74] hover:underline">{{ $event->title }}</button>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[#385e52]">
                                        <div class="flex items-center gap-1">
                                            <svg class="h-4 w-4 text-[#2f9b74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $event->date->format('M d, Y') }}
                                        </div>
                                        <div class="flex items-center gap-1 mt-1">
                                            <svg class="h-4 w-4 text-[#2f9b74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[#385e52]">
                                        <div class="flex items-center gap-1">
                                            <svg class="h-4 w-4 text-[#2f9b74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            </svg>
                                            {{ $event->venue }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="inline-flex items-center gap-2 rounded-full bg-[#e8f5ee] px-3 py-1">
                                            <svg class="h-4 w-4 text-[#2f9b74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <span class="text-xs font-bold text-[#2f9b74]">{{ $event->users_count }}/{{ $event->capacity }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
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
                                                class="inline-flex items-center justify-center rounded-lg p-2 text-[#385e52] hover:bg-[#e8f4ee] transition-colors" title="View details">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button type="button"
                                                data-edit-event
                                                data-url="{{ route('events.update', $event) }}"
                                                data-title="{{ $event->title }}"
                                                data-description="{{ $event->description }}"
                                                data-date="{{ $event->date->format('Y-m-d') }}"
                                                data-time="{{ \Illuminate\Support\Carbon::parse($event->time)->format('H:i') }}"
                                                data-venue="{{ $event->venue }}"
                                                data-capacity="{{ $event->capacity }}"
                                                data-status="{{ $event->status }}"
                                                class="inline-flex items-center justify-center rounded-lg p-2 text-[#385e52] hover:bg-[#e8f4ee] transition-colors" title="Edit">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                            <form method="POST" action="{{ route('events.destroy', $event) }}" data-confirm-submit data-confirm-title="Delete Event" data-confirm-message="Delete {{ $event->title }}? This action cannot be undone." class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center rounded-lg p-2 text-[#c43e3e] hover:bg-[#ffe8e8] transition-colors" title="Delete">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-[#b0cfc1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mt-4 text-sm text-[#5f746d]">No events matched your filters.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @else
        <x-slot name="header">
            <h2 class="sr-only">Student Events</h2>
        </x-slot>

        <section class="student-canvas">
            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between mb-6">
                <div>
                    <p class="text-sm font-semibold text-[#e7f5ef]">{{ now()->format('l, F d, Y') }}</p>
                    <h2 class="student-title">Discover Events</h2>
                    <p class="student-subtitle">Browse and register for upcoming events.</p>
                </div>
                <a href="{{ route('events.registrations') }}" class="student-pale-btn flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    My Registrations
                </a>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 flex items-start gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @if ($errors->has('registration'))
                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 flex items-start gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div>{{ $errors->first('registration') }}</div>
                </div>
            @endif

            <form method="GET" action="{{ route('events.index') }}" class="student-filter-bar mb-6">
                <div class="flex-1">
                    <input type="search" name="q" value="{{ $search }}" placeholder="Search by event name..." class="student-search w-full">
                </div>
                <div class="student-chip-row">
                    <button type="submit" name="status" value="all" class="student-chip {{ $statusFilter === 'all' ? 'is-active' : '' }}">All</button>
                    <button type="submit" name="status" value="ongoing" class="student-chip {{ $statusFilter === 'ongoing' ? 'is-active' : '' }}">Ongoing</button>
                    <button type="submit" name="status" value="upcoming" class="student-chip {{ $statusFilter === 'upcoming' ? 'is-active' : '' }}">Upcoming</button>
                    <button type="submit" name="status" value="done" class="student-chip {{ $statusFilter === 'done' ? 'is-active' : '' }}">Done</button>
                </div>
            </form>

            <div class="modern-event-grid">
                @forelse ($events as $event)
                    <article class="modern-event-card">
                        <div class="event-card-header">
                            <div class="event-date-badge">
                                <span class="badge-month">{{ $event->date->format('M') }}</span>
                                <span class="badge-day">{{ $event->date->format('d') }}</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="event-card-title">{{ $event->title }}</h4>
                                <p class="event-card-subtitle">{{ strtoupper($event->status === 'scheduled' ? ($event->date->isToday() ? 'ongoing' : ($event->date->isFuture() ? 'upcoming' : 'done')) : 'done') }}</p>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </button>
                        </div>

                        <p class="event-card-description">{{ Str::limit($event->description, 85) }}</p>

                        <div class="event-card-meta">
                            <div class="meta-item">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</span>
                            </div>
                            <div class="meta-item">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <span class="truncate">{{ Str::limit($event->venue, 20) }}</span>
                            </div>
                        </div>

                        <div class="event-card-progress">
                            <div class="progress-bar-small">
                                <div class="progress-fill-small" style="width: {{ $event->capacity > 0 ? ($event->users_count / $event->capacity) * 100 : 0 }}%"></div>
                            </div>
                            <p class="progress-text">{{ $event->users_count }}/{{ $event->capacity }} • {{ $event->capacity - $event->users_count }} slots</p>
                        </div>

                        <div class="flex gap-2 pt-4 border-t border-[#e8f4ee]">
                            @if (in_array($event->id, $registeredEventIds, true))
                                <span class="flex-1 rounded-lg bg-[#e8f5ee] py-2 px-3 text-center text-xs font-bold text-[#2f9b74]">Registered</span>
                            @elseif ($event->is_full || $event->status !== 'scheduled' || $event->date->isPast())
                                <span class="flex-1 rounded-lg bg-[#f0f4f2] py-2 px-3 text-center text-xs font-bold text-[#5f746d]">Unavailable</span>
                            @else
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
                                    data-can-register="1"
                                    data-register-url="{{ route('events.register', $event) }}"
                                    class="flex-1 rounded-lg bg-gradient-to-r from-[#4eb98a] to-[#2a8d6a] py-2 px-3 text-center text-xs font-bold text-white hover:brightness-105 transition">Register</button>
                            @endif

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
                                data-can-register="0"
                                class="flex-1 rounded-lg border-2 border-[#d6e5df] py-2 px-3 text-center text-xs font-bold text-[#2f9b74] hover:bg-[#f3f7f5] transition">View</button>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-[#b0cfc1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-4 text-sm text-[#5f746d]">No events matched your filters.</p>
                    </div>
                @endforelse
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
                <input type="hidden" name="redirect_to" value="events">
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
                <input type="hidden" name="redirect_to" value="events">
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
