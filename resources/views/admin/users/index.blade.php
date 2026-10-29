<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight flex items-center gap-3">
                <span class="p-2 bg-indigo-600 text-white rounded-xl shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </span>
                User Management
            </h2>
            <span class="text-xs font-semibold uppercase tracking-wider px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full border border-indigo-200">
                Admin Control
            </span>
        </div>
    </x-slot>

    {{-- ALPINE.JS STATE: TAB SELECTION & SEARCH --}}
    <div class="py-10 bg-slate-50 min-h-screen" x-data="{ activeTab: 'admin', search: '' }">
        <div class="max-w-7xl mx-auto px-6 space-y-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl shadow-sm text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl shadow-sm text-sm">
                    <p class="font-semibold mb-2">Please check the following:</p>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Header & Search Bar --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Categorized User Accounts</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Click a role tab below to view and add users specifically for that group.</p>
                </div>

                {{-- SEARCH BAR --}}
                <div class="relative w-full sm:w-64">
                    <input
                        type="text"
                        x-model="search"
                        placeholder="Search name, email..."
                        class="w-full text-sm border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 pl-9"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- TAB BUTTONS (Para mapili kung alin ang gusto i-display at lagyan nghiwalay na Add button) --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-4">
                <div class="flex items-center gap-2 overflow-x-auto">
                    {{-- Admin Tab Button --}}
                    <button @click="activeTab = 'admin'" 
                        :class="activeTab === 'admin' ? 'bg-purple-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition flex items-center gap-2 whitespace-nowrap">
                        <span class="w-2.5 h-2.5 rounded-full" :class="activeTab === 'admin' ? 'bg-white' : 'bg-purple-600'"></span>
                        Administrators
                    </button>

                    {{-- Staff Tab Button --}}
                    <button @click="activeTab = 'staff'" 
                        :class="activeTab === 'staff' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition flex items-center gap-2 whitespace-nowrap">
                        <span class="w-2.5 h-2.5 rounded-full" :class="activeTab === 'staff' ? 'bg-white' : 'bg-sky-500'"></span>
                        Staffs
                    </button>

                    {{-- Student Tab Button --}}
                    <button @click="activeTab = 'student'" 
                        :class="activeTab === 'student' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition flex items-center gap-2 whitespace-nowrap">
                        <span class="w-2.5 h-2.5 rounded-full" :class="activeTab === 'student' ? 'bg-white' : 'bg-emerald-500'"></span>
                        Students
                    </button>
                </div>

                {{-- SEPARATED ADD BUTTONS (Magbabago depende sa kung anong tab ang naka-select) --}}
                <div>
                    <template x-if="activeTab === 'admin'">
                        <a href="{{ route('admin.users.create') }}?role=admin" 
                           class="inline-flex items-center justify-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2.5 rounded-xl shadow transition text-sm whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add New Administrator
                        </a>
                    </template>

                    <template x-if="activeTab === 'staff'">
                        <a href="{{ route('admin.users.create') }}?role=staff" 
                           class="inline-flex items-center justify-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-semibold px-4 py-2.5 rounded-xl shadow transition text-sm whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add New Staff
                        </a>
                    </template>

                    <template x-if="activeTab === 'student'">
                        <a href="{{ route('admin.users.create') }}?role=student" 
                           class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2.5 rounded-xl shadow transition text-sm whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add New Student
                        </a>
                    </template>
                </div>
            </div>

            {{-- CONTENT SECTIONS (Lalabas lang ang section kapag tinap mo ang katugmang Tab) --}}
            <div class="space-y-6">

                {{-- 1. ADMINISTRATORS SECTION --}}
                @php 
                    $admins = $users->filter(fn($u) => strtolower($u->role) === 'admin'); 
                @endphp
                <div x-show="activeTab === 'admin'" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden p-6">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-purple-600 rounded-full"></span>
                            <h4 class="font-bold text-slate-800 text-base">Administrators List</h4>
                            <span class="text-xs bg-purple-50 text-purple-700 font-semibold px-2.5 py-0.5 rounded-full border border-purple-200">{{ $admins->count() }}</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/75 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                                    <th class="py-3 px-2 rounded-l-xl">No.</th>
                                    <th class="py-3 px-2">Name / Email</th>
                                    <th class="py-3 px-2 rounded-r-xl text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse ($admins as $index => $user)
                                    <tr class="hover:bg-slate-50/50 transition"
                                        x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                                        <td class="py-3 px-2 font-medium text-slate-600 align-middle">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-2 align-middle">
                                            <div class="font-bold text-slate-800 text-xs">{{ $user->name }}</div>
                                            <div class="text-slate-500 text-[11px]">{{ $user->email }}</div>
                                        </td>
                                        <td class="py-3 px-2 text-right align-middle">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit User" class="p-1.5 bg-sky-50 text-sky-600 hover:bg-sky-600 hover:text-white rounded-lg transition shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete User" class="p-1.5 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-lg transition shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-slate-400 text-sm">No administrators found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- 2. STAFF SECTION --}}
                @php 
                    $staffs = $users->filter(fn($u) => strtolower($u->role) === 'staff'); 
                @endphp
                <div x-show="activeTab === 'staff'" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden p-6" style="display: none;">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-sky-500 rounded-full"></span>
                            <h4 class="font-bold text-slate-800 text-base">Staffs List</h4>
                            <span class="text-xs bg-sky-50 text-sky-700 font-semibold px-2.5 py-0.5 rounded-full border border-sky-200">{{ $staffs->count() }}</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/75 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                                    <th class="py-3 px-2 rounded-l-xl">No.</th>
                                    <th class="py-3 px-2">Name / Email</th>
                                    <th class="py-3 px-2 rounded-r-xl text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse ($staffs as $index => $user)
                                    <tr class="hover:bg-slate-50/50 transition"
                                        x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                                        <td class="py-3 px-2 font-medium text-slate-600 align-middle">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-2 align-middle">
                                            <div class="font-bold text-slate-800 text-xs">{{ $user->name }}</div>
                                            <div class="text-slate-500 text-[11px]">{{ $user->email }}</div>
                                        </td>
                                        <td class="py-3 px-2 text-right align-middle">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit User" class="p-1.5 bg-sky-50 text-sky-600 hover:bg-sky-600 hover:text-white rounded-lg transition shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete User" class="p-1.5 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-lg transition shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-slate-400 text-sm">No staff accounts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- 3. STUDENTS SECTION --}}
                @php 
                    $students = $users->filter(fn($u) => strtolower($u->role) !== 'admin' && strtolower($u->role) !== 'staff'); 
                @endphp
                <div x-show="activeTab === 'student'" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden p-6" style="display: none;">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-emerald-500 rounded-full"></span>
                            <h4 class="font-bold text-slate-800 text-base">Students List</h4>
                            <span class="text-xs bg-emerald-50 text-emerald-700 font-semibold px-2.5 py-0.5 rounded-full border border-emerald-200">{{ $students->count() }}</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/75 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                                    <th class="py-3 px-2 rounded-l-xl">No.</th>
                                    <th class="py-3 px-2">Name / Email</th>
                                    <th class="py-3 px-2 rounded-r-xl text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse ($students as $index => $user)
                                    <tr class="hover:bg-slate-50/50 transition"
                                        x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                                        <td class="py-3 px-2 font-medium text-slate-600 align-middle">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-2 align-middle">
                                            <div class="font-bold text-slate-800 text-xs">{{ $user->name }}</div>
                                            <div class="text-slate-500 text-[11px]">{{ $user->email }}</div>
                                        </td>
                                        <td class="py-3 px-2 text-right align-middle">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit User" class="p-1.5 bg-sky-50 text-sky-600 hover:bg-sky-600 hover:text-white rounded-lg transition shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete User" class="p-1.5 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-lg transition shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-slate-400 text-sm">No students found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>