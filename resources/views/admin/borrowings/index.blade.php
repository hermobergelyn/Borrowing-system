<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowing Logs') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @php
                $role = strtolower(trim(auth()->user()->role ?? ''));
                $isAdmin = in_array($role, ['admin', 'sports coordinator']);
                $isStudentOrStaff = in_array($role, ['student', 'staff']);
            @endphp

            {{-- SUCCESS / ERROR MESSAGES --}}
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-xl shadow-sm text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-xl shadow-sm text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            {{-- HEADER ACTIONS: ADD BUTTON PARA SA STUDENT / STAFF O ADMIN --}}
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">
                    @if($isAdmin) All Borrowing Records @else My Borrowing Records @endif
                </h3>

                @if($isStudentOrStaff || $isAdmin)
                    <a href="{{ route('borrowings.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2.5 rounded-xl shadow-sm text-sm transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        {{ $isAdmin ? 'Add Borrowing Record' : 'Borrow Equipment' }}
                    </a>
                @endif
            </div>

            {{-- BORROWING RECORDS TABLE --}}
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl">
                <div class="p-6 sm:p-8 text-gray-900">
                    <div class="overflow-x-auto rounded-xl border border-gray-100 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50/75">
                                <tr>
                                    @if($isAdmin)
                                        <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Borrower</th>
                                    @endif
                                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Equipment</th>
                                    <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase">Qty</th>
                                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Borrowed Date</th>
                                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Returned At</th>
                                    <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                                    <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @forelse($borrowings as $borrowing)
                                    <tr class="hover:bg-gray-50/80 transition-colors">
                                        @if($isAdmin)
                                            <td class="px-5 py-4 whitespace-nowrap">
                                                <div class="font-semibold text-gray-900">{{ $borrowing->user->name ?? 'Unknown' }}</div>
                                                <div class="text-xs text-gray-500 capitalize">{{ $borrowing->user->role ?? '' }}</div>
                                            </td>
                                        @endif

                                        <td class="px-5 py-4 whitespace-nowrap font-medium text-gray-800">
                                            {{ $borrowing->equipment->name ?? 'Unknown' }}
                                        </td>

                                        <td class="px-5 py-4 whitespace-nowrap text-center font-semibold text-gray-600">
                                            {{ $borrowing->quantity }}
                                        </td>

                                        <td class="px-5 py-4 whitespace-nowrap text-gray-600 text-xs">
                                            {{ $borrowing->borrowed_date ? \Carbon\Carbon::parse($borrowing->borrowed_date)->format('M d, Y') : '—' }}
                                        </td>

                                        <td class="px-5 py-4 whitespace-nowrap text-gray-600 text-xs">
                                            {{ $borrowing->returned_at?->format('M d, Y h:i A') ?? '—' }}
                                        </td>

                                        <td class="px-5 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                                @if($borrowing->status === 'borrowed') bg-amber-50 text-amber-700 border border-amber-200 
                                                @elseif($borrowing->status === 'return_pending') bg-orange-50 text-orange-700 border border-orange-200 
                                                @else bg-emerald-50 text-emerald-700 border border-emerald-200 @endif">
                                                {{ ucfirst($borrowing->status) }}
                                            </span>
                                        </td>

                                        <td class="px-5 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                @if($isStudentOrStaff && $borrowing->status === 'borrowed')
                                                    <form method="POST" action="{{ route('borrowings.request-return', $borrowing) }}" onsubmit="return confirm('Request return?');">
                                                        @csrf
                                                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-3 py-1.5 rounded-lg text-xs">Return</button>
                                                    </form>
                                                @endif

                                                @if($isAdmin)
                                                    @if($borrowing->status === 'return_pending')
                                                        <form method="POST" action="{{ route('borrowings.confirm-return', $borrowing) }}" onsubmit="return confirm('Confirm return?');">
                                                            @csrf
                                                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-2.5 py-1.5 rounded-lg text-xs">Confirm</button>
                                                        </form>
                                                    @endif

                                                    {{-- HIWALAY NA EDIT PAGE LINK --}}
                                                    <a href="{{ route('borrowings.edit', $borrowing) }}" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-medium px-2.5 py-1.5 rounded-lg text-xs border border-indigo-200">
                                                        Edit
                                                    </a>

                                                    <form method="POST" action="{{ route('borrowings.destroy', $borrowing) }}" onsubmit="return confirm('Delete this log?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-700 font-medium px-2.5 py-1.5 rounded-lg text-xs border border-rose-200">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ $isAdmin ? 7 : 6 }}" class="px-5 py-12 text-center text-gray-400 text-sm">
                                            No borrowing records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $borrowings->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>