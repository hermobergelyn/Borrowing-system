<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Borrowing Record') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl p-6 sm:p-8">
                
                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Update Record #{{ $borrowing->id }}</h3>
                    <p class="text-xs text-gray-500">Modify the borrower, equipment, quantity, return date, or status of this borrowing log.</p>
                </div>

                <form method="POST" action="{{ route('borrowings.update', $borrowing) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- BORROWER SELECTION --}}
                    <div>
                        <label for="user_id" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Borrower (Student / Staff)</label>
                        <select name="user_id" id="user_id" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                            <option value="">-- Select borrower --</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id', $borrowing->user_id) == $u->id)>
                                    {{ $u->name }} ({{ ucfirst($u->role) }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- EQUIPMENT SELECTION --}}
                    <div>
                        <label for="equipment_id" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Equipment</label>
                        <select name="equipment_id" id="equipment_id" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                            <option value="">-- Select equipment --</option>
                            @foreach($equipment as $item)
                                <option value="{{ $item->id }}" @selected(old('equipment_id', $borrowing->equipment_id) == $item->id)>
                                    {{ $item->name }} ({{ $item->available_quantity }} available)
                                </option>
                            @endforeach
                        </select>
                        @error('equipment_id') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- QUANTITY --}}
                    <div>
                        <label for="quantity" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity', $borrowing->quantity) }}" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                        @error('quantity') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- BORROWED DATE --}}
                    <div>
                        <label for="borrowed_date" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Borrowed Date</label>
                        <input type="date" name="borrowed_date" id="borrowed_date" value="{{ old('borrowed_date', $borrowing->borrowed_date ? \Carbon\Carbon::parse($borrowing->borrowed_date)->format('Y-m-d') : '') }}" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                        @error('borrowed_date') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- STATUS SELECTION --}}
                    <div>
                        <label for="status" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Status</label>
                        <select name="status" id="status" required class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                            <option value="borrowed" @selected(old('status', $borrowing->status) === 'borrowed')>Borrowed</option>
                            <option value="return_pending" @selected(old('status', $borrowing->status) === 'return_pending')>Return Pending</option>
                            <option value="returned" @selected(old('status', $borrowing->status) === 'returned')>Returned</option>
                        </select>
                        @error('status') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- RETURNED DATE FIELD (KAPAG PETSA NA ISINAULI NI ADMIN/STUDENT) --}}
                    <div id="returned_at_container" class="{{ old('status', $borrowing->status) === 'returned' ? '' : 'hidden' }}">
                        <label for="returned_at" class="block text-xs font-semibold text-gray-600 uppercase mb-2">Returned Date & Time</label>
                        <input type="datetime-local" name="returned_at" id="returned_at" value="{{ old('returned_at', $borrowing->returned_at ? \Carbon\Carbon::parse($borrowing->returned_at)->format('Y-m-d\TH:i') : date('Y-m-d\TH:i')) }}" class="w-full border-gray-300 rounded-xl shadow-sm text-sm py-2.5">
                        <span class="text-xs text-gray-400 mt-1 block">I-set ang petsa at oras kung kailan opisyal na naibalik ang kagamitan.</span>
                        @error('returned_at') <span class="text-xs text-rose-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.borrowings.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-xl">Cancel</a>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl shadow-sm">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- SCRIPT PARA ILABAS/ITAGO ANG RETURNED AT FIELD DEPENDING SA STATUS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.getElementById('status');
            const returnedContainer = document.getElementById('returned_at_container');

            function toggleReturnedField() {
                if (statusSelect.value === 'returned') {
                    returnedContainer.classList.remove('hidden');
                } else {
                    returnedContainer.classList.add('hidden');
                }
            }

            statusSelect.addEventListener('change', toggleReturnedField);
        });
    </script>
</x-app-layout>