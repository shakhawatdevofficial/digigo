@extends('admin.layouts.adminpanel')

@section('title', 'CTA Customization - DigiGo')
@section('page_title', 'Call to Action (CTA) Customization')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Header Summary Card -->
    <div class="bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1 px-3 py-1 mb-2 text-[10px] font-bold text-amber-600 dark:text-brand-yellow bg-amber-50 dark:bg-amber-950/50 border border-amber-200 dark:border-amber-900 rounded-full uppercase tracking-wider">
                <i class="fa-solid fa-palette text-[9px]"></i> Website Customization
            </span>
            <h1 class="text-xl font-extrabold text-zinc-900 dark:text-white">
                Homepage Call to Action (CTA) Section
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Customize titles, description, buttons, and enable/disable the bottom CTA section.
            </p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white rounded-xl text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-eye text-xs"></i>
            <span>View Live Website</span>
        </a>
    </div>

    <!-- Customization Form -->
    <form action="{{ route('admin.customization.cta.update') }}" method="POST" class="bg-white dark:bg-brand-cardDark p-6 sm:p-8 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm space-y-6">
        @csrf

        <!-- Section 1: CTA Section Visibility -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">CTA Section Status</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Show or hide the Call to Action section on the homepage.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="cta_status" value="1" {{ \App\Models\Setting::get('cta_status', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-zinc-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-yellow"></div>
                </label>
            </div>
        </div>

        <!-- Section 2: CTA Content Fields -->
        <div class="space-y-4">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white">CTA Headings & Content</h3>
            
            <!-- Badge Text -->
            <div>
                <label for="cta_badge" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Tagline / Badge Text
                </label>
                <input 
                    type="text" 
                    name="cta_badge" 
                    id="cta_badge" 
                    value="{{ old('cta_badge', \App\Models\Setting::get('cta_badge', 'Instant Access')) }}"
                    placeholder="Instant Access"
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                >
            </div>

            <!-- Title -->
            <div>
                <label for="cta_title" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Main Title / Headline
                </label>
                <input 
                    type="text" 
                    name="cta_title" 
                    id="cta_title" 
                    value="{{ old('cta_title', \App\Models\Setting::get('cta_title', 'Ready to Upgrade Your Digital Experience?')) }}"
                    placeholder="Ready to Upgrade Your Digital Experience?"
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                >
            </div>

            <!-- Description -->
            <div>
                <label for="cta_description" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Subtitle / Paragraph Description
                </label>
                <textarea 
                    name="cta_description" 
                    id="cta_description" 
                    rows="3"
                    placeholder="Get instant delivery on all premium accounts with 100% official validity and 24/7 support."
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                >{{ old('cta_description', \App\Models\Setting::get('cta_description', 'Get instant delivery on all premium accounts with 100% official validity and 24/7 support.')) }}</textarea>
            </div>
        </div>

        <!-- Section 3: CTA Buttons -->
        <div class="pt-6 border-t border-cream-200 dark:border-brand-borderDark space-y-4">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white">CTA Action Buttons</h3>

            <!-- Primary Button (Yellow) -->
            <div class="p-4 rounded-2xl bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark">
                <h4 class="text-xs font-bold text-amber-600 dark:text-brand-yellow uppercase tracking-wider mb-3">Primary Button (Explore Shop)</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="cta_btn_primary_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Button Text
                        </label>
                        <input 
                            type="text" 
                            name="cta_btn_primary_text" 
                            id="cta_btn_primary_text" 
                            value="{{ old('cta_btn_primary_text', \App\Models\Setting::get('cta_btn_primary_text', 'Explore Shop')) }}"
                            placeholder="Explore Shop"
                            class="w-full bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                    </div>
                    <div>
                        <label for="cta_btn_primary_link" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Button Link / URL
                        </label>
                        <input 
                            type="text" 
                            name="cta_btn_primary_link" 
                            id="cta_btn_primary_link" 
                            value="{{ old('cta_btn_primary_link', \App\Models\Setting::get('cta_btn_primary_link', '#products')) }}"
                            placeholder="#products or custom URL"
                            class="w-full bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                    </div>
                </div>
            </div>

            <!-- Secondary Button (WhatsApp / Contact) -->
            <div class="p-4 rounded-2xl bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark">
                <h4 class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mb-3">Secondary Button (Contact Us)</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="cta_btn_secondary_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Button Text
                        </label>
                        <input 
                            type="text" 
                            name="cta_btn_secondary_text" 
                            id="cta_btn_secondary_text" 
                            value="{{ old('cta_btn_secondary_text', \App\Models\Setting::get('cta_btn_secondary_text', 'Contact Us')) }}"
                            placeholder="Contact Us"
                            class="w-full bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                    </div>
                    <div>
                        <label for="cta_btn_secondary_link" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Button Link / URL
                        </label>
                        <input 
                            type="text" 
                            name="cta_btn_secondary_link" 
                            id="cta_btn_secondary_link" 
                            value="{{ old('cta_btn_secondary_link', \App\Models\Setting::get('cta_btn_secondary_link', '#contact')) }}"
                            placeholder="#contact or https://wa.me/..."
                            class="w-full bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 flex justify-end">
            <button type="submit" class="px-8 py-3 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Save CTA Customization</span>
            </button>
        </div>
    </form>
</div>
@endsection

