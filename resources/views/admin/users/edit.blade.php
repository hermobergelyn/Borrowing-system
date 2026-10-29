<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight tracking-tight">{{ __('Edit User') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border border-gray-100">

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg" role="alert">
                        <div class="flex">
                            <div class="ml-3">
                                <strong class="text-sm font-semibold text-red-800">Please fix the following:</strong>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-150 text-sm"
                            required
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-150 text-sm"
                            required
                        >
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            New Password <span class="text-gray-400 font-normal text-xs">(leave blank to keep current)</span>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-150 text-sm"
                        >
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-150 text-sm"
                        >
                    </div>

                    <!-- Role (Display Only - Locked) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">User Role</label>
                        <div class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                {{ $user->role }}
                            </span>
                            <span class="text-xs text-gray-400 italic">Role cannot be changed here</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <a 
                            href="{{ route('admin.users.index') }}" 
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-150"
                        >
                            Cancel
                        </a>

                        <button 
                            type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2 rounded-lg shadow-sm transition duration-150 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Update User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>