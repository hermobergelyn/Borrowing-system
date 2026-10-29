<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrow Equipment') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl p-6 sm:p-8">
                
                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">New Borrowing Request</h3>
                    <p class="text-xs text-gray-500">Fill out the form below to record an equipment borrowing.</p>
                </div>

                @php
                    $role = strtolower(trim(auth()->user()->role ?? ''));
                    $isAdmin = in_array($role, ['admin', 'sports coordinator']);
                @endphp

                <form method="POST" action="{{ route('borrowings.store') }}" class="space-y-6">
                    @csrf

                    {{-- KUNG ADMIN, KAILANGAN PUMILI KUNG SINONG USER/STUDENT ANG NAG-BORROW --}}
                    @if($isAdmin)
                        <div>
                            <label for="user_id" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Borrower (Student / Staff)</label>
                            <select name="user_id" id="user_id" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                                <option value="">-- Select borrower --</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }} ({{ ucfirst($u->role) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div>
                        <label for="equipment_id" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Equipment</label>
                        <select name="equipment_id" id="equipment_id" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                            <option value="">-- Select equipment --</option>
                            @foreach($equipment as $item)
                                <option value="{{ $item->id }}" {{ old('equipment_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }} ({{ $item->available_quantity }} available)
                                </option>
                            @endforeach
                        </select>
                        @error('equipment_id') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="quantity" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity', 1) }}" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                        @error('quantity') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="borrowed_date" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Borrowed Date</label>
                        <input type="date" name="borrowed_date" id="borrowed_date" value="{{ old('borrowed_date', date('Y-m-d')) }}" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                        @error('borrowed_date') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ $isAdmin ? route('admin.borrowings.index') : route('borrowings.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-xl">Cancel</a>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl shadow-sm">Submit Request</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>