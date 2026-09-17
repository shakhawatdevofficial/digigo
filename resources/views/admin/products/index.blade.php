@extends('admin.layouts.adminpanel')

@section('title', 'All Products - DigiGo Admin')
@section('page_title', 'Products Management')

@section('content')
<div class="space-y-6">
    <!-- 1. Header Banner & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-brand-yellow">
                    Catalog Management
                </span>
            </div>
            <h1 class="text-xl font-bold text-zinc-900 dark:text-white mt-1">Digital Products</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage licenses, subscriptions, pricing, badges, and rich descriptions.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Quick Stats -->
            <div class="flex items-center gap-2">
                <div class="px-3 py-1.5 rounded-xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark text-center">
                    <span class="text-[9px] uppercase font-bold text-zinc-400 block">Total</span>
                    <span class="text-xs font-black text-zinc-800 dark:text-zinc-100">{{ $totalProducts }}</span>
                </div>
                <div class="px-3 py-1.5 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/50 text-center">
                    <span class="text-[9px] uppercase font-bold text-emerald-600 dark:text-emerald-400 block">Active</span>
                    <span class="text-xs font-black text-emerald-600 dark:text-emerald-400">{{ $activeProducts }}</span>
                </div>
            </div>

            <!-- Add Product Button -->
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Add New Product</span>
            </a>
        </div>
    </div>

    <!-- 2. Filters & Search Bar -->
    <div class="bg-white dark:bg-brand-cardDark p-4 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto flex-1">
            <!-- Search Input -->
            <div class="relative w-full sm:w-72">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Search by name, slug, badge..." 
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl pl-8 pr-3 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans"
                >
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-[11px] text-zinc-400"></i>
                @if($search)
                    <a href="{{ route('admin.products.index', ['category_id' => $categoryId]) }}" class="absolute right-2.5 top-2.5 text-[11px] text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </div>

            <!-- Category Filter Dropdown -->
            <div class="w-full sm:w-56">
                <select 
                    name="category_id" 
                    onchange="this.form.submit()" 
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans cursor-pointer"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 font-semibold rounded-xl text-xs hover:bg-cream-200 dark:hover:bg-zinc-700 transition-colors">
                Filter
            </button>

            @if($search || $categoryId)
                <a href="{{ route('admin.products.index') }}" class="text-xs text-rose-500 hover:underline font-medium">
                    Clear Filters
                </a>
            @endif
        </form>
    </div>

    <!-- 3. Products Table -->
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-cream-100/60 dark:bg-zinc-900/60 text-zinc-600 dark:text-zinc-400 font-bold uppercase text-[10px] tracking-wider border-b border-cream-200 dark:border-brand-borderDark">
                    <tr>
                        <th class="py-3.5 px-4">Product</th>
                        <th class="py-3.5 px-4">Category</th>
                        <th class="py-3.5 px-4">Pricing</th>
                        <th class="py-3.5 px-4">Badge</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200 dark:divide-brand-borderDark">
                    @forelse($products as $product)
                        <tr class="hover:bg-cream-50/50 dark:hover:bg-zinc-900/30 transition-colors">
                            <!-- Product Image & Name -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-cream-100 dark:bg-zinc-800 border border-cream-200 dark:border-zinc-700 flex items-center justify-center overflow-hidden shrink-0">
                                        @if($product->product_image)
                                            <img src="{{ asset($product->product_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-box text-zinc-400 text-lg"></i>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="font-bold text-zinc-900 dark:text-white text-xs truncate">{{ $product->name }}</h3>
                                        <p class="font-mono text-[10px] text-zinc-400 truncate">{{ $product->slug }}</p>
                                        @if($product->short_description)
                                            <p class="text-[10px] text-zinc-500 dark:text-zinc-400 truncate max-w-xs">{{ Str::limit($product->short_description, 45) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-3.5 px-4">
                                @if($product->category)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-brand-yellow border border-amber-200/60 dark:border-amber-900/40 font-semibold text-[11px]">
                                        <i class="fa-solid fa-tag text-[9px]"></i>
                                        <span>{{ $product->category->name }}</span>
                                    </span>
                                @else
                                    <span class="text-zinc-400 text-[11px] italic">Uncategorized</span>
                                @endif
                            </td>

                            <!-- Pricing -->
                            <td class="py-3.5 px-4">
                                <div class="flex flex-col">
                                    <span class="font-extrabold text-zinc-900 dark:text-white text-xs">
                                        ৳{{ number_format($product->price, 0) }}
                                    </span>
                                    @if($product->old_price)
                                        <span class="text-[10px] text-zinc-400 line-through">
                                            ৳{{ number_format($product->old_price, 0) }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Badge -->
                            <td class="py-3.5 px-4">
                                @if($product->badge)
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-zinc-900 text-brand-yellow dark:bg-zinc-800 dark:text-brand-yellow border border-zinc-700">
                                        {{ $product->badge }}
                                    </span>
                                @else
                                    <span class="text-zinc-400 text-[10px]">—</span>
                                @endif
                            </td>

                            <!-- Status Toggle -->
                            <td class="py-3.5 px-4">
                                <form action="{{ route('admin.products.toggle-status', $product) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="Click to toggle status" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold cursor-pointer transition-all {{ $product->status ? 'bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 hover:bg-emerald-200' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700 hover:bg-zinc-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $product->status ? 'bg-emerald-500' : 'bg-zinc-400' }}"></span>
                                        <span>{{ $product->status ? 'Active' : 'Inactive' }}</span>
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit -->
                                    <a 
                                        href="{{ route('admin.products.edit', $product) }}" 
                                        class="p-1.5 rounded-lg text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors"
                                        title="Edit Product"
                                    >
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <!-- Delete -->
                                    <button 
                                        type="button" 
                                        onclick="openDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors"
                                        title="Delete Product"
                                    >
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-zinc-400 dark:text-zinc-500">
                                <i class="fa-solid fa-box-open text-3xl mb-2 block text-zinc-300 dark:text-zinc-600"></i>
                                <p class="text-xs font-medium">No products found.</p>
                                <a href="{{ route('admin.products.create') }}" class="inline-block mt-3 px-4 py-1.5 bg-zinc-900 dark:bg-brand-yellow text-white dark:text-zinc-900 text-xs font-bold rounded-xl">
                                    Add Your First Product
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="p-4 border-t border-cream-200 dark:border-brand-borderDark">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<!-- ================= DELETE PRODUCT MODAL ================= -->
<div id="deleteProductModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs hidden p-4">
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark max-w-sm w-full p-6 shadow-2xl space-y-4 animate-in fade-in zoom-in-95 duration-200 text-center">
        <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xl mx-auto">
            <i class="fa-solid fa-trash-can"></i>
        </div>

        <div>
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Delete Product?</h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Are you sure you want to delete <span id="deleteProductName" class="font-bold text-zinc-800 dark:text-zinc-200"></span>? All associated images and records will be removed.
            </p>
        </div>

        <form id="deleteProductForm" method="POST">
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
    function openDeleteModal(id, name) {
        document.getElementById('deleteProductForm').action = '/admin/products/' + id;
        document.getElementById('deleteProductName').textContent = '"' + name + '"';
        document.getElementById('deleteProductModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteProductModal').classList.add('hidden');
    }
</script>
@endsection

