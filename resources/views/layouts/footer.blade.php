
    <!-- 9. FOOTER -->
    <footer id="about" class="bg-cream-100 dark:bg-zinc-950 text-zinc-600 dark:text-zinc-400 border-t border-cream-200 dark:border-brand-borderDark pt-16 pb-8 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-zinc-900 dark:bg-brand-yellow flex items-center justify-center font-bold text-brand-yellow dark:text-zinc-900 text-sm">
                            D
                        </div>
                        <span class="font-extrabold text-xl tracking-tight text-zinc-900 dark:text-white">DIGIGO<span class="text-brand-yellow">.</span></span>
                    </div>
                    <p class="text-xs leading-relaxed mb-4">
                        DigiGo.click provides exclusive official digital products subscription with seamless experience.
                    </p>
                    <div class="flex space-x-3 text-zinc-500 dark:text-zinc-400">
                        <a href="#" class="hover:text-zinc-900 dark:hover:text-white"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="hover:text-zinc-900 dark:hover:text-white"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="hover:text-zinc-900 dark:hover:text-white"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-900 dark:text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#home" class="hover:underline">Home</a></li>
                        <li><a href="#products" class="hover:underline">Digital Shop</a></li>
                        <li><a href="#testimonials" class="hover:underline">Reviews</a></li>
                        <li><a href="#faq" class="hover:underline">F.A.Q</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-900 dark:text-white mb-4">Categories</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#products" class="hover:underline">Cloud Products</a></li>
                        <li><a href="#products" class="hover:underline">Digital Subscriptions</a></li>
                        <li><a href="#products" class="hover:underline">Live TV & OTT</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-900 dark:text-white mb-4">Secured Payments</h4>
                    <p class="text-xs mb-3">We accept all major national cards & mobile wallets.</p>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/img/payment-method.png') }}" alt="Payment Methods" class="h-8" />    
                    </div>
                </div>
            </div>

            <div class="border-t border-cream-200 dark:border-zinc-800 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs gap-4">
                <p>©2026 DigiGo Bangladesh, All Rights Reserved.</p>
                <p class="text-zinc-400">GLOBAL OTT BRAND DIGITAL PARTNER</p>
            </div>
        </div>
    </footer>

    <!-- AOS JS CDN -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Swiper JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // 1. Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });

        // 2. Swiper Testimonial Slider
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 24 },
                1024: { slidesPerView: 3, spaceBetween: 24 },
            },
        });

        // 3. Category Filter Logic
        const filterBtns = document.querySelectorAll('.filter-btn');
        const productItems = document.querySelectorAll('.product-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.className = 'filter-btn px-4 py-2 text-xs font-semibold rounded-full bg-white dark:bg-brand-cardDark text-zinc-600 dark:text-zinc-300 hover:bg-cream-200 border border-cream-200 dark:border-brand-borderDark transition-all';
                });

                btn.className = 'filter-btn px-4 py-2 text-xs font-semibold rounded-full bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 transition-all';

                const filterValue = btn.getAttribute('data-filter');

                productItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // 4. Mobile Left Slide Drawer Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeDrawerBtn = document.getElementById('closeDrawerBtn');
        const mobileDrawer = document.getElementById('mobileDrawer');
        const mobileBackdrop = document.getElementById('mobileBackdrop');
        const mobileDrawerLinks = document.querySelectorAll('.mobile-drawer-link');

        function openDrawer() {
            mobileDrawer.classList.remove('-translate-x-full');
            mobileBackdrop.classList.remove('opacity-0', 'pointer-events-none');
        }

        function closeDrawer() {
            mobileDrawer.classList.add('-translate-x-full');
            mobileBackdrop.classList.add('opacity-0', 'pointer-events-none');
        }

        mobileMenuBtn.addEventListener('click', openDrawer);
        closeDrawerBtn.addEventListener('click', closeDrawer);
        mobileBackdrop.addEventListener('click', closeDrawer);

        mobileDrawerLinks.forEach(link => {
            link.addEventListener('click', closeDrawer);
        });

        // 5. FAQ Accordion Toggle
        const faqToggles = document.querySelectorAll('.faq-toggle');
        faqToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const content = toggle.nextElementSibling;
                const icon = toggle.querySelector('.icon');

                document.querySelectorAll('.faq-content').forEach(item => {
                    if (item !== content) {
                        item.classList.add('hidden');
                        item.previousElementSibling.querySelector('.icon').style.transform = 'rotate(0deg)';
                    }
                });

                content.classList.toggle('hidden');
                icon.style.transform = content.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
            });
        });

        // 6. Dark/Light Theme Toggle
        const themeToggleBtn = document.getElementById('themeToggle');
        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @stack('js')
    
</body>
</html>