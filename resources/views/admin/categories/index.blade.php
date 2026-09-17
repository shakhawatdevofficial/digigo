@extends('admin.layouts.adminpanel')

@section('title', 'Categories Management - DigiGo Admin')
@section('page_title', 'Product Categories')

@section('content')
<div class="space-y-6">
    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-brand-yellow">
                    Catalog Setup
                </span>
            </div>
            <h1 class="text-xl font-bold text-zinc-900 dark:text-white mt-1">Product Categories</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage and organize product categories with slug and status.</p>
        </div>

        <!-- Quick Stats Pill -->
        <div class="flex items-center gap-3">
            <div class="px-3.5 py-2 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark text-center">
                <span class="text-[10px] uppercase font-bold text-zinc-400 dark:text-zinc-500 block">Total</span>
                <span class="text-sm font-black text-zinc-800 dark:text-zinc-100">{{ $totalCategories }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/50 text-center">
                <span class="text-[10px] uppercase font-bold text-emerald-600 dark:text-emerald-400 block">Active</span>
                <span class="text-sm font-black text-emerald-600 dark:text-emerald-400">{{ $activeCategories }}</span>
            </div>
            <div class="px-3.5 py-2 rounded-2xl bg-zinc-100 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 text-center">
                <span class="text-[10px] uppercase font-bold text-zinc-500 dark:text-zinc-400 block">Inactive</span>
                <span class="text-sm font-black text-zinc-600 dark:text-zinc-400">{{ $inactiveCategories }}</span>
            </div>
        </div>
    </div>

    <!-- Main Content Layout (Form on Left, Table on Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- 1. Add New Category Form (1 Col) -->
        <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm">
            <div class="flex items-center gap-2.5 pb-4 mb-5 border-b border-cream-200 dark:border-brand-borderDark">
                <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-folder-plus"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Add New Category</h2>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Create a category for your products</p>
                </div>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="create_name" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Category Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="create_name" 
                        value="{{ old('name') }}" 
                        placeholder="e.g. OTT Subscriptions" 
                        required
                        onkeyup="generateSlug(this.value, 'create_slug')"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('name') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug Field -->
                <div>
                    <label for="create_slug" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Category Slug <span class="text-zinc-400 text-[10px] font-normal">(Auto-generated or custom)</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="slug" 
                            id="create_slug" 
                            value="{{ old('slug') }}" 
                            placeholder="ott-subscriptions" 
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('slug') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-mono transition-colors"
                        >
                    </div>
                    @error('slug')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Toggle -->
                <div class="pt-2">
                    <label class="flex items-center justify-between p-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark cursor-pointer select-none">
                        <div>
                            <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200 block">Active Status</span>
                            <span class="text-[10px] text-zinc-400 block">Show this category on store</span>
                        </div>
                        <input type="checkbox" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} class="w-4 h-4 text-amber-500 focus:ring-amber-400 rounded">
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-2.5 px-4 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Save Category</span>
                </button>
            </form>
        </div>

        <!-- 2. Categories Table List (2 Cols) -->
        <div class="lg:col-span-2 bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-4">
            <!-- Table Header & Search -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-cream-200 dark:border-brand-borderDark">
                <div>
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Existing Categories</h2>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Total {{ $categories->total() }} categories recorded</p>
                </div>

                <form method="GET" action="{{ route('admin.categories.index') }}" class="relative min-w-[220px]">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}" 
                        placeholder="Search category or slug..." 
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl pl-8 pr-3 py-1.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans"
                    >
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-[10px] text-zinc-400"></i>
                    @if($search)
                        <a href="{{ route('admin.categories.index') }}" class="absolute right-2.5 top-2 text-[10px] text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Categories Table -->
            <div class="overflow-x-auto rounded-2xl border border-cream-200 dark:border-brand-borderDark">
                <table class="w-full text-left text-xs">
                    <thead class="bg-cream-100/60 dark:bg-zinc-900/60 text-zinc-600 dark:text-zinc-400 font-bold uppercase text-[10px] tracking-wider border-b border-cream-200 dark:border-brand-borderDark">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Category</th>
                            <th class="py-3 px-4">Slug</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200 dark:divide-brand-borderDark">
                        @forelse($categories as $category)
                            <tr class="hover:bg-cream-50/50 dark:hover:bg-zinc-900/30 transition-colors">
                                <td class="py-3.5 px-4 font-mono text-[11px] text-zinc-400">
                                    {{ $category->id }}
                                </td>
                                <td class="py-3.5 px-4 font-bold text-zinc-900 dark:text-zinc-100">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg bg-amber-100 dark:bg-amber-950/50 text-amber-700 dark:text-brand-yellow flex items-center justify-center text-xs shrink-0">
                                            <i class="fa-solid fa-tag"></i>
                                        </div>
                                        <span>{{ $category->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 font-mono text-[11px] text-zinc-500 dark:text-zinc-400">
                                    <span class="px-2 py-0.5 rounded bg-cream-100 dark:bg-zinc-800 border border-cream-200 dark:border-zinc-700">
                                        {{ $category->slug }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <form action="{{ route('admin.categories.toggle-status', $category) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="Click to toggle status" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold cursor-pointer transition-all {{ $category->status ? 'bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 hover:bg-emerald-200' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-200' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $category->status ? 'bg-emerald-500' : 'bg-zinc-400' }}"></span>
                                            <span>{{ $category->status ? 'Active' : 'Inactive' }}</span>
                                        </button>
                                    </form>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <!-- Edit Button (Opens Modal) -->
                                        <button 
                                            type="button" 
                                            onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->slug) }}', {{ $category->status ? 1 : 0 }})"
                                            class="p-1.5 rounded-lg text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors"
                                            title="Edit Category"
                                        >
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </button>

                                        <!-- Delete Button (Opens Confirmation) -->
                                        <button 
                                            type="button"
                                            onclick="openDeleteModal({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                            class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors"
                                            title="Delete Category"
                                        >
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-zinc-400 dark:text-zinc-500">
                                    <i class="fa-solid fa-folder-open text-2xl mb-2 block"></i>
                                    <p class="text-xs">No categories found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($categories->hasPages())
                <div class="pt-2">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- ================= EDIT CATEGORY MODAL ================= -->
