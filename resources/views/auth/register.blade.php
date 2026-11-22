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
                    Create your account
                </h1>
                <p class="mt-3 text-sm sm:text-base leading-relaxed text-purple-100">
                    Join SportsLog to easily check available PE equipment, submit borrowing requests online, and keep track of your logbook history.
                </p>

                <div class="mt-8 space-y-3.5 text-sm text-purple-50">
                    <div class="flex items-center gap-3 rounded-2xl bg-white/10 border border-white/15 px-4 py-3 backdrop-blur-sm">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/15 text-xs font-bold">
                            1
                        </span>
                        <span>Quick sign-up using your school email or Google account</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl bg-white/10 border border-white/15 px-4 py-3 backdrop-blur-sm">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/15 text-xs font-bold">
                            2
                        </span>
                        <span>Browse available sports gear in real time before class</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl bg-white/10 border border-white/15 px-4 py-3 backdrop-blur-sm">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/15 text-xs font-bold">
                            3
                        </span>
                        <span>Hassle-free digital borrowing without paper logbooks</span>
                    </div>
                </div>
            </div>

            <!-- Bottom System Label -->
            <div class="relative z-10 text-xs text-purple-100/85">
                School Sports Equipment Borrowing Logbook System
            </div>
        </div>

        <!-- Right Half (50%): Clean White Registration Form Panel -->
        <div class="flex flex-col justify-between bg-white px-6 py-10 sm:px-12 lg:px-16">
            <div class="mx-auto w-full max-w-md my-auto">

                <!-- Header -->
                <div class="mb-6">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700 mb-3">
                        Sports Equipment Logbook
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Sign up
                    </h2>
                    <p class="mt-1.5 text-sm text-slate-500">
                        Create your student or staff account to get started.
                    </p>
                </div>

                <!-- Google OAuth Error Alert -->
                @if (session('error'))
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Google Sign-Up Button -->
                <div>
                    <a href="{{ route('auth.google') }}"
                       class="flex w-full items-center justify-center gap-2.5 rounded-xl border border-purple-200 bg-purple-50/40 px-4 py-2.5 text-sm font-bold text-slate-800 shadow-sm transition hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-purple-500/30">
                        <svg class="h-5 w-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                        <span>{{ __('Sign up with Google') }}</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="relative my-5">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-[11px] font-semibold uppercase tracking-wider">
                        <span class="bg-white px-3 text-slate-400">
                            Or register with email
                        </span>
                    </div>
                </div>

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold uppercase tracking-wide text-slate-700">
                            {{ __('Full Name') }}
                        </label>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Juan Dela Cruz"
                               required
                               autofocus
                               autocomplete="name"
                               class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500/20" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-red-600" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-3.5">
                        <label for="email" class="block text-xs font-bold uppercase tracking-wide text-slate-700">
                            {{ __('Email address') }}
                        </label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="you@example.com"
                               required
                               autocomplete="username"
                               class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500/20" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-600" />
                    </div>

                    <div class="mt-3.5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div>
                            <label for="gender" class="block text-xs font-bold uppercase tracking-wide text-slate-700">
                                Gender
                            </label>
                            <select id="gender"
                                    name="gender"
                                    required
                                    class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                                <option value="">Select gender</option>
                                <option value="female" @selected(old('gender') === 'female')>Female</option>
                                <option value="male" @selected(old('gender') === 'male')>Male</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-1.5 text-xs text-red-600" />
                        </div>

                        <div>
                            <label for="phone" class="block text-xs font-bold uppercase tracking-wide text-slate-700">
                                Phone Number
                            </label>
                            <input id="phone"
                                   type="tel"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="09XX XXX XXXX"
                                   required
                                   autocomplete="tel"
                                   class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500/20" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-1.5 text-xs text-red-600" />
                        </div>
                    </div>
                    <p class="mt-2 text-[11px] leading-relaxed text-slate-500">
                        Your Student or Employee ID will be generated automatically after you select your role.
                    </p>

                    <!-- Password -->
                    <div class="mt-3.5">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wide text-slate-700">
                            {{ __('Password') }}
                        </label>
                        <div class="relative mt-1.5">
                            <input id="password"
                                   type="password"
                                   name="password"
                                   placeholder="Create a password"
                                   required
                                   autocomplete="new-password"
                                   class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 pr-10 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500/20" />
                            <button type="button"
                                    onclick="toggleFieldVisibility('password')"
                                    aria-label="Toggle password visibility"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-purple-700 transition">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-600" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-3.5">
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wide text-slate-700">
                            {{ __('Confirm Password') }}
                        </label>
                        <div class="relative mt-1.5">
                            <input id="password_confirmation"
                                   type="password"
                                   name="password_confirmation"
                                   placeholder="Re-enter your password"
                                   required
                                   autocomplete="new-password"
                                   class="block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 pr-10 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500/20" />
                            <button type="button"
                                    onclick="toggleFieldVisibility('password_confirmation')"
                                    aria-label="Toggle confirm password visibility"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-purple-700 transition">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-red-600" />
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                                class="flex w-full items-center justify-center rounded-xl bg-purple-600 px-5 py-3 text-sm font-bold text-white shadow-md shadow-purple-600/20 transition hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                            {{ __('Create Account') }}
                        </button>
                    </div>
                </form>

                <!-- Terms & Privacy Note -->
                <p class="mt-4 text-center text-[11px] leading-relaxed text-slate-400">
                    By creating an account, you agree to our
                    <button type="button" onclick="openRegModal('termsRegModal')" class="font-semibold text-purple-700 hover:underline">Terms & Conditions</button>
                    and
                    <button type="button" onclick="openRegModal('privacyRegModal')" class="font-semibold text-purple-700 hover:underline">Privacy Policy</button>.
                </p>
            </div>

            <!-- Bottom Login Link -->
            <div class="mt-6 text-center text-xs text-slate-500">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" class="font-bold text-purple-700 hover:underline">
                    Sign in
                </a>
            </div>
        </div>

    </div>

    <!-- Terms & Conditions Modal -->
    <div id="termsRegModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
        <div class="w-full max-w-lg rounded-2xl border border-purple-100 bg-white p-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-purple-100 pb-3 mb-4">
                <h3 class="text-lg font-extrabold text-purple-950">Terms & Conditions</h3>
                <button type="button" onclick="closeRegModal('termsRegModal')" class="text-xl font-bold leading-none text-slate-400 hover:text-purple-700">×</button>
            </div>
            <div class="max-h-72 space-y-3 overflow-y-auto pr-1 text-sm leading-relaxed text-slate-600">
                <p><strong class="text-slate-800">1. Eligibility:</strong> Only enrolled students, faculty members, and authorized coaches with a valid school account may borrow sports equipment.</p>
                <p><strong class="text-slate-800">2. Care & Responsibility:</strong> Borrowers must inspect items upon pickup and return them in good condition within the scheduled session.</p>
                <p><strong class="text-slate-800">3. Lost or Damaged Gear:</strong> Any damage or unreturned items must be reported immediately to the PE Department or Sports Office.</p>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeRegModal('termsRegModal')" class="rounded-xl bg-purple-600 px-5 py-2 text-sm font-bold text-white transition hover:bg-purple-700">
                    Agree & Close
                </button>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div id="privacyRegModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
        <div class="w-full max-w-lg rounded-2xl border border-purple-100 bg-white p-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-purple-100 pb-3 mb-4">
                <h3 class="text-lg font-extrabold text-purple-950">Privacy Policy</h3>
                <button type="button" onclick="closeRegModal('privacyRegModal')" class="text-xl font-bold leading-none text-slate-400 hover:text-purple-700">×</button>
            </div>
            <div class="max-h-72 space-y-3 overflow-y-auto pr-1 text-sm leading-relaxed text-slate-600">
                <p><strong class="text-slate-800">1. Information We Collect:</strong> We collect your name, email, gender, phone number, student/employee ID, course and section or department, and borrowing history for school sports equipment tracking.</p>
                <p><strong class="text-slate-800">2. How We Use Information:</strong> Records are used to verify requests, log borrow/return timestamps, and manage equipment accountability.</p>
                <p><strong class="text-slate-800">3. Data Protection:</strong> All records remain confidential within the School Sports Office and PE Department.</p>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeRegModal('privacyRegModal')" class="rounded-xl bg-purple-600 px-5 py-2 text-sm font-bold text-white transition hover:bg-purple-700">
                    I Understand
                </button>
            </div>
        </div>
    </div>

    <script>
        function toggleFieldVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function openRegModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeRegModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-guest-layout>