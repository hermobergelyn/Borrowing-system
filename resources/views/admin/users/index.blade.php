<x-app-layout>
    @php
        $currentDate = now()->format('l, F j');

        $admins = $users->filter(fn($u) => in_array(strtolower(trim((string) $u->role)), ['admin', 'sports coordinator']));
        $staffs = $users->filter(fn($u) => strtolower(trim((string) $u->role)) === 'staff');
        $students = $users->filter(fn($u) => !in_array(strtolower(trim((string) $u->role)), ['admin', 'sports coordinator', 'staff']));
    @endphp

    {{-- ALPINE.JS STATE: TAB SELECTION & SEARCH --}}
    <div class="min-h-screen bg-gradient-to-b from-purple-50/70 via-white to-white px-4 py-7 sm:px-6 lg:px-8"
         x-data="{ activeTab: 'admin', search: '' }">
        <div class="mx-auto max-w-6xl space-y-5">

            {{-- 1. Top Header Row (Matching Dashboard Date, Title & Right Action) --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-bold text-purple-600 tracking-wide">
                        {{ $currentDate }}
                    </p>
                    <h1 class="mt-0.5 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">
                        Categorized <span class="text-purple-700">User Accounts</span>
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-slate-500">
                        Select a role tab to view, search, and manage administrator, staff, and student accounts.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-2.5">
                    <template x-if="activeTab === 'admin'">
                        <a href="{{ route('admin.users.create') }}?role=admin"
                           class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-4 py-2.5 text-xs sm:text-sm font-bold text-white shadow-sm transition hover:bg-purple-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Add Administrator</span>
                        </a>
                    </template>

                    <template x-if="activeTab === 'staff'">
                        <a href="{{ route('admin.users.create') }}?role=staff"
                           class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-4 py-2.5 text-xs sm:text-sm font-bold text-white shadow-sm transition hover:bg-purple-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Add Staff</span>
                        </a>
                    </template>

                    <template x-if="activeTab === 'student'">
                        <a href="{{ route('admin.users.create') }}?role=student"
                           class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-4 py-2.5 text-xs sm:text-sm font-bold text-white shadow-sm transition hover:bg-purple-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Add Student</span>
                        </a>
                    </template>
                </div>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-2xs flex items-center gap-2.5">
                    <svg class="h-5 w-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 shadow-2xs">
                    <p class="font-bold mb-1">Please check the following:</p>
                    <ul class="list-disc list-inside text-xs space-y-1 text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 2. Role Tabs & Aligned Search Bar Strip --}}
            <section class="rounded-2xl border border-purple-200/80 bg-white p-4 sm:p-5 shadow-2xs flex flex-col gap-3.5 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0">
                    <button type="button"
                            @click="activeTab = 'admin'"
                            :class="activeTab === 'admin' ? 'bg-purple-600 text-white shadow-2xs' : 'bg-purple-50/60 text-slate-700 hover:bg-purple-100/70 hover:text-purple-900 border border-purple-200/70'"
                            class="px-4 py-2 rounded-xl font-bold text-xs sm:text-sm transition flex items-center gap-2 whitespace-nowrap">
                        <span>Administrators</span>
                        <span class="rounded-full px-2 py-0.5 text-[11px] font-extrabold"
                              :class="activeTab === 'admin' ? 'bg-white/20 text-white' : 'bg-purple-100 text-purple-700'">
                            {{ $admins->count() }}
                        </span>
                    </button>

                    <button type="button"
                            @click="activeTab = 'staff'"
                            :class="activeTab === 'staff' ? 'bg-purple-600 text-white shadow-2xs' : 'bg-purple-50/60 text-slate-700 hover:bg-purple-100/70 hover:text-purple-900 border border-purple-200/70'"
                            class="px-4 py-2 rounded-xl font-bold text-xs sm:text-sm transition flex items-center gap-2 whitespace-nowrap">
                        <span>Staffs</span>
                        <span class="rounded-full px-2 py-0.5 text-[11px] font-extrabold"
                              :class="activeTab === 'staff' ? 'bg-white/20 text-white' : 'bg-purple-100 text-purple-700'">
                            {{ $staffs->count() }}
                        </span>
                    </button>

                    <button type="button"
                            @click="activeTab = 'student'"
                            :class="activeTab === 'student' ? 'bg-purple-600 text-white shadow-2xs' : 'bg-purple-50/60 text-slate-700 hover:bg-purple-100/70 hover:text-purple-900 border border-purple-200/70'"
                            class="px-4 py-2 rounded-xl font-bold text-xs sm:text-sm transition flex items-center gap-2 whitespace-nowrap">
                        <span>Students</span>
                        <span class="rounded-full px-2 py-0.5 text-[11px] font-extrabold"
                              :class="activeTab === 'student' ? 'bg-white/20 text-white' : 'bg-purple-100 text-purple-700'">
                            {{ $students->count() }}
                        </span>
                    </button>
                </div>

                {{-- Aligned Search Input --}}
                <div class="relative w-full md:w-72 shrink-0">
                    <input type="text"
                           x-model="search"
                           placeholder="Search name or email..."
                           class="w-full rounded-xl border border-purple-200 bg-purple-50/40 py-2 pl-9 pr-8 text-xs sm:text-sm text-slate-800 placeholder-slate-400 transition focus:border-purple-500 focus:bg-white focus:ring-2 focus:ring-purple-500/20">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-purple-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="button"
                            x-show="search !== ''"
                            @click="search = ''"
                            aria-label="Clear search"
                            class="absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400 hover:text-purple-700 text-sm font-bold"
                            style="display: none;">
                        ×
                    </button>
                </div>
            </section>

            {{-- 3. Categorized User Tables --}}
            <div class="space-y-6">

                {{-- ADMINISTRATORS SECTION --}}
                <section x-show="activeTab === 'admin'"
                         class="rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs">
                    <div class="flex items-center justify-between gap-3 mb-4 pb-3.5 border-b border-purple-100">
                        <div>
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                Administrators list
                            </h2>
                            <p class="text-xs text-slate-500">
                                System administrators and sports coordinators with management access
                            </p>
                        </div>
                        <span class="rounded-full bg-purple-100/80 px-3 py-1 text-xs font-bold text-purple-800">
                            {{ $admins->count() }} total
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-purple-50/75 border-b border-purple-100 text-purple-900/65 text-xs uppercase tracking-wider font-bold">
                                    <th class="py-3 px-3.5 rounded-l-xl w-16">No.</th>
                                    <th class="py-3 px-3.5">Name / Email</th>
                                    <th class="py-3 px-3.5">Role</th>
                                    <th class="py-3 px-3.5 rounded-r-xl text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-100/70 text-sm">
                                @forelse ($admins as $user)
                                    <tr class="hover:bg-purple-50/45 transition"
                                        x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                                        <td class="py-3.5 px-3.5 font-bold text-purple-700/80 align-middle">{{ $loop->iteration }}</td>
                                        <td class="py-3.5 px-3.5 align-middle">
                                            <div class="font-bold text-slate-900 text-xs sm:text-sm">{{ $user->name }}</div>
                                            <div class="text-slate-500 text-xs">{{ $user->email }}</div>
                                            <div class="mt-1 text-[11px] text-slate-500">
                                                {{ $user->gender ? ucfirst($user->gender) : 'Gender not set' }}
                                                <span class="mx-1 text-slate-300">·</span>
                                                {{ $user->phone ?: 'Contact number not set' }}
                                            </div>
                                            <div class="font-mono text-[11px] text-purple-700">
                                                {{ $user->student_id ?? $user->employee_id ?? 'ID pending' }}
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-3.5 align-middle">
                                            <span class="inline-flex items-center rounded-full bg-purple-100/80 px-2.5 py-0.5 text-[11px] font-bold text-purple-800 capitalize">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-3.5 text-right align-middle">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit User" class="p-2 bg-purple-50 text-purple-700 hover:bg-purple-600 hover:text-white rounded-xl transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete User" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-slate-400 text-sm">No administrators found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- STAFF SECTION --}}
                <section x-show="activeTab === 'staff'"
                         class="rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs"
                         style="display: none;">
                    <div class="flex items-center justify-between gap-3 mb-4 pb-3.5 border-b border-purple-100">
                        <div>
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                Staffs list
                            </h2>
                            <p class="text-xs text-slate-500">
                                Faculty and department staff accounts in the borrowing logbook
                            </p>
                        </div>
                        <span class="rounded-full bg-purple-100/80 px-3 py-1 text-xs font-bold text-purple-800">
                            {{ $staffs->count() }} total
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-purple-50/75 border-b border-purple-100 text-purple-900/65 text-xs uppercase tracking-wider font-bold">
                                    <th class="py-3 px-3.5 rounded-l-xl w-16">No.</th>
                                    <th class="py-3 px-3.5">Name / Email</th>
                                    <th class="py-3 px-3.5">Role</th>
                                    <th class="py-3 px-3.5 rounded-r-xl text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-100/70 text-sm">
                                @forelse ($staffs as $user)
                                    <tr class="hover:bg-purple-50/45 transition"
                                        x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                                        <td class="py-3.5 px-3.5 font-bold text-purple-700/80 align-middle">{{ $loop->iteration }}</td>
                                        <td class="py-3.5 px-3.5 align-middle">
                                            <div class="font-bold text-slate-900 text-xs sm:text-sm">{{ $user->name }}</div>
                                            <div class="text-slate-500 text-xs">{{ $user->email }}</div>
                                            <div class="mt-1 text-[11px] text-slate-500">
                                                {{ $user->gender ? ucfirst($user->gender) : 'Gender not set' }}
                                                <span class="mx-1 text-slate-300">·</span>
                                                {{ $user->phone ?: 'Contact number not set' }}
                                            </div>
                                            <div class="font-mono text-[11px] text-purple-700">
                                                {{ $user->student_id ?? $user->employee_id ?? 'ID pending' }}
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-3.5 align-middle">
                                            <span class="inline-flex items-center rounded-full bg-purple-100/80 px-2.5 py-0.5 text-[11px] font-bold text-purple-800 capitalize">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-3.5 text-right align-middle">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit User" class="p-2 bg-purple-50 text-purple-700 hover:bg-purple-600 hover:text-white rounded-xl transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete User" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-slate-400 text-sm">No staff accounts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- STUDENTS SECTION --}}
                <section x-show="activeTab === 'student'"
                         class="rounded-2xl border border-purple-200/80 bg-white p-6 shadow-2xs"
                         style="display: none;">
                    <div class="flex items-center justify-between gap-3 mb-4 pb-3.5 border-b border-purple-100">
                        <div>
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                                Students list
                            </h2>
                            <p class="text-xs text-slate-500">
                                Student borrowers registered to request sports equipment
                            </p>
                        </div>
                        <span class="rounded-full bg-purple-100/80 px-3 py-1 text-xs font-bold text-purple-800">
                            {{ $students->count() }} total
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-purple-50/75 border-b border-purple-100 text-purple-900/65 text-xs uppercase tracking-wider font-bold">
                                    <th class="py-3 px-3.5 rounded-l-xl w-16">No.</th>
                                    <th class="py-3 px-3.5">Name / Email</th>
                                    <th class="py-3 px-3.5">Role</th>
                                    <th class="py-3 px-3.5 rounded-r-xl text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-100/70 text-sm">
                                @forelse ($students as $user)
                                    <tr class="hover:bg-purple-50/45 transition"
                                        x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                                        <td class="py-3.5 px-3.5 font-bold text-purple-700/80 align-middle">{{ $loop->iteration }}</td>
                                        <td class="py-3.5 px-3.5 align-middle">
                                            <div class="font-bold text-slate-900 text-xs sm:text-sm">{{ $user->name }}</div>
                                            <div class="text-slate-500 text-xs">{{ $user->email }}</div>
                                            <div class="mt-1 text-[11px] text-slate-500">
                                                {{ $user->gender ? ucfirst($user->gender) : 'Gender not set' }}
                                                <span class="mx-1 text-slate-300">·</span>
                                                {{ $user->phone ?: 'Contact number not set' }}
                                            </div>
                                            <div class="font-mono text-[11px] text-purple-700">
                                                {{ $user->student_id ?? $user->employee_id ?? 'ID pending' }}
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-3.5 align-middle">
                                            <span class="inline-flex items-center rounded-full bg-purple-100/80 px-2.5 py-0.5 text-[11px] font-bold text-purple-800 capitalize">
                                                {{ $user->role ?: 'student' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-3.5 text-right align-middle">
                                            <div class="flex items-center justify-end gap-1.5">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit User" class="p-2 bg-purple-50 text-purple-700 hover:bg-purple-600 hover:text-white rounded-xl transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete User" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-slate-400 text-sm">No students found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>

        </div>
    </div>
</x-app-layout>