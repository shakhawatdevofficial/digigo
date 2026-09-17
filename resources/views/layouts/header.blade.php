
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', \App\Models\Setting::get('meta_title', 'DigiGo - Modern Digital Shop'))</title>
    
    <!-- Dynamic Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ \App\Models\Setting::get('site_favicon') ? asset(\App\Models\Setting::get('site_favicon')) : asset('assets/img/favicon.png') }}">

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', 'DigiGo provides exclusive official digital products subscription with seamless experience.'))">
    <meta name="keywords" content="@yield('meta_keywords', \App\Models\Setting::get('meta_keywords', 'digital subscriptions, ott accounts, software license, cloud services, bKash digital shop'))">
    <meta name="author" content="{{ \App\Models\Setting::get('meta_author', 'DigiGo Bangladesh') }}">

    <!-- OpenGraph & Social Media Meta Tags -->
    <meta property="og:title" content="@yield('title', \App\Models\Setting::get('meta_title', 'DigiGo - Modern Digital Shop'))">
    <meta property="og:description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', 'DigiGo provides exclusive official digital products subscription with seamless experience.'))">
    <meta property="og:image" content="{{ \App\Models\Setting::get('meta_og_image') ? asset(\App\Models\Setting::get('meta_og_image')) : (\App\Models\Setting::get('site_logo') ? asset(\App\Models\Setting::get('site_logo')) : asset('assets/img/digigo-logo.png')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', \App\Models\Setting::get('meta_title', 'DigiGo - Modern Digital Shop'))">
    <meta name="twitter:description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', 'DigiGo provides exclusive official digital products subscription with seamless experience.'))">
    <meta name="twitter:image" content="{{ \App\Models\Setting::get('meta_og_image') ? asset(\App\Models\Setting::get('meta_og_image')) : (\App\Models\Setting::get('site_logo') ? asset(\App\Models\Setting::get('site_logo')) : asset('assets/img/digigo-logo.png')) }}">

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

    <!-- AOS Animation CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Swiper CSS for Testimonial Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <style>
        .swiper-pagination-bullet-active {
            background-color: #FFD000 !important;
            width: 24px !important;
            border-radius: 9999px !important;
        }

        /* Smooth Floating Animations for Brand Badges */
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-14px) rotate(1.5deg); }
        }
        @keyframes floatMedium {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(-2deg); }
        }
        @keyframes floatFast {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-16px) rotate(2deg); }
        }
        .animate-float-1 { animation: floatSlow 5.5s ease-in-out infinite; }
        .animate-float-2 { animation: floatMedium 6.8s ease-in-out infinite 0.8s; }
        .animate-float-3 { animation: floatFast 5.2s ease-in-out infinite 1.5s; }
    </style>
    @stack('css')
</head>
<body class="bg-cream-50 text-zinc-800 dark:bg-brand-dark dark:text-zinc-100 transition-colors duration-300 font-sans antialiased overflow-x-hidden">

    <!-- 1. TOP BAR -->
    @include('layouts.topbar')

    <!-- 2. NAVBAR & MOBILE DRAWER -->
    @include('layouts.navbar')

    <!-- Mobile Left Slide-In Drawer Backdrop & Menu -->
    @include('layouts.mobilemenu')
