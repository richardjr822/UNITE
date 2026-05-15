<div x-data="{ sidebarOpen: false }" class="student-sidebar-wrapper">
    <!-- Hamburger Menu Button (Mobile Only) -->
    <button 
        @click="sidebarOpen = !sidebarOpen" 
        class="student-hamburger-btn"
        aria-label="Toggle menu"
        :aria-expanded="sidebarOpen"
    >
        <svg x-show="!sidebarOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="sidebarOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Overlay (Mobile Only) -->
    <div 
        x-show="sidebarOpen" 
        @click="sidebarOpen = false" 
        class="student-sidebar-overlay"
        x-transition
    ></div>

    <!-- Sidebar -->
    <aside class="student-sidebar" :class="{ 'is-open': sidebarOpen }">
        <div class="student-brand-card">
            <div class="student-brand-mark"></div>
            <div>
                <p class="student-brand-title">UNITE</p>
                <p class="student-brand-sub">School Events</p>
            </div>
        </div>

        <nav class="student-nav">
            <a href="{{ route('dashboard') }}" class="student-nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
                <svg class="student-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4" />
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('events.index') }}" class="student-nav-link {{ request()->routeIs('events.*') ? 'is-active' : '' }}">
                <svg class="student-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
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
</div>
