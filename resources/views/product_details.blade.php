@extends('layouts.website')

@section('title', $product->name . ' - DigiGo')

@section('content')
<div class="bg-cream-50 dark:bg-brand-dark min-h-screen py-8 sm:py-12 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- 1. Breadcrumbs Navigation -->
        <nav class="flex items-center gap-2 text-xs font-medium text-zinc-500 dark:text-zinc-400">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 dark:hover:text-white transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-house text-[11px]"></i>
                <span>Home</span>
            </a>
            <i class="fa-solid fa-chevron-right text-[9px] text-zinc-400"></i>
            <a href="{{ route('home') }}#products" class="hover:text-zinc-900 dark:hover:text-white transition-colors">
                Products
            </a>
            @if($product->category)
                <i class="fa-solid fa-chevron-right text-[9px] text-zinc-400"></i>
                <a href="{{ route('home') }}#products" class="text-amber-600 dark:text-brand-yellow font-semibold hover:underline">
                    {{ $product->category->name }}
                </a>
            @endif
            <i class="fa-solid fa-chevron-right text-[9px] text-zinc-400"></i>
            <span class="text-zinc-800 dark:text-zinc-200 truncate max-w-xs font-semibold">{{ $product->name }}</span>
        </nav>

        <!-- 2. Main Product Showcase Area (2 Columns) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            <!-- Left: Product Image & Badges (5 Cols) -->
            <div class="lg:col-span-5 space-y-4">
                <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-3xl p-8 flex items-center justify-center relative overflow-hidden shadow-sm aspect-square">
                    @if($product->product_image)
                        <img src="{{ asset($product->product_image) }}" alt="{{ $product->name }}" class="max-h-72 max-w-full object-contain hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-28 h-28 rounded-3xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center text-6xl shadow-sm">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                    @endif

                    <!-- Top Left Category Pill -->
                    @if($product->category)
                        <span class="absolute top-4 left-4 bg-amber-100 text-amber-800 dark:bg-amber-950/80 dark:text-brand-yellow text-xs font-bold px-3 py-1 rounded-full border border-amber-200/60 dark:border-amber-900/40">
                            {{ $product->category->name }}
                        </span>
                    @endif

                    <!-- Top Right Custom Badge -->
                    @if($product->badge)
                        <span class="absolute top-4 right-4 bg-red-100 text-red-800 dark:bg-red-950/80 dark:text-red-300 text-xs font-bold px-3 py-1 rounded-full border border-red-200 dark:border-red-900">
                            {{ $product->badge }}
                        </span>
                    @endif
                </div>

                <!-- Trust Badges List -->
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-3 text-center">
                        <i class="fa-solid fa-bolt text-amber-500 text-lg mb-1 block"></i>
                        <span class="text-[11px] font-bold text-zinc-800 dark:text-zinc-200 block">Instant</span>
                        <span class="text-[9px] text-zinc-400">Fast 5m Delivery</span>
                    </div>
                    <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-3 text-center">
                        <i class="fa-solid fa-shield text-emerald-500 text-lg mb-1 block"></i>
                        <span class="text-[11px] font-bold text-zinc-800 dark:text-zinc-200 block">100% Genuine</span>
                        <span class="text-[9px] text-zinc-400">Official Warranty</span>
                    </div>
                    <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-3 text-center">
                        <i class="fa-solid fa-headset text-sky-500 text-lg mb-1 block"></i>
                        <span class="text-[11px] font-bold text-zinc-800 dark:text-zinc-200 block">24/7 Help</span>
                        <span class="text-[9px] text-zinc-400">Live Assistance</span>
                    </div>
                </div>
            </div>

            <!-- Right: Product Information & Purchase Controls (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <!-- Product Title -->
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-zinc-900 dark:text-white leading-tight">
                        {{ $product->name }}
                    </h1>

                    <!-- Stock Status & Code -->
                    <div class="flex items-center gap-3 mt-3">
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-2.5 py-1 rounded-full border border-emerald-200/60 dark:border-emerald-900/60">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            In Stock • Instant Delivery
                        </span>
                        <span class="text-xs text-zinc-400 font-mono">SKU: DG-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <!-- Short Description -->
                    @if($product->short_description)
                        <p class="text-sm text-zinc-600 dark:text-zinc-300 mt-4 leading-relaxed">
                            {{ $product->short_description }}
                        </p>
                    @endif
                </div>

                <!-- Pricing Card -->
                <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-3xl p-6 shadow-sm space-y-4">
                    <div class="flex flex-wrap items-baseline gap-3">
                        <span class="text-3xl sm:text-4xl font-black text-zinc-900 dark:text-white">
                            ৳{{ number_format($product->price, 0) }}
                        </span>
                        @if($product->old_price && $product->old_price > $product->price)
                            <span class="text-lg text-zinc-400 line-through">
                                ৳{{ number_format($product->old_price, 0) }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded-lg bg-rose-100 text-rose-700 dark:bg-rose-950/60 dark:text-rose-400 text-xs font-bold border border-rose-200 dark:border-rose-900">
                                Save ৳{{ number_format($product->old_price - $product->price, 0) }} ({{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}% OFF)
                            </span>
                        @endif
                    </div>

                    <div class="text-xs text-zinc-500 dark:text-zinc-400 flex items-center gap-2">
                        <i class="fa-solid fa-truck-fast text-amber-500"></i>
                        <span>Automated digital credentials will be sent immediately after purchase.</span>
                    </div>

                    <!-- Call to Action Buttons -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <a href="{{ route('home') }}#contact" class="py-3.5 px-6 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-extrabold rounded-2xl text-sm transition-all shadow-md flex items-center justify-center gap-2 text-center">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span>Order / Buy Now</span>
                        </a>

                        <a href="https://wa.me/8801700000000?text={{ urlencode('Hello DigiGo, I am interested in buying ' . $product->name . ' (৳' . number_format($product->price, 0) . '). Please guide me!') }}" target="_blank" class="py-3.5 px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl text-sm transition-all shadow-md flex items-center justify-center gap-2 text-center">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>Chat on WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Payment Assurance -->
                <div class="bg-cream-100/60 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-2 text-zinc-700 dark:text-zinc-300 font-semibold">
                        <i class="fa-solid fa-lock text-emerald-500"></i>
                        <span>Guaranteed Safe & Secure Checkout</span>
                    </div>
                    <img src="{{ asset('assets/img/payment-method.png') }}" alt="Payment Methods" class="h-8" />
                </div>
            </div>
        </div>

        <!-- 3. Full Product Description (Rich HTML Content) -->
        <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-3xl p-6 sm:p-10 shadow-sm space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-cream-200 dark:border-brand-borderDark">
                <div class="w-9 h-9 rounded-xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Product Description & Features</h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Detailed specifications, terms, and usage guidelines.</p>
                </div>
            </div>

            <!-- Rendered HTML Content with Styled Headings, Tables, Lists, and Highlights -->
            <div class="prose prose-zinc dark:prose-invert max-w-none text-zinc-700 dark:text-zinc-300 text-sm leading-relaxed space-y-4">
                @if($product->product_description)
                    {!! $product->product_description !!}
                @else
                    <p class="text-zinc-400 italic">No detailed description provided for this product.</p>
                @endif
            </div>
        </div>

        <!-- 4. Related / Recommended Products -->
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
            <div class="space-y-6 pt-4">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-extrabold text-amber-600 dark:text-brand-yellow uppercase tracking-wider">Explore More</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-zinc-900 dark:text-white mt-0.5">Related Products</h2>
                    </div>
                    <a href="{{ route('home') }}#products" class="text-xs font-bold text-zinc-600 dark:text-zinc-300 hover:text-amber-600 dark:hover:text-brand-yellow transition-colors flex items-center gap-1">
                        <span>View All</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $rel)
                        <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-4 hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                            <div>
                                <a href="{{ route('product.details', $rel->slug) }}" class="block h-40 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center p-4 mb-3 relative overflow-hidden group/rel">
                                    @if($rel->product_image)
                                        <img src="{{ asset($rel->product_image) }}" alt="{{ $rel->name }}" class="max-h-28 max-w-full object-contain group-hover/rel:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center text-2xl">
                                            <i class="fa-solid fa-cube"></i>
                                        </div>
                                    @endif
                                    @if($rel->badge)
                                        <span class="absolute top-2.5 right-2.5 bg-red-100 text-red-800 dark:bg-red-950/80 dark:text-red-300 text-[9px] font-bold px-2 py-0.5 rounded-full">
                                            {{ $rel->badge }}
                                        </span>
                                    @endif
                                </a>

                                <h3 class="font-bold text-sm text-zinc-900 dark:text-white truncate">
                                    <a href="{{ route('product.details', $rel->slug) }}" class="hover:text-amber-600 dark:hover:text-brand-yellow transition-colors">
                                        {{ $rel->name }}
                                    </a>
                                </h3>
                                @if($rel->short_description)
                                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 line-clamp-2">{{ $rel->short_description }}</p>
                                @endif
                            </div>

                            <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-3 mt-4">
                                <span class="text-sm font-black text-zinc-900 dark:text-white">৳{{ number_format($rel->price, 0) }}</span>
                                <a href="{{ route('product.details', $rel->slug) }}" class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-[11px] font-bold px-3 py-1.5 rounded-lg transition-colors">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

