<x-app-layout>
    @php
        $currentDate = now()->format('l, F j');
        $role = strtolower(trim(auth()->user()->role ?? ''));
        $isAdmin = in_array($role, ['admin', 'sports coordinator']);
        $isStudentOrStaff = in_array($role, ['student', 'staff']);
    @endphp

    <div class="min-h-screen bg-gradient-to-b from-purple-50/70 via-white to-white px-4 py-7 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl space-y-6">

            {{-- 1. Top Date, Title & Primary Action --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-bold text-purple-600 tracking-wide">
                        {{ $currentDate }}
                    </p>
                    <h1 class="mt-0.5 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Borrowing <span class="text-purple-700">Logs</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        @if($isAdmin)
                            Track all sports equipment borrowing requests, active items, and confirmed returns.
                        @else
                            View your sports equipment borrowing history, active items, and return requests.
                        @endif
                    </p>
                </div>

                @if($isStudentOrStaff || $isAdmin)
                    <a href="{{ route('borrowings.create') }}"
                       class="inline-flex w-fit items-center gap-2 rounded-xl bg-purple-600 px-4 py-2.5 text-xs sm:text-sm font-bold text-white shadow-sm shadow-purple-600/20 transition hover:bg-purple-700 whitespace-nowrap">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>{{ $isAdmin ? '+ Add borrowing record' : '+ Borrow equipment' }}</span>
                    </a>
                @endif
            </div>

            {{-- SUCCESS / ERROR MESSAGES --}}
            @if(session('success'))
                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-2xs flex items-center gap-2.5">
                    <svg class="h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 shadow-2xs">
                    <p class="font-bold">{{ session('error') }}</p>
                </div>
            @endif

            {{-- 2. Borrowing Records Table Card --}}
            <section class="rounded-2xl border border-purple-200/80 bg-white shadow-2xs overflow-hidden">

                <div class="p-5 sm:p-6 border-b border-purple-100 bg-gradient-to-r from-purple-50/50 via-white to-white">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-3.5">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                        @if($isAdmin) All borrowing records @else My borrowing records @endif
                                    </h2>
                                    <span class="rounded-full bg-purple-100/80 px-2.5 py-0.5 text-xs font-bold text-purple-800">
                                        {{ method_exists($borrowings, 'total') ? $borrowings->total() : $borrowings->count() }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Monitor borrowed quantities, borrowing dates, return timestamps, and status
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-purple-100/80 text-left border-collapse">
                        <thead>
                            <tr class="bg-purple-50/75 border-b border-purple-100 text-purple-900/65 text-xs uppercase tracking-wider font-bold">
                                @if($isAdmin)
                                    <th class="px-5 py-3.5">Borrower</th>
                                @endif
                                <th class="px-5 py-3.5">Equipment</th>
                                <th class="px-5 py-3.5 text-center">Qty</th>
                                <th class="px-5 py-3.5">Borrowed Date</th>
                                <th class="px-5 py-3.5">Returned At</th>
                                <th class="px-5 py-3.5 text-center">Status</th>
                                <th class="px-5 py-3.5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-purple-100/70 text-sm bg-white">
                            @forelse($borrowings as $borrowing)
                                <tr class="hover:bg-purple-50/45 transition">
                                    @if($isAdmin)
                                        <td class="px-5 py-3.5 whitespace-nowrap align-middle">
                                            <div class="font-bold text-slate-900 text-xs sm:text-sm">{{ $borrowing->user->name ?? 'Unknown' }}</div>
                                            <div class="text-slate-500 text-xs capitalize">{{ $borrowing->user->role ?? '' }}</div>
                                        </td>
                                    @endif

                                    <td class="px-5 py-3.5 whitespace-nowrap font-bold text-slate-800 text-xs sm:text-sm align-middle">
                                        {{ $borrowing->equipment->name ?? 'Unknown' }}
                                    </td>

                                    <td class="px-5 py-3.5 whitespace-nowrap text-center font-extrabold text-purple-900 text-xs sm:text-sm align-middle">
                                        {{ $borrowing->quantity }}
                                    </td>

                                    <td class="px-5 py-3.5 whitespace-nowrap text-slate-600 text-xs align-middle">
                                        {{ $borrowing->borrowed_date ? \Carbon\Carbon::parse($borrowing->borrowed_date)->format('M d, Y') : '—' }}
                                    </td>

                                    <td class="px-5 py-3.5 whitespace-nowrap text-slate-600 text-xs align-middle">
                                        {{ $borrowing->returned_at?->format('M d, Y h:i A') ?? '—' }}
                                    </td>

                                    <td class="px-5 py-3.5 whitespace-nowrap text-center align-middle">
                                        <span class="inline-flex items-center rounded-full px-3 py-0.5 text-[11px] font-bold
                                            @if($borrowing->status === 'borrowed') bg-amber-50 text-amber-700 ring-1 ring-amber-200/80
                                            @elseif($borrowing->status === 'return_pending') bg-purple-100 text-purple-800 ring-1 ring-purple-200/80
                                            @else bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/80 @endif">
                                            {{ str_replace('_', ' ', ucfirst($borrowing->status)) }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-3.5 whitespace-nowrap text-right align-middle">
                                        <div class="inline-flex items-center justify-end gap-1.5">
                                            @if($isStudentOrStaff && $borrowing->status === 'borrowed')
                                                <form method="POST" action="{{ route('borrowings.request-return', $borrowing) }}" onsubmit="return confirm('Request return?');" class="inline">
                                                    @csrf
                                                    <button type="submit" class="rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold px-3 py-1.5 text-xs shadow-2xs transition">
                                                        Return
                                                    </button>
                                                </form>
                                            @endif

                                            @if($isAdmin)
                                                @if($borrowing->status === 'return_pending')
                                                    <form method="POST" action="{{ route('borrowings.confirm-return', $borrowing) }}" onsubmit="return confirm('Confirm return?');" class="inline">
                                                        @csrf
                                                        <button type="submit" class="rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-1.5 text-xs shadow-2xs transition">
                                                            Confirm
                                                        </button>
                                                    </form>
                                                @endif

                                                <a href="{{ route('borrowings.edit', $borrowing) }}"
                                                   title="Edit Borrowing Log"
                                                   class="p-2 bg-purple-50 text-purple-700 hover:bg-purple-600 hover:text-white rounded-xl transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form method="POST" action="{{ route('borrowings.destroy', $borrowing) }}" onsubmit="return confirm('Delete this log?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            title="Delete Borrowing Log"
                                                            class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $isAdmin ? 7 : 6 }}" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-2xl mb-3">
                                                📋
                                            </div>
                                            <h3 class="text-base font-extrabold text-slate-900">No Borrowing Records Found</h3>
                                            <p class="text-xs sm:text-sm text-slate-500 mt-1">There are no equipment borrowing logs to display yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($borrowings->hasPages())
                    <div class="px-6 py-4 border-t border-purple-100 bg-purple-50/30">
                        {{ $borrowings->links() }}
                    </div>
                @endif

            </section>

        </div>
    </div>
</x-app-layout>