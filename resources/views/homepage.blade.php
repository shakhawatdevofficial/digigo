@extends('layouts.website')
@section('content')
    <!-- 3. BANNER / HERO SECTION -->
    <section id="home" class="relative py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <span
                class="inline-block px-4 py-1.5 mb-6 text-xs font-semibold tracking-wider text-zinc-900 bg-brand-yellow/30 dark:bg-brand-yellow/10 dark:text-brand-yellow border border-brand-yellow/40 rounded-full">
                ONE CLICK DIGITAL SOLUTION
            </span>

            <h1
                class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-zinc-900 dark:text-white tracking-tight max-w-4xl mx-auto leading-tight">
                Your Digital Products, <br>
                <span class="italic font-serif font-normal">All in One Place.</span>
            </h1>

            <p class="mt-6 text-lg sm:text-xl text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto font-normal">
                DigiGo provides exclusive official digital product subscriptions with instant activation and 24/7 dedicated
                support.
            </p>

            <div class="mt-10 max-w-xl mx-auto" data-aos="fade-up">
                <div
                    class="flex items-center bg-white dark:bg-brand-cardDark p-2 rounded-full shadow-lg border border-cream-200 dark:border-brand-borderDark">
                    <i class="fa-solid fa-magnifying-glass text-zinc-400 ml-4 mr-2"></i>
                    <input type="text" placeholder="Search Office 365, YouTube, Spotify..."
                        class="w-full bg-transparent border-none outline-none text-sm text-zinc-800 dark:text-zinc-200 placeholder-zinc-400 font-sans">
                    <button
                        class="bg-brand-yellow hover:bg-brand-hover text-zinc-900 px-6 py-2.5 rounded-full font-semibold text-sm transition-all flex items-center gap-2 shrink-0">
                        Search <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>
            </div>

            <p class="mt-6 text-xs text-zinc-500 dark:text-zinc-500 font-medium tracking-wide" data-aos="fade-up">
                TRUSTED BY OVER <span class="font-bold text-zinc-800 dark:text-zinc-300">50,000+</span> CUSTOMERS BANGLADESH
                WIDE
            </p>
        </div>
    </section>

    <!-- 4. ALL PRODUCTS SECTION -->
    <section id="products"
        class="py-16 bg-cream-100/50 dark:bg-zinc-900/40 border-y border-cream-200 dark:border-brand-borderDark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12" data-aos="fade-up">
                <div>
                    <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-white">Discover Digital Products</h2>
                    <p class="text-zinc-600 dark:text-zinc-400 mt-2 text-sm">Explore our official digital subscriptions and
                        premium licenses.</p>
                </div>

                <!-- Category Filter Buttons -->
                <div class="flex flex-wrap gap-2 mt-4 md:mt-0" id="categoryFilters">
                    <button data-filter="all"
                        class="filter-btn px-4 py-2 text-xs font-semibold rounded-full bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 transition-all">All
                        Categories</button>
                    <button data-filter="cloud"
                        class="filter-btn px-4 py-2 text-xs font-semibold rounded-full bg-white dark:bg-brand-cardDark text-zinc-600 dark:text-zinc-300 hover:bg-cream-200 border border-cream-200 dark:border-brand-borderDark transition-all">Cloud
                        Products</button>
                    <button data-filter="subscription"
                        class="filter-btn px-4 py-2 text-xs font-semibold rounded-full bg-white dark:bg-brand-cardDark text-zinc-600 dark:text-zinc-300 hover:bg-cream-200 border border-cream-200 dark:border-brand-borderDark transition-all">Digital
                        Subscriptions</button>
                    <button data-filter="tv"
                        class="filter-btn px-4 py-2 text-xs font-semibold rounded-full bg-white dark:bg-brand-cardDark text-zinc-600 dark:text-zinc-300 hover:bg-cream-200 border border-cream-200 dark:border-brand-borderDark transition-all">Live
                        TV & OTT</button>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="productGrid">

                <!-- Product 1 (Cloud) -->
                <div data-category="cloud"
                    class="product-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-5 hover:shadow-xl transition-all duration-300 group"
                    data-aos="fade-up">
                    <div
                        class="h-48 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center p-6 mb-4 relative overflow-hidden">
                        <i
                            class="fa-brands fa-microsoft text-6xl text-blue-600 group-hover:scale-110 transition-transform duration-300"></i>
                        <span
                            class="absolute top-3 right-3 bg-blue-100 text-blue-800 text-[10px] font-bold px-2.5 py-1 rounded-full">Cloud</span>
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white">Office 365 Personal</h3>
                        <span
                            class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400 font-semibold px-2 py-0.5 rounded">Official</span>
                    </div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">Includes 1TB to 5TB OneDrive storage with full
                        premium apps suite.</p>
                    <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-4">
                        <div>
                            <span class="text-xs text-zinc-400 line-through">৳2,500</span>
                            <span class="text-lg font-extrabold text-zinc-900 dark:text-white ml-1">৳1,199</span>
                        </div>
                        <button
                            class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-xs px-4 py-2 rounded-lg font-semibold transition-colors">
                            Buy Now
                        </button>
                    </div>
                </div>

                <!-- Product 2 (Subscription) -->
                <div data-category="subscription"
                    class="product-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-5 hover:shadow-xl transition-all duration-300 group"
                    data-aos="fade-up">
                    <div
                        class="h-48 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center p-6 mb-4 relative overflow-hidden">
                        <i
                            class="fa-brands fa-youtube text-6xl text-red-600 group-hover:scale-110 transition-transform duration-300"></i>
                        <span
                            class="absolute top-3 right-3 bg-red-100 text-red-800 text-[10px] font-bold px-2.5 py-1 rounded-full">Popular</span>
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white">YouTube Premium</h3>
                        <span
                            class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400 font-semibold px-2 py-0.5 rounded">Official</span>
                    </div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">Ad-free videos, background play, and YouTube
                        Music Premium access.</p>
                    <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-4">
                        <div>
                            <span class="text-xs text-zinc-400 line-through">৳499</span>
                            <span class="text-lg font-extrabold text-zinc-900 dark:text-white ml-1">৳249</span>
                        </div>
                        <button
                            class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-xs px-4 py-2 rounded-lg font-semibold transition-colors">
                            Buy Now
                        </button>
                    </div>
                </div>

                <!-- Product 3 (Subscription) -->
                <div data-category="subscription"
                    class="product-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-5 hover:shadow-xl transition-all duration-300 group"
                    data-aos="fade-up">
                    <div
                        class="h-48 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center p-6 mb-4 relative overflow-hidden">
                        <i
                            class="fa-brands fa-spotify text-6xl text-emerald-500 group-hover:scale-110 transition-transform duration-300"></i>
                        <span
                            class="absolute top-3 right-3 bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2.5 py-1 rounded-full">Audio</span>
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white">Spotify Premium</h3>
                        <span
                            class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400 font-semibold px-2 py-0.5 rounded">Official</span>
                    </div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">Offline listening, high quality audio, no ad
                        interruptions.</p>
                    <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-4">
                        <div>
                            <span class="text-xs text-zinc-400 line-through">৳399</span>
                            <span class="text-lg font-extrabold text-zinc-900 dark:text-white ml-1">৳199</span>
                        </div>
                        <button
                            class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-xs px-4 py-2 rounded-lg font-semibold transition-colors">
                            Buy Now
                        </button>
                    </div>
                </div>

                <!-- Product 4 (TV & OTT) -->
                <div data-category="tv"
                    class="product-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-5 hover:shadow-xl transition-all duration-300 group"
                    data-aos="fade-up">
                    <div
                        class="h-48 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center p-6 mb-4 relative overflow-hidden">
                        <i
                            class="fa-brands fa-amazon text-6xl text-amber-500 group-hover:scale-110 transition-transform duration-300"></i>
                        <span
                            class="absolute top-3 right-3 bg-amber-100 text-amber-800 text-[10px] font-bold px-2.5 py-1 rounded-full">OTT</span>
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white">Prime Video</h3>
                        <span
                            class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400 font-semibold px-2 py-0.5 rounded">Official</span>
                    </div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">Prime Video membership subscription by Amazon.
                        High resolution streaming.</p>
                    <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-4">
                        <div>
                            <span class="text-xs text-zinc-400 line-through">৳299</span>
                            <span class="text-lg font-extrabold text-zinc-900 dark:text-white ml-1">৳149</span>
                        </div>
                        <button
                            class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-xs px-4 py-2 rounded-lg font-semibold transition-colors">
                            Buy Now
                        </button>
                    </div>
                </div>

                <!-- Product 5 (TV & OTT) -->
                <div data-category="tv"
                    class="product-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-5 hover:shadow-xl transition-all duration-300 group"
                    data-aos="fade-up">
                    <div
                        class="h-48 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center p-6 mb-4 relative overflow-hidden">
                        <i
                            class="fa-solid fa-tv text-6xl text-purple-500 group-hover:scale-110 transition-transform duration-300"></i>
                        <span
                            class="absolute top-3 right-3 bg-purple-100 text-purple-800 text-[10px] font-bold px-2.5 py-1 rounded-full">Live
                            TV</span>
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white">Dish Internet TV</h3>
                        <span
                            class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400 font-semibold px-2 py-0.5 rounded">Official</span>
                    </div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">170+ Live TV Channels & Live Sports for all
                        devices subscription.</p>
                    <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-4">
                        <div>
                            <span class="text-xs text-zinc-400 line-through">৳500</span>
                            <span class="text-lg font-extrabold text-zinc-900 dark:text-white ml-1">৳300</span>
                        </div>
                        <button
                            class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-xs px-4 py-2 rounded-lg font-semibold transition-colors">
                            Buy Now
                        </button>
                    </div>
                </div>

                <!-- Product 6 (Cloud) -->
                <div data-category="cloud"
                    class="product-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-5 hover:shadow-xl transition-all duration-300 group"
                    data-aos="fade-up">
                    <div
                        class="h-48 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center p-6 mb-4 relative overflow-hidden">
                        <i
                            class="fa-brands fa-google text-6xl text-sky-500 group-hover:scale-110 transition-transform duration-300"></i>
                        <span
                            class="absolute top-3 right-3 bg-sky-100 text-sky-800 text-[10px] font-bold px-2.5 py-1 rounded-full">Storage</span>
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white">Google One Storage</h3>
                        <span
                            class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400 font-semibold px-2 py-0.5 rounded">Official</span>
                    </div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">Expanded cloud storage across Drive, Gmail,
                        and Photos.</p>
                    <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-4">
                        <div>
                            <span class="text-xs text-zinc-400 line-through">৳1,800</span>
                            <span class="text-lg font-extrabold text-zinc-900 dark:text-white ml-1">৳850</span>
                        </div>
                        <button
                            class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-xs px-4 py-2 rounded-lg font-semibold transition-colors">
                            Buy Now
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. OUR HAPPY CUSTOMERS (TESTIMONIAL SLIDER) -->
    <section id="testimonials" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span
                    class="text-xs font-extrabold text-amber-600 dark:text-brand-yellow uppercase tracking-wider">Testimonials</span>
                <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-white mt-1">Our Happy Customers</h2>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2 text-sm">See what our verified clients have to say about
                    our digital services.</p>
            </div>

            <!-- Swiper Slider -->
            <div class="swiper mySwiper pb-12" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide h-auto">
                        <div
                            class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark p-6 rounded-2xl flex flex-col justify-between h-full shadow-sm">
                            <div>
                                <div class="flex items-center gap-1 text-brand-yellow mb-3 text-xs">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed italic">
                                    "Khub fast activation peyechi! Office 365 Personal er subscription payment korar 10 min
                                    er moddhe email e chole esheche. Highly recommended!"
                                </p>
                            </div>
                            <div class="flex items-center gap-3 mt-6 pt-4 border-t border-cream-100 dark:border-zinc-800">
                                <div
                                    class="w-10 h-10 rounded-full bg-brand-yellow/20 text-amber-700 dark:text-brand-yellow font-bold flex items-center justify-center text-sm">
                                    AH
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-zinc-900 dark:text-white">Ariful Hasan</h4>
                                    <p class="text-[10px] text-zinc-400">Software Engineer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide h-auto">
                        <div
                            class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark p-6 rounded-2xl flex flex-col justify-between h-full shadow-sm">
                            <div>
                                <div class="flex items-center gap-1 text-brand-yellow mb-3 text-xs">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed italic">
                                    "YouTube Premium and Spotify buy koresilam. Product pura official ebong ekono smooth
                                    choltese. Support team tao khub helpful."
                                </p>
                            </div>
                            <div class="flex items-center gap-3 mt-6 pt-4 border-t border-cream-100 dark:border-zinc-800">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-950 dark:text-blue-400 font-bold flex items-center justify-center text-sm">
                                    SI
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-zinc-900 dark:text-white">Siam Islam</h4>
                                    <p class="text-[10px] text-zinc-400">Content Creator</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide h-auto">
                        <div
                            class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark p-6 rounded-2xl flex flex-col justify-between h-full shadow-sm">
                            <div>
                                <div class="flex items-center gap-1 text-brand-yellow mb-3 text-xs">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed italic">
                                    "Best digital subscription site in BD! Price compare korle onek shasroymoyi ebong
                                    service oo 100% genuine."
                                </p>
                            </div>
                            <div class="flex items-center gap-3 mt-6 pt-4 border-t border-cream-100 dark:border-zinc-800">
                                <div
                                    class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-950 dark:text-emerald-400 font-bold flex items-center justify-center text-sm">
                                    TA
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-zinc-900 dark:text-white">Tanvir Ahmed</h4>
                                    <p class="text-[10px] text-zinc-400">Digital Marketer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </section>

    <!-- 6. CALL TO ACTION (CTA SECTION) -->
    <section class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto bg-zinc-900 text-white rounded-3xl p-8 sm:p-12 relative overflow-hidden shadow-2xl"
            data-aos="fade-up">
            <div
                class="absolute -right-10 -bottom-10 w-64 h-64 bg-brand-yellow/10 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="max-w-2xl text-center lg:text-left">
                    <span class="text-xs font-bold text-brand-yellow uppercase tracking-wider mb-2 inline-block">Instant
                        Access</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Ready to Upgrade Your Digital
                        Experience?</h2>
                    <p class="text-zinc-400 mt-3 text-sm sm:text-base">Get instant delivery on all premium accounts with
                        100% official validity and 24/7 support.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 shrink-0">
                    <a href="#products"
                        class="inline-flex items-center justify-center px-6 py-3 bg-brand-yellow text-zinc-900 font-bold rounded-full hover:bg-brand-hover transition-colors text-sm">
                        Explore Shop <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    <a href="#contact"
                        class="inline-flex items-center justify-center px-6 py-3 border border-zinc-700 hover:bg-zinc-800 text-white font-semibold rounded-full transition-colors text-sm">
                        <i class="fa-brands fa-whatsapp mr-2 text-emerald-400"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. FAQ SECTION -->
    <section id="faq"
        class="py-16 bg-cream-100/50 dark:bg-zinc-900/40 border-t border-cream-200 dark:border-brand-borderDark">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-white">Frequently Asked Questions</h2>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2 text-sm">Everything you need to know about our digital
                    service delivery.</p>
            </div>

            <div class="space-y-4" data-aos="fade-up">
                <!-- FAQ Item 1 -->
                <div
                    class="faq-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl overflow-hidden">
                    <button
                        class="faq-toggle w-full p-5 text-left text-base font-bold text-zinc-900 dark:text-white flex items-center justify-between focus:outline-none">
                        <span>How quickly will I receive my product after payment?</span>
                        <i
                            class="fa-solid fa-chevron-down text-xs text-zinc-400 transition-transform duration-300 icon"></i>
                    </button>
                    <div
                        class="faq-content hidden px-5 pb-5 pt-0 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed border-t border-cream-100 dark:border-zinc-800/50 mt-1">
                        Most digital subscriptions are activated within 5 to 15 minutes after payment confirmation. In rare
                        cases, it can take up to 1 hour.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div
                    class="faq-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl overflow-hidden">
                    <button
                        class="faq-toggle w-full p-5 text-left text-base font-bold text-zinc-900 dark:text-white flex items-center justify-between focus:outline-none">
                        <span>Are these accounts fully official and personal?</span>
                        <i
                            class="fa-solid fa-chevron-down text-xs text-zinc-400 transition-transform duration-300 icon"></i>
                    </button>
                    <div
                        class="faq-content hidden px-5 pb-5 pt-0 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed border-t border-cream-100 dark:border-zinc-800/50 mt-1">
                        Yes, all products provided by DigiGo are 100% official accounts or activations applied directly to
                        your personal email account.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div
                    class="faq-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl overflow-hidden">
                    <button
                        class="faq-toggle w-full p-5 text-left text-base font-bold text-zinc-900 dark:text-white flex items-center justify-between focus:outline-none">
                        <span>What payment methods do you accept in Bangladesh?</span>
                        <i
                            class="fa-solid fa-chevron-down text-xs text-zinc-400 transition-transform duration-300 icon"></i>
                    </button>
                    <div
                        class="faq-content hidden px-5 pb-5 pt-0 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed border-t border-cream-100 dark:border-zinc-800/50 mt-1">
                        We accept all local payment methods including bKash, Nagad, Rocket, as well as Visa/Mastercard cards
                        via SSLCommerz gateway.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. CONTACT SECTION -->
    <section id="contact" class="py-20 border-t border-cream-200 dark:border-brand-borderDark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="text-xs font-extrabold text-amber-600 dark:text-brand-yellow uppercase tracking-wider">Get In
                    Touch</span>
                <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-white mt-1">Contact Us</h2>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2 text-sm">Have a question or need a custom digital
                    subscription? Reach out to us anytime.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" data-aos="fade-up">
                <!-- Info Cards -->
                <div class="space-y-4">
                    <div
                        class="bg-white dark:bg-brand-cardDark p-6 rounded-2xl border border-cream-200 dark:border-brand-borderDark flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-brand-yellow/20 text-zinc-900 dark:text-brand-yellow flex items-center justify-center shrink-0 text-lg">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-zinc-900 dark:text-white text-base">Email Us</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Send us an email for general
                                inquiries.</p>
                            <a href="mailto:email@digigo.click"
                                class="text-xs font-semibold text-amber-600 dark:text-brand-yellow mt-2 inline-block">email@digigo.click</a>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-brand-cardDark p-6 rounded-2xl border border-cream-200 dark:border-brand-borderDark flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 text-lg">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-zinc-900 dark:text-white text-base">WhatsApp Support</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Fastest response for instant order
                                help.</p>
                            <a href="#"
                                class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 mt-2 inline-block">+880
                                1700-000000</a>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-brand-cardDark p-6 rounded-2xl border border-cream-200 dark:border-brand-borderDark flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-950 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 text-lg">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-zinc-900 dark:text-white text-base">Office Location</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Gulshan-1, Dhaka, Bangladesh.</p>
                            <span class="text-xs font-semibold text-blue-600 dark:text-blue-400 mt-2 inline-block">Visit
                                Support Desk</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div
                    class="lg:col-span-2 bg-white dark:bg-brand-cardDark p-8 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="flex items-center gap-3 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 p-4 rounded-xl mb-4 border border-green-200 dark:border-green-800"
                            role="alert">
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-green-200 dark:bg-green-800 text-green-700 dark:text-green-300 shrink-0">
                                <i class="fa-solid fa-check" aria-hidden="true"></i>
                            </span>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('contact') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2">Your
                                    Name</label>
                                <input type="text" placeholder="John Doe" required name="name"
                                    value="{{ old('name') }}"
                                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl p-3 text-xs outline-none focus:border-brand-yellow font-sans">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2">Email
                                    Address</label>
                                <input type="email" placeholder="example@mail.com" required name="email"
                                    value="{{ old('email') }}"
                                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl p-3 text-xs outline-none focus:border-brand-yellow font-sans">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2">Subject</label>
                            <input type="text" placeholder="Custom Order Inquiry" name="subject"
                                value="{{ old('subject') }}"
                                class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl p-3 text-xs outline-none focus:border-brand-yellow font-sans">
                            @error('subject')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2">Your
                                Message</label>
                            <textarea rows="4" placeholder="Write your message here..." required name="message"
                                class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl p-3 text-xs outline-none focus:border-brand-yellow font-sans">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-colors">
                            Send Message <i class="fa-solid fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = this;
            const submitButton = form.querySelector('button[type="submit"]');
            const tokenInput = document.getElementById('recaptcha_token');

            submitButton.disabled = true;
            submitButton.innerHTML = 'Sending...';

            console.log('Site Key:', '{{ config('services.recaptcha.site_key') }}');

            if (typeof grecaptcha === 'undefined') {
                console.error('reCAPTCHA script did not load.');
                alert('reCAPTCHA could not be loaded. Please refresh the page.');
                submitButton.disabled = false;
                submitButton.innerHTML =
                    'Send Message <i class="fa-solid fa-paper-plane ml-2"></i>';
                return;
            }

            grecaptcha.ready(function() {

                grecaptcha.execute(
                        '{{ config('services.recaptcha.site_key') }}', {
                            action: 'contact_form'
                        }
                    )
                    .then(function(token) {

                        console.log('reCAPTCHA token received:', token);

                        tokenInput.value = token;

                        form.submit();
                    })
                    .catch(function(error) {

                        console.error('reCAPTCHA execute error:', error);

                        submitButton.disabled = false;
                        submitButton.innerHTML =
                            'Send Message <i class="fa-solid fa-paper-plane ml-2"></i>';

                        alert('reCAPTCHA verification failed. Check browser console.');
                    });
            });
        });
    </script>
@endpush
