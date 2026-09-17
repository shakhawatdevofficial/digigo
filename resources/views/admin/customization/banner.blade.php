@extends('admin.layouts.adminpanel')

@section('title', 'Hero / Banner Customization - DigiGo')
@section('page_title', 'Homepage Banner Customization')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Header Summary Card -->
    <div class="bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1 px-3 py-1 mb-2 text-[10px] font-bold text-amber-600 dark:text-brand-yellow bg-amber-50 dark:bg-amber-950/50 border border-amber-200 dark:border-amber-900 rounded-full uppercase tracking-wider">
                <i class="fa-solid fa-palette text-[9px]"></i> Website Customization
            </span>
            <h1 class="text-xl font-extrabold text-zinc-900 dark:text-white">
                Homepage Hero / Banner Section
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Customize titles, subtitles, badges, search bar placeholder, and enable/disable the banner area.
            </p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white rounded-xl text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-eye text-xs"></i>
            <span>View Live Homepage</span>
        </a>
    </div>

    <!-- Customization Form -->
    <form action="{{ route('admin.customization.banner.update') }}" method="POST" class="bg-white dark:bg-brand-cardDark p-6 sm:p-8 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm space-y-6">
        @csrf

        <!-- Section 1: Banner Section Visibility -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Banner Section Status</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Show or hide the entire hero/banner area on the homepage.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="banner_status" value="1" {{ \App\Models\Setting::get('banner_status', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-zinc-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-yellow"></div>
                </label>
            </div>
        </div>

        <!-- Section 2: Banner Content Fields -->
        <div class="space-y-4">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Hero Titles & Content</h3>
            
            <!-- Badge Text -->
            <div>
                <label for="banner_badge" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Badge / Tagline Text
                </label>
                <input 
                    type="text" 
                    name="banner_badge" 
                    id="banner_badge" 
                    value="{{ old('banner_badge', \App\Models\Setting::get('banner_badge', 'ONE CLICK DIGITAL SOLUTION')) }}"
                    placeholder="ONE CLICK DIGITAL SOLUTION"
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                >
            </div>

            <!-- Title Line 1 & Line 2 Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label for="banner_title_1" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Main Title (First Line)
                    </label>
                    <input 
                        type="text" 
                        name="banner_title_1" 
                        id="banner_title_1" 
                        value="{{ old('banner_title_1', \App\Models\Setting::get('banner_title_1', 'Your Digital Products,')) }}"
                        placeholder="Your Digital Products,"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <div>
                    <label for="banner_title_2" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Main Title (Second Line / Italic Highlight)
                    </label>
                    <input 
                        type="text" 
                        name="banner_title_2" 
                        id="banner_title_2" 
                        value="{{ old('banner_title_2', \App\Models\Setting::get('banner_title_2', 'All in One Place.')) }}"
                        placeholder="All in One Place."
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="banner_description" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Subtitle / Paragraph Description
                </label>
                <textarea 
                    name="banner_description" 
                    id="banner_description" 
                    rows="3"
                    placeholder="DigiGo provides exclusive official digital product subscriptions with instant activation..."
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                >{{ old('banner_description', \App\Models\Setting::get('banner_description', 'DigiGo provides exclusive official digital product subscriptions with instant activation and 24/7 dedicated support.')) }}</textarea>
            </div>

            <!-- Search Bar Placeholder & Trust Footer -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 pt-2">
                <div>
                    <label for="banner_search_placeholder" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-solid fa-magnifying-glass text-amber-500 mr-1"></i> Search Box Placeholder
                    </label>
                    <input 
                        type="text" 
                        name="banner_search_placeholder" 
                        id="banner_search_placeholder" 
                        value="{{ old('banner_search_placeholder', \App\Models\Setting::get('banner_search_placeholder', 'Search Office 365, YouTube, Spotify...')) }}"
                        placeholder="Search Office 365, YouTube, Spotify..."
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <div>
                    <label for="banner_trusted_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-solid fa-shield-check text-amber-500 mr-1"></i> Bottom Trust / Counter Text
                    </label>
                    <input 
                        type="text" 
                        name="banner_trusted_text" 
                        id="banner_trusted_text" 
                        value="{{ old('banner_trusted_text', \App\Models\Setting::get('banner_trusted_text', 'TRUSTED BY OVER 50,000+ CUSTOMERS BANGLADESH WIDE')) }}"
                        placeholder="TRUSTED BY OVER 50,000+ CUSTOMERS BANGLADESH WIDE"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Save Banner Customization</span>
            </button>
        </div>
    </form>
</div>
@endsection

