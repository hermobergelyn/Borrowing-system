<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-blue-600 text-white shadow-md shadow-indigo-600/20">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold tracking-tight text-slate-900 sm:text-xl">
                        Equipment Borrowing & Logbook System
                    </h2>
                    <p class="text-xs text-slate-500">
                        School Sports Equipment Borrowing Logbook System
                    </p>
                </div>
            </div>

            <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-indigo-200/80 bg-indigo-50 px-3.5 py-1 text-[11px] font-bold uppercase tracking-wider text-indigo-700 shadow-2xs">
                <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>
                Sports & Inventory Portal
            </span>
        </div>
    </x-slot>

    <!-- Styled Dashboard Canvas -->
    <div class="relative min-h-screen bg-slate-100 py-8">
        <!-- Subtle Athletic Court Grid & Ambient Top Glow -->
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
            <div class="absolute -top-24 left-1/2 h-80 w-[48rem] -translate-x-1/2 rounded-full bg-indigo-500/10 blur-3xl"></div>
            <div class="absolute right-0 top-40 h-72 w-72 rounded-full bg-emerald-400/10 blur-3xl"></div>
            <div class="h-full w-full opacity-45"
                 style="background-image:
                    linear-gradient(to right, rgba(15, 23, 42, 0.04) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(15, 23, 42, 0.04) 1px, transparent 1px);
                    background-size: 32px 32px;">
            </div>
        </div>

        <div class="relative z-10 mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <!-- Hero / Welcome Banner -->
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#23197a] via-[#2d249e] to-[#3730a3] p-6 text-white shadow-xl shadow-indigo-950/15 ring-1 ring-white/10 sm:p-8">
                <!-- Decorative Courtside Circles -->
                <div class="pointer-events-none absolute -right-12 -top-12 h-64 w-64 rounded-full border border-white/10 bg-white/5"></div>
                <div class="pointer-events-none absolute -bottom-20 right-28 h-52 w-52 rounded-full bg-sky-400/10 blur-xl"></div>

                <div class="relative z-10 flex flex-col justify-between gap-6 lg:flex-row lg:items-center">
                    <div class="max-w-2xl space-y-2.5">
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-[11px] font-semibold uppercase tracking-widest text-indigo-100 backdrop-blur-xs">
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                            Active Session
                        </span>

                        <h3 class="flex items-center gap-2 text-2xl font-extrabold tracking-tight sm:text-3xl">
                            <span>Welcome back, {{ Auth::user()->name ?? 'Admin' }}!</span>
                            <span aria-hidden="true">🏆</span>
                        </h3>

                        <p class="text-sm leading-relaxed text-indigo-100/90 sm:text-[15px]">
                            You are logged in as
                            <span class="font-semibold text-white underline decoration-indigo-300/60 underline-offset-4">
                                Sports Coordinator
                            </span>.
                            Monitor equipment inventory, logs, and facility conditions below.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ url('/admin/users') }}"
                           class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 shadow-md transition duration-150 hover:-translate-y-0.5 hover:bg-slate-50">
                            <svg class="h-4 w-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h11zm2-10a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>Manage Users</span>
                        </a>

                        <a href="{{ url('/admin/logs') }}"
                           class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-xs transition duration-150 hover:-translate-y-0.5 hover:bg-white/20">
                            <svg class="h-4 w-4 text-indigo-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>View Equipment Logbook</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Outdoor Sports Facility & Weather Status Card -->
            <section class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-sm ring-1 ring-slate-950/[0.03] sm:p-7">
                <div class="mb-6 flex flex-col justify-between gap-4 border-b border-slate-100 pb-5 sm:flex-row sm:items-center">
                    <div class="flex items-start gap-3.5">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-xl ring-1 ring-amber-200/70">
                            ⛅
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900 sm:text-lg">
                                Outdoor Sports Facility & Weather Status
                            </h4>
                            <p class="mt-0.5 text-xs text-slate-500 sm:text-sm">
                                Real-time condition for outdoor equipment usage and training schedules.
                            </p>
                        </div>
                    </div>

                    <button type="button"
                            onclick="window.location.reload()"
                            class="inline-flex items-center justify-center gap-1.5 self-start rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-xs font-semibold text-slate-700 shadow-2xs transition hover:border-slate-300 hover:bg-slate-100 sm:self-center">
                        <svg class="h-3.5 w-3.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span>Refresh</span>
                    </button>
                </div>

                <!-- Weather Metric Tiles -->
                <div class="grid grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-5">
                    <div class="rounded-xl border border-slate-200/80 bg-gradient-to-b from-slate-50/90 to-white p-4 transition hover:border-indigo-200 hover:shadow-xs">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Location</p>
                        <p class="mt-2 text-base font-extrabold uppercase tracking-wide text-slate-900">
                            {{ $location ?? 'ARAKAN' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200/80 bg-gradient-to-b from-slate-50/90 to-white p-4 transition hover:border-indigo-200 hover:shadow-xs">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Temperature</p>
                        <p class="mt-2 text-base font-extrabold text-slate-900">
                            {{ $temperature ?? '24.99 °C' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200/80 bg-gradient-to-b from-slate-50/90 to-white p-4 transition hover:border-indigo-200 hover:shadow-xs">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Condition</p>
                        <p class="mt-2 text-base font-extrabold text-slate-900">
                            {{ $condition ?? 'Broken Clouds' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200/80 bg-gradient-to-b from-slate-50/90 to-white p-4 transition hover:border-indigo-200 hover:shadow-xs">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Humidity</p>
                        <p class="mt-2 text-base font-extrabold text-slate-900">
                            {{ $humidity ?? '91 %' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200/80 bg-gradient-to-b from-slate-50/90 to-white p-4 transition hover:border-indigo-200 hover:shadow-xs">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Wind Speed</p>
                        <p class="mt-2 text-base font-extrabold text-slate-900">
                            {{ $windSpeed ?? '7.7 km/h' }}
                        </p>
                    </div>
                </div>

                <!-- Footer Status -->
                <div class="mt-5 flex flex-col justify-between gap-2 border-t border-slate-100 pt-4 text-xs text-slate-400 sm:flex-row sm:items-center">
                    <span>Synced via Laravel HTTP Client</span>
                    <span class="inline-flex items-center gap-1.5">
                        <span>Status:</span>
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 font-semibold text-emerald-700 ring-1 ring-emerald-200/70">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Connected
                        </span>
                    </span>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
```[cite: 8]

Kung gusto nimo nga i-adjust pa ang color scheme (pananglitan mag-add og emerald/green sports accent sa banner o buttons) o magbutang og summary cards sa ubos sa weather card, ingna lang ko.