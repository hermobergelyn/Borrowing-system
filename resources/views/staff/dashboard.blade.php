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
        $userName = Auth::user()->name ?? 'Staff';
    @endphp

    <div class="min-h-screen bg-gradient-to-b from-purple-50/70 via-white to-white px-4 py-7 sm:px-6 lg:px-8"
         x-data="{ helpMenuOpen: false, activeModal: null }"
         @keydown.escape.window="helpMenuOpen = false; activeModal = null">
        <div class="mx-auto max-w-6xl space-y-5">

            <!-- 1. Top Header Row (Date, Greeting, Subtitle & Help Button) -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-bold text-purple-600 tracking-wide">
                        {{ $currentDate }}
                    </p>
                    <h1 class="mt-0.5 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        {{ $greeting }}, <span class="text-purple-700">{{ $userName }}</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        You are logged in as a <strong class="font-semibold text-slate-700">PE Instructor</strong>. Request sports equipment and track your borrowing logs here.
                    </p>
                </div>

                <!-- Help Button & Quick Popover for About & Support / How to Use -->
                <div class="relative shrink-0" @click.outside="helpMenuOpen = false">
                    <button type="button"
                            @click="helpMenuOpen = !helpMenuOpen"
                            class="inline-flex items-center gap-2 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-bold text-purple-800 shadow-2xs transition hover:border-purple-300 hover:bg-purple-50 whitespace-nowrap">
                        <svg class="h-4 w-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Help</span>
                        <svg class="h-3.5 w-3.5 text-purple-500 transition-transform" :class="helpMenuOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="helpMenuOpen"
                         x-transition
                         style="display: none;"
                         class="absolute right-0 mt-2 w-60 rounded-2xl border border-purple-200 bg-white p-2 shadow-lg z-30">
                        <button type="button"
                                @click="helpMenuOpen = false; activeModal = 'about'"
                                class="flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-left text-xs sm:text-sm font-bold text-slate-800 transition hover:bg-purple-50 hover:text-purple-800">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-purple-100 text-base">💜</span>
                            <span>About & Support</span>
                        </button>
                        <button type="button"
                                @click="helpMenuOpen = false; activeModal = 'guide'"
                                class="flex w-full items-center gap-3 rounded-xl px-3.5 py-2.5 text-left text-xs sm:text-sm font-bold text-slate-800 transition hover:bg-purple-50 hover:text-purple-800">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-purple-100 text-base">📘</span>
                            <span>How to use the system</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. Main Overview Card with 4-Step Flow & Primary CTA -->
            <section class="rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-start gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">
                                Sports equipment borrowing guide
                            </h2>
                            <p class="mt-0.5 text-xs sm:text-sm text-slate-500 max-w-2xl">
                                Submit a borrowing request for your PE classes or training sessions and monitor your active items and returns in one place.
                            </p>

                            <div class="mt-4 grid grid-cols-1 gap-x-8 gap-y-2.5 sm:grid-cols-2">
                                <a href="{{ route('borrowings.create') }}" class="flex items-center gap-2.5 text-xs text-slate-600 hover:text-purple-700 transition">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-[11px] font-bold text-purple-700">1</span>
                                    <span>Select sports gear & available stock</span>
                                </a>
                                <a href="{{ route('borrowings.create') }}" class="flex items-center gap-2.5 text-xs text-slate-600 hover:text-purple-700 transition">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-[11px] font-bold text-purple-700">2</span>
                                    <span>Enter quantity and borrowed date</span>
                                </a>
                                <a href="{{ route('borrowings.index') }}" class="flex items-center gap-2.5 text-xs text-slate-600 hover:text-purple-700 transition">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-[11px] font-bold text-purple-700">3</span>
                                    <span>Track active borrowed equipment logs</span>
                                </a>
                                <a href="{{ route('borrowings.index') }}" class="flex items-center gap-2.5 text-xs text-slate-600 hover:text-purple-700 transition">
                                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-[11px] font-bold text-purple-700">4</span>
                                    <span>Request return once class or activity ends</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="shrink-0">
                        <a href="{{ route('borrowings.create') }}"
                           class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-purple-600 px-5 py-3 text-xs sm:text-sm font-bold text-white shadow-sm transition hover:bg-purple-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Borrow equipment</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- 3. Tinted Light Purple Strip Banner: About & Support / How to Use the System -->
            <section class="rounded-2xl border border-purple-200/80 bg-purple-100/65 px-6 py-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-start sm:items-center gap-3.5">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-600 text-white shadow-2xs text-base">
                        💜
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900">
                            About & Support and How to Use the System
                        </h3>
                        <p class="mt-0.5 text-xs text-slate-600">
                            Click either option to view system details, support notes, or step-by-step borrowing instructions.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                    <button type="button"
                            @click="activeModal = 'about'"
                            class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-purple-600 px-4 py-2.5 text-xs font-bold text-white shadow-2xs transition hover:bg-purple-700">
                        <span>About & Support</span>
                    </button>
                    <button type="button"
                            @click="activeModal = 'guide'"
                            class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs font-bold text-purple-900 transition hover:bg-purple-50">
                        <span>How to use the system</span>
                    </button>
                </div>
            </section>

            <!-- 4. Quick Actions Grid -->
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <a href="{{ route('borrowings.create') }}"
                   class="group rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs transition hover:border-purple-400 hover:bg-purple-50/30 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700 text-lg">
                            🏀
                        </span>
                        <div>
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-purple-800 transition">
                                Borrow sports equipment
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Create a new borrowing request for balls, nets, and gear
                            </p>
                        </div>
                    </div>
                    <span class="text-purple-400 group-hover:text-purple-700 font-bold text-lg">›</span>
                </a>

                <a href="{{ route('borrowings.index') }}"
                   class="group rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs transition hover:border-purple-400 hover:bg-purple-50/30 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700 text-lg">
                            📋
                        </span>
                        <div>
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-purple-800 transition">
                                View my borrowing logs
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Check borrowed items, dates, and request equipment returns
                            </p>
                        </div>
                    </div>
                    <span class="text-purple-400 group-hover:text-purple-700 font-bold text-lg">›</span>
                </a>
            </div>

        </div>

        <!-- CENTERED BLURRED BACKDROP MODAL FOR ABOUT & SUPPORT / HOW TO USE THE SYSTEM -->
        <div x-show="activeModal !== null"
             x-transition.opacity
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center bg-purple-950/25 backdrop-blur-md p-4"
             @click.self="activeModal = null">

            <!-- Modal 1: About & Support -->
            <div x-show="activeModal === 'about'"
                 x-transition.scale.origin.center
                 style="display: none;"
                 class="relative w-full max-w-lg rounded-3xl border border-purple-200 bg-gradient-to-b from-purple-50 via-white to-white p-7 sm:p-8 shadow-2xl text-center">

                <!-- Decorative Stickers -->
                <div class="mb-4 flex items-center justify-center gap-2.5">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-2xl shadow-2xs">🏅</span>
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-2xl shadow-2xs">💜</span>
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-2xl shadow-2xs">🤝</span>
                </div>

                <span class="inline-block rounded-full bg-purple-100 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-purple-800">
                    About & Support
                </span>

                <h3 class="mt-3 text-xl sm:text-2xl font-extrabold text-slate-900">
                    School Sports Equipment Borrowing Logbook System
                </h3>

                <p class="mt-3 text-xs sm:text-sm leading-relaxed text-slate-600">
                    This portal helps PE instructors and staff request sports equipment, monitor active borrowed items, and coordinate returns smoothly with the Sports Coordinator. For assistance with missing stock, wrong counts, or account issues, please reach out to your Sports Coordinator or IT Support desk.
                </p>

                <div class="mt-5 flex flex-wrap items-center justify-center gap-2 text-xs font-semibold text-purple-800">
                    <span class="rounded-full border border-purple-200 bg-purple-50 px-3 py-1">🏀 Equipment Tracking</span>
                    <span class="rounded-full border border-purple-200 bg-purple-50 px-3 py-1">✨ PE & Staff Ready</span>
                </div>

                <div class="mt-6 pt-4 border-t border-purple-100 flex items-center justify-center gap-3">
                    <button type="button"
                            @click="activeModal = 'guide'"
                            class="rounded-xl border border-purple-200 bg-purple-50/70 px-4 py-2 text-xs font-bold text-purple-800 transition hover:bg-purple-100">
                        How to use the system →
                    </button>
                    <button type="button"
                            @click="activeModal = null"
                            class="rounded-xl bg-purple-600 px-5 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-purple-700">
                        Close
                    </button>
                </div>
            </div>

            <!-- Modal 2: How to Use the System -->
            <div x-show="activeModal === 'guide'"
                 x-transition.scale.origin.center
                 style="display: none;"
                 class="relative w-full max-w-lg rounded-3xl border border-purple-200 bg-gradient-to-b from-purple-50 via-white to-white p-7 sm:p-8 shadow-2xl text-center">

                <!-- Decorative Stickers -->
                <div class="mb-4 flex items-center justify-center gap-2.5">
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-2xl shadow-2xs">🏀</span>
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-2xl shadow-2xs">📋</span>
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-2xl shadow-2xs">✅</span>
                </div>

                <span class="inline-block rounded-full bg-purple-100 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-purple-800">
                    How to Use the System
                </span>

                <h3 class="mt-3 text-xl sm:text-2xl font-extrabold text-slate-900">
                    Simple Steps to Borrow & Return Gear
                </h3>

                <p class="mt-3 text-xs sm:text-sm leading-relaxed text-slate-600">
                    1. Click <strong class="text-slate-800">Borrow equipment</strong> and choose the item, quantity, and borrowed date.<br>
                    2. Submit your request and view your active items under <strong class="text-slate-800">My borrowing logs</strong>.<br>
                    3. Once finished using the equipment, click <strong class="text-slate-800">Return</strong> so the coordinator can confirm it back into stock.
                </p>

                <div class="mt-5 flex flex-wrap items-center justify-center gap-2 text-xs font-semibold text-purple-800">
                    <span class="rounded-full border border-purple-200 bg-purple-50 px-3 py-1">📝 Easy Request</span>
                    <span class="rounded-full border border-purple-200 bg-purple-50 px-3 py-1">🔄 Quick Return</span>
                </div>

                <div class="mt-6 pt-4 border-t border-purple-100 flex items-center justify-center gap-3">
                    <a href="{{ route('borrowings.create') }}"
                       class="rounded-xl bg-purple-600 px-5 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-purple-700">
                        Borrow equipment
                    </a>
                    <button type="button"
                            @click="activeModal = null"
                            class="rounded-xl border border-purple-200 bg-white px-4 py-2 text-xs font-bold text-purple-800 transition hover:bg-purple-50">
                        Close
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>