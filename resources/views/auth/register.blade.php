@extends('layouts.website')

@section('title', 'Register - DigiGo')

@section('content')
<section class="min-h-[calc(100vh-200px)] py-12 lg:py-20 flex items-center justify-center relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-brand-yellow/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-md w-full mx-auto px-4 sm:px-6 relative z-10" data-aos="fade-up">
        <!-- Card Container -->
        <div class="bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-xl p-6 sm:p-8 transition-colors">
            
            <!-- Header & Badge -->
            <div class="text-center mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 dark:text-white tracking-tight">
                    Create an Account
                </h1>
                <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 mt-2">
                    Join DigiGo to get instant access to premium digital products
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

            <!-- Register Form -->
            <form action="{{ route('store') }}" method="POST" class="space-y-4" novalidate>
                @csrf

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                            <i class="fa-solid fa-user text-xs"></i>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}" 
                            placeholder="John Doe" 
                            required 
                            autofocus
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('name') border-red-500 dark:border-red-500 focus:border-red-500 @else border-cream-200 dark:border-brand-borderDark focus:border-brand-yellow @enderror rounded-xl pl-10 pr-3.5 py-3 text-xs outline-none font-sans text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 transition-colors"
                        >
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

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
                    <label for="password" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Minimum 8 characters" 
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

                <!-- Confirm Password Input -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                            <i class="fa-solid fa-shield-halved text-xs"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            placeholder="Re-type your password" 
                            required
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('password_confirmation') border-red-500 dark:border-red-500 focus:border-red-500 @else border-cream-200 dark:border-brand-borderDark focus:border-brand-yellow @enderror rounded-xl pl-10 pr-10 py-3 text-xs outline-none font-sans text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 transition-colors"
                        >
                        <button 
                            type="button" 
                            id="toggleConfirmPassword" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 cursor-pointer focus:outline-none"
                            aria-label="Toggle confirm password visibility"
                        >
                            <i class="fa-solid fa-eye text-xs" id="confirmPasswordIcon"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Terms & Conditions Note -->
                <div class="pt-1">
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 leading-relaxed">
                        By creating an account, you agree to our 
                        <a href="{{ route('terms') }}" class="font-semibold text-zinc-800 dark:text-zinc-200 hover:underline">Terms of Service</a> 
                        and 
                        <a href="{{ route('privacy') }}" class="font-semibold text-zinc-800 dark:text-zinc-200 hover:underline">Privacy Policy</a>.
                    </p>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full mt-2 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold py-3 px-4 rounded-xl text-xs transition-all duration-200 flex items-center justify-center gap-2 shadow-sm hover:shadow active:scale-[0.99] cursor-pointer"
                >
                    <span>Create Account</span>
                    <i class="fa-solid fa-user-plus text-xs"></i>
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-cream-200 dark:border-brand-borderDark"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-3 bg-white dark:bg-brand-cardDark text-zinc-400 font-medium">
                        Already registered?
                    </span>
                </div>
            </div>

            <!-- Sign In Link -->
            <div class="text-center">
                <p class="text-xs text-zinc-600 dark:text-zinc-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-bold text-zinc-900 dark:text-brand-yellow hover:underline ml-1">
                        Sign in
                    </a>
                </p>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-xs text-zinc-500 dark:text-zinc-500">
            <div class="flex items-center gap-1.5">
                <i class="fa-solid fa-shield-halved text-brand-yellow"></i>
                <span>Official Partner Guarantee</span>
            </div>
            <div class="flex items-center gap-1.5">
                <i class="fa-solid fa-headset text-brand-yellow"></i>
                <span>24/7 Dedicated Support</span>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function setupPasswordToggle(buttonId, inputId, iconId) {
            const toggleBtn = document.getElementById(buttonId);
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (toggleBtn && input && icon) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    icon.classList.toggle('fa-eye', !isPassword);
                    icon.classList.toggle('fa-eye-slash', isPassword);
                });
            }
        }

        setupPasswordToggle('togglePassword', 'password', 'passwordIcon');
        setupPasswordToggle('toggleConfirmPassword', 'password_confirmation', 'confirmPasswordIcon');
    });
</script>
@endpush

