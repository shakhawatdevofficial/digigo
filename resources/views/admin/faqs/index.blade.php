@extends('admin.layouts.adminpanel')

@section('title', 'Frequently Asked Questions (FAQ) - DigiGo Admin')
@section('page_title', 'FAQ Questions')

@section('content')
<div class="space-y-6">

    <!-- Header & Section Settings Card -->
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-6 border-b border-cream-200 dark:border-brand-borderDark">
            <div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-brand-yellow">
                        Customer Support
                    </span>
                    <span class="px-2 py-0.5 text-[10px] font-bold rounded-md {{ \App\Models\Setting::get('faq_status', '1') == '1' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400' : 'bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-400' }}">
                        {{ \App\Models\Setting::get('faq_status', '1') == '1' ? 'Section Enabled' : 'Section Hidden' }}
                    </span>
                </div>
                <h1 class="text-xl font-bold text-zinc-900 dark:text-white mt-1.5">FAQ & Help Center Customization</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Customize homepage FAQ accordion, questions, and answers.</p>
            </div>

            <!-- Quick Stats -->
            <div class="flex items-center gap-3">
                <div class="px-3.5 py-2 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark text-center min-w-[70px]">
                    <span class="text-[10px] uppercase font-bold text-zinc-400 dark:text-zinc-500 block">Total</span>
                    <span class="text-sm font-black text-zinc-800 dark:text-zinc-100">{{ $totalFaqs }}</span>
                </div>
                <div class="px-3.5 py-2 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/50 text-center min-w-[70px]">
                    <span class="text-[10px] uppercase font-bold text-emerald-600 dark:text-emerald-400 block">Active</span>
                    <span class="text-sm font-black text-emerald-600 dark:text-emerald-400">{{ $activeFaqs }}</span>
                </div>
                <div class="px-3.5 py-2 rounded-2xl bg-zinc-100 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 text-center min-w-[70px]">
                    <span class="text-[10px] uppercase font-bold text-zinc-500 dark:text-zinc-400 block">Inactive</span>
                    <span class="text-sm font-black text-zinc-600 dark:text-zinc-400">{{ $inactiveFaqs }}</span>
                </div>
            </div>
        </div>

        <!-- Section Customization Form -->
        <form action="{{ route('admin.faqs.section.update') }}" method="POST" class="pt-5 space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Section Badge -->
                <div>
                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1">
                        Section Badge Text
                    </label>
                    <input 
                        type="text" 
                        name="faq_badge" 
                        value="{{ old('faq_badge', \App\Models\Setting::get('faq_badge', 'FAQ')) }}" 
                        placeholder="e.g. FAQ" 
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow"
                    >
                </div>

                <!-- Section Title -->
                <div>
                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1">
                        Section Heading Title
                    </label>
                    <input 
                        type="text" 
                        name="faq_title" 
                        value="{{ old('faq_title', \App\Models\Setting::get('faq_title', 'Frequently Asked Questions')) }}" 
                        placeholder="e.g. Frequently Asked Questions" 
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow"
                    >
                </div>

                <!-- Section Status Toggle -->
                <div class="flex items-end">
                    <label class="w-full flex items-center justify-between p-2.5 rounded-xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark cursor-pointer select-none">
                        <div>
                            <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200 block">Show Section on Homepage</span>
                            <span class="text-[10px] text-zinc-400 block">Turn on or off FAQ accordion</span>
                        </div>
                        <input type="checkbox" name="faq_status" value="1" {{ \App\Models\Setting::get('faq_status', '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-amber-500 focus:ring-amber-400 rounded">
                    </label>
                </div>
            </div>

            <!-- Section Description -->
            <div>
                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1">
                    Section Subtitle / Description
                </label>
                <input 
                    type="text" 
                    name="faq_description" 
                    value="{{ old('faq_description', \App\Models\Setting::get('faq_description', 'Everything you need to know about our digital service delivery.')) }}" 
                    placeholder="e.g. Everything you need to know about our digital service delivery." 
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow"
                >
            </div>

            <!-- Save Section Settings Button -->
            <div class="flex justify-end pt-1">
                <button type="submit" class="px-5 py-2 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Save Section Settings</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Main Content Layout (Add Form Left, Table Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- 1. Add New FAQ Form (1 Col) -->
        <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm">
            <div class="flex items-center gap-2.5 pb-4 mb-5 border-b border-cream-200 dark:border-brand-borderDark">
                <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-circle-plus"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Add FAQ Question</h2>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Add a new Q&A item to the FAQ section</p>
                </div>
            </div>

            <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Question -->
                <div>
                    <label for="question" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Question <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="question" 
                        id="question" 
                        value="{{ old('question') }}" 
                        placeholder="e.g. How quickly will I receive my product after payment?" 
                        required
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('question') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                    @error('question')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Answer -->
                <div>
                    <label for="answer" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Answer <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="answer" 
                        id="answer" 
                        rows="4" 
                        placeholder="Provide clear and helpful answer for the customer..." 
                        required
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('answer') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors leading-relaxed"
                    >{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order Field -->
                <div>
                    <label for="order" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Display Order <span class="text-zinc-400 text-[10px] font-normal">(Lower numbers display first)</span>
                    </label>
                    <input 
                        type="number" 
                        name="order" 
                        id="order" 
                        value="{{ old('order', '0') }}" 
                        min="0"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('order') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                    @error('order')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Checkbox -->
                <div class="pt-1">
                    <label class="flex items-center justify-between p-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark cursor-pointer select-none">
                        <div>
                            <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200 block">Active Status</span>
                            <span class="text-[10px] text-zinc-400 block">Show this question in accordion</span>
                        </div>
                        <input type="checkbox" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-amber-500 focus:ring-amber-400 rounded">
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-2.5 px-4 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Add FAQ Question</span>
                </button>
            </form>
        </div>

        <!-- 2. FAQ Table List (2 Cols) -->
        <div class="lg:col-span-2 bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-4">
            <!-- Table Header & Search -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-cream-200 dark:border-brand-borderDark">
                <div>
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">All FAQ Questions</h2>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Total {{ $faqs->total() }} questions available</p>
                </div>

                <!-- Search Form -->
                <form action="{{ route('admin.faqs.index') }}" method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ $search }}" 
                            placeholder="Search question or answer..." 
                            class="w-48 sm:w-64 bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl pl-8 pr-3 py-1.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                        >
                        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-[11px] text-zinc-400"></i>
                    </div>
                    @if($search)
                        <a href="{{ route('admin.faqs.index') }}" class="p-1.5 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 text-xs transition-colors" title="Clear filter">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-cream-100 dark:border-zinc-800 text-[11px] font-bold text-zinc-400 uppercase tracking-wider">
                            <th class="py-3 px-3 w-12 text-center">#Order</th>
                            <th class="py-3 px-3">Question & Answer</th>
                            <th class="py-3 px-3 text-center whitespace-nowrap">Status</th>
                            <th class="py-3 px-3 text-right whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-100 dark:divide-zinc-800 text-xs">
                        @forelse($faqs as $item)
                            <tr class="hover:bg-cream-50/60 dark:hover:bg-zinc-900/40 transition-colors">
                                <!-- Order Badge -->
                                <td class="py-3.5 px-3 text-center">
                                    <span class="inline-block px-2 py-1 rounded-lg bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 font-mono text-[10px] font-bold">
                                        {{ $item->order }}
                                    </span>
                                </td>

                                <!-- Question & Answer -->
                                <td class="py-3.5 px-3">
                                    <div class="space-y-1">
                                        <p class="font-bold text-zinc-900 dark:text-zinc-100 leading-snug">
                                            {{ $item->question }}
                                        </p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-2 leading-relaxed">
                                            {{ $item->answer }}
                                        </p>
                                    </div>
                                </td>

                                <!-- Status Toggle -->
                                <td class="py-3.5 px-3 text-center whitespace-nowrap">
                                    <form action="{{ route('admin.faqs.toggle-status', $item) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button 
                                            type="submit" 
                                            class="px-2.5 py-1 rounded-full text-[10px] font-bold inline-flex items-center gap-1.5 transition-colors {{ $item->status ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400 hover:bg-emerald-200' : 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-400 hover:bg-rose-200' }}"
                                            title="Click to toggle status"
                                        >
                                            <span class="w-1.5 h-1.5 rounded-full {{ $item->status ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>

                                <!-- Actions -->
                                <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <!-- Edit Modal Trigger -->
                                        <button 
                                            type="button" 
                                            onclick="openEditModal({{ $item->id }})"
                                            class="w-7 h-7 rounded-lg bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-amber-100 hover:text-amber-800 dark:hover:bg-zinc-700 flex items-center justify-center text-xs transition-colors"
                                            title="Edit FAQ"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <!-- Delete Button Trigger -->
                                        <button 
                                            type="button" 
                                            onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->question) }}')"
                                            class="w-7 h-7 rounded-lg bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-900/60 flex items-center justify-center text-xs transition-colors"
                                            title="Delete FAQ"
                                        >
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-zinc-400">
                                    <i class="fa-solid fa-circle-question text-2xl mb-2 block opacity-40"></i>
                                    <p class="text-xs font-medium">No FAQ questions found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($faqs->hasPages())
                <div class="pt-4 border-t border-cream-100 dark:border-zinc-800">
                    {{ $faqs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- EDIT MODALS -->
@foreach($faqs as $item)
<div id="editModal_{{ $item->id }}" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden backdrop-blur-sm">
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark w-full max-w-lg overflow-hidden shadow-2xl animate-in fade-in zoom-in-95 duration-200">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-5 border-b border-cream-200 dark:border-brand-borderDark">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Edit FAQ Question</h3>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Update question and answer details</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal({{ $item->id }})" class="w-7 h-7 rounded-lg text-zinc-400 hover:text-zinc-800 dark:hover:text-white flex items-center justify-center">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('admin.faqs.update', $item) }}" method="POST" class="p-5 space-y-4">
            @csrf
            @method('PUT')

            <!-- Question Field -->
            <div>
                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1">
                    Question <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="question" 
                    value="{{ old('question', $item->question) }}" 
                    required
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow"
                >
            </div>

            <!-- Answer Field -->
            <div>
                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1">
                    Answer <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="answer" 
                    rows="4" 
                    required
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow leading-relaxed"
                >{{ old('answer', $item->answer) }}</textarea>
            </div>

            <!-- Order Field -->
            <div>
                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1">
                    Display Order
                </label>
                <input 
                    type="number" 
                    name="order" 
                    value="{{ old('order', $item->order) }}" 
                    min="0"
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow"
                >
            </div>

            <!-- Status Checkbox -->
            <div>
                <label class="flex items-center justify-between p-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark cursor-pointer select-none">
                    <div>
                        <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200 block">Active Status</span>
                        <span class="text-[10px] text-zinc-400 block">Show this question in accordion</span>
                    </div>
                    <input type="checkbox" name="status" value="1" {{ old('status', $item->status) ? 'checked' : '' }} class="w-4 h-4 text-amber-500 focus:ring-amber-400 rounded">
                </label>
            </div>

            <!-- Modal Actions -->
            <div class="flex items-center justify-end gap-2.5 pt-2">
                <button type="button" onclick="closeEditModal({{ $item->id }})" class="px-4 py-2 rounded-xl border border-cream-200 dark:border-brand-borderDark text-xs font-bold text-zinc-600 dark:text-zinc-400 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 rounded-xl bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 text-xs font-bold hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- GLOBAL DELETE CONFIRMATION MODAL -->
<div id="deleteModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 hidden backdrop-blur-sm">
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark w-full max-w-sm p-6 overflow-hidden shadow-2xl text-center space-y-4">
        <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center mx-auto text-lg">
            <i class="fa-solid fa-trash-can"></i>
        </div>
        <div>
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Delete FAQ Question?</h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Are you sure you want to delete <strong id="deleteTargetQuestion" class="text-zinc-800 dark:text-zinc-200"></strong>? This action cannot be undone.</p>
        </div>
        <form id="deleteForm" action="" method="POST" class="flex items-center justify-center gap-2 pt-2">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteModal()" class="w-1/2 py-2 rounded-xl border border-cream-200 dark:border-brand-borderDark text-xs font-bold text-zinc-600 dark:text-zinc-400 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors">
                Cancel
            </button>
            <button type="submit" class="w-1/2 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-colors shadow-sm">
                Yes, Delete
            </button>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    function openEditModal(id) {
        const modal = document.getElementById('editModal_' + id);
        if (modal) modal.classList.remove('hidden');
    }

    function closeEditModal(id) {
        const modal = document.getElementById('editModal_' + id);
        if (modal) modal.classList.add('hidden');
    }

    function openDeleteModal(id, question) {
        const modal = document.getElementById('deleteModal');
        const questionSpan = document.getElementById('deleteTargetQuestion');
        const form = document.getElementById('deleteForm');

        if (modal && questionSpan && form) {
            questionSpan.innerText = '"' + question + '"';
            form.action = `/admin/faqs/${id}`;
            modal.classList.remove('hidden');
        }
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        if (modal) modal.classList.add('hidden');
    }
</script>
@endpush

