<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select Role — {{ config('app.name', 'SportsLog') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-b from-purple-50/70 via-white to-purple-50/50 text-slate-800 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">
        <!-- Top Brand -->
        <div class="flex items-center gap-2.5 mb-4">
            <x-application-logo class="h-7 w-auto fill-current text-purple-700" />
            <span class="font-extrabold text-lg text-purple-950 tracking-tight">SportsLog</span>
        </div>

        <!-- Heading -->
        <div class="text-center max-w-xl mb-7">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-purple-950 tracking-tight">
                Welcome, {{ explode(' ', trim($user->name))[0] }}!
            </h1>
            <p class="mt-1.5 text-sm text-slate-600">
                Tell us how you'll use SportsLog and we'll set up your account. Your Student or Employee ID will be generated automatically.
            </p>
        </div>

        <!-- Main Card Container -->
        <div x-data="{ selectedRole: '{{ old('role', $user->role ?? '') }}' }"
             class="w-full max-w-3xl rounded-3xl bg-white border border-purple-100 shadow-xl shadow-purple-950/5 p-5 sm:p-8">

            <!-- Continuing As Bar -->
            <div class="flex flex-wrap items-center justify-between gap-3 rounded-2xl bg-purple-50/70 border border-purple-100 px-4 py-3 mb-6">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-purple-600 text-sm font-bold text-white">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 leading-tight">
                        <div class="text-[11px] font-medium text-slate-500">Continuing as</div>
                        <div class="truncate text-sm font-semibold text-purple-950">{{ $user->email }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs font-semibold text-purple-700 hover:text-purple-900 underline underline-offset-2">
                        Not you? Log out
                    </button>
                </form>
            </div>

            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-xs font-medium text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('role.store') }}">
                @csrf

                <!-- Two Role Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                    <!-- Option 1: Student -->
                    <label @click="selectedRole = 'student'"
                           :class="selectedRole === 'student'
                               ? 'border-purple-600 bg-purple-50/60 ring-2 ring-purple-600/20'
                               : 'border-slate-200 hover:border-purple-300 bg-white'"
                           class="relative cursor-pointer rounded-2xl border p-5 sm:p-6 transition flex flex-col justify-between">

                        <!-- Top-Right Check Badge -->
                        <span x-show="selectedRole === 'student'"
                              x-cloak
                              class="absolute top-5 right-5 flex h-6 w-6 items-center justify-center rounded-full bg-purple-700 text-white shadow-sm">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>

                        <div>
                            <input type="radio" name="role" value="student" x-model="selectedRole" class="sr-only">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-700 mb-4">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                            </div>

                            <h2 class="text-lg font-bold text-purple-950">Student</h2>
                            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                                I want to borrow sports equipment for classes or practice.
                            </p>

                            <ul class="mt-4 space-y-2 text-xs sm:text-sm text-slate-600">
                                <li class="flex items-center gap-2">
                                    <span class="text-purple-600 font-bold">✓</span>
                                    <span>Browse available sports equipment</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-purple-600 font-bold">✓</span>
                                    <span>Submit borrowing and return requests</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-purple-600 font-bold">✓</span>
                                    <span>Track your personal borrowing logs</span>
                                </li>
                            </ul>
                        </div>
                    </label>

                    <!-- Option 2: PE Instructor -->
                    <label @click="selectedRole = 'pe_instructor'"
                           :class="selectedRole === 'pe_instructor'
                               ? 'border-purple-600 bg-purple-50/60 ring-2 ring-purple-600/20'
                               : 'border-slate-200 hover:border-purple-300 bg-white'"
                           class="relative cursor-pointer rounded-2xl border p-5 sm:p-6 transition flex flex-col justify-between">

                        <!-- Top-Right Check Badge -->
                        <span x-show="selectedRole === 'pe_instructor'"
                              x-cloak
                              class="absolute top-5 right-5 flex h-6 w-6 items-center justify-center rounded-full bg-purple-700 text-white shadow-sm">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>

                        <div>
                            <input type="radio" name="role" value="pe_instructor" x-model="selectedRole" class="sr-only">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-700 mb-4">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>

                            <h2 class="text-lg font-bold text-purple-950">PE Instructor</h2>
                            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                                I handle PE classes, sessions, and equipment coordination.
                            </p>

                            <ul class="mt-4 space-y-2 text-xs sm:text-sm text-slate-600">
                                <li class="flex items-center gap-2">
                                    <span class="text-purple-600 font-bold">✓</span>
                                    <span>Request equipment for PE class sessions</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-purple-600 font-bold">✓</span>
                                    <span>Monitor equipment availability</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-purple-600 font-bold">✓</span>
                                    <span>View borrowing activity and history</span>
                                </li>
                            </ul>
                        </div>
                    </label>
                </div>

                <!-- Continue Button -->
                <div class="mt-7">
                    <button type="submit"
                            :disabled="!selectedRole"
                            :class="!selectedRole ? 'opacity-50 cursor-not-allowed' : 'hover:bg-purple-800 cursor-pointer'"
                            class="w-full rounded-xl bg-purple-700 px-5 py-3 text-sm font-bold text-white shadow-sm transition flex items-center justify-center gap-2">
                        <span>Continue</span>
                        <span aria-hidden="true">→</span>
                    </button>
                </div>
            </form>

            <p class="mt-4 text-center text-[11px] text-slate-400">
                By continuing, you agree to follow school equipment borrowing guidelines.
            </p>
        </div>
    </div>
</body>
</html>