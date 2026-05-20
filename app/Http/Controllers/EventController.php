<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $search = trim((string) request('q', ''));
        $statusFilter = (string) request('status', 'all');

        $eventQuery = Event::query()->withCount('users');

        if ($search !== '') {
            $eventQuery->where(function ($query) use ($search): void {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhere('venue', 'like', '%'.$search.'%');
            });
        }

        $today = now()->toDateString();
        if ($statusFilter === 'ongoing') {
            $eventQuery->whereDate('date', '=', $today)
                ->where('status', 'scheduled');
        } elseif ($statusFilter === 'upcoming') {
            $eventQuery->whereDate('date', '>', $today)
                ->where('status', 'scheduled');
        } elseif ($statusFilter === 'done') {
            $eventQuery->where(function ($query) use ($today): void {
                $query->whereDate('date', '<', $today)
                    ->orWhere('status', 'cancelled');
            });
        }

        $events = $eventQuery
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $upcomingEvents = Event::query()
            ->upcoming()
            ->withCount('users')
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $registeredEventIds = $user->role === 'student'
            ? $user->events()->pluck('events.id')->all()
            : [];

        return view('events.index', [
            'events' => $events,
            'upcomingEvents' => $upcomingEvents,
            'isAdmin' => $user->role === 'admin',
            'search' => $search,
            'statusFilter' => $statusFilter,
            'registeredEventIds' => $registeredEventIds,
        ]);
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('events.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'venue' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:scheduled,cancelled'],
        ]);

        Event::create($validated);

        $redirectRoute = $request->input('redirect_to') === 'dashboard'
            ? 'dashboard'
            : 'events.index';

        return redirect()
            ->route($redirectRoute)
            ->with('status', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $event->loadCount('users');

        if ($currentUser->role === 'admin') {
            $event->load(['users' => function ($query): void {
                $query->select('users.id', 'users.name', 'users.email')
                    ->withPivot('created_at')
                    ->orderByPivot('created_at', 'asc');
            }]);
        }

        $alreadyRegistered = $currentUser->events()
            ->where('event_id', $event->id)
            ->exists();

        return view('events.show', [
            'event' => $event,
            'alreadyRegistered' => $alreadyRegistered,
            'isAdmin' => $currentUser->role === 'admin',
        ]);
    }

    public function edit(Event $event)
    {
        $this->ensureAdmin();

        return view('events.edit', [
            'event' => $event,
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'venue' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:scheduled,cancelled'],
        ]);

        $event->update($validated);

        $redirectRoute = $request->input('redirect_to') === 'dashboard'
            ? 'dashboard'
            : 'events.index';

        return redirect()
            ->route($redirectRoute)
            ->with('status', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $this->ensureAdmin();

        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('status', 'Event deleted successfully.');
    }

    public function register(Event $event)
    {
        $this->ensureStudent();

        if ($event->status !== 'scheduled') {
            return back()->withErrors(['registration' => 'You can only register for scheduled events.']);
        }

        if ($event->date->isPast()) {
            return back()->withErrors(['registration' => 'You cannot register for past events.']);
        }

        /** @var User $user */
        $user = Auth::user();

        $alreadyRegistered = $user->events()->where('event_id', $event->id)->exists();
        if ($alreadyRegistered) {
            return back()->withErrors(['registration' => 'You are already registered for this event.']);
        }

        DB::transaction(function () use ($event, $user): void {
            $eventWithCount = Event::query()
                ->whereKey($event->id)
                ->lockForUpdate()
                ->withCount('users')
                ->firstOrFail();

            if ($eventWithCount->users_count >= $eventWithCount->capacity) {
                throw ValidationException::withMessages([
                    'registration' => 'Event is already full.',
                ]);
            }

            $user->events()->attach($event->id);
        });

        return back()->with('status', 'Registration successful.');
    }

    public function unregister(Event $event)
    {
        $this->ensureStudent();

        /** @var User $user */
        $user = Auth::user();
        $user->events()->detach($event->id);

        return back()->with('status', 'You have been removed from this event.');
    }

    public function registrations()
    {
        $this->ensureStudent();

        /** @var User $user */
        $user = Auth::user();

        $search = trim((string) request('q', ''));
        $statusFilter = (string) request('status', 'all');

        $query = $user->events()->withCount('users');

        if ($search !== '') {
            $query->where(function ($subQuery) use ($search): void {
                $subQuery->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhere('venue', 'like', '%'.$search.'%');
            });
        }

        $today = now()->toDateString();
        if ($statusFilter === 'ongoing') {
            $query->whereDate('date', '=', $today)
                ->where('status', 'scheduled');
        } elseif ($statusFilter === 'upcoming') {
            $query->whereDate('date', '>', $today)
                ->where('status', 'scheduled');
        } elseif ($statusFilter === 'done') {
            $query->where(function ($subQuery) use ($today): void {
                $subQuery->whereDate('date', '<', $today)
                    ->orWhere('status', 'cancelled');
            });
        }

        $registrations = $query
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        return view('events.registrations', [
            'registrations' => $registrations,
            'search' => $search,
            'statusFilter' => $statusFilter,
        ]);
    }

    private function ensureAdmin(): void
    {
        abort_unless(Auth::user()->role === 'admin', 403);
    }

    private function ensureStudent(): void
    {
        abort_unless(Auth::user()->role === 'student', 403);
    }
}
