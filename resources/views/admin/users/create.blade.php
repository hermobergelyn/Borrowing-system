<x-app-layout>
    @php
        $currentDate = now()->format('l, F j');
        $selectedRole = request('role', 'user');
        $roleTitle = ucfirst($selectedRole);
    @endphp

    <div class="min-h-screen bg-gradient-to-b from-purple-50/70 via-white to-white px-4 py-7 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl space-y-6">

            <!-- Top Date & Full-Width Header -->
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-bold text-purple-600 tracking-wide">
                        {{ $currentDate }}
                    </p>
                    <h1 class="mt-0.5 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Add New <span class="text-purple-700">{{ $roleTitle }}</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Fill in the information below to add a new {{ $selectedRole }} account to the system.
                    </p>
                </div>

                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex w-fit items-center gap-1.5 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-bold text-purple-800 shadow-2xs transition hover:border-purple-300 hover:bg-purple-50">
                    <span>← Back to users</span>
                </a>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-rose-800 shadow-2xs" role="alert">
                    <strong class="text-sm font-bold">Please fix the following:</strong>
                    <ul class="mt-1.5 list-disc list-inside space-y-1 text-xs text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Full-Width Form Card -->
            <section class="rounded-2xl border border-purple-200/80 bg-white p-6 sm:p-8 shadow-2xs">
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                    @csrf

                    <!-- Hidden Role -->
                    <input type="hidden" name="role" value="{{ $selectedRole }}">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Name
                            </label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Enter full name"
                                class="w-full rounded-xl border px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20 @error('name') border-rose-400 bg-rose-50/40 @else border-purple-200 bg-purple-50/30 @enderror"
                            >
                            @error('name')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Email
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="example@school.com"
                                class="w-full rounded-xl border px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20 @error('email') border-rose-400 bg-rose-50/40 @else border-purple-200 bg-purple-50/30 @enderror"
                            >
                            @error('email')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Gender
                            </label>
                            <select
                                id="gender"
                                name="gender"
                                required
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                                <option value="">Select gender</option>
                                <option value="female" @selected(old('gender') === 'female')>Female</option>
                                <option value="male" @selected(old('gender') === 'male')>Male</option>
                            </select>
                            @error('gender')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Contact Number
                            </label>
                            <input
                                id="phone"
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                required
                                autocomplete="tel"
                                placeholder="09XX XXX XXXX"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                            @error('phone')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Password
                            </label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Enter password"
                                class="w-full rounded-xl border px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20 @error('password') border-rose-400 bg-rose-50/40 @else border-purple-200 bg-purple-50/30 @enderror"
                            >
                            <p class="mt-1 text-xs text-slate-400">Password must be at least 8 characters.</p>
                            @error('password')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Confirm Password
                            </label>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Confirm password"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                        </div>
                    </div>

                    @if ($selectedRole === 'student')
                        <div>
                            <label for="course_section" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Course & Section
                            </label>
                            <input
                                id="course_section"
                                type="text"
                                name="course_section"
                                value="{{ old('course_section') }}"
                                required
                                placeholder="e.g. BSIT 3A"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                            @error('course_section')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @elseif ($selectedRole === 'staff')
                        <div>
                            <label for="department" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Department / Assigned Classes
                            </label>
                            <input
                                id="department"
                                type="text"
                                name="department"
                                value="{{ old('department') }}"
                                required
                                placeholder="e.g. Physical Education"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                            @error('department')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <p class="text-xs text-slate-500">
                        The Student or Employee ID is generated automatically when this account is saved.
                    </p>

                    <!-- Locked Role Display -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Assigned Role
                        </label>
                        <div class="flex items-center justify-between rounded-xl border border-purple-200/80 bg-purple-50/60 px-4 py-2.5 text-sm">
                            <span class="font-extrabold uppercase tracking-wider text-purple-900">{{ $selectedRole }}</span>
                            <span class="rounded-full bg-purple-100 px-2.5 py-0.5 text-[11px] font-bold text-purple-700">Fixed</span>
                        </div>
                        <p class="mt-1 text-xs text-slate-400">The role is automatically set based on where you initiated this action.</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between pt-5 border-t border-purple-100">
                        <a
                            href="{{ route('admin.users.index') }}"
                            class="text-xs sm:text-sm font-bold text-slate-500 hover:text-purple-800 transition"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-2.5 shadow-sm shadow-purple-600/20 transition text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                        >
                            Save {{ $roleTitle }}
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>