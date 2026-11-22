<x-app-layout>
    @php
        $currentDate = now()->format('l, F j');
        $role = strtolower(trim(auth()->user()->role ?? ''));
        $isAdmin = in_array($role, ['admin', 'sports coordinator']);
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
                        Borrow <span class="text-purple-700">Equipment</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Fill out the form below to record a new sports equipment borrowing request.
                    </p>
                </div>

                <a href="{{ $isAdmin ? route('admin.borrowings.index') : route('borrowings.index') }}"
                   class="inline-flex w-fit items-center gap-1.5 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-bold text-purple-800 shadow-2xs transition hover:border-purple-300 hover:bg-purple-50">
                    <span>← Back to logs</span>
                </a>
            </div>

            <!-- Full-Width Form Card -->
            <section class="rounded-2xl border border-purple-200/80 bg-white p-6 sm:p-8 shadow-2xs">
                <form method="POST" action="{{ route('borrowings.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        {{-- KUNG ADMIN, KAILANGAN PUMILI KUNG SINONG USER/STUDENT ANG NAG-BORROW --}}
                        @if($isAdmin)
                            <div class="md:col-span-2">
                                <label for="user_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Borrower (Student / Staff)
                                </label>
                                <select name="user_id" id="user_id" required
                                        class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                                    <option value="">-- Select borrower --</option>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                            {{ $u->name }} ({{ ucfirst($u->role) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        <div class="{{ $isAdmin ? '' : 'md:col-span-2' }}">
                            <label for="equipment_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Equipment
                            </label>
                            <select name="equipment_id" id="equipment_id" required
                                    class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                                <option value="">-- Select equipment --</option>
                                @foreach($equipment as $item)
                                    <option value="{{ $item->id }}" {{ old('equipment_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} ({{ $item->available_quantity }} available)
                                    </option>
                                @endforeach
                            </select>
                            @error('equipment_id') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="quantity" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Quantity
                            </label>
                            <input type="number" name="quantity" id="quantity" min="1"
                                   value="{{ old('quantity', 1) }}" required
                                   class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                            @error('quantity') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="borrowed_date" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Borrowed Date
                            </label>
                            <input type="date" name="borrowed_date" id="borrowed_date"
                                   value="{{ old('borrowed_date', date('Y-m-d')) }}" required
                                   class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                            @error('borrowed_date') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-5 border-t border-purple-100">
                        <a href="{{ $isAdmin ? route('admin.borrowings.index') : route('borrowings.index') }}"
                           class="text-xs sm:text-sm font-bold text-slate-500 hover:text-purple-800 transition">
                            Cancel
                        </a>
                        <button type="submit"
                                class="rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-2.5 text-xs sm:text-sm shadow-sm shadow-purple-600/20 transition focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                            Submit Request
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>