@extends('layouts.website')

@section('title', $query ? 'Search results for "' . $query . '" - DigiGo' : 'Search Digital Products - DigiGo')

@section('content')
<main class="min-h-screen bg-cream-50 dark:bg-brand-dark transition-colors py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Search Header & Hero Input -->
        <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-3xl p-6 sm:p-10 shadow-sm text-center relative overflow-visible">
            <div class="max-w-3xl mx-auto space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-brand-yellow">
                    <i class="fa-solid fa-magnifying-glass text-[10px]"></i> Product Finder
                </span>
                <h1 class="text-2xl sm:text-4xl font-extrabold text-zinc-900 dark:text-white tracking-tight">
                    Search Digital Subscriptions & Licenses
                </h1>
                <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400">
                    Find your desired streaming accounts, cloud subscriptions, software tools and gaming passes instantly.
                </p>

                <!-- Search Input Form with Live Suggestions Dropdown -->
                <div class="relative mt-6 max-w-2xl mx-auto text-left">
                    <form action="{{ route('search') }}" method="GET" id="searchPageForm" class="relative">
                        @if($categorySlug)
                            <input type="hidden" name="category" value="{{ $categorySlug }}">
                        @endif
                        @if($sort !== 'latest')
                            <input type="hidden" name="sort" value="{{ $sort }}">
                        @endif

                        <div class="relative flex items-center">
                            <i class="fa-solid fa-magnifying-glass absolute left-4 sm:left-5 text-zinc-400 dark:text-zinc-500 text-base pointer-events-none"></i>
                            
                            <input 
                                type="text" 
                                name="q" 
                                id="mainSearchInput" 
                                value="{{ $query }}" 
                                placeholder="Search products by name (e.g. Netflix, Spotify, Canva, VPN)..." 
                                autocomplete="off"
                                class="w-full bg-cream-50 dark:bg-zinc-900/90 border-2 border-cream-200 dark:border-brand-borderDark rounded-2xl pl-12 sm:pl-14 pr-24 sm:pr-28 py-3.5 sm:py-4 text-sm font-medium text-zinc-900 dark:text-white placeholder-zinc-400 focus:outline-none focus:border-brand-yellow dark:focus:border-brand-yellow transition-all shadow-inner"
                            >

                            <!-- Clear / Search Buttons inside input -->
                            <div class="absolute right-2.5 flex items-center gap-1.5">
                                @if($query)
                                    <a href="{{ route('search', array_filter(['category' => $categorySlug, 'sort' => $sort !== 'latest' ? $sort : null])) }}" class="p-2 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 text-xs rounded-lg transition-colors" title="Clear Search">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                @endif
                                <button type="submit" class="px-4 sm:px-5 py-2 sm:py-2.5 bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 font-bold text-xs sm:text-sm rounded-xl hover:opacity-95 transition-all shadow">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Live Suggestions Dropdown Box -->
                    <div id="liveSuggestionsBox" class="absolute left-0 right-0 top-full mt-2 bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl shadow-2xl z-50 overflow-hidden hidden transition-all">
                        <div class="p-3 border-b border-cream-100 dark:border-zinc-800 flex items-center justify-between text-[11px] font-bold text-zinc-400 uppercase tracking-wider">
                            <span><i class="fa-solid fa-bolt text-brand-yellow mr-1"></i> Live Product Suggestions</span>
                            <span id="suggestionsCount" class="text-[10px] text-zinc-500"></span>
                        </div>
                        <div id="suggestionsList" class="divide-y divide-cream-100 dark:divide-zinc-800/80 max-h-80 overflow-y-auto">
                            <!-- Populated via JS -->
                        </div>
                        <a id="viewAllSuggestionsBtn" href="#" class="block p-3 text-center text-xs font-bold text-zinc-900 dark:text-brand-yellow bg-cream-50/80 dark:bg-zinc-900/80 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors border-t border-cream-100 dark:border-zinc-800">
                            View all matching results <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Category Filter Pills -->
                <div class="flex flex-wrap items-center justify-center gap-2 pt-4">
                    <a 
                        href="{{ route('search', array_filter(['q' => $query, 'sort' => $sort !== 'latest' ? $sort : null])) }}" 
                        class="px-4 py-2 text-xs font-semibold rounded-full border transition-all {{ empty($categorySlug) ? 'bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 border-zinc-900 dark:border-brand-yellow shadow-sm' : 'bg-cream-100/80 dark:bg-zinc-900 text-zinc-700 dark:text-zinc-300 border-cream-200 dark:border-brand-borderDark hover:border-brand-yellow' }}"
                    >
                        All Categories
                    </a>
                    @foreach($categories as $category)
                        <a 
                            href="{{ route('search', array_filter(['q' => $query, 'category' => $category->slug, 'sort' => $sort !== 'latest' ? $sort : null])) }}" 
                            class="px-4 py-2 text-xs font-semibold rounded-full border transition-all {{ $categorySlug === $category->slug ? 'bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 border-zinc-900 dark:border-brand-yellow shadow-sm' : 'bg-cream-100/80 dark:bg-zinc-900 text-zinc-700 dark:text-zinc-300 border-cream-200 dark:border-brand-borderDark hover:border-brand-yellow' }}"
                        >
                            {{ $category->name }}
                            <span class="text-[10px] opacity-70 ml-1">({{ $category->products_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Search Results Info Bar & Sort Selector -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-2 border-b border-cream-200 dark:border-brand-borderDark">
            <div>
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">
                    @if($query)
                        Search Results for <span class="text-amber-600 dark:text-brand-yellow">"{{ $query }}"</span>
                    @elseif($categorySlug)
                        Products in <span class="text-amber-600 dark:text-brand-yellow">"{{ $categories->firstWhere('slug', $categorySlug)?->name ?? $categorySlug }}"</span>
                    @else
                        All Available Digital Products
                    @endif
                </h2>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                    Found {{ $products->total() }} {{ Str::plural('product', $products->total()) }} matching your criteria
                </p>
            </div>

            <!-- Sort By Selector -->
            <div class="flex items-center gap-2 self-end sm:self-auto">
                <span class="text-xs font-semibold text-zinc-500 dark:text-zinc-400">Sort by:</span>
                <select 
                    onchange="location = this.value;" 
                    class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl px-3 py-1.5 text-xs font-semibold text-zinc-800 dark:text-zinc-200 outline-none focus:border-brand-yellow cursor-pointer shadow-sm"
                >
                    <option value="{{ route('search', array_filter(['q' => $query, 'category' => $categorySlug, 'sort' => 'latest'])) }}" {{ $sort === 'latest' ? 'selected' : '' }}>Latest Products</option>
                    <option value="{{ route('search', array_filter(['q' => $query, 'category' => $categorySlug, 'sort' => 'price_low'])) }}" {{ $sort === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ route('search', array_filter(['q' => $query, 'category' => $categorySlug, 'sort' => 'price_high'])) }}" {{ $sort === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="{{ route('search', array_filter(['q' => $query, 'category' => $categorySlug, 'sort' => 'name_asc'])) }}" {{ $sort === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-5 flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div>
                            <!-- Product Image / Banner -->
                            <a href="{{ route('product.details', $product->slug) }}" class="block w-full h-44 rounded-xl bg-cream-100 dark:bg-zinc-800 mb-4 overflow-hidden relative shadow-inner">
                                @if($product->product_image)
                                    <img src="{{ asset($product->product_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-zinc-400">
                                        <i class="fa-solid fa-cube text-3xl mb-1 text-zinc-300 dark:text-zinc-600"></i>
                                        <span class="text-[10px] uppercase font-bold tracking-wider">Digital Pass</span>
                                    </div>
                                @endif

                                @if($product->category)
                                    <span class="absolute top-2.5 left-2.5 bg-black/70 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-md">
                                        {{ $product->category->name }}
                                    </span>
                                @endif

                                @if($product->badge)
                                    <span class="absolute top-2.5 right-2.5 bg-brand-yellow text-zinc-900 text-[10px] font-extrabold px-2 py-0.5 rounded shadow">
                                        {{ $product->badge }}
                                    </span>
                                @endif
                            </a>

                            <!-- Product Name -->
                            <div class="mb-2">
                                <a href="{{ route('product.details', $product->slug) }}" class="font-bold text-base text-zinc-900 dark:text-white leading-snug hover:text-amber-600 dark:hover:text-brand-yellow transition-colors line-clamp-1">
                                    {{ $product->name }}
                                </a>
                            </div>

                            <!-- Short Description -->
                            @if($product->short_description)
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4 line-clamp-2">
                                    {{ $product->short_description }}
                                </p>
                            @endif
                        </div>

                        <!-- Price & Buy Button -->
                        <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-3.5 mt-auto">
                            <div>
                                @if($product->old_price)
                                    <span class="text-xs text-zinc-400 line-through block">৳{{ number_format($product->old_price, 0) }}</span>
                                @endif
                                <span class="text-base font-extrabold text-zinc-900 dark:text-white">৳{{ number_format($product->price, 0) }}</span>
                            </div>
                            <a href="{{ route('product.details', $product->slug) }}" class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-xs px-3.5 py-2 rounded-xl font-bold transition-colors flex items-center gap-1.5 shadow-sm">
                                <span>Buy Now</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="pt-6 border-t border-cream-200 dark:border-brand-borderDark flex justify-center">
                    {{ $products->links() }}
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-3xl p-12 text-center max-w-xl mx-auto shadow-sm space-y-4">
                <div class="w-16 h-16 mx-auto rounded-3xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-brand-yellow flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="text-lg font-bold text-zinc-900 dark:text-white">No Matching Products Found</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">
                    We couldn't find any digital products matching <span class="font-bold text-zinc-800 dark:text-zinc-200">"{{ $query }}"</span>. Try checking spelling or search with general keywords.
                </p>
                <div class="pt-2 flex flex-wrap items-center justify-center gap-2">
                    <a href="{{ route('search') }}" class="px-4 py-2 bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 text-xs font-bold rounded-xl shadow hover:opacity-95 transition-all">
                        Browse All Products
                    </a>
                    <a href="{{ route('home') }}#products" class="px-4 py-2 bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-xs font-semibold rounded-xl hover:bg-cream-200 dark:hover:bg-zinc-700 transition-colors">
                        Go to Home Shop
                    </a>
                </div>
            </div>
        @endif

    </div>
</main>

<!-- Live Search Autocomplete Client Script -->
<script>
    (function() {
        const searchInput = document.getElementById('mainSearchInput');
        const suggestionsBox = document.getElementById('liveSuggestionsBox');
        const suggestionsList = document.getElementById('suggestionsList');
        const suggestionsCount = document.getElementById('suggestionsCount');
        const viewAllBtn = document.getElementById('viewAllSuggestionsBtn');

        let debounceTimer;

        if (!searchInput || !suggestionsBox) return;

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();

            clearTimeout(debounceTimer);

            if (query.length < 1) {
                suggestionsBox.classList.add('hidden');
                return;
            }

            debounceTimer = setTimeout(() => {
                fetchSuggestions(query);
            }, 250);
        });

        // Hide suggestions on outside click
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.classList.add('hidden');
            }
        });

        // Show suggestions if focus with existing query
        searchInput.addEventListener('focus', function() {
            if (this.value.trim().length >= 1 && suggestionsList.children.length > 0) {
                suggestionsBox.classList.remove('hidden');
            }
        });

        function fetchSuggestions(query) {
            fetch(`{{ route('search.suggestions') }}?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.results && data.results.length > 0) {
                        suggestionsList.innerHTML = '';
                        suggestionsCount.textContent = `${data.total} found`;
                        viewAllBtn.href = `{{ route('search') }}?q=${encodeURIComponent(query)}`;

                        data.results.forEach(product => {
                            const item = document.createElement('a');
                            item.href = product.url;
                            item.className = 'flex items-center gap-3 p-3 hover:bg-cream-50 dark:hover:bg-zinc-800/80 transition-colors group';

                            const imageHtml = product.image 
                                ? `<img src="${product.image}" alt="${product.name}" class="w-10 h-10 rounded-lg object-cover shrink-0 border border-cream-200 dark:border-zinc-700">`
                                : `<div class="w-10 h-10 rounded-lg bg-cream-100 dark:bg-zinc-800 border border-cream-200 dark:border-zinc-700 flex items-center justify-center text-zinc-400 shrink-0 text-xs"><i class="fa-solid fa-cube"></i></div>`;

                            const badgeHtml = product.badge
                                ? `<span class="px-1.5 py-0.5 text-[9px] font-extrabold rounded bg-brand-yellow text-zinc-900 uppercase ml-1">${product.badge}</span>`
                                : '';

                            const categoryHtml = product.category
                                ? `<span class="text-[10px] text-zinc-400 dark:text-zinc-500">${product.category}</span>`
                                : '';

                            const oldPriceHtml = product.old_price 
                                ? `<span class="text-[10px] text-zinc-400 line-through mr-1">৳${product.old_price}</span>` 
                                : '';

                            item.innerHTML = `
                                ${imageHtml}
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-1">
                                        <span class="font-bold text-xs text-zinc-900 dark:text-white truncate group-hover:text-amber-600 dark:group-hover:text-brand-yellow transition-colors">${product.name}</span>
                                        ${badgeHtml}
                                    </div>
                                    ${categoryHtml}
                                </div>
                                <div class="text-right shrink-0">
                                    ${oldPriceHtml}
                                    <span class="text-xs font-black text-zinc-900 dark:text-white">৳${product.price}</span>
                                </div>
                            `;

                            suggestionsList.appendChild(item);
                        });

                        suggestionsBox.classList.remove('hidden');
                    } else {
                        suggestionsList.innerHTML = `
                            <div class="p-4 text-center text-xs text-zinc-400">
                                No live suggestions for "${query}". Press Enter to search all.
                            </div>
                        `;
                        suggestionsCount.textContent = '0 found';
                        viewAllBtn.href = `{{ route('search') }}?q=${encodeURIComponent(query)}`;
                        suggestionsBox.classList.remove('hidden');
                    }
                })
                .catch(err => {
                    console.error('Error fetching search suggestions:', err);
                });
        }
    })();
</script>
@endsection

