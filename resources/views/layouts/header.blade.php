
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','DigiGo - Modern Digital Shop')</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

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
