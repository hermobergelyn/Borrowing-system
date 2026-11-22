<x-app-layout>
    @php
        $hour = (int) now()->format('G');
        if ($hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }

        $currentDate = now()->format('l, F j');
        $userName = Auth::user()->name ?? 'Bergelyn';
    @endphp

    <div class="min-h-screen bg-gradient-to-b from-purple-50/70 via-white to-white px-4 py-7 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl space-y-5">

            <!-- 1. Top Header Row (Matching Date, Greeting, Subtitle & Right Action Button) -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-bold text-purple-600 tracking-wide">
                        {{ $currentDate }}
                    </p>
                    <h1 class="mt-0.5 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ $greeting }}, <span class="text-purple-700">{{ $userName }}</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Your sports gear, borrowing logs, returns, and facility updates in one place.
                    </p>
                </div>

                <a href="{{ route('equipment.index') }}"
                   class="inline-flex w-fit items-center gap-2 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-bold text-purple-900 shadow-2xs transition hover:border-purple-300 hover:bg-purple-50">
                    <svg class="h-4 w-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                    </svg>
                    <span>Browse sports gear</span>
                </a>
            </div>

            <!-- 2. Main White Card with 4-Step Flow & Primary CTA (Matching Top Banner Card) -->
            <section class="rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">
                                Sports equipment logbook overview
                            </h2>
                            <p class="mt-0.5 text-xs sm:text-sm text-slate-500 max-w-2xl">
                                Add sports gear you need and submit borrowing requests. Once approved, active logs and returns are tracked right here.
                            </p>

                            <!-- 4 Step Items (Matching 1, 2, 3, 4 Grid in Reference) -->
                            <div class="mt-4 grid grid-cols-1 gap-x-8 gap-y-2.5 sm:grid-cols-2">
                                <a href="{{ route('equipment.index') }}" class="flex items-center gap-2.5 text-xs text-slate-600 hover:text-purple-700 transition">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-[11px] font-bold text-purple-700">1</span>
                                    <span>Browse available sports gear</span>
                                </a>
                                <a href="{{ route('equipment.create') }}" class="flex items-center gap-2.5 text-xs text-slate-600 hover:text-purple-700 transition">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-[11px] font-bold text-purple-700">2</span>
                                    <span>Add or update equipment stock</span>
                                </a>
                                <a href="{{ route('admin.borrowings.index') }}" class="flex items-center gap-2.5 text-xs text-slate-600 hover:text-purple-700 transition">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-[11px] font-bold text-purple-700">3</span>
                                    <span>Review & approve borrowing logs</span>
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2.5 text-xs text-slate-600 hover:text-purple-700 transition">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-[11px] font-bold text-purple-700">4</span>
                                    <span>Manage student & staff accounts</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="shrink-0">
                        <a href="{{ route('admin.borrowings.index') }}"
                           class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-purple-600 px-5 py-3 text-xs sm:text-sm font-bold text-white shadow-sm transition hover:bg-purple-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                            </svg>
                            <span>Open logbook</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- 3. Tinted Light Purple Strip Banner (Matching Second Banner Strip) -->
            <section class="rounded-2xl border border-purple-200/80 bg-purple-100/65 px-6 py-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start sm:items-center gap-3.5">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-600 text-white shadow-2xs">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h11zm2-10a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900">
                                Equipment accountability & return reminders
                            </h3>
                            <span class="inline-flex items-center gap-1 rounded-full bg-purple-200/80 px-2.5 py-0.5 text-[11px] font-bold text-purple-900">
                                ● Sports Coordinator
                            </span>
                        </div>
                        <p class="mt-0.5 text-xs text-slate-600">
                            Keep track of active borrowers, returned gear, and registered members ({{ isset($users) ? $users->count() : 0 }} total users).
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                    <a href="{{ route('admin.users.index') }}"
                       class="inline-flex items-center justify-center rounded-xl bg-purple-600 px-4 py-2.5 text-xs font-bold text-white shadow-2xs transition hover:bg-purple-700">
                        Manage users
                    </a>
                    <a href="{{ route('equipment.index') }}"
                       class="inline-flex items-center justify-center rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs font-bold text-purple-900 transition hover:bg-purple-50">
                        View equipment
                    </a>
                </div>
            </section>

            <!-- 4. Lower Two-Column Grid (Matching Left Table Card + Right Quick Actions / Status Card) -->
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-12">

                <!-- Left (7 cols): Borrowing & Facility Weather Overview Card -->
                <section class="lg:col-span-7 rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-2 pb-4 border-b border-purple-100">
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">
                                    Outdoor facility & weather status
                                </h3>
                                <p class="text-xs text-slate-500">
                                    Real-time outdoor condition for PE and sports training
                                </p>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-purple-700 hover:underline">
                                Refresh
                            </a>
                        </div>

                        @if(isset($errorMessage))
                            <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800">
                                <p class="text-xs font-bold">Weather Information Unavailable</p>
                                <p class="mt-1 text-xs text-rose-600">{{ $errorMessage }}</p>
                            </div>
                        @elseif(isset($weatherData))
                            <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <div class="rounded-xl border border-purple-100 bg-purple-50/50 p-3.5">
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-purple-700/70">Location</span>
                                    <span class="mt-1 block text-sm font-extrabold uppercase text-slate-900 truncate">{{ $weatherData['city'] }}</span>
                                </div>
                                <div class="rounded-xl border border-purple-100 bg-purple-50/50 p-3.5">
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-purple-700/70">Temperature</span>
                                    <span class="mt-1 block text-sm font-extrabold text-slate-900">{{ $weatherData['temperature'] }} °C</span>
                                </div>
                                <div class="rounded-xl border border-purple-100 bg-purple-50/50 p-3.5">
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-purple-700/70">Condition</span>
                                    <span class="mt-1 block text-sm font-bold capitalize text-slate-900 truncate">{{ $weatherData['description'] }}</span>
                                </div>
                                <div class="rounded-xl border border-purple-100 bg-purple-50/50 p-3.5">
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-purple-700/70">Humidity</span>
                                    <span class="mt-1 block text-sm font-extrabold text-slate-900">{{ $weatherData['humidity'] }} %</span>
                                </div>
                                <div class="rounded-xl border border-purple-100 bg-purple-50/50 p-3.5">
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-purple-700/70">Wind Speed</span>
                                    <span class="mt-1 block text-sm font-extrabold text-slate-900">{{ $weatherData['wind_speed'] }} km/h</span>
                                </div>
                                <div class="rounded-xl border border-purple-100 bg-purple-50/50 p-3.5 flex flex-col justify-center">
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-purple-700/70">API Status</span>
                                    <span class="mt-1 inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700">
                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                        Connected
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-5 pt-3 border-t border-purple-100/80 flex items-center justify-between text-[11px] text-slate-400">
                        <span>Synced via Laravel HTTP Client</span>
                        <span>Sports & PE Department</span>
                    </div>
                </section>

                <!-- Right (5 cols): Quick Actions Card (Matching Right Quick Actions Card) -->
                <section class="lg:col-span-5 rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs">
                    <h3 class="text-base font-extrabold text-slate-900">
                        Quick actions
                    </h3>
                    <p class="mt-0.5 text-xs text-slate-500 mb-4">
                        Jump straight to daily equipment & logbook tasks
                    </p>

                    <div class="space-y-3">
                        <a href="{{ route('admin.borrowings.index') }}"
                           class="flex items-center gap-3.5 rounded-xl border border-purple-100 bg-purple-50/40 p-3.5 transition hover:border-purple-300 hover:bg-purple-50">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700 font-bold text-sm">
                                📋
                            </span>
                            <div class="min-w-0 flex-1">
                                <span class="block text-sm font-bold text-slate-900">Manage borrowing logs</span>
                                <span class="block text-xs text-slate-500">Check active borrows & confirm returns</span>
                            </div>
                            <span class="text-purple-400 font-bold">›</span>
                        </a>

                        <a href="{{ route('equipment.index') }}"
                           class="flex items-center gap-3.5 rounded-xl border border-purple-100 bg-purple-50/40 p-3.5 transition hover:border-purple-300 hover:bg-purple-50">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700 font-bold text-sm">
                                🏀
                            </span>
                            <div class="min-w-0 flex-1">
                                <span class="block text-sm font-bold text-slate-900">Equipment inventory</span>
                                <span class="block text-xs text-slate-500">View and update available sports items</span>
                            </div>
                            <span class="text-purple-400 font-bold">›</span>
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3.5 rounded-xl border border-purple-100 bg-purple-50/40 p-3.5 transition hover:border-purple-300 hover:bg-purple-50">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700 font-bold text-sm">
                                ⚙️
                            </span>
                            <div class="min-w-0 flex-1">
                                <span class="block text-sm font-bold text-slate-900">Account settings</span>
                                <span class="block text-xs text-slate-500">Update your profile & credentials</span>
                            </div>
                            <span class="text-purple-400 font-bold">›</span>
                        </a>
                    </div>
                </section>

            </div>

        </div>
    </div>
</x-app-layout>