<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(string $role = 'student'): View
    {
        abort_unless(in_array($role, ['admin', 'student'], true), 404);

        return view('auth.login', [
            'role' => $role,
        ]);
    }

    public function store(LoginRequest $request, string $role = 'student'): RedirectResponse
    {
        abort_unless(in_array($role, ['admin', 'student'], true), 404);

        $request->authenticate();

        if ($request->user()?->role !== $role) {
            Auth::guard('web')->logout();

            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This account does not belong to the selected login flow.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
