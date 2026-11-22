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
        $userName = Auth::user()->name ?? 'Admin';
    @endphp

    <div class="px-4 py-7 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl space-y-6">

            <!-- Top Date, Greeting & Subtitle (Matching Reference) -->
            <div>
                <p class="text-xs font-bold text-purple-600 tracking-wide">
                    {{ $currentDate }}
                </p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                    {{ $greeting }}, {{ $userName }}
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Here's how your sports equipment borrowing logbook is doing.
                </p>
            </div>

            <!-- Setup / Quick-Start Card (Matching Reference Banner Layout) -->
            <section class="rounded-2xl border border-purple-200/80 bg-gradient-to-br from-purple-50/90 via-white to-purple-50/50 p-6 sm:p-7 shadow-xs">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-start gap-4 max-w-3xl">
                        <!-- Rounded Square Icon Block -->
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-600 text-white shadow-sm">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>

                        <div class="flex-1">
                            <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">
                                Let's set up your sports equipment logbook
                            </h2>
                            <p class="mt-1 text-xs sm:text-sm leading-relaxed text-slate-500">
                                It takes a few minutes. Once it's ready, students and coaches can check available gear and request items, and you can track borrowing logs, returns, and inventory in one place.
                            </p>

                            <!-- 3 Step Pills (Matching 1, 2, 3 Step Boxes in Reference) -->
                            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-3">
                                <a href="{{ route('equipment.index') }}"
                                   class="flex items-center gap-3 rounded-xl border border-purple-200/70 bg-white px-3.5 py-2.5 text-left transition hover:border-purple-400 hover:bg-purple-50/40">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-purple-100 text-xs font-bold text-purple-700">
                                        1
                                    </span>
                                    <span class="text-xs font-semibold text-slate-700 leading-snug">
                                        Add sports equipment & stock
                                    </span>
                                </a>

                                <a href="{{ route('admin.users.index') }}"
                                   class="flex items-center gap-3 rounded-xl border border-purple-200/70 bg-white px-3.5 py-2.5 text-left transition hover:border-purple-400 hover:bg-purple-50/40">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-purple-100 text-xs font-bold text-purple-700">
                                        2
                                    </span>
                                    <span class="text-xs font-semibold text-slate-700 leading-snug">
                                        Verify students, coaches & roles
                                    </span>
                                </a>

                                <a href="{{ route('admin.borrowings.index') }}"
                                   class="flex items-center gap-3 rounded-xl border border-purple-200/70 bg-white px-3.5 py-2.5 text-left transition hover:border-purple-400 hover:bg-purple-50/40">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-purple-100 text-xs font-bold text-purple-700">
                                        3
                                    </span>
                                    <span class="text-xs font-semibold text-slate-700 leading-snug">
                                        Approve requests & track returns
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Primary Action Button on Right -->
                    <div class="shrink-0">
                        <a href="{{ route('equipment.index') }}"
                           class="inline-flex w-full sm:w-auto items-center justify-center gap-1.5 rounded-xl bg-purple-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-purple-700">
                            <span>+ Add equipment</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Outdoor Sports Facility & Weather Status Card -->
            <section class="rounded-2xl border border-purple-100 bg-white p-6 shadow-xs sm:p-7">
                <div class="mb-6 flex flex-col justify-between gap-4 border-b border-purple-100/70 pb-5 sm:flex-row sm:items-center">
                    <div class="flex items-start gap-3.5">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-xl ring-1 ring-purple-200/70">
                            ⛅
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 sm:text-lg">
                                Outdoor Sports Facility & Weather Status
                            </h3>
                            <p class="mt-0.5 text-xs text-slate-500 sm:text-sm">
                                Real-time condition for outdoor equipment usage and training schedules.
                            </p>
                        </div>
                    </div>

                    <button type="button"
                            onclick="window.location.reload()"
                            class="inline-flex items-center justify-center gap-1.5 self-start rounded-xl border border-purple-200/80 bg-purple-50/70 px-4 py-2 text-xs font-semibold text-purple-800 transition hover:border-purple-300 hover:bg-purple-100/70 sm:self-center">
                        <svg class="h-3.5 w-3.5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span>Refresh</span>
                    </button>
                </div>

                <!-- Weather Metric Tiles -->
                <div class="grid grid-cols-1 gap-3.5 sm:grid-cols-2 lg:grid-cols-5">
                    <div class="rounded-xl border border-purple-100 bg-gradient-to-b from-purple-50/50 to-white p-4 transition hover:border-purple-300">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-purple-900/50">Location</p>
                        <p class="mt-2 text-base font-extrabold uppercase tracking-wide text-slate-900">
                            {{ $location ?? 'ARAKAN' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-purple-100 bg-gradient-to-b from-purple-50/50 to-white p-4 transition hover:border-purple-300">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-purple-900/50">Temperature</p>
                        <p class="mt-2 text-base font-extrabold text-slate-900">
                            {{ $temperature ?? '24.99 °C' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-purple-100 bg-gradient-to-b from-purple-50/50 to-white p-4 transition hover:border-purple-300">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-purple-900/50">Condition</p>
                        <p class="mt-2 text-base font-extrabold text-slate-900">
                            {{ $condition ?? 'Broken Clouds' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-purple-100 bg-gradient-to-b from-purple-50/50 to-white p-4 transition hover:border-purple-300">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-purple-900/50">Humidity</p>
                        <p class="mt-2 text-base font-extrabold text-slate-900">
                            {{ $humidity ?? '91 %' }}
                        </p>
                    </div>

                    <div class="rounded-xl border border-purple-100 bg-gradient-to-b from-purple-50/50 to-white p-4 transition hover:border-purple-300">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-purple-900/50">Wind Speed</p>
                        <p class="mt-2 text-base font-extrabold text-slate-900">
                            {{ $windSpeed ?? '7.7 km/h' }}
                        </p>
                    </div>
                </div>

                <!-- Footer Status -->
                <div class="mt-5 flex flex-col justify-between gap-2 border-t border-purple-100/70 pt-4 text-xs text-slate-400 sm:flex-row sm:items-center">
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
</x-app-layout>s