@extends('admin.layouts.adminpanel')

@section('title', 'Top Navigation Customization - DigiGo')
@section('page_title', 'Top Nav & Header Customization')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Header Summary Card -->
    <div class="bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1 px-3 py-1 mb-2 text-[10px] font-bold text-amber-600 dark:text-brand-yellow bg-amber-50 dark:bg-amber-950/50 border border-amber-200 dark:border-amber-900 rounded-full uppercase tracking-wider">
                <i class="fa-solid fa-palette text-[9px]"></i> Website Customization
            </span>
            <h1 class="text-xl font-extrabold text-zinc-900 dark:text-white">
                Top Nav & Header Settings
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Customize the top notice bar, contact info, support text, and header action buttons.
            </p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white rounded-xl text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-eye text-xs"></i>
            <span>View Live Website</span>
        </a>
    </div>

    <!-- Customization Form -->
    <form action="{{ route('admin.customization.topnav.update') }}" method="POST" class="bg-white dark:bg-brand-cardDark p-6 sm:p-8 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm space-y-6">
        @csrf

        <!-- Section 1: Top Bar Visibility -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Top Notice Bar Status</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Show or hide the topmost black info bar across the entire website.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="topbar_status" value="1" {{ \App\Models\Setting::get('topbar_status', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-zinc-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-yellow"></div>
                </label>
            </div>
        </div>

        <!-- Section 2: Top Bar Content Fields -->
        <div>
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white mb-4">Top Bar Content & Contact Info</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <!-- Support Email -->
                <div>
                    <label for="topbar_email" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-solid fa-envelope text-amber-500 mr-1"></i> Support Email
                    </label>
                    <input 
                        type="text" 
                        name="topbar_email" 
                        id="topbar_email" 
                        value="{{ old('topbar_email', \App\Models\Setting::get('topbar_email', 'email@digigo.click')) }}"
                        placeholder="email@digigo.click"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <!-- Partner Badge Text -->
                <div>
                    <label for="topbar_partner_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-solid fa-shield-halved text-amber-500 mr-1"></i> Partner Badge Text
                    </label>
                    <input 
                        type="text" 
                        name="topbar_partner_text" 
                        id="topbar_partner_text" 
                        value="{{ old('topbar_partner_text', \App\Models\Setting::get('topbar_partner_text', 'Official Digital Partner')) }}"
                        placeholder="Official Digital Partner"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <!-- Delivery Feature Text -->
                <div>
                    <label for="topbar_delivery_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-solid fa-bolt text-amber-500 mr-1"></i> Delivery Feature Text
                    </label>
                    <input 
                        type="text" 
                        name="topbar_delivery_text" 
                        id="topbar_delivery_text" 
                        value="{{ old('topbar_delivery_text', \App\Models\Setting::get('topbar_delivery_text', 'Instant Delivery')) }}"
                        placeholder="Instant Delivery"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <!-- Support Time Text -->
                <div>
                    <label for="topbar_support_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-solid fa-headset text-amber-500 mr-1"></i> Support Availability Text
                    </label>
                    <input 
                        type="text" 
                        name="topbar_support_text" 
                        id="topbar_support_text" 
                        value="{{ old('topbar_support_text', \App\Models\Setting::get('topbar_support_text', '24/7 Live Support')) }}"
                        placeholder="24/7 Live Support"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>
            </div>
        </div>

        <!-- Section 3: Navbar Action Button -->
        <div class="pt-6 border-t border-cream-200 dark:border-brand-borderDark">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white mb-4">Header CTA Button</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <!-- CTA Button Text -->
                <div>
                    <label for="navbar_btn_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Button Label
                    </label>
                    <input 
                        type="text" 
                        name="navbar_btn_text" 
                        id="navbar_btn_text" 
                        value="{{ old('navbar_btn_text', \App\Models\Setting::get('navbar_btn_text', 'Get Started')) }}"
                        placeholder="Get Started"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <!-- CTA Button Link -->
                <div>
                    <label for="navbar_btn_link" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Button Link / URL
                    </label>
                    <input 
                        type="text" 
                        name="navbar_btn_link" 
                        id="navbar_btn_link" 
                        value="{{ old('navbar_btn_link', \App\Models\Setting::get('navbar_btn_link', '#products')) }}"
                        placeholder="#products or /register"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Save Customization</span>
            </button>
        </div>
    </form>
</div>
@endsection

