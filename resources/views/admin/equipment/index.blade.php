<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Equipment Management
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Manage sports equipment and available stock
                </p>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a
                    href="{{ route('equipment.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition whitespace-nowrap"
                >
                    + Add
                </a>
            </div>
        </div>
    </x-slot>

    {{-- DITO NAKALAGAY ANG ALPINE.JS SEARCH STATE --}}
    <div class="py-8" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR MESSAGE --}}
            @if (session('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-100 border border-red-300 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            {{-- VALIDATION ERRORS --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-100 border border-red-300 text-red-800">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- EQUIPMENT TABLE --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">

                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Sports Equipment
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                List of all available sports equipment (Instant Offline Search)
                            </p>
                        </div>

                        {{-- OFFLINE INSTANT SEARCH BAR --}}
                        <div class="relative w-full sm:w-64">
                            <input
                                type="text"
                                x-model="search"
                                placeholder="Type to filter..."
                                class="w-full text-sm border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 pl-9"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Equipment Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Quantity</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Available Quantity</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($equipments as $item)
                                <tr class="hover:bg-gray-50 transition"
                                    x-show="search === '' || 
                                          '{{ strtolower($item->name) }}'.includes(search.toLowerCase()) || 
                                          '{{ strtolower($item->category) }}'.includes(search.toLowerCase())">
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $item->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="text-sm font-semibold text-gray-800">
                                            {{ $item->total_quantity }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="text-sm font-semibold {{ $item->available_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $item->available_quantity }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($item->available_quantity <= 0)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Out of Stock</span>
                                        @elseif ($item->available_quantity < $item->total_quantity)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Partially Available</span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Available</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center items-center gap-2">
                                            <a href="{{ route('equipment.edit', $item->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg text-xs font-semibold hover:bg-blue-200 transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('equipment.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg text-xs font-semibold hover:bg-red-200 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="text-5xl mb-4">🏀</div>
                                            <h3 class="text-lg font-semibold text-gray-800">No Equipment Found</h3>
                                            <p class="text-sm text-gray-500 mt-1">There are no sports equipment records yet.</p>
                                            <a href="{{ route('equipment.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                                                + Add First Equipment
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>