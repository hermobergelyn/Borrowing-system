<x-app-layout>
    @php
        $currentDate = now()->format('l, F j');
    @endphp

    {{-- ALPINE.JS SEARCH STATE --}}
    <div class="min-h-screen bg-gradient-to-b from-purple-50/70 via-white to-white px-4 py-7 sm:px-6 lg:px-8"
         x-data="{ search: '' }">
        <div class="mx-auto max-w-6xl space-y-6">

            {{-- 1. Top Date, Title & Primary Add Button --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-bold text-purple-600 tracking-wide">
                        {{ $currentDate }}
                    </p>
                    <h1 class="mt-0.5 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Equipment <span class="text-purple-700">Management</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Manage sports equipment, categories, and available stock levels.
                    </p>
                </div>

                <a href="{{ route('equipment.create') }}"
                   class="inline-flex w-fit items-center gap-2 rounded-xl bg-purple-600 px-4 py-2.5 text-xs sm:text-sm font-bold text-white shadow-sm shadow-purple-600/20 transition hover:bg-purple-700 whitespace-nowrap">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Add equipment</span>
                </a>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-2xs flex items-center gap-2.5">
                    <svg class="h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- ERROR MESSAGE --}}
            @if (session('error'))
                <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 shadow-2xs">
                    <p class="font-bold">{{ session('error') }}</p>
                </div>
            @endif

            {{-- VALIDATION ERRORS --}}
            @if ($errors->any())
                <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 shadow-2xs">
                    <p class="font-bold mb-1">Please check the following:</p>
                    <ul class="list-disc list-inside text-xs space-y-1 text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 2. Equipment Table Card with Aligned Search Bar --}}
            <section class="rounded-2xl border border-purple-200/80 bg-white shadow-2xs overflow-hidden">

                <div class="p-5 sm:p-6 border-b border-purple-100 bg-gradient-to-r from-purple-50/50 via-white to-white">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-3.5">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                        Sports equipment inventory
                                    </h2>
                                    <span class="rounded-full bg-purple-100/80 px-2.5 py-0.5 text-xs font-bold text-purple-800">
                                        {{ $equipments->count() }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    List of sports equipment and real-time stock availability
                                </p>
                            </div>
                        </div>

                        {{-- ALIGNED OFFLINE INSTANT SEARCH BAR --}}
                        <div class="relative w-full sm:w-72 shrink-0">
                            <input
                                type="text"
                                x-model="search"
                                placeholder="Search equipment or category..."
                                class="w-full rounded-xl border border-purple-200 bg-purple-50/40 py-2 pl-9 pr-8 text-xs sm:text-sm text-slate-800 placeholder-slate-400 transition focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-500/20"
                            >
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-purple-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <button type="button"
                                    x-show="search !== ''"
                                    @click="search = ''"
                                    aria-label="Clear search"
                                    class="absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400 hover:text-purple-700 text-sm font-bold"
                                    style="display: none;">
                                ×
                            </button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-purple-100/80 text-left border-collapse">
                        <thead>
                            <tr class="bg-purple-50/75 border-b border-purple-100 text-purple-900/65 text-xs uppercase tracking-wider font-bold">
                                <th class="px-5 py-3.5">#</th>
                                <th class="px-5 py-3.5">Equipment Name</th>
                                <th class="px-5 py-3.5">Category</th>
                                <th class="px-5 py-3.5 text-center">Total Qty</th>
                                <th class="px-5 py-3.5 text-center">Available Qty</th>
                                <th class="px-5 py-3.5 text-center">Status</th>
                                <th class="px-5 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-purple-100/70 text-sm bg-white">
                            @forelse ($equipments as $item)
                                <tr class="hover:bg-purple-50/45 transition"
                                    x-show="search === '' ||
                                          '{{ strtolower($item->name) }}'.includes(search.toLowerCase()) ||
                                          '{{ strtolower($item->category) }}'.includes(search.toLowerCase())">

                                    <td class="px-5 py-3.5 whitespace-nowrap text-xs sm:text-sm font-bold text-purple-700/80 align-middle">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap align-middle">
                                        <div class="text-xs sm:text-sm font-bold text-slate-900">
                                            {{ $item->name }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap align-middle">
                                        <span class="inline-flex items-center rounded-full bg-purple-100/80 px-2.5 py-0.5 text-[11px] font-bold text-purple-800">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-center align-middle">
                                        <span class="text-xs sm:text-sm font-bold text-slate-800">
                                            {{ $item->total_quantity }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-center align-middle">
                                        <span class="text-xs sm:text-sm font-extrabold {{ $item->available_quantity > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                            {{ $item->available_quantity }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-center align-middle">
                                        @if ($item->available_quantity <= 0)
                                            <span class="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-0.5 text-[11px] font-bold text-rose-700 ring-1 ring-rose-200/70">
                                                Out of Stock
                                            </span>
                                        @elseif ($item->available_quantity < $item->total_quantity)
                                            <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-[11px] font-bold text-amber-700 ring-1 ring-amber-200/70">
                                                Partially Available
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700 ring-1 ring-emerald-200/70">
                                                Available
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-right align-middle">
                                        <div class="inline-flex items-center justify-end gap-1.5">
                                            <a href="{{ route('equipment.edit', $item->id) }}"
                                               title="Edit Equipment"
                                               class="p-2 bg-purple-50 text-purple-700 hover:bg-purple-600 hover:text-white rounded-xl transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('equipment.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this equipment?');"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        title="Delete Equipment"
                                                        class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-2xl mb-3">
                                                🏀
                                            </div>
                                            <h3 class="text-base font-extrabold text-slate-900">No Equipment Found</h3>
                                            <p class="text-xs sm:text-sm text-slate-500 mt-1">There are no sports equipment records yet.</p>
                                            <a href="{{ route('equipment.create') }}"
                                               class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-purple-600 px-4 py-2.5 text-xs sm:text-sm font-bold text-white shadow-sm transition hover:bg-purple-700">
                                                <span>+ Add First Equipment</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </section>

        </div>
    </div>
</x-app-layout>