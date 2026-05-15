<x-app-layout>
    <x-slot name="header">
        <h2 class="sr-only">Event Details</h2>
    </x-slot>

    <section class="student-canvas">
        <div class="max-w-6xl mx-auto space-y-6">
            @if (session('status'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->has('registration'))
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first('registration') }}
                </div>
            @endif

            <section class="surface-card">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <p class="student-kicker">Event Details</p>
                        <h3 class="text-3xl font-extrabold text-[#13221e]">{{ $event->title }}</h3>
                        <p class="mt-2 text-[#49625a]">{{ $event->description }}</p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-sm {{ $event->status === 'scheduled' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <dl class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <dt class="text-sm text-[#587068]">Date</dt>
                        <dd class="text-[#172924] font-semibold">{{ $event->date->format('M d, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-[#587068]">Time</dt>
                        <dd class="text-[#172924] font-semibold">{{ \Illuminate\Support\Carbon::parse($event->time)->format('h:i A') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-[#587068]">Venue</dt>
                        <dd class="text-[#172924] font-semibold">{{ $event->venue }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-[#587068]">Capacity</dt>
                        <dd class="text-[#172924] font-semibold">{{ $event->users_count }} / {{ $event->capacity }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <p class="text-sm text-gray-600">Available slots: <span class="font-semibold text-gray-800">{{ $event->available_slots }}</span></p>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Back to Events</a>

                    @if ($isAdmin)
                        <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Edit Event</a>
                    @else
                        @if ($event->status !== 'scheduled' || $event->date->isPast())
                            <span class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-600">Registration Closed</span>
                        @elseif ($alreadyRegistered)
                            <form method="POST" action="{{ route('events.unregister', $event) }}" data-confirm-submit data-confirm-title="Cancel Registration" data-confirm-message="Cancel your registration for {{ $event->title }}?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center rounded-md bg-amber-600 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-700">Cancel Registration</button>
                            </form>
                        @elseif ($event->is_full)
                            <span class="inline-flex items-center rounded-md bg-red-100 px-4 py-2 text-sm font-semibold text-red-700">Event Full</span>
                        @else
                            <form method="POST" action="{{ route('events.register', $event) }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Register for Event</button>
                            </form>
                        @endif
                    @endif
                </div>
            </section>

            @if ($isAdmin)
                <section class="surface-card">
                    <h4 class="text-lg font-semibold text-[#14241f]">Registered Participants</h4>
                    @if ($event->users->isEmpty())
                        <p class="mt-2 text-sm text-[#52655f]">No participants registered yet.</p>
                    @else
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead>
                                    <tr class="text-left text-gray-500">
                                        <th class="px-3 py-2">Name</th>
                                        <th class="px-3 py-2">Email</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-700">
                                    @foreach ($event->users as $participant)
                                        <tr>
                                            <td class="px-3 py-2">{{ $participant->name }}</td>
                                            <td class="px-3 py-2">{{ $participant->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </section>
            @endif
        </div>
    </section>
</x-app-layout>
