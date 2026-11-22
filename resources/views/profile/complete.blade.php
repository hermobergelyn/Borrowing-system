<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete Profile — {{ config('app.name', 'SportsLog') }}</title>
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
                Complete your profile
            </h1>
            <p class="mt-1.5 text-sm text-slate-600">
                A few quick details so we can verify your account and set up your SportsLog access.
            </p>
        </div>

        <!-- Main Card Container -->
        <div x-data="{ gender: '{{ old('gender', $user->gender ?? '') }}' }"
             class="w-full max-w-2xl rounded-3xl bg-white border border-purple-100 shadow-xl shadow-purple-950/5 p-5 sm:p-8 space-y-6">

            <!-- User & Role Summary Bar -->
            <div class="flex flex-wrap items-center justify-between gap-3 rounded-2xl bg-purple-50/70 border border-purple-100 px-4 py-3">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-purple-600 text-sm font-bold text-white">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 leading-tight">
                        <div class="text-sm font-bold text-purple-950 truncate">{{ $user->name }}</div>
                        <div class="truncate text-xs text-slate-500">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700">
                        {{ $user->role === 'pe_instructor' ? 'PE Instructor' : 'Student' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                <div class="rounded-xl border border-purple-100 bg-white px-4 py-3">
                    <div class="text-[11px] font-medium text-slate-500">
                        {{ $user->role === 'pe_instructor' ? 'Employee ID (read-only)' : 'Student ID (read-only)' }}
                    </div>
                    <div class="mt-1 font-mono text-sm font-bold text-purple-950">
                        {{ $user->role === 'pe_instructor' ? $user->employee_id : $user->student_id }}
                    </div>
                </div>
                @if (filled($user->gender) || filled($user->phone))
                    <div class="rounded-xl border border-purple-100 bg-white px-4 py-3">
                        <div class="grid grid-cols-2 gap-x-3 gap-y-1 text-sm">
                            <span class="text-slate-500">Gender</span>
                            <span class="font-semibold text-purple-950">{{ filled($user->gender) ? ucfirst($user->gender) : 'Not provided' }}</span>
                            <span class="text-slate-500">Phone</span>
                            <span class="font-semibold text-purple-950">{{ $user->phone ?: 'Not provided' }}</span>
                        </div>
                    </div>
                @endif
            </div>

            @if ($errors->any())
                <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-xs font-medium text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('profile.complete.store') }}" class="space-y-6">
                @csrf

                @if (blank($user->gender))
                    <div>
                        <label class="block text-sm font-semibold text-purple-950 mb-2.5">
                            Gender <span class="text-red-500">*</span>
                        </label>

                        <div class="grid grid-cols-2 gap-3.5">
                            <label @click="gender = 'male'"
                                   :class="gender === 'male'
                                       ? 'border-purple-600 bg-purple-50/60 ring-2 ring-purple-600/20'
                                       : 'border-slate-200 hover:border-purple-300 bg-white'"
                                   class="relative cursor-pointer rounded-2xl border p-4 transition flex flex-col items-center justify-center gap-1.5">
                                <span x-show="gender === 'male'"
                                      x-cloak
                                      class="absolute top-3 right-3 flex h-5 w-5 items-center justify-center rounded-full bg-purple-700 text-white">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <input type="radio" name="gender" value="male" x-model="gender" class="sr-only">
                                <span class="text-lg font-bold text-purple-950">♂</span>
                                <span class="text-sm font-semibold text-slate-700">Male</span>
                            </label>

                            <label @click="gender = 'female'"
                                   :class="gender === 'female'
                                       ? 'border-purple-600 bg-purple-50/60 ring-2 ring-purple-600/20'
                                       : 'border-slate-200 hover:border-purple-300 bg-white'"
                                   class="relative cursor-pointer rounded-2xl border p-4 transition flex flex-col items-center justify-center gap-1.5">
                                <span x-show="gender === 'female'"
                                      x-cloak
                                      class="absolute top-3 right-3 flex h-5 w-5 items-center justify-center rounded-full bg-purple-700 text-white">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <input type="radio" name="gender" value="female" x-model="gender" class="sr-only">
                                <span class="text-lg font-bold text-purple-950">♀</span>
                                <span class="text-sm font-semibold text-slate-700">Female</span>
                            </label>
                        </div>
                    </div>
                @endif

                <!-- Phone Number -->
                @if (blank($user->phone))
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-purple-950 mb-1.5">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input id="phone"
                               name="phone"
                               type="tel"
                               value="{{ old('phone', $user->phone ?? '') }}"
                               placeholder="09XX XXX XXXX"
                               required
                               class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-600/20">
                    </div>
                @endif

                <!-- Role-Specific Field -->
                @if ($user->role === 'pe_instructor')
                    <div>
                        <label for="department" class="block text-sm font-semibold text-purple-950 mb-1.5">
                            PE Department / Assigned Classes <span class="text-red-500">*</span>
                        </label>
                        <input id="department"
                               name="department"
                               type="text"
                               value="{{ old('department', $user->department ?? '') }}"
                               placeholder="e.g. Physical Education Department"
                               required
                               class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-600/20">
                    </div>
                @else
                    <div>
                        <label for="course_section" class="block text-sm font-semibold text-purple-950 mb-1.5">
                            Course & Section <span class="text-red-500">*</span>
                        </label>
                        <input id="course_section"
                               name="course_section"
                               type="text"
                               value="{{ old('course_section', $user->course_section ?? '') }}"
                               placeholder="e.g. BSIT 3A"
                               required
                               class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-600/20">
                    </div>
                @endif

                <!-- Save & Proceed to Dashboard -->
                <div class="pt-2">
                    <button type="submit"
                            class="w-full rounded-xl bg-purple-700 hover:bg-purple-800 px-5 py-3 text-sm font-bold text-white shadow-sm transition flex items-center justify-center gap-2 cursor-pointer">
                        <span>Save & Go to Dashboard</span>
                        <span aria-hidden="true">→</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>