@extends('admin.layouts.adminpanel')

@section('title', 'Edit Product - DigiGo Admin')
@section('page_title', 'Edit Product')

@section('content')
<!-- Include jQuery & Summernote Lite for Rich HTML Editing -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<style>
    /* Clean dark/light adaptations for Summernote editor */
    .note-editor.note-frame {
        border-radius: 1rem !important;
        border: 1px solid #e4e4e7 !important;
        overflow: hidden !important;
        background-color: #fff !important;
    }
    .dark .note-editor.note-frame {
        border-color: #27272a !important;
        background-color: #18181b !important;
    }
    .dark .note-toolbar {
        background-color: #1f1f23 !important;
        border-bottom: 1px solid #27272a !important;
    }
    .dark .note-editable {
        background-color: #18181b !important;
        color: #f4f4f5 !important;
    }
    .dark .note-btn {
        background-color: #27272a !important;
        color: #e4e4e7 !important;
        border-color: #3f3f46 !important;
    }
    .note-editable {
        min-height: 250px !important;
        font-family: inherit !important;
        font-size: 13px !important;
    }
</style>

<div class="space-y-6 max-w-6xl mx-auto">
    <!-- Top Bar -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 dark:hover:text-white flex items-center gap-1.5 transition-colors">
                <i class="fa-solid fa-arrow-left text-[11px]"></i>
                <span>Back to Products</span>
            </a>
            <h1 class="text-xl font-bold text-zinc-900 dark:text-white mt-2">Edit Product: {{ $product->name }}</h1>
        </div>
    </div>

    <!-- Edit Product Form -->
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Main Information & Rich HTML Description (2 Cols) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white pb-3 border-b border-cream-200 dark:border-brand-borderDark">
                        Product Details
                    </h2>

                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $product->name) }}" 
                            required
                            onkeyup="generateSlug(this.value, 'slug')"
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('name') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            URL Slug <span class="text-zinc-400 text-[10px] font-normal">(Auto-generated or custom)</span>
                        </label>
                        <input 
                            type="text" 
                            name="slug" 
                            id="slug" 
                            value="{{ old('slug', $product->slug) }}" 
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('slug') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-mono transition-colors"
                        >
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label for="short_description" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Short Description <span class="text-zinc-400 text-[10px] font-normal">(Displays on cards)</span>
                        </label>
                        <textarea 
                            name="short_description" 
                            id="short_description" 
                            rows="2" 
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('short_description') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >{{ old('short_description', $product->short_description) }}</textarea>
                        @error('short_description')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Rich Text HTML Description Card -->
                <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-cream-200 dark:border-brand-borderDark">
                        <div>
                            <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Full Product Description (HTML Editor)</h2>
                            <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Use Headings, Tables, Bold, Underline, Highlight Colors, Images, and more.</p>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-brand-yellow">
                            WYSIWYG
                        </span>
                    </div>

                    <div>
                        <textarea name="product_description" id="product_description">{{ old('product_description', $product->product_description) }}</textarea>
                        @error('product_description')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column: Category, Pricing, Image & Status (1 Col) -->
            <div class="space-y-6">
                <!-- Publishing & Status Card -->
                <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white pb-3 border-b border-cream-200 dark:border-brand-borderDark">
                        Publishing
                    </h2>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="category_id" 
                            id="category_id" 
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('category_id') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans cursor-pointer"
                        >
                            <option value="">Select a Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Badge Pill -->
                    <div>
                        <label for="badge" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Product Badge <span class="text-zinc-400 text-[10px] font-normal">(e.g. Official, Popular, Hot Deal)</span>
                        </label>
                        <input 
                            type="text" 
                            name="badge" 
                            id="badge" 
                            value="{{ old('badge', $product->badge) }}" 
                            placeholder="Official" 
                            class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans"
                        >
                        <!-- Quick Suggestions -->
                        <div class="flex flex-wrap gap-1.5 mt-2">
                            @foreach(['Official', 'Popular', 'Trending', 'Cloud', 'Audio', 'OTT', 'Hot Deal'] as $badgeOption)
                                <button type="button" onclick="document.getElementById('badge').value='{{ $badgeOption }}'" class="text-[10px] px-2 py-0.5 rounded-md bg-cream-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 hover:bg-brand-yellow hover:text-zinc-900 transition-colors">
                                    {{ $badgeOption }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Active Status Switch -->
                    <div class="pt-2">
                        <label class="flex items-center justify-between p-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark cursor-pointer select-none">
                            <div>
                                <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200 block">Active Status</span>
                                <span class="text-[10px] text-zinc-400 block">Show this product on website</span>
                            </div>
                            <input type="checkbox" name="status" value="1" {{ old('status', $product->status ? '1' : '0') == '1' ? 'checked' : '' }} class="w-4 h-4 text-amber-500 focus:ring-amber-400 rounded">
                        </label>
                    </div>
                </div>

                <!-- Pricing Card -->
                <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white pb-3 border-b border-cream-200 dark:border-brand-borderDark">
                        Pricing Setup
                    </h2>

                    <!-- Sale Price -->
                    <div>
                        <label for="price" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Sale Price (৳) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-2.5 text-zinc-400 font-bold text-xs">৳</span>
                            <input 
                                type="number" 
                                step="0.01" 
                                min="0" 
                                name="price" 
                                id="price" 
                                value="{{ old('price', $product->price) }}" 
                                required
                                class="w-full bg-cream-50 dark:bg-zinc-900 border @error('price') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl pl-8 pr-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                            >
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Old / Regular Price -->
                    <div>
                        <label for="old_price" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Original Price (৳) <span class="text-zinc-400 text-[10px] font-normal">(Strikethrough)</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-2.5 text-zinc-400 font-bold text-xs">৳</span>
                            <input 
                                type="number" 
                                step="0.01" 
                                min="0" 
                                name="old_price" 
                                id="old_price" 
                                value="{{ old('old_price', $product->old_price) }}" 
                                class="w-full bg-cream-50 dark:bg-zinc-900 border @error('old_price') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl pl-8 pr-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                            >
                        </div>
                        @error('old_price')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Product Image Card -->
                <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm space-y-4">
                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white pb-3 border-b border-cream-200 dark:border-brand-borderDark">
                        Product Image
                    </h2>

                    <div class="space-y-3">
                        <div id="imagePreviewContainer" class="w-full h-40 rounded-2xl bg-cream-50 dark:bg-zinc-900 border-2 border-dashed border-cream-300 dark:border-zinc-700 flex flex-col items-center justify-center overflow-hidden relative">
                            @if($product->product_image)
                                <img id="imagePreview" src="{{ asset($product->product_image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain p-2">
                                <div id="imagePlaceholder" class="text-center p-4 hidden">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-zinc-400 mb-2"></i>
                                    <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-300">Upload Product Image</p>
                                    <p class="text-[10px] text-zinc-400 mt-0.5">PNG, JPG, WebP, SVG (Max 2MB)</p>
                                </div>
                            @else
                                <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-contain hidden p-2">
                                <div id="imagePlaceholder" class="text-center p-4">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-zinc-400 mb-2"></i>
                                    <p class="text-xs font-semibold text-zinc-600 dark:text-zinc-300">Upload Product Image</p>
                                    <p class="text-[10px] text-zinc-400 mt-0.5">PNG, JPG, WebP, SVG (Max 2MB)</p>
                                </div>
                            @endif
                        </div>

                        <label class="block w-full text-center py-2 px-4 bg-cream-100 dark:bg-zinc-800 hover:bg-cream-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-200 rounded-xl text-xs font-bold cursor-pointer transition-colors">
                            <i class="fa-solid fa-image mr-1 text-amber-500"></i> Change Image
                            <input type="file" name="product_image" id="product_image" accept="image/*" class="hidden" onchange="previewProductImage(this)">
                        </label>
                        @error('product_image')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-2xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-all shadow-md flex items-center justify-center gap-2">
                    <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                    <span>Update Product</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Initialize Summernote Lite with rich features
    $(document).ready(function() {
        $('#product_description').summernote({
            placeholder: 'Write comprehensive product details, package inclusions, terms, license keys info, tables, instructions...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

    function generateSlug(text, targetId) {
        const slug = text
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById(targetId).value = slug;
    }

    function previewProductImage(input) {
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('imagePlaceholder');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

