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
                        Edit Borrowing <span class="text-purple-700">Record</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Update Record #{{ $borrowing->id }} — modify the borrower, equipment, quantity, return date, or status.
                    </p>
                </div>

                <a href="{{ route('admin.borrowings.index') }}"
                   class="inline-flex w-fit items-center gap-1.5 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs sm:text-sm font-bold text-purple-800 shadow-2xs transition hover:border-purple-300 hover:bg-purple-50">
                    <span>← Back to logs</span>
                </a>
            </div>

            <!-- Full-Width Form Card -->
            <section class="rounded-2xl border border-purple-200/80 bg-white p-6 sm:p-8 shadow-2xs">
                <form method="POST" action="{{ route('borrowings.update', $borrowing) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        {{-- BORROWER SELECTION --}}
                        <div>
                            <label for="user_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Borrower (Student / Staff)
                            </label>
                            <select name="user_id" id="user_id" required
                                    class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                                <option value="">-- Select borrower --</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}" @selected(old('user_id', $borrowing->user_id) == $u->id)>
                                        {{ $u->name }} ({{ ucfirst($u->role) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- EQUIPMENT SELECTION --}}
                        <div>
                            <label for="equipment_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Equipment
                            </label>
                            <select name="equipment_id" id="equipment_id" required
                                    class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                                <option value="">-- Select equipment --</option>
                                @foreach($equipment as $item)
                                    <option value="{{ $item->id }}" @selected(old('equipment_id', $borrowing->equipment_id) == $item->id)>
                                        {{ $item->name }} ({{ $item->available_quantity }} available)
                                    </option>
                                @endforeach
                            </select>
                            @error('equipment_id') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- QUANTITY --}}
                        <div>
                            <label for="quantity" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Quantity
                            </label>
                            <input type="number" name="quantity" id="quantity" min="1"
                                   value="{{ old('quantity', $borrowing->quantity) }}" required
                                   class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                            @error('quantity') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- BORROWED DATE --}}
                        <div>
                            <label for="borrowed_date" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Borrowed Date
                            </label>
                            <input type="date" name="borrowed_date" id="borrowed_date"
                                   value="{{ old('borrowed_date', $borrowing->borrowed_date ? \Carbon\Carbon::parse($borrowing->borrowed_date)->format('Y-m-d') : '') }}" required
                                   class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                            @error('borrowed_date') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- STATUS SELECTION --}}
                        <div class="{{ old('status', $borrowing->status) === 'returned' ? '' : 'md:col-span-2' }}">
                            <label for="status" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Status
                            </label>
                            <select name="status" id="status" required
                                    class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                                <option value="borrowed" @selected(old('status', $borrowing->status) === 'borrowed')>Borrowed</option>
                                <option value="return_pending" @selected(old('status', $borrowing->status) === 'return_pending')>Return Pending</option>
                                <option value="returned" @selected(old('status', $borrowing->status) === 'returned')>Returned</option>
                            </select>
                            @error('status') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- RETURNED DATE FIELD --}}
                        <div id="returned_at_container" class="{{ old('status', $borrowing->status) === 'returned' ? '' : 'hidden' }}">
                            <label for="returned_at" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Returned Date & Time
                            </label>
                            <input type="datetime-local" name="returned_at" id="returned_at"
                                   value="{{ old('returned_at', $borrowing->returned_at ? \Carbon\Carbon::parse($borrowing->returned_at)->format('Y-m-d\TH:i') : date('Y-m-d\TH:i')) }}"
                                   class="w-full rounded-xl border border-purple-200 bg-purple-50/30 px-4 py-2.5 text-sm text-slate-900 shadow-2xs transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                            <span class="text-xs text-slate-400 mt-1 block">Set the exact date and time when the sports equipment was returned.</span>
                            @error('returned_at') <span class="text-xs font-medium text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-5 border-t border-purple-100">
                        <a href="{{ route('admin.borrowings.index') }}"
                           class="text-xs sm:text-sm font-bold text-slate-500 hover:text-purple-800 transition">
                            Cancel
                        </a>
                        <button type="submit"
                                class="rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-2.5 text-xs sm:text-sm shadow-sm shadow-purple-600/20 transition focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                            Save Changes
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.getElementById('status');
            const returnedContainer = document.getElementById('returned_at_container');

            function toggleReturnedField() {
                if (statusSelect.value === 'returned') {
                    returnedContainer.classList.remove('hidden');
                    statusSelect.parentElement.classList.remove('md:col-span-2');
                } else {
                    returnedContainer.classList.add('hidden');
                    statusSelect.parentElement.classList.add('md:col-span-2');
                }
            }

            statusSelect.addEventListener('change', toggleReturnedField);
        });
    </script>
</x-app-layout>