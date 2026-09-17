    <nav class="sticky top-0 z-40 bg-cream-50/90 dark:bg-brand-dark/90 backdrop-blur-md border-b border-cream-200 dark:border-brand-borderDark transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2">
                    @if(\App\Models\Setting::get('site_logo'))
                        <img src="{{ asset(\App\Models\Setting::get('site_logo')) }}" alt="DigiGo Logo" class="h-10 w-auto" />
                    @else
                        <img src="{{ asset('assets/img/digigo-logo.png') }}" alt="DigiGo Logo" class="h-10 w-auto" />
                    @endif
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center space-x-8 font-medium text-sm">
                    <a href="{{ route('home') }}#home" class="hover:text-amber-600 dark:hover:text-brand-yellow transition-colors">Home</a>
                    <a href="{{ route('home') }}#products" class="hover:text-amber-600 dark:hover:text-brand-yellow transition-colors">Digital Shop</a>
                    <a href="{{ route('home') }}#testimonials" class="hover:text-amber-600 dark:hover:text-brand-yellow transition-colors">Reviews</a>
                    <a href="{{ route('home') }}#faq" class="hover:text-amber-600 dark:hover:text-brand-yellow transition-colors">F.A.Q</a>
                    <a href="{{ route('home') }}#contact" class="hover:text-amber-600 dark:hover:text-brand-yellow transition-colors">Contact</a>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <!-- Search Button -->
                    <a href="{{ route('search') }}" class="p-2.5 rounded-full bg-cream-100 dark:bg-brand-cardDark text-zinc-700 dark:text-zinc-200 hover:bg-cream-200 dark:hover:bg-zinc-800 hover:text-amber-600 dark:hover:text-brand-yellow transition-colors" title="Search Digital Products">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </a>

                    <!-- Dark/Light Mode Toggle -->
                    <button id="themeToggle" class="p-2.5 rounded-full bg-cream-100 dark:bg-brand-cardDark text-zinc-700 dark:text-zinc-200 hover:bg-cream-200 dark:hover:bg-zinc-800 transition-colors">
                        <i class="fa-solid fa-moon dark:hidden"></i>
                        <i class="fa-solid fa-sun hidden dark:block text-brand-yellow"></i>
                    </button>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-zinc-900 bg-brand-yellow hover:bg-brand-hover rounded-full transition-all shadow-sm gap-1.5">
                                <i class="fa-solid fa-gauge"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="hidden sm:inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-zinc-900 bg-brand-yellow hover:bg-brand-hover rounded-full transition-all shadow-sm gap-1.5">
                                <i class="fa-solid fa-user"></i> Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">
                            Sign In
                        </a>
                        <a href="{{ \App\Models\Setting::get('navbar_btn_link', route('register')) }}" class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-zinc-900 bg-brand-yellow hover:bg-brand-hover rounded-full transition-all shadow-sm">
                            {{ \App\Models\Setting::get('navbar_btn_text', 'Get Started') }}
                        </a>
                    @endauth

                    <!-- Mobile Hamburger Button -->
                    <button id="mobileMenuBtn" class="md:hidden p-2.5 rounded-xl bg-cream-100 dark:bg-brand-cardDark text-zinc-800 dark:text-white focus:outline-none">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>