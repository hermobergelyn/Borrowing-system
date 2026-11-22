<x-app-layout>
    @php
        $currentDate = now()->format('l, F j');
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
                        Edit <span class="text-purple-700">User</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Update account details or reset the password for this user.
                    </p>
                </div>

                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex w-fit items-center gap-1.5 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-bold text-purple-800 shadow-2xs transition hover:border-purple-300 hover:bg-purple-50">
                    <span>← Back to users</span>
                </a>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-rose-800 shadow-2xs" role="alert">
                    <strong class="text-sm font-bold">Please fix the following:</strong>
                    <ul class="mt-1.5 list-disc list-inside space-y-1 text-xs text-rose-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Full-Width Form Card -->
            <section class="rounded-2xl border border-purple-200/80 bg-white p-6 sm:p-8 shadow-2xs">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Name
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                required
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Email Address
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                required
                            >
                        </div>

                        <div>
                            <label for="gender" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Gender
                            </label>
                            <select
                                id="gender"
                                name="gender"
                                required
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                                <option value="">Select gender</option>
                                <option value="female" @selected(old('gender', $user->gender) === 'female')>Female</option>
                                <option value="male" @selected(old('gender', $user->gender) === 'male')>Male</option>
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
                                type="tel"
                                id="phone"
                                name="phone"
                                value="{{ old('phone', $user->phone) }}"
                                autocomplete="tel"
                                required
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                            @error('phone')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if (strtolower(trim($user->role)) === 'student')
                            <div>
                                <label for="course_section" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Course & Section
                                </label>
                                <input
                                    type="text"
                                    id="course_section"
                                    name="course_section"
                                    value="{{ old('course_section', $user->course_section) }}"
                                    required
                                    class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                >
                                @error('course_section')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @elseif (in_array(strtolower(trim($user->role)), ['staff', 'pe_instructor', 'pe instructor'], true))
                            <div>
                                <label for="department" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Department / Assigned Classes
                                </label>
                                <input
                                    type="text"
                                    id="department"
                                    name="department"
                                    value="{{ old('department', $user->department) }}"
                                    required
                                    class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                >
                                @error('department')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                New Password <span class="text-slate-400 font-normal normal-case tracking-normal">(leave blank to keep current)</span>
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Confirm New Password
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="••••••••"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                        </div>
                    </div>

                    <!-- Role (Display Only - Locked) -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            User Role
                        </label>
                        <div class="flex items-center justify-between rounded-xl border border-purple-200/80 bg-purple-50/60 px-4 py-2.5">
                            <span class="text-xs sm:text-sm font-extrabold uppercase tracking-wider text-purple-900">
                                {{ $user->role }}
                            </span>
                            <span class="rounded-full bg-purple-100 px-2.5 py-0.5 text-[11px] font-bold text-purple-700">
                                Locked
                            </span>
                        </div>
                        <p class="mt-1 text-xs text-slate-400">Role cannot be changed here.</p>
                    </div>

                    @if ($user->student_id || $user->employee_id)
                        <div class="rounded-xl border border-purple-100 bg-purple-50/50 px-4 py-3">
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                {{ $user->student_id ? 'Student ID' : 'Employee ID' }} (read-only)
                            </div>
                            <div class="mt-1 font-mono text-sm font-bold text-purple-950">
                                {{ $user->student_id ?? $user->employee_id }}
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
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
                            Update User
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>