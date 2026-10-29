<x-app-layout>
    @php
        $selectedRole = request('role', 'user'); // Kunin ang role mula sa URL (?role=admin), default ay 'user'
        $roleTitle = ucfirst($selectedRole);     // I-capitalize (Admin, Staff, Student)
    @endphp

    {{-- Page Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight tracking-tight">
            {{ __('Add New ' . $roleTitle) }}
        </h2>
    </x-slot>

    {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            {{-- Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border border-gray-100">
                
                {{-- Header Title inside card --}}
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Create New {{ $roleTitle }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Fill in the information below to add a new {{ $selectedRole }} account to the system.</p>
                </div>

                {{-- Validation Errors --}}
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

                {{-- Add User Form --}}
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
                    @csrf

                    {{-- Naka-hidden input ang role para maipasa pa rin sa Controller, hindi na mapapalitan --}}
                    <input type="hidden" name="role" value="{{ $selectedRole }}">

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                            placeholder="Enter full name"
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 text-sm @error('name') border-red-500 @else border-gray-300 @enderror"
                        >
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email"
                            placeholder="example@school.com"
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 text-sm @error('email') border-red-500 @else border-gray-300 @enderror"
                        >
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            placeholder="Enter password"
                            class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 text-sm @error('password') border-red-500 @else border-gray-300 @enderror"
                        >
                        <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters.</p>
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Confirm password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 text-sm"
                        >
                    </div>

                    {{-- Locked Role Display (Hindi na editable, nakaselyo na base sa pinanggalingang button) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Assigned Role</label>
                        <div class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg shadow-sm text-sm flex items-center justify-between">
                            <span class="font-semibold text-gray-700 uppercase tracking-wide">{{ $selectedRole }}</span>
                            <span class="text-xs text-gray-400 bg-gray-200/60 px-2 py-0.5 rounded">Fixed</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">The role is automatically set based on where you initiated this action.</p>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <a 
                            href="{{ route('admin.users.index') }}" 
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-150"
                        >
                            Cancel
                        </a>

                        <button 
                            type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow-sm transition duration-150 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Save {{ $roleTitle }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>