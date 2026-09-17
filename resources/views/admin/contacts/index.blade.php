@extends('admin.layouts.adminpanel')

@section('title', 'Contact Inquiries - DigiGo Admin')
@section('page_title', 'Contact Inquiries')

@section('content')
<div class="space-y-6">
    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-brand-yellow">
                    Customer Support
                </span>
            </div>
            <h1 class="text-xl font-bold text-zinc-900 dark:text-white mt-1">Contact Inquiries & Messages</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage customer inquiries received from the website contact form and reply via email.</p>
        </div>

        <!-- Quick Stats Pills -->
        <div class="flex flex-wrap items-center gap-2.5">
            <div class="px-3.5 py-2 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-zinc-400 dark:text-zinc-500 block">Total</span>
                <span class="text-sm font-black text-zinc-800 dark:text-zinc-100">{{ $totalContacts }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/50 text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-amber-600 dark:text-brand-yellow block">Pending</span>
                <span class="text-sm font-black text-amber-600 dark:text-brand-yellow">{{ $pendingContacts }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/50 text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-emerald-600 dark:text-emerald-400 block">Replied</span>
                <span class="text-sm font-black text-emerald-600 dark:text-emerald-400">{{ $repliedContacts }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-zinc-100 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 text-center min-w-[70px]">
                <span class="text-[10px] uppercase font-bold text-zinc-500 dark:text-zinc-400 block">Closed</span>
                <span class="text-sm font-black text-zinc-600 dark:text-zinc-400">{{ $closedContacts }}</span>
            </div>
        </div>
    </div>

    <!-- Actions Bar: Search, Filters -->
    <div class="bg-white dark:bg-brand-cardDark p-4 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col md:flex-row items-center justify-between gap-3">
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="flex flex-wrap items-center gap-2.5 w-full md:w-auto flex-1">
            <!-- Search Input -->
            <div class="relative flex-1 min-w-[220px] max-w-md">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Search by sender name, email, subject or message..." 
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl pl-9 pr-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors font-sans"
                >
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
            </div>

            <!-- Status Filter -->
            <select 
                name="status" 
                onchange="this.form.submit()" 
                class="bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3 py-2 text-xs text-zinc-800 dark:text-zinc-200 outline-none focus:border-brand-yellow font-sans cursor-pointer"
            >
                <option value="">All Statuses</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="read" {{ $status === 'read' ? 'selected' : '' }}>Read</option>
                <option value="replied" {{ $status === 'replied' ? 'selected' : '' }}>Replied</option>
                <option value="closed" {{ $status === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>

            @if($search || $status)
                <a href="{{ route('admin.contacts.index') }}" class="px-3 py-2 text-xs font-semibold text-rose-500 hover:text-rose-600 bg-rose-50 dark:bg-rose-950/30 rounded-xl transition-colors">
                    <i class="fa-solid fa-rotate-left mr-1"></i> Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Contacts Table Card -->
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-cream-200 dark:border-brand-borderDark bg-cream-50/50 dark:bg-zinc-900/40 text-[11px] font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                        <th class="py-3.5 px-4 sm:px-6">Sender</th>
                        <th class="py-3.5 px-4">Subject & Message Preview</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Received</th>
                        <th class="py-3.5 px-4 sm:px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-100 dark:divide-zinc-800/80 text-xs">
                    @forelse ($contacts as $contactItem)
                        <tr class="hover:bg-cream-50/60 dark:hover:bg-zinc-800/40 transition-colors {{ ! $contactItem->is_read ? 'bg-amber-50/30 dark:bg-amber-950/10' : '' }}">
                            <!-- Sender Info -->
                            <td class="py-3.5 px-4 sm:px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-2xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 font-bold text-xs flex items-center justify-center shrink-0 shadow-sm">
                                        {{ strtoupper(substr($contactItem->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-1.5">
                                            <span class="font-bold text-zinc-900 dark:text-white truncate {{ ! $contactItem->is_read ? 'font-black' : '' }}">
                                                {{ $contactItem->name }}
                                            </span>
                                            @if(! $contactItem->is_read)
                                                <span class="w-2 h-2 rounded-full bg-rose-500 shrink-0" title="Unread Message"></span>
                                            @endif
                                        </div>
                                        <span class="text-[11px] text-zinc-500 dark:text-zinc-400">{{ $contactItem->email }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Subject & Message Preview -->
                            <td class="py-3.5 px-4 max-w-xs sm:max-w-md">
                                <div class="font-semibold text-zinc-900 dark:text-zinc-100 truncate">
                                    {{ $contactItem->subject ?: 'General Inquiry' }}
                                </div>
                                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 line-clamp-1 mt-0.5">
                                    {{ Str::limit($contactItem->message, 80) }}
                                </p>
                            </td>

                            <!-- Status & Quick Status Update -->
                            <td class="py-3.5 px-4">
                                <form action="{{ route('admin.contacts.status', $contactItem->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <select 
                                        name="status" 
                                        onchange="this.form.submit()" 
                                        class="text-[10px] font-bold uppercase tracking-wider rounded-xl px-2.5 py-1 border cursor-pointer outline-none transition-colors 
                                            @if($contactItem->status === 'pending') bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-brand-yellow border-amber-200 dark:border-amber-900/50 
                                            @elseif($contactItem->status === 'replied') bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border-emerald-200 dark:border-emerald-900/50 
                                            @elseif($contactItem->status === 'read') bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-400 border-blue-200 dark:border-blue-900/50 
                                            @else bg-zinc-100 dark:bg-zinc-800/80 text-zinc-600 dark:text-zinc-400 border-zinc-200 dark:border-zinc-700 @endif"
                                    >
                                        <option value="pending" {{ $contactItem->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="read" {{ $contactItem->status === 'read' ? 'selected' : '' }}>Read</option>
                                        <option value="replied" {{ $contactItem->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                        <option value="closed" {{ $contactItem->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Received Date -->
                            <td class="py-3.5 px-4 text-zinc-500 dark:text-zinc-400 text-[11px] whitespace-nowrap">
                                <div>{{ $contactItem->created_at ? $contactItem->created_at->format('M d, Y') : 'N/A' }}</div>
                                <span class="text-[10px] text-zinc-400">{{ $contactItem->created_at ? $contactItem->created_at->diffForHumans() : '' }}</span>
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-3.5 px-4 sm:px-6 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- View & Reply Details Button -->
                                    <a 
                                        href="{{ route('admin.contacts.show', $contactItem->id) }}" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 text-xs font-bold shadow-sm hover:opacity-95 transition-all"
                                        title="View Message & Reply"
                                    >
                                        <i class="fa-solid fa-eye text-[11px]"></i>
                                        <span>View & Reply</span>
                                    </a>

                                    <!-- Delete Message -->
                                    <form action="{{ route('admin.contacts.destroy', $contactItem->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contact message from {{ $contactItem->name }}?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="p-2 rounded-xl text-rose-500 hover:text-rose-700 bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/50 transition-colors"
                                            title="Delete Message"
                                        >
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-zinc-500 dark:text-zinc-400">
                                <div class="w-12 h-12 mx-auto mb-3 rounded-2xl bg-cream-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 text-lg">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                                <p class="text-sm font-bold text-zinc-800 dark:text-zinc-200">No contact inquiries found</p>
                                <p class="text-xs text-zinc-400 mt-0.5">When visitors submit messages from the contact form, they will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($contacts->hasPages())
            <div class="p-4 border-t border-cream-200 dark:border-brand-borderDark">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

