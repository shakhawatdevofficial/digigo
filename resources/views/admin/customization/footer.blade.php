@extends('admin.layouts.adminpanel')

@section('title', 'Footer & Logo Customization - DigiGo Admin')
@section('page_title', 'Footer & Logo Customization')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Header Summary Card -->
    <div class="bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1 px-3 py-1 mb-2 text-[10px] font-bold text-amber-600 dark:text-brand-yellow bg-amber-50 dark:bg-amber-950/50 border border-amber-200 dark:border-amber-900 rounded-full uppercase tracking-wider">
                <i class="fa-solid fa-palette text-[9px]"></i> Website Customization
            </span>
            <h1 class="text-xl font-extrabold text-zinc-900 dark:text-white">
                Footer & Logo Branding Settings
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Customize website logo, footer descriptions, social links, payment icons, and copyright details.
            </p>
        </div>
        <a href="{{ route('home') }}#about" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white rounded-xl text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-eye text-xs"></i>
            <span>View Live Footer</span>
        </a>
    </div>

    <!-- Customization Form -->
    <form action="{{ route('admin.customization.footer.update') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-brand-cardDark p-6 sm:p-8 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm space-y-6">
        @csrf

        <!-- Section 1: Footer Visibility Toggle -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Footer Section Status</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Enable or disable footer display on the website.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="footer_status" value="1" {{ \App\Models\Setting::get('footer_status', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-zinc-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-yellow"></div>
                </label>
            </div>
        </div>

        <!-- Section 2: Logo & Brand Identity -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark space-y-4">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                <i class="fa-solid fa-gem text-amber-500"></i>
                <span>Brand Logo & About Description</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                <!-- Website Logo -->
                <div>
                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2">
                        Website Logo (Navbar & Footer)
                    </label>

                    <div class="flex items-center gap-4 mb-3 p-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark">
                        <div class="h-12 w-auto min-w-[50px] p-2 rounded-xl bg-white dark:bg-zinc-800 border border-cream-200 dark:border-zinc-700 flex items-center justify-center">
                            @if(\App\Models\Setting::get('site_logo'))
                                <img src="{{ asset(\App\Models\Setting::get('site_logo')) }}" alt="Logo" class="max-h-8 max-w-[120px] object-contain">
                            @else
                                <img src="{{ asset('assets/img/digigo-logo.png') }}" alt="DigiGo Logo" class="max-h-8 max-w-[120px] object-contain">
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Current Logo</p>
                            <p class="text-[10px] text-zinc-400">PNG, JPG, WEBP, or SVG (Max 2MB)</p>
                        </div>
                    </div>

                    <input 
                        type="file" 
                        name="site_logo" 
                        accept="image/*"
                        class="w-full text-xs text-zinc-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cream-100 dark:file:bg-zinc-800 file:text-zinc-700 dark:file:text-zinc-300 hover:file:bg-amber-100 border border-cream-200 dark:border-brand-borderDark rounded-xl p-1 bg-cream-50 dark:bg-zinc-900"
                    >
                    @error('site_logo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer Description -->
                <div>
                    <label for="footer_description" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Footer Tagline / Short Description
                    </label>
                    <textarea 
                        name="footer_description" 
                        id="footer_description" 
                        rows="4" 
                        placeholder="DigiGo.click provides exclusive official digital products subscription with seamless experience."
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors leading-relaxed"
                    >{{ old('footer_description', \App\Models\Setting::get('footer_description', 'DigiGo.click provides exclusive official digital products subscription with seamless experience.')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Section 3: Social Media Links -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark space-y-4">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                <i class="fa-solid fa-share-nodes text-amber-500"></i>
                <span>Social Media Profiles</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Facebook -->
                <div>
                    <label for="footer_facebook_url" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-brands fa-facebook text-blue-600 mr-1"></i> Facebook URL
                    </label>
                    <input 
                        type="text" 
                        name="footer_facebook_url" 
                        id="footer_facebook_url" 
                        value="{{ old('footer_facebook_url', \App\Models\Setting::get('footer_facebook_url', '#')) }}"
                        placeholder="https://facebook.com/yourpage"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <!-- Twitter / X -->
                <div>
                    <label for="footer_twitter_url" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-brands fa-twitter text-sky-500 mr-1"></i> Twitter / X URL
                    </label>
                    <input 
                        type="text" 
                        name="footer_twitter_url" 
                        id="footer_twitter_url" 
                        value="{{ old('footer_twitter_url', \App\Models\Setting::get('footer_twitter_url', '#')) }}"
                        placeholder="https://twitter.com/yourhandle"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <!-- Instagram -->
                <div>
                    <label for="footer_instagram_url" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-brands fa-instagram text-pink-500 mr-1"></i> Instagram URL
                    </label>
                    <input 
                        type="text" 
                        name="footer_instagram_url" 
                        id="footer_instagram_url" 
                        value="{{ old('footer_instagram_url', \App\Models\Setting::get('footer_instagram_url', '#')) }}"
                        placeholder="https://instagram.com/yourhandle"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <!-- YouTube -->
                <div>
                    <label for="footer_youtube_url" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-brands fa-youtube text-red-600 mr-1"></i> YouTube URL
                    </label>
                    <input 
                        type="text" 
                        name="footer_youtube_url" 
                        id="footer_youtube_url" 
                        value="{{ old('footer_youtube_url', \App\Models\Setting::get('footer_youtube_url')) }}"
                        placeholder="https://youtube.com/@channel"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <!-- WhatsApp Support Link -->
                <div>
                    <label for="footer_whatsapp_url" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        <i class="fa-brands fa-whatsapp text-emerald-500 mr-1"></i> WhatsApp URL / Number
                    </label>
                    <input 
                        type="text" 
                        name="footer_whatsapp_url" 
                        id="footer_whatsapp_url" 
                        value="{{ old('footer_whatsapp_url', \App\Models\Setting::get('footer_whatsapp_url', 'https://wa.me/8801700000000')) }}"
                        placeholder="https://wa.me/8801700000000"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>
            </div>
        </div>

        <!-- Section 4: Secured Payment Gateways Box -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark space-y-4">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                <i class="fa-solid fa-credit-card text-amber-500"></i>
                <span>Secured Payments Box</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
                <div class="space-y-4">
                    <div>
                        <label for="footer_payment_title" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Payment Section Title
                        </label>
                        <input 
                            type="text" 
                            name="footer_payment_title" 
                            id="footer_payment_title" 
                            value="{{ old('footer_payment_title', \App\Models\Setting::get('footer_payment_title', 'Secured Payments')) }}"
                            placeholder="Secured Payments"
                            class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                        >
                    </div>

                    <div>
                        <label for="footer_payment_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                            Payment Section Subtitle / Notice
                        </label>
                        <input 
                            type="text" 
                            name="footer_payment_text" 
                            id="footer_payment_text" 
                            value="{{ old('footer_payment_text', \App\Models\Setting::get('footer_payment_text', 'We accept all major national cards & mobile wallets.')) }}"
                            placeholder="We accept all major national cards & mobile wallets."
                            class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                        >
                    </div>
                </div>

                <!-- Payment Methods Image Upload -->
                <div>
                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2">
                        Payment Methods Banner / Gateway Logos
                    </label>

                    <div class="flex items-center gap-4 mb-3 p-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark">
                        <div class="h-10 p-1.5 rounded-xl bg-white dark:bg-zinc-800 border border-cream-200 dark:border-zinc-700 flex items-center justify-center">
                            @if(\App\Models\Setting::get('footer_payment_image'))
                                <img src="{{ asset(\App\Models\Setting::get('footer_payment_image')) }}" alt="Payment Methods" class="max-h-7 object-contain">
                            @else
                                <img src="{{ asset('assets/img/payment-method.png') }}" alt="Payment Methods" class="max-h-7 object-contain">
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Current Payment Banner</p>
                            <p class="text-[10px] text-zinc-400">Upload custom gateways image if needed</p>
                        </div>
                    </div>

                    <input 
                        type="file" 
                        name="footer_payment_image" 
                        accept="image/*"
                        class="w-full text-xs text-zinc-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cream-100 dark:file:bg-zinc-800 file:text-zinc-700 dark:file:text-zinc-300 hover:file:bg-amber-100 border border-cream-200 dark:border-brand-borderDark rounded-xl p-1 bg-cream-50 dark:bg-zinc-900"
                    >
                    @error('footer_payment_image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 5: Bottom Copyright & Partner Badge -->
        <div class="space-y-4">
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white flex items-center gap-2">
                <i class="fa-solid fa-copyright text-amber-500"></i>
                <span>Bottom Bar & Copyright</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Copyright Text -->
                <div>
                    <label for="footer_copyright_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Copyright Notice Text
                    </label>
                    <input 
                        type="text" 
                        name="footer_copyright_text" 
                        id="footer_copyright_text" 
                        value="{{ old('footer_copyright_text', \App\Models\Setting::get('footer_copyright_text', '©2026 DigiGo Bangladesh, All Rights Reserved.')) }}"
                        placeholder="©2026 DigiGo Bangladesh, All Rights Reserved."
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <!-- Partner Badge Text -->
                <div>
                    <label for="footer_partner_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Partner Badge / Slogan Text
                    </label>
                    <input 
                        type="text" 
                        name="footer_partner_text" 
                        id="footer_partner_text" 
                        value="{{ old('footer_partner_text', \App\Models\Setting::get('footer_partner_text', 'GLOBAL OTT BRAND DIGITAL PARTNER')) }}"
                        placeholder="GLOBAL OTT BRAND DIGITAL PARTNER"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-cream-200 dark:border-brand-borderDark flex items-center justify-between">
            <p class="text-[11px] text-zinc-400">Changes will reflect instantly on the public website footer.</p>
            <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Save Footer Settings</span>
            </button>
        </div>
    </form>
</div>
@endsection
