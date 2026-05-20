<x-app-layout>
    <x-slot name="header">
        <h2 class="sr-only">My Registrations</h2>
    </x-slot>

    <section class="student-canvas">
        <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between mb-6">
            <div>
                <p class="text-sm font-semibold text-[#e7f5ef]">{{ now()->format('l, F d, Y') }}</p>
                <h2 class="student-title">My Event Registrations</h2>
                <p class="student-subtitle">Manage and track your registered events.</p>
            </div>
            <a href="{{ route('events.index') }}" class="student-pale-btn flex items-center gap-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Browse Events
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

        <form method="GET" action="{{ route('events.registrations') }}" class="student-filter-bar mb-6">
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
            @forelse ($registrations as $event)
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
                            data-can-register="0"
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
                            class="flex-1 rounded-lg border-2 border-[#d6e5df] py-2 px-3 text-center text-xs font-bold text-[#2f9b74] hover:bg-[#f3f7f5] transition">View Details</button>
                        <form method="POST" action="{{ route('events.unregister', $event) }}" data-confirm-submit data-confirm-title="Cancel Registration" data-confirm-message="Cancel your registration for {{ $event->title }}?" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full rounded-lg bg-[#ff9800] hover:bg-[#f57c00] py-2 px-3 text-center text-xs font-bold text-white transition">Unregister</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-[#b0cfc1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-sm text-[#5f746d]">You have no event registrations yet.</p>
                    <a href="{{ route('events.index') }}" class="mt-3 inline-flex items-center gap-2 rounded-lg bg-[#2f9b74] px-4 py-2 text-sm font-semibold text-white hover:bg-[#2a8766] transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Browse Events
                    </a>
                </div>
            @endforelse
        </div>
        @if ($registrations->hasPages())
            <div class="mt-5 flex items-center justify-between gap-4">
                <p class="text-sm text-white/70">
                    Showing {{ $registrations->firstItem() }}–{{ $registrations->lastItem() }} of {{ $registrations->total() }} events
                </p>
                <div class="flex items-center gap-1">
                    @if ($registrations->onFirstPage())
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-white/30 cursor-not-allowed">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </span>
                    @else
                        <a href="{{ $registrations->previousPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white/10 border border-white/30 text-white hover:bg-white/20 transition">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </a>
                    @endif
                    @foreach ($registrations->getUrlRange(max(1, $registrations->currentPage() - 2), min($registrations->lastPage(), $registrations->currentPage() + 2)) as $page => $url)
                        @if ($page === $registrations->currentPage())
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white text-xs font-bold text-[#1f4f3f]">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white/10 border border-white/30 text-xs font-semibold text-white hover:bg-white/20 transition">{{ $page }}</a>
                        @endif
                    @endforeach
                    @if ($registrations->hasMorePages())
                        <a href="{{ $registrations->nextPageUrl() }}" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white/10 border border-white/30 text-white hover:bg-white/20 transition">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @else
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-white/30 cursor-not-allowed">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </section>

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
</x-app-layout>
