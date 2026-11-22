<x-guest-layout>
    <!-- Full-Screen Sports Equipment Background -->
    <div class="fixed inset-0 z-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/sports-rack-bg.jpg') }}');">
        <!-- Dark overlay + subtle blur para hilom ang background -->
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-[2px]"></div>
    </div>

    <!-- Centered Login Card Above Background -->
    <div class="relative z-10 flex min-h-screen items-center justify-center px-4 py-10">
        <div class="w-full max-w-md rounded-2xl border border-white/15 bg-slate-950/85 p-7 text-white shadow-2xl backdrop-blur-md">

            <!-- System Title & Context -->
            <div class="mb-6 text-center">
                <span class="inline-block rounded-full border border-emerald-400/30 bg-emerald-500/15 px-3 py-1 text-xs font-semibold text-emerald-300">
                    Sports Equipment Logbook
                </span>
                <h1 class="mt-2.5 text-lg font-bold leading-snug text-white">
                    School Sports Equipment Borrowing Logbook System
                </h1>
                <p class="mt-1 text-xs text-slate-300">
                    Sign in to manage or borrow sports equipment
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-emerald-300" :status="session('status')" />

            <!-- Google OAuth Error Alert -->
            @if (session('error'))
                <div class="mb-4 rounded-lg border border-red-400/30 bg-red-500/15 p-3 text-sm text-red-200">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-200">
                        {{ __('Email') }}
                    </label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="username"
                           class="mt-1.5 block w-full rounded-lg border border-slate-700 bg-slate-900/90 px-3.5 py-2.5 text-sm text-white placeholder-slate-400 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-slate-200">
                        {{ __('Password') }}
                    </label>
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           class="mt-1.5 block w-full rounded-lg border border-slate-700 bg-slate-900/90 px-3.5 py-2.5 text-sm text-white placeholder-slate-400 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                </div>

                <!-- Remember Me -->
                <div class="mt-4 block">
                    <label for="remember_me" class="inline-flex cursor-pointer items-center">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-blue-600 focus:ring-blue-500">
                        <span class="ms-2 text-sm text-slate-300">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password & Log In Button -->
                <div class="mt-5 flex items-center justify-between gap-3">
                    @if (Route::has('password.request'))
                        <a class="rounded-md text-xs font-medium text-slate-300 underline hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit"
                            class="ms-auto inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-white shadow transition duration-150 ease-in-out hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-950">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-700"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="bg-slate-950/90 px-3 text-slate-400">
                        Or continue with
                    </span>
                </div>
            </div>

            <!-- Google Sign-In Button -->
            <div>
                <a href="{{ route('auth.google') }}"
                   class="flex w-full items-center justify-center rounded-lg border border-slate-300/30 bg-white px-4 py-2.5 text-xs font-semibold uppercase tracking-widest text-slate-900 shadow-sm transition duration-150 ease-in-out hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-950">
                    <svg class="me-2 h-5 w-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.19v3.15C3.17 21.36 7.21 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.19C.43 8.12 0 9.87 0 12s.43 3.88 1.19 5.42l4.09-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.21 0 3.17 2.64 1.19 6.58l4.09 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    {{ __('Sign in with Google') }}
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>