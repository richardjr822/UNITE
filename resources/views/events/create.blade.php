<x-app-layout>
    <x-slot name="header">
        <h2 class="sr-only">Create Event</h2>
    </x-slot>

    <section class="student-canvas">
        <div class="max-w-5xl mx-auto">
            <div class="surface-card">
                <p class="student-kicker">Admin</p>
                <h3 class="text-3xl font-extrabold text-[#12221d]">Create Event</h3>
                <p class="mt-1 text-sm text-[#4d655d]">Add full event details for students to discover and register.</p>
                <form method="POST" action="{{ route('events.store') }}">
                    @include('events._form', ['buttonText' => 'Create Event'])
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
