@extends('admin.layouts.adminpanel')

@section('title', 'Logo, Favicon & SEO Settings - DigiGo Admin')
@section('page_title', 'Logo, Favicon & SEO Settings')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Header Summary Card -->
    <div class="bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1 px-3 py-1 mb-2 text-[10px] font-bold text-amber-600 dark:text-brand-yellow bg-amber-50 dark:bg-amber-950/50 border border-amber-200 dark:border-amber-900 rounded-full uppercase tracking-wider">
                <i class="fa-solid fa-palette text-[9px]"></i> Website Customization
            </span>
            <h1 class="text-xl font-extrabold text-zinc-900 dark:text-white">
                Logo, Favicon & SEO Settings
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Upload brand logo, browser favicon, and optimize search engine meta tags and social share previews.
            </p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white rounded-xl text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-eye text-xs"></i>
            <span>View Live Website</span>
        </a>
    </div>

    <!-- Customization Form -->
    <form action="{{ route('admin.customization.seo.update') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-brand-cardDark p-6 sm:p-8 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm space-y-8">
        @csrf

        <!-- Section 1: Logo & Favicon Assets -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark space-y-6">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                <i class="fa-solid fa-gem text-amber-500"></i>
                <span>Brand Visual Assets</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- 1. Main Website Logo -->
                <div class="p-4 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark space-y-3">
                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300">
                        Main Website Logo <span class="text-amber-600 dark:text-brand-yellow">(Navbar & Mobile)</span>
                    </label>

                    <div class="h-16 p-2 rounded-xl bg-white dark:bg-zinc-800 border border-cream-200 dark:border-zinc-700 flex items-center justify-center">
                        @if(\App\Models\Setting::get('site_logo'))
                            <img src="{{ asset(\App\Models\Setting::get('site_logo')) }}" alt="Logo" class="max-h-12 max-w-full object-contain">
                        @else
                            <img src="{{ asset('assets/img/digigo-logo.png') }}" alt="DigiGo Logo" class="max-h-12 max-w-full object-contain">
                        @endif
                    </div>

                    <input 
                        type="file" 
                        name="site_logo" 
                        accept="image/*"
                        class="w-full text-xs text-zinc-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-semibold file:bg-cream-100 dark:file:bg-zinc-800 file:text-zinc-700 dark:file:text-zinc-300 hover:file:bg-amber-100 border border-cream-200 dark:border-brand-borderDark rounded-xl p-1 bg-white dark:bg-zinc-900"
                    >
                    <p class="text-[10px] text-zinc-400">PNG, SVG, JPG, WEBP (Max 2MB)</p>
                </div>

                <!-- 2. Browser Favicon -->
                <div class="p-4 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark space-y-3">
                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300">
                        Browser Tab Favicon <span class="text-amber-600 dark:text-brand-yellow">(16x16 / 32x32)</span>
                    </label>

                    <div class="h-16 p-2 rounded-xl bg-white dark:bg-zinc-800 border border-cream-200 dark:border-zinc-700 flex items-center justify-center">
                        @if(\App\Models\Setting::get('site_favicon'))
                            <img src="{{ asset(\App\Models\Setting::get('site_favicon')) }}" alt="Favicon" class="w-8 h-8 object-contain">
                        @else
                            <img src="{{ asset('assets/img/favicon.png') }}" alt="Favicon" class="w-8 h-8 object-contain">
                        @endif
                    </div>

                    <input 
                        type="file" 
                        name="site_favicon" 
                        accept=".ico,image/png,image/x-icon,image/svg+xml,image/webp,image/jpeg"
                        class="w-full text-xs text-zinc-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-semibold file:bg-cream-100 dark:file:bg-zinc-800 file:text-zinc-700 dark:file:text-zinc-300 hover:file:bg-amber-100 border border-cream-200 dark:border-brand-borderDark rounded-xl p-1 bg-white dark:bg-zinc-900"
                    >
                    <p class="text-[10px] text-zinc-400">ICO, PNG, SVG, WEBP (Max 1MB)</p>
                </div>

                <!-- 3. Social Share OG Image -->
                <div class="p-4 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark space-y-3">
                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300">
                        Social Share Preview <span class="text-amber-600 dark:text-brand-yellow">(OG Image)</span>
                    </label>

                    <div class="h-16 p-2 rounded-xl bg-white dark:bg-zinc-800 border border-cream-200 dark:border-zinc-700 flex items-center justify-center">
                        @if(\App\Models\Setting::get('meta_og_image'))
                            <img src="{{ asset(\App\Models\Setting::get('meta_og_image')) }}" alt="Social Share Preview" class="max-h-12 max-w-full object-contain">
                        @else
                            <div class="text-[11px] text-zinc-400 font-medium">Default Site Banner</div>
                        @endif
                    </div>

                    <input 
                        type="file" 
                        name="meta_og_image" 
                        accept="image/*"
                        class="w-full text-xs text-zinc-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-semibold file:bg-cream-100 dark:file:bg-zinc-800 file:text-zinc-700 dark:file:text-zinc-300 hover:file:bg-amber-100 border border-cream-200 dark:border-brand-borderDark rounded-xl p-1 bg-white dark:bg-zinc-900"
                    >
                    <p class="text-[10px] text-zinc-400">1200x630 px recommended (Max 2MB)</p>
                </div>
            </div>
        </div>

        <!-- Section 2: SEO Meta Tags -->
        <div class="space-y-6">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass-chart text-amber-500"></i>
                <span>Search Engine Optimization (SEO) Meta Tags</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <!-- Meta Title -->
                <div>
                    <label for="meta_title" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Default Meta Page Title <span class="text-zinc-400 text-[10px] font-normal">(Shown on browser tab & Google)</span>
                    </label>
                    <input 
                        type="text" 
                        name="meta_title" 
                        id="meta_title" 
                        value="{{ old('meta_title', \App\Models\Setting::get('meta_title', 'DigiGo - Modern Digital Shop Bangladesh')) }}"
                        placeholder="DigiGo - Modern Digital Shop Bangladesh"
                        oninput="updateGooglePreview()"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <!-- Meta Author / Brand Name -->
                <div>
                    <label for="meta_author" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Meta Author / Brand Name
                    </label>
                    <input 
                        type="text" 
                        name="meta_author" 
                        id="meta_author" 
                        value="{{ old('meta_author', \App\Models\Setting::get('meta_author', 'DigiGo Bangladesh')) }}"
                        placeholder="DigiGo Bangladesh"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>
            </div>

            <!-- Meta Keywords -->
            <div>
                <label for="meta_keywords" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Meta Keywords <span class="text-zinc-400 text-[10px] font-normal">(Comma separated)</span>
                </label>
                <input 
                    type="text" 
                    name="meta_keywords" 
                    id="meta_keywords" 
                    value="{{ old('meta_keywords', \App\Models\Setting::get('meta_keywords', 'digital subscriptions, ott accounts, software license, cloud services, bKash digital shop')) }}"
                    placeholder="digital subscriptions, ott accounts, software license, cloud services"
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                >
            </div>

            <!-- Meta Description -->
            <div>
                <label for="meta_description" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Meta Description <span class="text-zinc-400 text-[10px] font-normal">(Search results snippet)</span>
                </label>
                <textarea 
                    name="meta_description" 
                    id="meta_description" 
                    rows="3" 
                    oninput="updateGooglePreview()"
                    placeholder="DigiGo provides exclusive official digital products subscription with seamless experience."
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors leading-relaxed"
                >{{ old('meta_description', \App\Models\Setting::get('meta_description', 'DigiGo provides exclusive official digital products subscription with seamless experience.')) }}</textarea>
            </div>

            <!-- Live Google Snippet Preview -->
            <div class="p-5 rounded-2xl bg-cream-50 dark:bg-zinc-900/80 border border-cream-200 dark:border-brand-borderDark space-y-2">
                <div class="flex items-center gap-2 text-zinc-400 text-[11px] font-bold uppercase tracking-wider">
                    <i class="fa-brands fa-google text-blue-500"></i>
                    <span>Live Search Engine Preview</span>
                </div>
                <div class="space-y-1">
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 truncate">{{ url('/') }}</p>
                    <h4 id="previewTitle" class="text-sm font-bold text-blue-600 dark:text-blue-400 hover:underline cursor-pointer">
                        {{ \App\Models\Setting::get('meta_title', 'DigiGo - Modern Digital Shop Bangladesh') }}
                    </h4>
                    <p id="previewDesc" class="text-xs text-zinc-600 dark:text-zinc-300 line-clamp-2 leading-relaxed">
                        {{ \App\Models\Setting::get('meta_description', 'DigiGo provides exclusive official digital products subscription with seamless experience.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-cream-200 dark:border-brand-borderDark flex items-center justify-between">
            <p class="text-[11px] text-zinc-400">Settings will apply immediately to public website header and search engines.</p>
            <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Save Logo, Favicon & SEO</span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    function updateGooglePreview() {
        const titleInput = document.getElementById('meta_title');
        const descInput = document.getElementById('meta_description');
        const previewTitle = document.getElementById('previewTitle');
        const previewDesc = document.getElementById('previewDesc');

        if (titleInput && previewTitle) {
            previewTitle.innerText = titleInput.value || 'DigiGo - Modern Digital Shop';
        }
        if (descInput && previewDesc) {
            previewDesc.innerText = descInput.value || 'DigiGo provides exclusive official digital products subscription with seamless experience.';
        }
    }
</script>
@endpush

