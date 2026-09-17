    <div id="mobileBackdrop" class="fixed inset-0 bg-black/50 z-50 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden"></div>
    <div id="mobileDrawer" class="fixed top-0 left-0 bottom-0 w-72 bg-cream-50 dark:bg-brand-cardDark z-50 -translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col justify-between p-6 shadow-2xl border-r border-cream-200 dark:border-brand-borderDark">
        <div>
            <div class="flex items-center justify-between pb-6 border-b border-cream-200 dark:border-brand-borderDark">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-zinc-900 dark:bg-brand-yellow flex items-center justify-center font-bold text-brand-yellow dark:text-zinc-900 text-sm">
                        D
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-zinc-900 dark:text-white">DIGIGO<span class="text-brand-yellow">.</span></span>
                </div>
                <button id="closeDrawerBtn" class="p-2 text-zinc-500 hover:text-zinc-900 dark:hover:text-white text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="mt-6 flex flex-col space-y-4 font-medium text-base">
                <a href="#home" class="mobile-drawer-link py-2 border-b border-cream-100 dark:border-zinc-800 hover:text-brand-yellow transition-colors">Home</a>
                <a href="#products" class="mobile-drawer-link py-2 border-b border-cream-100 dark:border-zinc-800 hover:text-brand-yellow transition-colors">Digital Shop</a>
                <a href="#testimonials" class="mobile-drawer-link py-2 border-b border-cream-100 dark:border-zinc-800 hover:text-brand-yellow transition-colors">Reviews</a>
                <a href="#faq" class="mobile-drawer-link py-2 border-b border-cream-100 dark:border-zinc-800 hover:text-brand-yellow transition-colors">F.A.Q</a>
                <a href="#contact" class="mobile-drawer-link py-2 border-b border-cream-100 dark:border-zinc-800 hover:text-brand-yellow transition-colors">Contact</a>
            </div>
        </div>

        <div>
            <a href="#products" class="mobile-drawer-link block w-full text-center py-3 text-sm font-semibold text-zinc-900 bg-brand-yellow rounded-full shadow">
                Get Started
            </a>
            <p class="text-center text-[10px] text-zinc-400 mt-4">©2026 DigiGo Bangladesh</p>
        </div>
    </div>