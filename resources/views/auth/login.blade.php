<x-guest-layout :standalone="true">
    <div class="min-h-screen w-full grid grid-cols-1 lg:grid-cols-2 bg-white text-slate-800 antialiased selection:bg-purple-200 selection:text-purple-950">

        <!-- Left Half (50%): Soft Light Purple Brand Panel -->
        <div class="relative flex flex-col justify-between bg-gradient-to-br from-purple-700 via-violet-600 to-purple-500 p-8 sm:p-12 lg:p-14 text-white overflow-hidden">
            <!-- Soft Decorative Glows -->
            <div class="pointer-events-none absolute -top-24 -right-24 h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-24 h-80 w-80 rounded-full bg-purple-950/20 blur-3xl"></div>

            <!-- Top Brand Logo -->
            <div class="relative z-10">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-white font-extrabold text-lg tracking-tight">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-purple-700 font-extrabold text-sm shadow-md">
                        SE
                    </span>
                    <span>SportsLog</span>
                </a>
            </div>

            <!-- Middle Welcome Copy & Highlights -->
            <div class="relative z-10 my-12 max-w-md">
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight text-white">
                    Welcome back
                </h1>
                <p class="mt-3 text-sm sm:text-base leading-relaxed text-purple-100">
                    Pick up where you left off; check available sports equipment, request items, or manage your school borrowing logbook.
                </p>

                <div class="mt-8 space-y-3.5 text-sm text-purple-50">
                    <div class="flex items-center gap-3 rounded-2xl bg-white/10 border border-white/15 px-4 py-3 backdrop-blur-sm">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/15 text-xs font-bold">
                            ✓
                        </span>
                        <span>Check real-time sports gear availability before PE or practice</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl bg-white/10 border border-white/15 px-4 py-3 backdrop-blur-sm">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/15 text-xs font-bold">
                            ✓
                        </span>
                        <span>Track borrowed items, request status, and return schedules</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl bg-white/10 border border-white/15 px-4 py-3 backdrop-blur-sm">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/15 text-xs font-bold">
                            ✓
                        </span>
                        <span>Organized digital logbook for students, coaches, and staff</span>
                    </div>
                </div>
            </div>

            <!-- Bottom System Label -->
            <div class="relative z-10 text-xs text-purple-100/85">
                School Sports Equipment Borrowing Logbook System
            </div>
        </div>

        <!-- Right Half (50%): Clean White Sign-In Form Panel -->
        <div class="flex flex-col justify-between bg-white px-6 py-10 sm:px-12 lg:px-16">
            <div class="mx-auto w-full max-w-md my-auto">

                <!-- Header -->
                <div class="mb-7">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700 mb-3">
                        Sports Equipment Logbook
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Sign in
                    </h2>
                    <p class="mt-1.5 text-sm text-slate-500">
                        Welcome back! Enter your details to continue.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700" :status="session('status')" />

                <!-- Google OAuth Error Alert -->
                @if (session('error'))
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Google Sign-In Button (Top placement matching reference) -->
                <div>
                    <a href="{{ route('auth.google') }}"
                       class="flex w-full items-center justify-center gap-2.5 rounded-xl border border-purple-200 bg-purple-50/40 px-4 py-2.5 text-sm font-bold text-slate-800 shadow-sm transition hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-purple-500/30">
                        <svg class="h-5 w-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.19v3.15C3.17 21.36 7.21 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.19C.43 8.12 0 9.87 0 12s.43 3.88 1.19 5.42l4.09-3.15z"/>
                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.21 0 3.17 2.64 1.19 6.58l4.09 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                        </svg>
                        <span>{{ __('Continue with Google') }}</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-[11px] font-semibold uppercase tracking-wider">
                        <span class="bg-white px-3 text-slate-400">
                            Or sign in with email
                        </span>
                    </div>
                </div>

                <!-- Email & Password Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wide text-slate-700">
                            {{ __('Email address') }}
                        </label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="you@example.com"
                               required
                               autofocus
                               autocomplete="username"
                               class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500/20" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-600" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wide text-slate-700">
                            {{ __('Password') }}
                        </label>
                        <div class="relative mt-1.5">
                            <input id="password"
                                   type="password"
                                   name="password"
                                   placeholder="Your password"
                                   required
                                   autocomplete="current-password"
                                   class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 pr-10 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500/20" />
                            <button type="button"
                                    onclick="togglePasswordVisibility()"
                                    aria-label="Toggle password visibility"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-purple-700 transition">
                                <svg id="eyeIcon" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-600" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="mt-4 flex items-center justify-between gap-3">
                        <label for="remember_me" class="inline-flex cursor-pointer items-center">
                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember"
                                   class="h-4 w-4 rounded border-slate-300 text-purple-600 focus:ring-purple-500">
                            <span class="ms-2 text-xs font-medium text-slate-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-xs font-semibold text-purple-700 hover:text-purple-800 hover:underline focus:outline-none"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                                class="flex w-full items-center justify-center rounded-xl bg-purple-600 px-5 py-3 text-sm font-bold text-white shadow-md shadow-purple-600/20 transition hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                            {{ __('Sign in') }}
                        </button>
                    </div>
                </form>

                <!-- Terms & Privacy Note -->
                <p class="mt-5 text-center text-[11px] leading-relaxed text-slate-400">
                    By continuing, you agree to our
                    <button type="button" onclick="openAuthModal('termsAuthModal')" class="font-semibold text-purple-700 hover:underline">Terms & Conditions</button>
                    and
                    <button type="button" onclick="openAuthModal('privacyAuthModal')" class="font-semibold text-purple-700 hover:underline">Privacy Policy</button>.
                </p>
            </div>

            <!-- Bottom Register Link -->
            @if (Route::has('register'))
                <div class="mt-8 text-center text-xs text-slate-500">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-bold text-purple-700 hover:underline">
                        Create one
                    </a>
                </div>
            @endif
        </div>

    </div>

    <!-- Terms & Conditions Modal -->
    <div id="termsAuthModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
        <div class="w-full max-w-lg rounded-2xl border border-purple-100 bg-white p-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-purple-100 pb-3 mb-4">
                <h3 class="text-lg font-extrabold text-purple-950">Terms & Conditions</h3>
                <button type="button" onclick="closeAuthModal('termsAuthModal')" class="text-xl font-bold leading-none text-slate-400 hover:text-purple-700">×</button>
            </div>
            <div class="max-h-72 space-y-3 overflow-y-auto pr-1 text-sm leading-relaxed text-slate-600">
                <p><strong class="text-slate-800">1. Eligibility:</strong> Only enrolled students, faculty members, and authorized coaches with a valid school account may borrow sports equipment.</p>
                <p><strong class="text-slate-800">2. Care & Responsibility:</strong> Borrowers must inspect items upon pickup and return them in good condition within the scheduled session.</p>
                <p><strong class="text-slate-800">3. Lost or Damaged Gear:</strong> Any damage or unreturned items must be reported immediately to the PE Department or Sports Office.</p>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeAuthModal('termsAuthModal')" class="rounded-xl bg-purple-600 px-5 py-2 text-sm font-bold text-white transition hover:bg-purple-700">
                    Agree & Close
                </button>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div id="privacyAuthModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
        <div class="w-full max-w-lg rounded-2xl border border-purple-100 bg-white p-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-purple-100 pb-3 mb-4">
                <h3 class="text-lg font-extrabold text-purple-950">Privacy Policy</h3>
                <button type="button" onclick="closeAuthModal('privacyAuthModal')" class="text-xl font-bold leading-none text-slate-400 hover:text-purple-700">×</button>
            </div>
            <div class="max-h-72 space-y-3 overflow-y-auto pr-1 text-sm leading-relaxed text-slate-600">
                <p><strong class="text-slate-800">1. Information We Collect:</strong> We collect your name, email, gender, phone number, student/employee ID, course and section or department, and borrowing history for school sports equipment tracking.</p>
                <p><strong class="text-slate-800">2. How We Use Information:</strong> Records are used to verify requests, log borrow/return timestamps, and manage equipment accountability.</p>
                <p><strong class="text-slate-800">3. Data Protection:</strong> All records remain confidential within the School Sports Office and PE Department.</p>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeAuthModal('privacyAuthModal')" class="rounded-xl bg-purple-600 px-5 py-2 text-sm font-bold text-white transition hover:bg-purple-700">
                    I Understand
                </button>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function openAuthModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAuthModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-guest-layout>