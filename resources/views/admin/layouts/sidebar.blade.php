<!-- Mobile Backdrop -->
<div id="adminSidebarBackdrop" class="fixed inset-0 bg-black/50 z-40 lg:hidden opacity-0 pointer-events-none transition-opacity duration-300"></div>

<!-- Sidebar Container -->
<aside id="adminPanelSidebar" class="fixed top-0 left-0 bottom-0 w-64 bg-white dark:bg-brand-cardDark border-r border-cream-200 dark:border-brand-borderDark z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col justify-between overflow-y-auto">
    <div>
        <!-- Brand Logo & Header -->
        <div class="flex items-center justify-between h-16 px-5 border-b border-cream-200 dark:border-brand-borderDark">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-zinc-900 dark:bg-brand-yellow flex items-center justify-center font-bold text-base text-brand-yellow dark:text-zinc-900 shadow-sm">
                    D
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-lg tracking-tight text-zinc-900 dark:text-white leading-tight">DIGIGO<span class="text-brand-yellow">.</span></span>
                    <span class="text-[9px] font-bold tracking-widest text-rose-600 dark:text-rose-400 uppercase">Admin Center</span>
                </div>
            </a>
            <button id="adminCloseSidebarBtn" type="button" class="lg:hidden p-1.5 rounded-lg text-zinc-400 hover:text-zinc-800 dark:hover:text-white">
                <i class="fa-solid fa-xmark text-base"></i>
            </button>
        </div>

        <!-- Admin Quick Info Card -->
        <div class="p-4 mx-3 my-3 rounded-2xl bg-zinc-900 text-white border border-zinc-800 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-brand-yellow text-zinc-900 font-bold text-sm flex items-center justify-center shrink-0">
                @if(Auth::user() && Auth::user()->photo)
                    <img src="{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover rounded-xl">
                @else
                    <span>{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</span>
                @endif
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</h4>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                    <span class="text-[10px] font-medium text-zinc-400">Superadmin Online</span>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="px-3 py-2 space-y-1">
            <p class="px-3 text-[10px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-2">Core Dashboard</p>

            <!-- Dashboard Link -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-zinc-900 dark:text-white bg-cream-100 dark:bg-zinc-800/80 border border-cream-200 dark:border-brand-borderDark transition-colors">
                <i class="fa-solid fa-chart-line w-4 text-amber-600 dark:text-brand-yellow"></i>
                <span>Dashboard Overview</span>
            </a>

            <!-- Customization Section -->
            <p class="px-3 text-[10px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider pt-3 mb-2">Customization</p>
            <div class="admin-sidebar-dropdown">
                <button type="button" class="admin-dropdown-toggle w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium {{ request()->routeIs('admin.customization.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.faqs.*') ? 'text-zinc-900 dark:text-white font-bold bg-cream-50 dark:bg-zinc-800/60' : 'text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white' }} transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-palette w-4 {{ request()->routeIs('admin.customization.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.faqs.*') ? 'text-amber-600 dark:text-brand-yellow' : 'text-amber-500' }}"></i>
                        <span>Website Customization</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 transition-transform duration-200 admin-dropdown-arrow {{ request()->routeIs('admin.customization.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.faqs.*') ? 'rotate-180' : '' }}"></i>
                </button>
                <div class="admin-dropdown-content {{ request()->routeIs('admin.customization.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.faqs.*') ? '' : 'hidden' }} pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('admin.customization.topnav') }}" class="block px-3 py-1.5 text-[11px] rounded-lg {{ request()->routeIs('admin.customization.topnav') ? 'text-amber-600 dark:text-brand-yellow font-bold bg-cream-100 dark:bg-zinc-800/60' : 'text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30' }} transition-colors">
                        <i class="fa-solid fa-window-maximize text-[9px] mr-1"></i> Top Nav & Header
                    </a>
                    <a href="{{ route('admin.customization.banner') }}" class="block px-3 py-1.5 text-[11px] rounded-lg {{ request()->routeIs('admin.customization.banner') ? 'text-amber-600 dark:text-brand-yellow font-bold bg-cream-100 dark:bg-zinc-800/60' : 'text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30' }} transition-colors">
                        <i class="fa-solid fa-image text-[9px] mr-1"></i> Hero / Banner Area
                    </a>
                    <a href="{{ route('admin.customization.cta') }}" class="block px-3 py-1.5 text-[11px] rounded-lg {{ request()->routeIs('admin.customization.cta') ? 'text-amber-600 dark:text-brand-yellow font-bold bg-cream-100 dark:bg-zinc-800/60' : 'text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30' }} transition-colors">
                        <i class="fa-solid fa-bullhorn text-[9px] mr-1"></i> Call to Action (CTA)
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="block px-3 py-1.5 text-[11px] rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'text-amber-600 dark:text-brand-yellow font-bold bg-cream-100 dark:bg-zinc-800/60' : 'text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30' }} transition-colors">
                        <i class="fa-solid fa-comments text-[9px] mr-1"></i> Testimonials & Reviews
                    </a>
                    <a href="{{ route('admin.faqs.index') }}" class="block px-3 py-1.5 text-[11px] rounded-lg {{ request()->routeIs('admin.faqs.*') ? 'text-amber-600 dark:text-brand-yellow font-bold bg-cream-100 dark:bg-zinc-800/60' : 'text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30' }} transition-colors">
                        <i class="fa-solid fa-circle-question text-[9px] mr-1"></i> FAQ Questions
                    </a>
                </div>
            </div>

            <!-- Dropdown 1: Products Management -->
            <p class="px-3 text-[10px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider pt-3 mb-2">Catalog & Sales</p>
            <div class="admin-sidebar-dropdown">
                <button type="button" class="admin-dropdown-toggle w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') ? 'text-zinc-900 dark:text-white font-bold bg-cream-50 dark:bg-zinc-800/60' : 'text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white' }} transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-box-open w-4 {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') ? 'text-amber-600 dark:text-brand-yellow' : 'text-zinc-400' }}"></i>
                        <span>Products & Catalog</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 transition-transform duration-200 admin-dropdown-arrow {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') ? 'rotate-180' : '' }}"></i>
                </button>
                <div class="admin-dropdown-content {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.products.*') ? '' : 'hidden' }} pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('admin.categories.index') }}" class="block px-3 py-1.5 text-[11px] rounded-lg {{ request()->routeIs('admin.categories.*') ? 'text-amber-600 dark:text-brand-yellow font-bold bg-cream-100 dark:bg-zinc-800/60' : 'text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30' }} transition-colors">
                        <i class="fa-solid fa-layer-group text-[9px] mr-1"></i> Categories
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="block px-3 py-1.5 text-[11px] rounded-lg {{ request()->routeIs('admin.products.index') ? 'text-amber-600 dark:text-brand-yellow font-bold bg-cream-100 dark:bg-zinc-800/60' : 'text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30' }} transition-colors">
                        <i class="fa-solid fa-boxes-stacked text-[9px] mr-1"></i> All Products
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="block px-3 py-1.5 text-[11px] rounded-lg {{ request()->routeIs('admin.products.create') ? 'text-amber-600 dark:text-brand-yellow font-bold bg-cream-100 dark:bg-zinc-800/60' : 'text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30' }} transition-colors">
                        <i class="fa-solid fa-plus text-[9px] mr-1"></i> Add New Product
                    </a>
                </div>
            </div>

            <!-- Dropdown 2: Orders & Sales -->
            <div class="admin-sidebar-dropdown">
                <button type="button" class="admin-dropdown-toggle w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-cart-shopping w-4 text-zinc-400"></i>
                        <span>Orders & Billing</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 transition-transform duration-200 admin-dropdown-arrow"></i>
                </button>
                <div class="admin-dropdown-content hidden pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">All Orders</a>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Pending Verification</a>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Completed Sales</a>
                </div>
            </div>

            <!-- Dropdown 3: License Vault -->
            <div class="admin-sidebar-dropdown">
                <button type="button" class="admin-dropdown-toggle w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-key w-4 text-zinc-400"></i>
                        <span>License Keys Pool</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 transition-transform duration-200 admin-dropdown-arrow"></i>
                </button>
                <div class="admin-dropdown-content hidden pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Available Key Stocks</a>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Batch Upload Keys</a>
                </div>
            </div>

            <!-- Single Link: User Accounts -->
            <p class="px-3 text-[10px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider pt-3 mb-2">Management</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                <i class="fa-solid fa-users w-4 text-zinc-400"></i>
                <span>Customer Accounts</span>
            </a>

            <!-- Single Link: Inquiries -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                <i class="fa-solid fa-envelope-open-text w-4 text-zinc-400"></i>
                <span>Contact Inquiries</span>
            </a>

            <!-- Dropdown 4: System Settings -->
            <div class="admin-sidebar-dropdown">
                <button type="button" class="admin-dropdown-toggle w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-cream-50 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-sliders w-4 text-zinc-400"></i>
                        <span>System Settings</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-zinc-400 transition-transform duration-200 admin-dropdown-arrow"></i>
                </button>
                <div class="admin-dropdown-content hidden pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">General Configuration</a>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">Payment Gateways</a>
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-1.5 text-[11px] rounded-lg text-zinc-600 dark:text-zinc-400 hover:text-amber-600 dark:hover:text-brand-yellow hover:bg-cream-50 dark:hover:bg-zinc-800/30 transition-colors">SMTP & Mail Config</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Bottom Admin Logout -->
    <div class="p-3 border-t border-cream-200 dark:border-brand-borderDark">
        <a href="{{ route('admin.logout') }}" class="flex items-center justify-center gap-2 w-full px-3.5 py-2.5 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/30 hover:bg-rose-100 dark:hover:bg-rose-900/40 transition-colors">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Log Out Admin</span>
        </a>
    </div>
</aside>

