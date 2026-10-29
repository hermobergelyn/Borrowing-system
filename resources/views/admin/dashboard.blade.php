<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight flex items-center gap-3">
                <span class="p-2 bg-indigo-600 text-white rounded-xl shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </span>
                {{ __('Equipment Borrowing & Logbook System') }}
            </h2>
            <span class="text-xs font-semibold uppercase tracking-wider px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full border border-indigo-200">
                Sports & Inventory Portal
            </span>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- ===================================================== -->
            <!-- WELCOME & QUICK ACTIONS SECTION -->
            <!-- ===================================================== -->
            <div class="bg-gradient-to-r from-indigo-900 via-indigo-800 to-blue-900 rounded-2xl shadow-xl overflow-hidden text-white">
                <div class="p-8 relative">
                    <div class="absolute right-6 -bottom-6 opacity-10 pointer-events-none">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <span class="bg-indigo-500/30 text-indigo-200 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full backdrop-blur-sm border border-indigo-400/20">
                                    Active Session
                                </span>
                                <h1 class="text-3xl font-extrabold mt-2 tracking-tight">
                                    Welcome back, Admin! 🏆
                                </h1>
                                <p class="text-indigo-200 mt-1 text-sm md:text-base">
                                    You are logged in as <strong class="text-white underline decoration-indigo-400 underline-offset-4">Sports Coordinator</strong>. Monitor equipment inventory, logs, and facility conditions below.
                                </p>
                            </div>

                            <div class="flex flex-wrap items-center gap-3 pt-2 md:pt-0">
                                <a href="{{ route('admin.users.index') }}" class="bg-white text-indigo-900 font-semibold px-5 py-2.5 rounded-xl shadow hover:bg-indigo-50 transition transform hover:-translate-y-0.5 flex items-center gap-2 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    Manage Users
                                </a>
                                <a href="{{ route('borrowings.index') }}" class="bg-indigo-600/60 hover:bg-indigo-600 text-white font-semibold px-5 py-2.5 rounded-xl border border-indigo-400/30 backdrop-blur-sm transition text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    View Equipment Logbook
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===================================================== -->
            <!-- WEATHER DASHBOARD (Server-side via Laravel HTTP Client) -->
            <!-- ===================================================== -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-sky-50 text-sky-600 rounded-lg">🌤️</div>
                            <div>
                                <h3 class="text-base font-bold text-slate-800">Outdoor Sports Facility & Weather Status</h3>
                                <p class="text-xs text-slate-500">Real-time condition for outdoor equipment usage and training schedules.</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold px-3.5 py-2 rounded-lg transition">
                            Refresh
                        </a>
                    </div>

                    @if(isset($errorMessage))
                        <!-- ERROR FALLBACK MESSAGE -->
                        <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 text-rose-800">
                            <p class="text-sm font-bold flex items-center gap-2">
                                Weather Information Unavailable
                            </p>
                            <p class="text-xs text-rose-600 mt-1">{{ $errorMessage }}</p>
                        </div>
                    @elseif(isset($weatherData))
                        <!-- WEATHER DATA DISPLAY -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                            <div class="bg-slate-50/80 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 text-xs font-medium uppercase tracking-wider">Location</div>
                                <div class="text-base font-bold text-slate-800 mt-1 uppercase truncate">{{ $weatherData['city'] }}</div>
                            </div>
                            <div class="bg-slate-50/80 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 text-xs font-medium uppercase tracking-wider">Temperature</div>
                                <div class="text-xl font-extrabold text-slate-800 mt-1">{{ $weatherData['temperature'] }} <span class="text-sm font-semibold text-slate-500">°C</span></div>
                            </div>
                            <div class="bg-slate-50/80 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 text-xs font-medium uppercase tracking-wider">Condition</div>
                                <div class="text-base font-bold text-slate-800 mt-1 capitalize truncate">{{ $weatherData['description'] }}</div>
                            </div>
                            <div class="bg-slate-50/80 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 text-xs font-medium uppercase tracking-wider">Humidity</div>
                                <div class="text-xl font-extrabold text-slate-800 mt-1">{{ $weatherData['humidity'] }} <span class="text-sm font-semibold text-slate-500">%</span></div>
                            </div>
                            <div class="bg-slate-50/80 p-4 rounded-xl border border-slate-200/80">
                                <div class="text-slate-400 text-xs font-medium uppercase tracking-wider">Wind Speed</div>
                                <div class="text-xl font-extrabold text-slate-800 mt-1">{{ $weatherData['wind_speed'] }} <span class="text-xs font-semibold text-slate-500">km/h</span></div>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                            <span>Synced via Laravel HTTP Client</span>
                            <span>Status: <strong class="text-emerald-600 font-medium">Connected</strong></span>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

</x-app-layout>