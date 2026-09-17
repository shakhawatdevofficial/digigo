@extends('layouts.website')

@section('title', 'Login - DigiGo')

@section('content')
<section class="min-h-[calc(100vh-200px)] py-12 lg:py-20 flex items-center justify-center relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-brand-yellow/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-md w-full mx-auto px-4 sm:px-6 relative z-10" data-aos="fade-up">
        <!-- Card Container -->
        <div class="bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-xl p-6 sm:p-8 transition-colors">
            
            <!-- Header & Badge -->
            <div class="text-center mb-8">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 mb-4 text-xs font-semibold tracking-wider text-zinc-900 bg-brand-yellow/30 dark:bg-brand-yellow/10 dark:text-brand-yellow border border-brand-yellow/40 rounded-full">
                    <i class="fa-solid fa-lock text-[10px]"></i> SECURE AUTHENTICATION
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 dark:text-white tracking-tight">
                    Welcome Back
                </h1>
                <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 mt-2">
                    Enter your credentials to access your DigiGo account
                </p>
            </div>

            {{-- Flash Success Message --}}
            @if (session('success'))
                <div class="flex items-center gap-3 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 p-3.5 rounded-xl mb-6 border border-emerald-200 dark:border-emerald-900 text-xs" role="alert">
                    <i class="fa-solid fa-circle-check text-emerald-500 shrink-0 text-sm"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Flash Error Message --}}
            @if (session('error'))
                <div class="flex items-center gap-3 bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-300 p-3.5 rounded-xl mb-6 border border-rose-200 dark:border-rose-900 text-xs" role="alert">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 shrink-0 text-sm"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('authenticate') }}" method="POST" class="space-y-4" novalidate>
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}" 
                            placeholder="name@example.com" 
                            required 
                            autofocus
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('email') border-red-500 dark:border-red-500 focus:border-red-500 @else border-cream-200 dark:border-brand-borderDark focus:border-brand-yellow @enderror rounded-xl pl-10 pr-3.5 py-3 text-xs outline-none font-sans text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 transition-colors"
                        >
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <a href="{{ route('home') }}#contact" class="text-[11px] font-medium text-amber-600 dark:text-brand-yellow hover:underline">
                            Forgot password?
                        </a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="••••••••" 
                            required
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('password') border-red-500 dark:border-red-500 focus:border-red-500 @else border-cream-200 dark:border-brand-borderDark focus:border-brand-yellow @enderror rounded-xl pl-10 pr-10 py-3 text-xs outline-none font-sans text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 transition-colors"
                        >
                        <button 
                            type="button" 
                            id="togglePassword" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 cursor-pointer focus:outline-none"
                            aria-label="Toggle password visibility"
                        >
                            <i class="fa-solid fa-eye text-xs" id="passwordIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            class="w-4 h-4 rounded border-cream-200 dark:border-brand-borderDark text-brand-yellow focus:ring-brand-yellow/30 bg-cream-50 dark:bg-zinc-900 accent-brand-yellow cursor-pointer"
                        >
                        <span class="text-xs text-zinc-600 dark:text-zinc-400">Remember me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full mt-2 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold py-3 px-4 rounded-xl text-xs transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:shadow active:scale-[0.99] cursor-pointer"
                >
                    <span>Sign In</span>
                    <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-cream-200 dark:border-brand-borderDark"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-3 bg-white dark:bg-brand-cardDark text-zinc-400 font-medium">
                        New to DigiGo?
                    </span>
                </div>
            </div>

            <!-- Create Account Link -->
            <div class="text-center">
                <p class="text-xs text-zinc-600 dark:text-zinc-400">
                    Don't have an account yet?
                    <a href="{{ route('register') }}" class="font-bold text-zinc-900 dark:text-brand-yellow hover:underline ml-1">
                        Create an account
                    </a>
                </p>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-xs text-zinc-500 dark:text-zinc-500">
            <div class="flex items-center gap-1.5">
                <i class="fa-solid fa-shield-halved text-brand-yellow"></i>
                <span>256-Bit SSL Encryption</span>
            </div>
            <div class="flex items-center gap-1.5">
                <i class="fa-solid fa-bolt text-brand-yellow"></i>
                <span>Instant Access</span>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        if (toggleBtn && passwordInput && passwordIcon) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                passwordIcon.classList.toggle('fa-eye', !isPassword);
                passwordIcon.classList.toggle('fa-eye-slash', isPassword);
            });
        }
    });
</script>
@endpush

