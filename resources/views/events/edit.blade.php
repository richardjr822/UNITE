<x-app-layout>
    <x-slot name="header">
        <h2 class="sr-only">Edit Event</h2>
    </x-slot>

    <section class="student-canvas">
        <div class="max-w-5xl mx-auto">
            <div class="surface-card">
                <p class="student-kicker">Admin</p>
                <h3 class="text-3xl font-extrabold text-[#12221d]">Edit Event</h3>
                <p class="mt-1 text-sm text-[#4d655d]">Update details, status, capacity, and schedule accurately.</p>
                <form method="POST" action="{{ route('events.update', $event) }}">
                    @method('PUT')
                    @include('events._form', ['buttonText' => 'Update Event'])
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
