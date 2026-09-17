<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard - DigiGo')</title>

    <!-- Google Font: Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Roboto', 'sans-serif'],
                    },
                    colors: {
                        cream: {
                            50: '#FAF7F2',
                            100: '#F5EFE6',
                            200: '#EBE0D0',
                        },
                        brand: {
                            yellow: '#FFD000',
                            hover: '#E6B800',
                            dark: '#0F0F11',
                            cardDark: '#18181B',
                            borderDark: '#27272A'
                        }
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Inline Dark Theme Check to Prevent FOUC -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @stack('css')
</head>
<body class="bg-cream-50 text-zinc-800 dark:bg-brand-dark dark:text-zinc-100 transition-colors duration-200 font-sans antialiased min-h-screen flex flex-col">

    <!-- User Sidebar Component -->
    @include('user.layouts.sidebar')

    <!-- Main Content Area Wrapper -->
    <div class="lg:pl-64 flex flex-col flex-1 min-h-screen">
        
        <!-- User Navbar Component -->
        @include('user.layouts.navbar')

        <!-- Page Content Body -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            <!-- Flash Message Alerts -->
            @if (session('success'))
                <div class="flex items-center gap-3 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 p-4 rounded-2xl mb-6 border border-emerald-200 dark:border-emerald-900 text-xs shadow-sm">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-sm shrink-0"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="flex items-center gap-3 bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 p-4 rounded-2xl mb-6 border border-rose-200 dark:border-rose-900 text-xs shadow-sm">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-sm shrink-0"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Panel Footer -->
        <footer class="border-t border-cream-200 dark:border-brand-borderDark py-4 px-6 text-center text-xs text-zinc-500 dark:text-zinc-400 bg-white/50 dark:bg-brand-cardDark/50">
            <p>© {{ date('Y') }} DigiGo Bangladesh • All Rights Reserved</p>
        </footer>
    </div>

    <!-- Panel Interaction Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Mobile Sidebar Controls
            const sidebar = document.getElementById('panelSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const openSidebarBtn = document.getElementById('sidebarToggleBtn');
            const closeSidebarBtn = document.getElementById('closeSidebarBtn');

            function openSidebar() {
                if (sidebar && backdrop) {
                    sidebar.classList.remove('-translate-x-full');
                    backdrop.classList.remove('opacity-0', 'pointer-events-none');
                }
            }

            function closeSidebar() {
                if (sidebar && backdrop) {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('opacity-0', 'pointer-events-none');
                }
            }

            if (openSidebarBtn) openSidebarBtn.addEventListener('click', openSidebar);
            if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', closeSidebar);
            if (backdrop) backdrop.addEventListener('click', closeSidebar);

            // 2. Sidebar Accordion Dropdowns
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const content = this.nextElementSibling;
                    const arrow = this.querySelector('.dropdown-arrow');
                    
                    const isExpanded = !content.classList.contains('hidden');
                    
                    // Close other dropdowns
                    document.querySelectorAll('.dropdown-content').forEach(el => {
                        if (el !== content) el.classList.add('hidden');
                    });
                    document.querySelectorAll('.dropdown-arrow').forEach(ar => {
                        if (ar !== arrow) ar.style.transform = 'rotate(0deg)';
                    });

                    if (isExpanded) {
                        content.classList.add('hidden');
                        if (arrow) arrow.style.transform = 'rotate(0deg)';
                    } else {
                        content.classList.remove('hidden');
                        if (arrow) arrow.style.transform = 'rotate(180deg)';
                    }
                });
            });

            // 3. Navbar Notification Dropdown
            const notifBtn = document.getElementById('notificationBtn');
            const notifMenu = document.getElementById('notificationMenu');
            if (notifBtn && notifMenu) {
                notifBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    notifMenu.classList.toggle('hidden');
                    // close user menu if open
                    const userMenu = document.getElementById('userMenu');
                    if (userMenu) userMenu.classList.add('hidden');
                });
            }

            // 4. Navbar User Profile Dropdown
            const userDropdownBtn = document.getElementById('userDropdownBtn');
            const userMenu = document.getElementById('userMenu');
            if (userDropdownBtn && userMenu) {
                userDropdownBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    userMenu.classList.toggle('hidden');
                    // close notif menu if open
                    if (notifMenu) notifMenu.classList.add('hidden');
                });
            }

            // Click outside closes dropdowns
            document.addEventListener('click', function (e) {
                if (notifMenu && !notifMenu.contains(e.target) && notifBtn && !notifBtn.contains(e.target)) {
                    notifMenu.classList.add('hidden');
                }
                if (userMenu && !userMenu.contains(e.target) && userDropdownBtn && !userDropdownBtn.contains(e.target)) {
                    userMenu.classList.add('hidden');
                }
            });

            // 5. Theme Toggle Handler
            const themeToggleBtn = document.getElementById('panelThemeToggle');
            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function () {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                });
            }
        });
    </script>

    @stack('js')
</body>
</html>

