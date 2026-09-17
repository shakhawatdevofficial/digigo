@extends('admin.layouts.adminpanel')

@section('title', 'User Management - DigiGo Admin')
@section('page_title', 'User Management')

@section('content')
<div class="space-y-6">
    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-brand-yellow">
                    Accounts & Access
                </span>
            </div>
            <h1 class="text-xl font-bold text-zinc-900 dark:text-white mt-1">User Management</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage administrator and customer accounts, permissions and access status.</p>
        </div>

        <!-- Quick Stats Pills -->
        <div class="flex flex-wrap items-center gap-2.5">
            <div class="px-3.5 py-2 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-zinc-400 dark:text-zinc-500 block">Total</span>
                <span class="text-sm font-black text-zinc-800 dark:text-zinc-100">{{ $totalUsers }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/50 text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-amber-600 dark:text-brand-yellow block">Admins</span>
                <span class="text-sm font-black text-amber-600 dark:text-brand-yellow">{{ $totalAdmins }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-900/50 text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-blue-600 dark:text-blue-400 block">Customers</span>
                <span class="text-sm font-black text-blue-600 dark:text-blue-400">{{ $totalCustomers }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/50 text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-emerald-600 dark:text-emerald-400 block">Active</span>
                <span class="text-sm font-black text-emerald-600 dark:text-emerald-400">{{ $activeUsers }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-zinc-100 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-zinc-500 dark:text-zinc-400 block">Inactive</span>
                <span class="text-sm font-black text-zinc-600 dark:text-zinc-400">{{ $inactiveUsers }}</span>
            </div>
        </div>
    </div>

    <!-- Actions Bar: Search, Filters & Add New Button -->
    <div class="bg-white dark:bg-brand-cardDark p-4 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col md:flex-row items-center justify-between gap-3">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-center gap-2.5 w-full md:w-auto flex-1">
            <!-- Search Input -->
            <div class="relative flex-1 min-w-[200px] max-w-md">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Search by name, email or phone..." 
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl pl-9 pr-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors font-sans"
                >
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
            </div>

            <!-- Role Filter -->
            <select 
                name="role" 
                onchange="this.form.submit()" 
                class="bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3 py-2 text-xs text-zinc-800 dark:text-zinc-200 outline-none focus:border-brand-yellow font-sans cursor-pointer"
            >
                <option value="">All Roles</option>
                <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admins only</option>
                <option value="user" {{ $role === 'user' ? 'selected' : '' }}>Customers only</option>
            </select>

            <!-- Status Filter -->
            <select 
                name="status" 
                onchange="this.form.submit()" 
                class="bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3 py-2 text-xs text-zinc-800 dark:text-zinc-200 outline-none focus:border-brand-yellow font-sans cursor-pointer"
            >
                <option value="">All Statuses</option>
                <option value="1" {{ $status === '1' ? 'selected' : '' }}>Active Only</option>
                <option value="0" {{ $status === '0' ? 'selected' : '' }}>Inactive Only</option>
            </select>

            @if($search || $role || $status !== null && $status !== '')
                <a href="{{ route('admin.users.index') }}" class="px-3 py-2 text-xs font-semibold text-rose-500 hover:text-rose-600 bg-rose-50 dark:bg-rose-950/30 rounded-xl transition-colors">
                    <i class="fa-solid fa-rotate-left mr-1"></i> Reset
                </a>
            @endif
        </form>

        <!-- Add User Button -->
        <a href="{{ route('admin.users.create') }}" class="shrink-0 inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 text-xs font-bold shadow hover:opacity-95 transition-all">
            <i class="fa-solid fa-user-plus text-xs"></i>
            <span>Add New User</span>
        </a>
    </div>

    <!-- Users Table Card -->
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-cream-200 dark:border-brand-borderDark bg-cream-50/50 dark:bg-zinc-900/40 text-[11px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                        <th class="py-3.5 px-4 sm:px-6">User / Profile</th>
                        <th class="py-3.5 px-4">Contact Info</th>
                        <th class="py-3.5 px-4">Role</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Registered</th>
                        <th class="py-3.5 px-4 sm:px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-100 dark:divide-zinc-800/80 text-xs">
                    @forelse ($users as $userItem)
                        <tr class="hover:bg-cream-50/60 dark:hover:bg-zinc-800/40 transition-colors">
                            <!-- User Name & Avatar -->
                            <td class="py-3.5 px-4 sm:px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-2xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 font-bold text-sm flex items-center justify-center shrink-0 overflow-hidden shadow-sm">
                                        @if($userItem->photo)
                                            <img src="{{ asset($userItem->photo) }}" alt="{{ $userItem->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span>{{ strtoupper(substr($userItem->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-zinc-900 dark:text-white truncate">{{ $userItem->name }}</span>
                                            @if(Auth::id() === $userItem->id)
                                                <span class="px-2 py-0.5 text-[9px] font-bold rounded-full bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-brand-yellow">
                                                    You
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-[11px] text-zinc-400">ID: #{{ $userItem->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact Info -->
                            <td class="py-3.5 px-4">
                                <div class="flex flex-col">
                                    <span class="text-zinc-800 dark:text-zinc-200 font-medium">{{ $userItem->email }}</span>
                                    <span class="text-[11px] text-zinc-400">{{ $userItem->phone ?? 'No phone' }}</span>
                                </div>
                            </td>

                            <!-- Role -->
                            <td class="py-3.5 px-4">
                                @if($userItem->role === 'admin')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-[10px] font-extrabold bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-brand-yellow border border-amber-200 dark:border-amber-900/50 uppercase tracking-wider">
                                        <i class="fa-solid fa-shield-halved text-[9px]"></i> Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-[10px] font-bold bg-blue-50 dark:bg-blue-950/50 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-900/50 uppercase tracking-wider">
                                        <i class="fa-solid fa-user text-[9px]"></i> Customer
                                    </span>
                                @endif
                            </td>

                            <!-- Status & Quick Toggle -->
                            <td class="py-3.5 px-4">
                                @if(Auth::id() === $userItem->id)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-900/40">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                    </span>
                                @else
                                    <form action="{{ route('admin.users.toggle-status', $userItem->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button 
                                            type="submit" 
                                            title="Click to toggle status"
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[11px] font-bold transition-all {{ $userItem->status ? 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-900/40 hover:bg-emerald-100' : 'bg-rose-50 dark:bg-rose-950/50 text-rose-700 dark:text-rose-400 border border-rose-200 dark:border-rose-900/40 hover:bg-rose-100' }}"
                                        >
                                            <span class="w-1.5 h-1.5 rounded-full {{ $userItem->status ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                            {{ $userItem->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                @endif
                            </td>

                            <!-- Registered Date -->
                            <td class="py-3.5 px-4 text-zinc-500 dark:text-zinc-400 text-[11px]">
                                <div>{{ $userItem->created_at ? $userItem->created_at->format('M d, Y') : 'N/A' }}</div>
                                <span class="text-[10px] text-zinc-400">{{ $userItem->created_at ? $userItem->created_at->diffForHumans() : '' }}</span>
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-3.5 px-4 sm:px-6 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit User -->
                                    <a 
                                        href="{{ route('admin.users.edit', $userItem->id) }}" 
                                        class="p-2 rounded-xl text-zinc-500 hover:text-zinc-900 dark:hover:text-white bg-cream-100 dark:bg-zinc-800 hover:bg-cream-200 dark:hover:bg-zinc-700 transition-colors"
                                        title="Edit User"
                                    >
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <!-- Delete User -->
                                    @if(Auth::id() !== $userItem->id)
                                        <form action="{{ route('admin.users.destroy', $userItem->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete user {{ $userItem->name }}? This action cannot be undone.');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="p-2 rounded-xl text-rose-500 hover:text-rose-700 bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/50 transition-colors"
                                                title="Delete User"
                                            >
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-zinc-500 dark:text-zinc-400">
                                <div class="w-12 h-12 mx-auto mb-3 rounded-2xl bg-cream-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 text-lg">
                                    <i class="fa-solid fa-user-slash"></i>
                                </div>
                                <p class="text-sm font-bold text-zinc-800 dark:text-zinc-200">No users found</p>
                                <p class="text-xs text-zinc-400 mt-0.5">Try adjusting your search query or filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="p-4 border-t border-cream-200 dark:border-brand-borderDark">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

