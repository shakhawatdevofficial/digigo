<!-- Mobile Backdrop -->
<div id="sidebarBackdrop" class="fixed inset-0 bg-black/50 z-40 lg:hidden opacity-0 pointer-events-none transition-opacity duration-300"></div>

<!-- Sidebar Container -->
<aside id="panelSidebar" class="fixed top-0 left-0 bottom-0 w-64 bg-white dark:bg-brand-cardDark border-r border-cream-200 dark:border-brand-borderDark z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col justify-between overflow-y-auto">
    <div>
        <!-- Brand Logo & Header -->
        <div class="flex items-center justify-between h-16 px-5 border-b border-cream-200 dark:border-brand-borderDark">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-zinc-900 dark:bg-brand-yellow flex items-center justify-center font-bold text-base text-brand-yellow dark:text-zinc-900 shadow-sm">
                    D
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-lg tracking-tight text-zinc-900 dark:text-white leading-tight">DIGIGO<span class="text-brand-yellow">.</span></span>
                    <span class="text-[9px] font-bold tracking-widest text-amber-600 dark:text-brand-yellow uppercase">User Portal</span>
                </div>
            </a>
            <button id="closeSidebarBtn" type="button" class="lg:hidden p-1.5 rounded-lg text-zinc-400 hover:text-zinc-800 dark:hover:text-white">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>

        <!-- User Quick Card in Sidebar -->
        <div class="p-4 mx-3 my-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 font-bold text-sm flex items-center justify-center shrink-0">
                @if(Auth::user() && Auth::user()->photo)
                    <img src="{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover rounded-xl">
                @else
                    <span>{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</span>
                @endif
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="text-xs font-bold text-zinc-900 dark:text-white truncate">{{ Auth::user()->name ?? 'User' }}</h4>
                <p class="text-[10px] text-zinc-500 dark:text-zinc-400 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="px-3 py-2 space-y-1">
            <p class="px-3 text-[10px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-2">Main Navigation</p>

            <!-- Dashboard Link -->
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-900 dark:text-white bg-cream-100 dark:bg-zinc-800/80 border border-cream-200 dark:border-brand-borderDark transition-colors">
                <i class="fa-solid fa-chart-pie w-4 text-amber-600 dark:text-brand-yellow"></i>
                <span>Dashboard</span>
            </a>

            <!-- Dropdown 1: Orders & Subscriptions -->
            <div class="sidebar-dropdown">
                <button type="button" class="dropdown-toggle w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bag-shopping w-4 text-zinc-400"></i>
                        <span>My Subscriptions</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 transition-transform duration-200 dropdown-arrow"></i>
                </button>
                <div class="dropdown-content hidden pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">All Orders</a>
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Active Licenses</a>
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Order History</a>
                </div>
            </div>

            <!-- Single Link: Digital Keys -->
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                <i class="fa-solid fa-key w-4 text-zinc-400"></i>
                <span>License Vault</span>
            </a>

            <!-- Dropdown 2: Wallet & Payments -->
            <div class="sidebar-dropdown">
                <button type="button" class="dropdown-toggle w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-wallet w-4 text-zinc-400"></i>
                        <span>Wallet & Invoices</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 transition-transform duration-200 dropdown-arrow"></i>
                </button>
                <div class="dropdown-content hidden pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">My Balance</a>
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Transaction History</a>
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Download Invoices</a>
                </div>
            </div>

            <!-- Single Link: Support Helpdesk -->
            <a href="{{ route('home') }}#contact" target="_blank" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                <i class="fa-solid fa-headset w-4 text-zinc-400"></i>
                <span>24/7 Support Desk</span>
            </a>

            <!-- Dropdown 3: Account Settings -->
            <p class="px-3 text-[10px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider pt-3 mb-2">Preferences</p>
            <div class="sidebar-dropdown">
                <button type="button" class="dropdown-toggle w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-gear w-4 text-zinc-400"></i>
                        <span>Account Settings</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 transition-transform duration-200 dropdown-arrow"></i>
                </button>
                <div class="dropdown-content hidden pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Profile Details</a>
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Security & Password</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Bottom Action & Logout -->
    <div class="p-3 border-t border-cream-200 dark:border-brand-borderDark">
        <a href="{{ route('user.logout') }}" class="flex items-center justify-center gap-2 w-full px-3.5 py-2.5 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/30 hover:bg-rose-100 dark:hover:bg-rose-900/40 transition-colors">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Log Out</span>
        </a>
    </div>
</aside>

