<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight tracking-tight">
                    Add Equipment
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Add new sports equipment to the inventory
                </p>
            </div>

            <a
                href="{{ route('equipment.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition shadow-sm"
            >
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">

                {{-- HEADER CARD SECTION --}}
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                            🏀
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 tracking-tight">
                                Equipment Details
                            </h3>
                            <p class="text-sm text-gray-500">
                                Enter the equipment information below.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FORM --}}
                <form
                    method="POST"
                    action="{{ route('equipment.store') }}"
                    class="p-8 space-y-6"
                >
                    @csrf

                    {{-- EQUIPMENT NAME --}}
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
                            Equipment Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="Example: Basketball"
                            required
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 text-sm @error('name') border-red-500 @else border-gray-300 @enderror"
                        >
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- CATEGORY --}}
                    <div>
                        <label
                            for="category"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
                            Category
                        </label>
                        <input
                            type="text"
                            name="category"
                            id="category"
                            value="{{ old('category') }}"
                            placeholder="Example: Ball"
                            required
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 text-sm @error('category') border-red-500 @else border-gray-300 @enderror"
                        >
                        @error('category')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- TOTAL QUANTITY --}}
                    <div>
                        <label
                            for="total_quantity"
                            class="block text-sm font-medium text-gray-700 mb-1"
                        >
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
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 text-sm @error('total_quantity') border-red-500 @else border-gray-300 @enderror"
                        >
                        <p class="mt-1 text-xs text-gray-500">
                            Enter the total number of units available in your inventory.
                        </p>
                        @error('total_quantity')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- DATABASE INFO BANNER --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex gap-3 items-start">
                            <div class="text-blue-600 text-base mt-0.5">
                                ℹ️
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-blue-900">
                                    Stock Information
                                </p>
                                <p class="text-xs text-blue-700 mt-0.5">
                                    When you add equipment, the available quantity will automatically be set equal to the total quantity.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <a
                            href="{{ route('equipment.index') }}"
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-150"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow-sm transition duration-150 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Add Equipment
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>