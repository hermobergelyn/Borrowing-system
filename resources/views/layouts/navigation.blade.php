@php
    $role = strtolower(trim(auth()->user()->role ?? ''));
    $isAdmin = in_array($role, ['admin', 'sports coordinator']);

    $hour = (int) now()->format('G');
    if ($hour < 12) {
        $greeting = 'Good morning';
    } elseif ($hour < 18) {
        $greeting = 'Good afternoon';
    } else {
        $greeting = 'Good evening';
    }

    $currentDate = now()->format('l, F j');
@endphp

<div x-data="{ mobileOpen: false }" class="contents">
    <!-- Mobile Top Header Bar -->
    <div class="lg:hidden sticky top-0 z-40 flex items-center justify-between bg-white border-b border-purple-100 px-4 py-3 shadow-sm">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
            <x-application-logo class="block h-8 w-auto fill-current text-purple-700" />
            <span class="font-extrabold text-sm text-purple-950 tracking-tight">SportsLog</span>
        </a>

        <button @click="mobileOpen = !mobileOpen"
                type="button"
                aria-label="Toggle navigation menu"
                class="inline-flex items-center justify-center rounded-xl p-2 text-purple-700 hover:bg-purple-50 focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': mobileOpen, 'inline-flex': !mobileOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !mobileOpen, 'inline-flex': mobileOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Slide-Over Backdrop -->
    <div x-show="mobileOpen"
         x-transition.opacity
         @click="mobileOpen = false"
         class="fixed inset-0 z-40 bg-slate-900/35 backdrop-blur-xs lg:hidden"
         style="display: none;"></div>

    <!-- Floating Rounded Sidebar Card -->
    <aside :class="mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed top-4 bottom-4 left-4 z-50 w-64 shrink-0 rounded-3xl bg-white border border-purple-100 shadow-lg shadow-purple-950/5 flex flex-col justify-between transition-transform duration-200 ease-in-out lg:sticky lg:top-4 lg:h-[calc(100vh-2rem)] lg:ml-4 lg:my-4">

        <div class="flex flex-col flex-1 overflow-y-auto px-5 pt-6 pb-4">
            <!-- Mobile Close Button -->
            <div class="flex justify-end lg:hidden mb-1">
                <button @click="mobileOpen = false" type="button" class="text-slate-400 hover:text-purple-700 text-xl leading-none px-1">
                    ×
                </button>
            </div>

            <!-- Centered Brand Logo (Matched to Reference Layout) -->
            <div class="mb-7 flex flex-col items-center text-center">
                <a href="{{ route('dashboard') }}" class="group flex flex-col items-center">
                    <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-purple-50 border border-purple-100 text-purple-700 group-hover:bg-purple-100 transition">
                        <x-application-logo class="block h-10 w-auto fill-current text-purple-700" />
                    </span>
                    <span class="mt-2.5 block font-extrabold text-base text-purple-950 leading-tight tracking-tight">SportsLog</span>
                    <span class="block text-[11px] font-medium text-purple-600 mt-0.5">Equipment Logbook</span>
                </a>
            </div>

            <!-- Main Navigation Links -->
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3.5 rounded-xl px-3.5 py-2.5 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-purple-100/80 text-purple-800 font-semibold' : 'text-slate-600 hover:bg-purple-50 hover:text-purple-800' }}">
                    <svg class="h-4 w-4 shrink-0 {{ request()->routeIs('dashboard') ? 'text-purple-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="leading-none">{{ __('Dashboard') }}</span>
                </a>

                @if($isAdmin)
                    <div class="pt-4 pb-1.5 px-3.5">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-purple-900/50">
                            {{ __('Management') }}
                        </span>
                    </div>

                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-3.5 rounded-xl px-3.5 py-2.5 text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'bg-purple-100/80 text-purple-800 font-semibold' : 'text-slate-600 hover:bg-purple-50 hover:text-purple-800' }}">
                        <svg class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.users.*') ? 'text-purple-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="leading-none">{{ __('Manage Users') }}</span>
                    </a>

                    <a href="{{ route('equipment.index') }}"
                       class="flex items-center gap-3.5 rounded-xl px-3.5 py-2.5 text-sm font-medium transition {{ request()->routeIs('equipment.*') ? 'bg-purple-100/80 text-purple-800 font-semibold' : 'text-slate-600 hover:bg-purple-50 hover:text-purple-800' }}">
                        <svg class="h-4 w-4 shrink-0 {{ request()->routeIs('equipment.*') ? 'text-purple-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span class="leading-none">{{ __('Manage Equipment') }}</span>
                    </a>

                    <a href="{{ route('admin.borrowings.index') }}"
                       class="flex items-center gap-3.5 rounded-xl px-3.5 py-2.5 text-sm font-medium transition {{ request()->routeIs('admin.borrowings.*') ? 'bg-purple-100/80 text-purple-800 font-semibold' : 'text-slate-600 hover:bg-purple-50 hover:text-purple-800' }}">
                        <svg class="h-4 w-4 shrink-0 {{ request()->routeIs('admin.borrowings.*') ? 'text-purple-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="leading-none">{{ __('Borrowing Logs') }}</span>
                    </a>
                @else
                    <div class="pt-4 pb-1.5 px-3.5">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-purple-900/50">
                            {{ __('Activity') }}
                        </span>
                    </div>

                    <a href="{{ route('borrowings.index') }}"
                       class="flex items-center gap-3.5 rounded-xl px-3.5 py-2.5 text-sm font-medium transition {{ request()->routeIs('borrowings.*') ? 'bg-purple-100/80 text-purple-800 font-semibold' : 'text-slate-600 hover:bg-purple-50 hover:text-purple-800' }}">
                        <svg class="h-4 w-4 shrink-0 {{ request()->routeIs('borrowings.*') ? 'text-purple-700' : 'text-slate-400' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="leading-none">{{ __('Borrowing Logs') }}</span>
                    </a>
                @endif
            </nav>
        </div>

        <!-- Bottom User Profile & Log Out (Matched to Reference Layout) -->
        <div class="border-t border-purple-100 px-4 py-3.5 space-y-2.5 bg-purple-50/40 rounded-b-3xl">
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 rounded-xl px-2.5 py-1.5 text-left transition {{ request()->routeIs('profile.*') ? 'bg-purple-100/80 text-purple-900' : 'hover:bg-purple-50 text-slate-700' }}">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-purple-600 text-xs font-bold text-white">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1 leading-tight">
                    <div class="truncate text-xs font-medium text-slate-600">
                        {{ Auth::user()->role ? ucfirst(Auth::user()->role) : __('Profile') }}
                        <span class="mx-1 text-slate-400">·</span>
                        <span class="font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-xl px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-purple-100/70 hover:text-purple-800 transition">
                    <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="leading-none">{{ __('Log Out') }}</span>
                </button>
            </form>
        </div>
    </aside>
</div>