@extends('layouts.website')
@section('content')
    <!-- 3. BANNER / HERO SECTION -->
    @if(\App\Models\Setting::get('banner_status', '1') == '1')
    <section id="home" class="relative py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            @if($badge = \App\Models\Setting::get('banner_badge', 'ONE CLICK DIGITAL SOLUTION'))
                <span
                    class="inline-block px-4 py-1.5 mb-6 text-xs font-semibold tracking-wider text-zinc-900 bg-brand-yellow/30 dark:bg-brand-yellow/10 dark:text-brand-yellow border border-brand-yellow/40 rounded-full">
                    {{ $badge }}
                </span>
            @endif

            <h1
                class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-zinc-900 dark:text-white tracking-tight max-w-4xl mx-auto leading-tight">
                {{ \App\Models\Setting::get('banner_title_1', 'Your Digital Products,') }} <br>
                <span class="italic font-serif font-normal">{{ \App\Models\Setting::get('banner_title_2', 'All in One Place.') }}</span>
            </h1>

            @if($description = \App\Models\Setting::get('banner_description', 'DigiGo provides exclusive official digital product subscriptions with instant activation and 24/7 dedicated support.'))
                <p class="mt-6 text-lg sm:text-xl text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto font-normal">
                    {{ $description }}
                </p>
            @endif

            <div class="mt-10 max-w-xl mx-auto" data-aos="fade-up">
                <div
                    class="flex items-center bg-white dark:bg-brand-cardDark p-2 rounded-full shadow-lg border border-cream-200 dark:border-brand-borderDark">
                    <i class="fa-solid fa-magnifying-glass text-zinc-400 ml-4 mr-2"></i>
                    <input type="text" placeholder="{{ \App\Models\Setting::get('banner_search_placeholder', 'Search Office 365, YouTube, Spotify...') }}"
                        class="w-full bg-transparent border-none outline-none text-sm text-zinc-800 dark:text-zinc-200 placeholder-zinc-400 font-sans">
                    <button
                        class="bg-brand-yellow hover:bg-brand-hover text-zinc-900 px-6 py-2.5 rounded-full font-semibold text-sm transition-all flex items-center gap-2 shrink-0">
                        Search <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>
            </div>

            @if($trustedText = \App\Models\Setting::get('banner_trusted_text', 'TRUSTED BY OVER 50,000+ CUSTOMERS BANGLADESH WIDE'))
                <p class="mt-6 text-xs text-zinc-500 dark:text-zinc-500 font-medium tracking-wide" data-aos="fade-up">
                    {{ $trustedText }}
                </p>
            @endif
        </div>
    </section>
    @endif

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
                        class="filter-btn px-4 py-2 text-xs font-semibold rounded-full bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 transition-all">
                        All Categories
                    </button>
                    @if(isset($categories) && $categories->count() > 0)
                        @foreach($categories as $category)
                            <button data-filter="{{ $category->slug }}"
                                class="filter-btn px-4 py-2 text-xs font-semibold rounded-full bg-white dark:bg-brand-cardDark text-zinc-600 dark:text-zinc-300 hover:bg-cream-200 border border-cream-200 dark:border-brand-borderDark transition-all">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="productGrid">
                @forelse($products as $product)
                    <div data-category="{{ $product->category->slug ?? 'uncategorized' }}"
                        class="product-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-2xl p-5 hover:shadow-xl transition-all duration-300 group flex flex-col justify-between"
                        data-aos="fade-up">
                        <div>
                            <!-- Product Image / Icon Box -->
                            <a href="{{ route('product.details', $product->slug) }}" class="block h-48 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center p-6 mb-4 relative overflow-hidden group/img">
                                @if($product->product_image)
                                    <img src="{{ asset($product->product_image) }}" alt="{{ $product->name }}" class="max-h-36 max-w-full object-contain group-hover/img:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-16 h-16 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center text-4xl group-hover/img:scale-110 transition-transform duration-300">
                                        <i class="fa-solid fa-cube"></i>
                                    </div>
                                @endif

                                @if($product->badge)
                                    <span class="absolute top-3 right-3 bg-red-100 text-red-800 dark:bg-red-950/80 dark:text-red-300 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                        {{ $product->badge }}
                                    </span>
                                @elseif($product->category)
                                    <span class="absolute top-3 right-3 bg-amber-100 text-amber-800 dark:bg-amber-950/80 dark:text-amber-300 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                        {{ $product->category->name }}
                                    </span>
                                @endif
                            </a>

                            <!-- Product Name & Badge -->
                            <div class="flex justify-between items-start mb-2 gap-2">
                                <a href="{{ route('product.details', $product->slug) }}" class="font-bold text-lg text-zinc-900 dark:text-white leading-snug hover:text-amber-600 dark:hover:text-brand-yellow transition-colors">
                                    {{ $product->name }}
                                </a>
                                @if($product->badge)
                                    <span class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400 font-semibold px-2 py-0.5 rounded shrink-0">
                                        {{ $product->badge }}
                                    </span>
                                @endif
                            </div>

                            <!-- Short Description -->
                            @if($product->short_description)
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">{{ $product->short_description }}</p>
                            @endif
                        </div>

                        <!-- Price & Buy Button -->
                        <div class="flex items-center justify-between border-t border-cream-100 dark:border-zinc-800 pt-4 mt-auto">
                            <div>
                                @if($product->old_price)
                                    <span class="text-xs text-zinc-400 line-through">৳{{ number_format($product->old_price, 0) }}</span>
                                @endif
                                <span class="text-lg font-extrabold text-zinc-900 dark:text-white ml-1">৳{{ number_format($product->price, 0) }}</span>
                            </div>
                            <a href="{{ route('product.details', $product->slug) }}" class="bg-zinc-900 hover:bg-zinc-800 dark:bg-brand-yellow dark:text-zinc-900 dark:hover:bg-brand-hover text-white text-xs px-4 py-2 rounded-lg font-semibold transition-colors flex items-center gap-1.5">
                                <span>Buy Now</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-16 text-zinc-400">
                        <i class="fa-solid fa-box-open text-4xl mb-3 block text-zinc-300 dark:text-zinc-600"></i>
                        <p class="text-sm font-medium">No products available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. OUR HAPPY CUSTOMERS (TESTIMONIAL SLIDER) -->
    @if(\App\Models\Setting::get('testimonials_status', '1') == '1' && $testimonials->count() > 0)
    <section id="testimonials" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span
                    class="text-xs font-extrabold text-amber-600 dark:text-brand-yellow uppercase tracking-wider">{{ \App\Models\Setting::get('testimonials_badge', 'Testimonials') }}</span>
                <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-white mt-1">{{ \App\Models\Setting::get('testimonials_title', 'Our Happy Customers') }}</h2>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2 text-sm">{{ \App\Models\Setting::get('testimonials_description', 'See what our verified clients have to say about our digital services.') }}</p>
            </div>

            <!-- Swiper Slider -->
            <div class="swiper mySwiper pb-12" data-aos="fade-up">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $item)
                        <!-- Slide -->
                        <div class="swiper-slide h-auto">
                            <div
                                class="bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark p-6 rounded-2xl flex flex-col justify-between h-full shadow-sm">
                                <div>
                                    <div class="flex items-center gap-1 text-brand-yellow mb-3 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $item->rating)
                                                <i class="fa-solid fa-star"></i>
                                            @else
                                                <i class="fa-regular fa-star text-zinc-300 dark:text-zinc-600"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed italic">
                                        "{{ $item->comment }}"
                                    </p>
                                </div>
                                <div class="flex items-center gap-3 mt-6 pt-4 border-t border-cream-100 dark:border-zinc-800">
                                    @if($item->avatar)
                                        <img src="{{ asset($item->avatar) }}" alt="{{ $item->name }}" class="w-10 h-10 rounded-full object-cover border border-cream-200 dark:border-brand-borderDark shrink-0">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-full bg-brand-yellow/20 text-amber-700 dark:text-brand-yellow font-bold flex items-center justify-center text-sm shrink-0">
                                            {{ $item->initials }}
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-xs font-bold text-zinc-900 dark:text-white">{{ $item->name }}</h4>
                                        <p class="text-[10px] text-zinc-400">{{ $item->designation ?: 'Verified Customer' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </section>
    @endif

    <!-- 6. CALL TO ACTION (CTA SECTION) -->
    @if(\App\Models\Setting::get('cta_status', '1') == '1')
    <section class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto bg-zinc-900 text-white rounded-3xl p-8 sm:p-12 relative overflow-hidden shadow-2xl"
            data-aos="fade-up">
            <div
                class="absolute -right-10 -bottom-10 w-64 h-64 bg-brand-yellow/10 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="max-w-2xl text-center lg:text-left">
                    @if($ctaBadge = \App\Models\Setting::get('cta_badge', 'Instant Access'))
                        <span class="text-xs font-bold text-brand-yellow uppercase tracking-wider mb-2 inline-block">
                            {{ $ctaBadge }}
                        </span>
                    @endif
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                        {{ \App\Models\Setting::get('cta_title', 'Ready to Upgrade Your Digital Experience?') }}
                    </h2>
                    @if($ctaDesc = \App\Models\Setting::get('cta_description', 'Get instant delivery on all premium accounts with 100% official validity and 24/7 support.'))
                        <p class="text-zinc-400 mt-3 text-sm sm:text-base">
                            {{ $ctaDesc }}
                        </p>
                    @endif
                </div>
                <div class="flex flex-col sm:flex-row gap-4 shrink-0">
                    <a href="{{ \App\Models\Setting::get('cta_btn_primary_link', '#products') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-brand-yellow text-zinc-900 font-bold rounded-full hover:bg-brand-hover transition-colors text-sm">
                        {{ \App\Models\Setting::get('cta_btn_primary_text', 'Explore Shop') }} <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ \App\Models\Setting::get('cta_btn_secondary_link', '#contact') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-zinc-700 hover:bg-zinc-800 text-white font-semibold rounded-full transition-colors text-sm">
                        <i class="fa-brands fa-whatsapp mr-2 text-emerald-400"></i> {{ \App\Models\Setting::get('cta_btn_secondary_text', 'Contact Us') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 7. FAQ SECTION -->
    @if(\App\Models\Setting::get('faq_status', '1') == '1' && $faqs->count() > 0)
    <section id="faq"
        class="py-16 bg-cream-100/50 dark:bg-zinc-900/40 border-t border-cream-200 dark:border-brand-borderDark">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                @if(\App\Models\Setting::get('faq_badge'))
                <span
                    class="text-xs font-extrabold text-amber-600 dark:text-brand-yellow uppercase tracking-wider block mb-1">{{ \App\Models\Setting::get('faq_badge', 'FAQ') }}</span>
                @endif
                <h2 class="text-3xl font-extrabold text-zinc-900 dark:text-white">{{ \App\Models\Setting::get('faq_title', 'Frequently Asked Questions') }}</h2>
                <p class="text-zinc-600 dark:text-zinc-400 mt-2 text-sm">{{ \App\Models\Setting::get('faq_description', 'Everything you need to know about our digital service delivery.') }}</p>
            </div>

            <div class="space-y-4" data-aos="fade-up">
                @foreach($faqs as $faq)
                    <!-- FAQ Item -->
                    <div
                        class="faq-item bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl overflow-hidden">
                        <button
                            class="faq-toggle w-full p-5 text-left text-base font-bold text-zinc-900 dark:text-white flex items-center justify-between focus:outline-none">
                            <span>{{ $faq->question }}</span>
                            <i
                                class="fa-solid fa-chevron-down text-xs text-zinc-400 transition-transform duration-300 icon"></i>
                        </button>
                        <div
                            class="faq-content hidden px-5 pb-5 pt-0 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed border-t border-cream-100 dark:border-zinc-800/50 mt-1">
                            {{ $faq->answer }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

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
