<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $upcomingEvents = Event::query()
            ->upcoming()
            ->withCount('users')
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $eventsThisWeek = Event::query()
            ->upcoming()
            ->whereBetween('date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->count();

        $eventsThisMonth = Event::query()
            ->upcoming()
            ->whereBetween('date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->count();

        $registeredEvents = collect();
        $nextRegisteredEvent = null;

        if ($user->role === 'student') {
            $registeredEvents = $user->events()
                ->withCount('users')
                ->whereDate('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->orderBy('time')
                ->get();

            $nextRegisteredEvent = $registeredEvents->first();
        }

        return view('dashboard', [
            'upcomingEvents' => $upcomingEvents,
            'eventsThisWeek' => $eventsThisWeek,
            'eventsThisMonth' => $eventsThisMonth,
            'isAdmin' => $user->role === 'admin',
            'registeredEvents' => $registeredEvents,
            'nextRegisteredEvent' => $nextRegisteredEvent,
            'registeredEventIds' => $registeredEvents->pluck('id')->all(),
        ]);
    }
}
