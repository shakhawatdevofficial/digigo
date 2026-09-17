@extends('admin.layouts.adminpanel')

@section('title', 'Contact Message from ' . $contact->name . ' - DigiGo Admin')
@section('page_title', 'View & Reply Inquiry')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <!-- Top Navigation & Status Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-brand-cardDark p-5 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.contacts.index') }}" class="w-9 h-9 rounded-xl bg-cream-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-600 dark:text-zinc-300 hover:bg-cream-200 dark:hover:bg-zinc-700 transition-colors">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-lg font-bold text-zinc-900 dark:text-white">Inquiry #{{ $contact->id }}</h1>
                    @if($contact->status === 'pending')
                        <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-brand-yellow">
                            Pending
                        </span>
                    @elseif($contact->status === 'replied')
                        <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-400">
                            Replied
                        </span>
                    @elseif($contact->status === 'read')
                        <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-blue-100 dark:bg-blue-950/60 text-blue-800 dark:text-blue-400">
                            Read
                        </span>
                    @else
                        <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">
                            Closed
                        </span>
                    @endif
                </div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Received on {{ $contact->created_at ? $contact->created_at->format('F d, Y \a\t h:i A') : 'N/A' }}</p>
            </div>
        </div>

        <!-- Quick Status Change Form & Delete Action -->
        <div class="flex items-center gap-2.5">
            <form action="{{ route('admin.contacts.status', $contact->id) }}" method="POST" class="flex items-center gap-2">
                @csrf
                <span class="text-xs font-bold text-zinc-500 dark:text-zinc-400 hidden sm:inline">Status:</span>
                <select 
                    name="status" 
                    onchange="this.form.submit()" 
                    class="bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3 py-2 text-xs font-semibold text-zinc-800 dark:text-zinc-200 outline-none focus:border-brand-yellow font-sans cursor-pointer"
                >
                    <option value="pending" {{ $contact->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="closed" {{ $contact->status === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </form>

            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 rounded-xl text-rose-500 hover:text-rose-700 bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/50 transition-colors" title="Delete Inquiry">
                    <i class="fa-solid fa-trash-can text-xs"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- 2-Column Layout: Left (Message Details) & Right (Reply Form) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- LEFT COLUMN: Contact Inquiry Details (5 Cols) -->
        <div class="lg:col-span-5 space-y-6">
            <!-- Customer Information Card -->
            <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-5">
                <div class="flex items-center gap-2.5 pb-4 border-b border-cream-200 dark:border-brand-borderDark">
                    <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Sender Information</h2>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Customer contact details</p>
                    </div>
                </div>

                <div class="space-y-3.5 text-xs">
                    <div>
                        <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-1">Full Name</span>
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 font-bold text-xs flex items-center justify-center shrink-0">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </div>
                            <span class="font-bold text-zinc-900 dark:text-white text-sm">{{ $contact->name }}</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-1">Email Address</span>
                        <a href="mailto:{{ $contact->email }}" class="inline-flex items-center gap-1.5 text-amber-600 dark:text-brand-yellow font-medium hover:underline">
                            <i class="fa-solid fa-envelope text-[11px]"></i>
                            <span>{{ $contact->email }}</span>
                        </a>
                    </div>

                    <div>
                        <span class="text-[11px] font-bold text-zinc-400 uppercase tracking-wider block mb-1">Subject</span>
                        <span class="font-semibold text-zinc-800 dark:text-zinc-200 bg-cream-50 dark:bg-zinc-900 px-3 py-1.5 rounded-xl border border-cream-200 dark:border-brand-borderDark block">
                            {{ $contact->subject ?: 'General Inquiry' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Original Message Content Card -->
            <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-4">
                <div class="flex items-center gap-2.5 pb-4 border-b border-cream-200 dark:border-brand-borderDark">
                    <div class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-message"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Customer Message</h2>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Content sent via contact form</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-cream-50 dark:bg-zinc-900/70 border border-cream-200 dark:border-brand-borderDark text-xs text-zinc-800 dark:text-zinc-200 leading-relaxed whitespace-pre-line font-sans">
                    {{ $contact->message }}
                </div>
            </div>

            <!-- Previous Reply History (if already replied) -->
            @if($contact->replied_at && $contact->reply_message)
                <div class="bg-emerald-50/50 dark:bg-emerald-950/20 rounded-3xl border border-emerald-200 dark:border-emerald-900/50 p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-emerald-200 dark:border-emerald-900/50">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 dark:text-emerald-400 text-sm"></i>
                            <h3 class="text-xs font-bold text-emerald-800 dark:text-emerald-300">Previous Reply Sent</h3>
                        </div>
                        <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-medium">
                            {{ $contact->replied_at->format('M d, Y h:i A') }}
                        </span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-emerald-700 dark:text-emerald-400 block mb-1">Subject: {{ $contact->reply_subject }}</span>
                        <div class="p-3.5 rounded-xl bg-white dark:bg-zinc-900 border border-emerald-100 dark:border-emerald-900/30 text-xs text-zinc-700 dark:text-zinc-300 leading-relaxed whitespace-pre-line">
                            {{ $contact->reply_message }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- RIGHT COLUMN: Email Reply Form (7 Cols) -->
        <div class="lg:col-span-7">
            <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 sm:p-8 shadow-sm space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-cream-200 dark:border-brand-borderDark">
                    <div class="w-10 h-10 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-base">
                        <i class="fa-solid fa-reply"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Send Email Reply</h2>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Compose and dispatch an official email reply directly to {{ $contact->email }}.</p>
                    </div>
                </div>

                <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST" class="space-y-4" onsubmit="document.getElementById('sendReplyBtn').disabled = true; document.getElementById('sendReplyBtn').innerHTML = '<i class=\'fa-solid fa-spinner fa-spin mr-2\'></i> Sending Reply...';">
                    @csrf

                    <!-- Grid: From Name & From Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Sender Name -->
                        <div>
                            <label for="reply_name" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                                Sender Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="reply_name" 
                                value="{{ old('name', $defaultFromName) }}" 
                                required
                                class="w-full bg-cream-50 dark:bg-zinc-900 border @error('name') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                            >
                            @error('name')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- From Email (SMTP address) -->
                        <div>
                            <label for="from_email" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                                From Email (SMTP Address) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="from_email" 
                                id="from_email" 
                                value="{{ old('from_email', $defaultFromEmail) }}" 
                                required
                                class="w-full bg-cream-50 dark:bg-zinc-900 border @error('from_email') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                            >
                            @error('from_email')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Recipient Email Display -->
                    <div>
                        <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Recipient Email (Customer)
                        </label>
                        <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-cream-100/70 dark:bg-zinc-800/80 border border-cream-200 dark:border-zinc-700 text-xs text-zinc-700 dark:text-zinc-300">
                            <i class="fa-solid fa-paper-plane text-zinc-400 text-xs"></i>
                            <span class="font-bold text-zinc-900 dark:text-white">{{ $contact->name }}</span>
                            <span class="text-zinc-400">&lt;{{ $contact->email }}&gt;</span>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Email Subject <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="subject" 
                            id="subject" 
                            value="{{ old('subject', 'Re: ' . ($contact->subject ?: 'Your inquiry at DigiGo')) }}" 
                            required
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('subject') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                        @error('subject')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message Textarea -->
                    <div>
                        <label for="reply_message_input" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Reply Message Content <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="message" 
                            id="reply_message_input" 
                            rows="9" 
                            required
                            placeholder="Type your reply message to the customer here..." 
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('message') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-2xl p-4 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors leading-relaxed"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t border-cream-200 dark:border-brand-borderDark flex items-center justify-between">
                        <p class="text-[11px] text-zinc-400">
                            <i class="fa-solid fa-info-circle mr-1"></i> The reply email will be sent to the customer's inbox.
                        </p>
                        <button 
                            type="submit" 
                            id="sendReplyBtn"
                            class="px-6 py-2.5 rounded-xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 text-xs font-bold shadow hover:opacity-95 transition-all inline-flex items-center gap-2"
                        >
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                            <span>Send Reply Email</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

