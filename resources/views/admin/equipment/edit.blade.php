<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight tracking-tight">{{ __('Edit Equipment') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border border-gray-100">
                
                <!-- Header Title inside card -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Equipment</h1>
                    <p class="text-sm text-gray-500 mt-1">Update the details of this sports item.</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg" role="alert">
                        <div class="flex">
                            <div class="ml-3">
                                <strong class="text-sm font-semibold text-red-800">Please fix the following:</strong>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('equipment.update', $equipment) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Equipment Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Equipment Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $equipment->name) }}" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-150 text-sm"
                            placeholder="e.g. Basketball"
                        >
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <input 
                            type="text" 
                            id="category" 
                            name="category" 
                            value="{{ old('category', $equipment->category) }}" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-150 text-sm"
                            placeholder="e.g. Balls"
                        >
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                        <input 
                            type="number" 
                            id="quantity" 
                            name="quantity" 
                            value="{{ old('quantity', $equipment->quantity) }}" 
                            min="0" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-150 text-sm"
                            placeholder="0"
                        >
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <a 
                            href="{{ route('equipment.index') }}" 
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-150"
                        >
                            Cancel
                        </a>

                        <button 
                            type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2 rounded-lg shadow-sm transition duration-150 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Update Equipment
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>