<div id="editCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs hidden p-4">
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark max-w-md w-full p-6 shadow-2xl space-y-5 animate-in fade-in zoom-in-95 duration-200">
        <div class="flex items-center justify-between pb-3 border-b border-cream-200 dark:border-brand-borderDark">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-pen"></i>
                </div>
                <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Edit Category</h3>
            </div>
            <button type="button" onclick="closeEditModal()" class="p-1 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <form id="editCategoryForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Edit Name -->
            <div>
                <label for="edit_name" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="edit_name" 
                    required
                    onkeyup="generateSlug(this.value, 'edit_slug')"
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                >
            </div>

            <!-- Edit Slug -->
            <div>
                <label for="edit_slug" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Category Slug
                </label>
                <input 
                    type="text" 
                    name="slug" 
                    id="edit_slug" 
                    required
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-mono transition-colors"
                >
            </div>

            <!-- Edit Status -->
            <div>
                <label class="flex items-center justify-between p-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark cursor-pointer select-none">
                    <div>
                        <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200 block">Active Status</span>
                        <span class="text-[10px] text-zinc-400 block">Show this category on store</span>
                    </div>
                    <input type="checkbox" name="status" id="edit_status" value="1" class="w-4 h-4 text-amber-500 focus:ring-amber-400 rounded">
                </label>
            </div>

            <!-- Modal Action Buttons -->
            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-xs font-semibold rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-check text-xs"></i>
                    <span>Update Category</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= DELETE CATEGORY MODAL ================= -->
<div id="deleteCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs hidden p-4">
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark max-w-sm w-full p-6 shadow-2xl space-y-4 animate-in fade-in zoom-in-95 duration-200 text-center">
        <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xl mx-auto">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <div>
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Delete Category?</h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Are you sure you want to delete <span id="deleteCategoryName" class="font-bold text-zinc-800 dark:text-zinc-200"></span>? This action cannot be undone.
            </p>
        </div>

        <form id="deleteCategoryForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex items-center justify-center gap-2 pt-2">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-xs font-semibold rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl text-xs transition-colors shadow-sm">
                    Yes, Delete
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function generateSlug(text, targetId) {
        const slug = text
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById(targetId).value = slug;
    }

    function openEditModal(id, name, slug, status) {
        document.getElementById('editCategoryForm').action = '/admin/categories/' + id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_slug').value = slug;
        document.getElementById('edit_status').checked = status === 1;
        document.getElementById('editCategoryModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editCategoryModal').classList.add('hidden');
    }

    function openDeleteModal(id, name) {
        document.getElementById('deleteCategoryForm').action = '/admin/categories/' + id;
        document.getElementById('deleteCategoryName').textContent = '"' + name + '"';
        document.getElementById('deleteCategoryModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteCategoryModal').classList.add('hidden');
    }
</script>
@endsection

