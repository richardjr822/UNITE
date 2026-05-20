<x-app-layout>
    <x-slot name="header">
        <h2 class="sr-only">Event Details</h2>
    </x-slot>

    <section class="student-canvas">
        <div class="max-w-4xl mx-auto space-y-6">
            @if (session('status'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 flex items-start gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @if ($errors->has('registration'))
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 flex items-start gap-3">
                    <svg class="h-5 w-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div>{{ $errors->first('registration') }}</div>
                </div>
            @endif

            <!-- Event Header Card -->
            <article class="featured-event-card">
                <div class="featured-event-header">
                    <div>
                        <p class="featured-event-label">Event Details</p>
                        <h1 class="featured-event-title">{{ $event->title }}</h1>
                        <p class="featured-event-description">{{ $event->description }}</p>
                    </div>
                    <div class="featured-event-badge">
                        <span class="inline-flex rounded-full px-4 py-2 text-sm font-bold {{ $event->status === 'scheduled' ? 'bg-[#e8f5ee] text-[#2f9b74]' : 'bg-amber-100 text-amber-700' }}">
                            {{ ucfirst($event->status) }}
                        </span>
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
                            <p class="meta-value">{{ $event->date->format('l, F d, Y') }}</p>
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
                            <p class="meta-value">{{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</p>
                        </div>
                    </div>

                    <div class="featured-event-meta">
                        <div class="meta-icon-wrapper">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="meta-label">Venue</p>
                            <p class="meta-value">{{ $event->venue }}</p>
                        </div>
                    </div>

                    <div class="featured-event-meta">
                        <div class="meta-icon-wrapper">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="meta-label">Capacity</p>
                            <p class="meta-value">{{ $event->users_count }}/{{ $event->capacity }}</p>
                        </div>
                    </div>
                </div>

                <div class="featured-event-progress">
                    <div class="flex items-center justify-between mb-2">
                        <span class="progress-label">Registration Progress</span>
                        <span class="progress-percentage">{{ $event->capacity > 0 ? round(($event->users_count / $event->capacity) * 100) : 0 }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $event->capacity > 0 ? ($event->users_count / $event->capacity) * 100 : 0 }}%"></div>
                    </div>
                    <p class="progress-hint">{{ $event->available_slots }} slots available</p>
                </div>

                <div class="featured-event-actions flex-col md:flex-row">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-[#d6e5df] px-6 py-3 font-semibold text-[#2f9b74] hover:bg-[#f3f7f5] transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Events
                    </a>

                    @if ($isAdmin)
                        <a href="{{ route('events.edit', $event) }}" class="featured-event-btn featured-event-btn-primary">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Event
                        </a>
                    @else
                        @if ($event->status !== 'scheduled' || $event->date->isPast())
                            <span class="inline-flex items-center justify-center rounded-xl bg-[#f0f4f2] px-6 py-3 font-semibold text-[#5f746d]">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Registration Closed
                            </span>
                        @elseif ($alreadyRegistered)
                            <form method="POST" action="{{ route('events.unregister', $event) }}" data-confirm-submit data-confirm-title="Cancel Registration" data-confirm-message="Cancel your registration for {{ $event->title }}?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#ff9800] px-6 py-3 font-semibold text-white hover:bg-[#f57c00] transition">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancel Registration
                                </button>
                            </form>
                        @elseif ($event->is_full)
                            <span class="inline-flex items-center justify-center rounded-xl bg-red-100 px-6 py-3 font-semibold text-red-700">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2m0-4a2 2 0 100-4 2 2 0 000 4zm0-6a2 2 0 100-4 2 2 0 000 4zm0 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                Event Full
                            </span>
                        @else
                            <form method="POST" action="{{ route('events.register', $event) }}" class="contents">
                                @csrf
                                <button type="submit" class="featured-event-btn featured-event-btn-primary">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    Register for Event
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </article>

            @if ($isAdmin)
                <!-- Participants Section -->
                <article class="rounded-2xl border border-[#d6e5df] bg-white p-6 md:p-8 shadow">
                    <h2 class="text-2xl font-bold text-[#112a21] mb-6 flex items-center gap-2">
                        <svg class="h-6 w-6 text-[#2f9b74]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0zM6 20h12v-2a4 4 0 00-8 0v2z" />
                        </svg>
                        Registered Participants
                    </h2>

                    @if ($event->users->isEmpty())
                        <div class="py-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-[#b0cfc1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0zM6 20h12v-2a4 4 0 00-8 0v2z" />
                            </svg>
                            <p class="mt-4 text-sm text-[#5f746d]">No participants registered yet.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-[#e8f4ee]">
                                <thead>
                                    <tr class="bg-[#f3faf6]">
                                        <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-[#385e52]">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-[#385e52]">Email</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#e8f4ee]">
                                    @foreach ($event->users as $participant)
                                        <tr class="hover:bg-[#f8fdfb] transition-colors">
                                            <td class="px-6 py-4 text-sm font-semibold text-[#1b3a2f]">{{ $participant->name }}</td>
                                            <td class="px-6 py-4 text-sm text-[#385e52]">{{ $participant->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </article>
            @endif
        </div>
    </section>
</x-app-layout>
