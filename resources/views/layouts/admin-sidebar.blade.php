<aside class="student-sidebar">
    <div class="student-brand-card">
        <div class="student-brand-mark"></div>
        <div>
            <p class="student-brand-title">UNITE</p>
            <p class="student-brand-sub">School Events</p>
        </div>
    </div>

    <nav class="student-nav">
        <a href="{{ route('dashboard') }}" class="student-nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
            <span>Dashboard</span>
        </a>
        <a href="{{ route('events.index') }}" class="student-nav-link {{ request()->routeIs('events.*') ? 'is-active' : '' }}">
            <span>Events</span>
        </a>
    </nav>

    <div class="student-sidebar-bottom">
        <div class="student-user">
            <p class="student-user-name">{{ auth()->user()->name }}</p>
            <p class="student-user-role">Admin</p>
        </div>

        <div class="mt-3 space-y-2">
            <a href="{{ route('profile.edit') }}" class="student-profile-link">Profile</a>
            <form method="POST" action="{{ route('logout') }}" data-confirm-submit data-confirm-title="Log Out" data-confirm-message="Are you sure you want to log out?">
                @csrf
                <button class="student-logout-btn" type="submit">Log Out</button>
            </form>
        </div>
    </div>
</aside>
