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
                        Edit <span class="text-purple-700">Equipment</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Update the details and stock count of this sports item.
                    </p>
                </div>

                <a href="{{ route('equipment.index') }}"
                   class="inline-flex w-fit items-center gap-1.5 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-bold text-purple-800 shadow-2xs transition hover:border-purple-300 hover:bg-purple-50">
                    <span>← Back to equipment</span>
                </a>
            </div>

            <!-- Error Messages -->
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
                <form action="{{ route('equipment.update', $equipment) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                        <!-- Equipment Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Equipment Name
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $equipment->name) }}"
                                required
                                placeholder="e.g. Basketball"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Category
                            </label>
                            <input
                                type="text"
                                id="category"
                                name="category"
                                value="{{ old('category', $equipment->category) }}"
                                required
                                placeholder="e.g. Balls"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label for="quantity" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Quantity
                            </label>
                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                value="{{ old('quantity', $equipment->quantity ?? $equipment->total_quantity) }}"
                                min="0"
                                required
                                placeholder="0"
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                            >
                        </div>
                    </div>

                    <!-- Actions -->
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
                            Update Equipment
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>