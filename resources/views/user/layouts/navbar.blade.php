<header class="sticky top-0 z-30 flex items-center justify-between h-16 px-4 sm:px-6 bg-white/90 dark:bg-brand-cardDark/90 backdrop-blur-md border-b border-cream-200 dark:border-brand-borderDark transition-colors">
    <!-- Left: Mobile Toggle & Page Title -->
    <div class="flex items-center gap-3">
        <button id="sidebarToggleBtn" type="button" class="lg:hidden p-2 rounded-xl text-zinc-600 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors focus:outline-none">
            <i class="fa-solid fa-bars-staggered text-lg"></i>
        </button>

        <div class="hidden sm:block">
            <h2 class="text-sm font-bold text-zinc-800 dark:text-zinc-100">@yield('page_title', 'User Dashboard')</h2>
            <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Welcome back, {{ Auth::user()->name ?? 'User' }}</p>
        </div>
    </div>

    <!-- Right: Quick Actions, Theme Toggle, Notifications, User Menu -->
    <div class="flex items-center gap-2 sm:gap-3">
        <!-- View Storefront Link -->
        <a href="{{ route('home') }}" target="_blank" class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:text-amber-600 dark:hover:text-brand-yellow rounded-lg hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors">
            <i class="fa-solid fa-globe text-xs"></i>
            <span>Visit Shop</span>
        </a>

        <!-- Dark/Light Theme Toggle -->
        <button id="panelThemeToggle" type="button" class="p-2 rounded-xl text-zinc-600 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors" title="Toggle Theme">
            <i class="fa-solid fa-moon dark:hidden text-sm"></i>
            <i class="fa-solid fa-sun hidden dark:block text-brand-yellow text-sm"></i>
        </button>

        <!-- Notification Dropdown -->
        <div class="relative" id="notificationDropdownContainer">
            <button id="notificationBtn" type="button" class="relative p-2 rounded-xl text-zinc-600 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors focus:outline-none">
                <i class="fa-solid fa-bell text-sm"></i>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-brand-yellow rounded-full ring-2 ring-white dark:ring-brand-cardDark"></span>
            </button>

            <!-- Dropdown Menu -->
            <div id="notificationMenu" class="hidden absolute right-0 mt-2 w-80 sm:w-96 bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-xl py-3 z-50 transition-all">
                <div class="flex items-center justify-between px-4 pb-3 border-b border-cream-200 dark:border-brand-borderDark">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-xs text-zinc-900 dark:text-white">Notifications</span>
                        <span class="px-2 py-0.5 text-[10px] font-bold bg-brand-yellow/30 text-zinc-900 dark:text-brand-yellow rounded-full">2 New</span>
                    </div>
                    <button type="button" class="text-[11px] text-amber-600 dark:text-brand-yellow hover:underline font-medium">Mark all read</button>
                </div>

                <div class="max-h-72 overflow-y-auto divide-y divide-cream-100 dark:divide-brand-borderDark">
                    <!-- Notification 1 -->
                    <div class="flex items-start gap-3 p-3.5 hover:bg-cream-50 dark:hover:bg-zinc-900/50 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 text-xs">
                            <i class="fa-solid fa-check-circle"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-zinc-800 dark:text-zinc-100 truncate">Account Activated</p>
                            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5 line-clamp-2">Your DigiGo user account is verified and active.</p>
                            <span class="text-[10px] text-zinc-400 mt-1 inline-block">Just now</span>
                        </div>
                    </div>

                    <!-- Notification 2 -->
                    <div class="flex items-start gap-3 p-3.5 hover:bg-cream-50 dark:hover:bg-zinc-900/50 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-brand-yellow flex items-center justify-center shrink-0 text-xs">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-zinc-800 dark:text-zinc-100 truncate">Special Discount</p>
                            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5 line-clamp-2">Get up to 20% off on all Cloud and OTT subscriptions this week.</p>
                            <span class="text-[10px] text-zinc-400 mt-1 inline-block">2 hours ago</span>
                        </div>
                    </div>
                </div>

                <div class="px-4 pt-2.5 border-t border-cream-200 dark:border-brand-borderDark text-center">
                    <a href="#" class="text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:text-amber-600 dark:hover:text-brand-yellow">View all notifications</a>
                </div>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div class="relative" id="userDropdownContainer">
            <button id="userDropdownBtn" type="button" class="flex items-center gap-2 p-1.5 rounded-xl hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors focus:outline-none">
                <div class="w-8 h-8 rounded-xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 font-bold text-xs flex items-center justify-center shadow-sm overflow-hidden border border-cream-200 dark:border-brand-borderDark">
                    @if(Auth::user() && Auth::user()->photo)
                        <img src="{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                    @else
                        <span>{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
                    @endif
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-xs font-bold text-zinc-800 dark:text-zinc-100 leading-none truncate max-w-[120px]">{{ Auth::user()->name ?? 'User' }}</p>
                    <span class="text-[10px] font-semibold text-brand-yellow leading-none">Customer</span>
                </div>
                <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 ml-1 hidden md:block"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="userMenu" class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-xl py-2 z-50 transition-all divide-y divide-cream-100 dark:divide-brand-borderDark">
                <!-- User Info Header -->
                <div class="px-4 py-2.5">
                    <p class="text-xs font-bold text-zinc-900 dark:text-white truncate">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 truncate mt-0.5">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                </div>

                <!-- Links -->
                <div class="py-1">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-zinc-700 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white transition-colors">
                        <i class="fa-solid fa-user-circle w-4 text-zinc-400"></i>
                        <span>My Profile</span>
                    </a>
                    <a href="{{ route('user.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-zinc-700 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white transition-colors">
                        <i class="fa-solid fa-key w-4 text-zinc-400"></i>
                        <span>Change Password</span>
                    </a>
                </div>

                <!-- Logout Link -->
                <div class="py-1">
                    <a href="{{ route('user.logout') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors font-semibold">
                        <i class="fa-solid fa-arrow-right-from-bracket w-4"></i>
                        <span>Sign Out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

