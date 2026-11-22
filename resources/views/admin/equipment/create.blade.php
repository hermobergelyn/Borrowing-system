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
                        Add <span class="text-purple-700">Equipment</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Add new sports equipment and set initial stock in your inventory.
                    </p>
                </div>

                <a href="{{ route('equipment.index') }}"
                   class="inline-flex w-fit items-center gap-1.5 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-bold text-purple-800 shadow-2xs transition hover:border-purple-300 hover:bg-purple-50">
                    <span>← Back to equipment</span>
                </a>
            </div>

            <!-- Full-Width Form Card -->
            <section class="rounded-2xl border border-purple-200/80 bg-white shadow-2xs overflow-hidden">

                <!-- Header Strip inside Card -->
                <div class="px-6 py-5 sm:px-8 border-b border-purple-100 bg-gradient-to-r from-purple-50/70 via-white to-white flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-purple-100 text-2xl text-purple-700">
                        🏀
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">
                            Equipment Details
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500">
                            Enter the sports item information below.
                        </p>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('equipment.store') }}" class="p-6 sm:p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                        <!-- Equipment Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Equipment Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                placeholder="Example: Basketball"
                                required
                                class="w-full rounded-xl border px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20 @error('name') border-rose-400 bg-rose-50/40 @else border-purple-200 bg-purple-50/30 @enderror"
                            >
                            @error('name')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Category
                            </label>
                            <input
                                type="text"
                                name="category"
                                id="category"
                                value="{{ old('category') }}"
                                placeholder="Example: Ball"
                                required
                                class="w-full rounded-xl border px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20 @error('category') border-rose-400 bg-rose-50/40 @else border-purple-200 bg-purple-50/30 @enderror"
                            >
                            @error('category')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Total Quantity -->
                        <div>
                            <label for="total_quantity" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Total Quantity
                            </label>
                            <input
                                type="number"
                                name="total_quantity"
                                id="total_quantity"
                                value="{{ old('total_quantity') }}"
                                placeholder="Example: 10"
                                min="1"
                                required
                                class="w-full rounded-xl border px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20 @error('total_quantity') border-rose-400 bg-rose-50/40 @else border-purple-200 bg-purple-50/30 @enderror"
                            >
                            @error('total_quantity')
                                <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <p class="text-xs text-slate-400">
                        Enter the total number of units available in your inventory.
                    </p>

                    <!-- Stock Info Banner -->
                    <div class="rounded-xl border border-purple-200/80 bg-purple-50/60 p-4">
                        <div class="flex gap-3 items-start">
                            <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-purple-100 text-xs font-extrabold text-purple-700 mt-0.5">
                                i
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm font-bold text-purple-950">
                                    Stock Information
                                </p>
                                <p class="text-xs text-slate-600 mt-0.5">
                                    When you add equipment, the available quantity will automatically be set equal to the total quantity.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between pt-5 border-t border-purple-100">
                        <a
                            href="{{ route('equipment.index') }}"
                            class="text-xs sm:text-sm font-bold text-slate-500 hover:text-purple-800 transition"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-2.5 shadow-sm shadow-purple-600/20 transition text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                        >
                            Add Equipment
                        </button>
                    </div>
                </form>

            </section>

        </div>
    </div>
</x-app-layout>