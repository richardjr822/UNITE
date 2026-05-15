@csrf

<div class="grid gap-5 md:grid-cols-2">
    <div class="form-grid-field md:col-span-2">
        <label for="title" class="block">Title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $event->title ?? '') }}" required>
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-grid-field md:col-span-2">
        <label for="description" class="block">Description</label>
        <textarea id="description" name="description" rows="4" required>{{ old('description', $event->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-grid-field">
        <label for="date" class="block">Date</label>
        <input id="date" name="date" type="date" value="{{ old('date', isset($event) ? $event->date?->format('Y-m-d') : '') }}" required>
        @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-grid-field">
        <label for="time" class="block">Time</label>
        <input id="time" name="time" type="time" value="{{ old('time', isset($event) ? \Illuminate\Support\Carbon::parse($event->time)->format('H:i') : '') }}" required>
        @error('time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-grid-field">
        <label for="venue" class="block">Venue</label>
        <input id="venue" name="venue" type="text" value="{{ old('venue', $event->venue ?? '') }}" required>
        @error('venue')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-grid-field">
        <label for="capacity" class="block">Capacity</label>
        <input id="capacity" name="capacity" type="number" min="1" value="{{ old('capacity', $event->capacity ?? 1) }}" required>
        @error('capacity')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-grid-field">
        <label for="status" class="block">Status</label>
        <select id="status" name="status" required>
            @php($status = old('status', $event->status ?? 'scheduled'))
            <option value="scheduled" @selected($status === 'scheduled')>Scheduled</option>
            <option value="cancelled" @selected($status === 'cancelled')>Cancelled</option>
        </select>
        @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">{{ $buttonText }}</button>
    <a href="{{ route('events.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Cancel</a>
</div>
