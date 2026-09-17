@extends('admin.layouts.adminpanel')

@section('title', 'Contact Us & Location Customization - DigiGo Admin')
@section('page_title', 'Contact Information Customization')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Header Summary Card -->
    <div class="bg-white dark:bg-brand-cardDark p-6 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="inline-flex items-center gap-1 px-3 py-1 mb-2 text-[10px] font-bold text-amber-600 dark:text-brand-yellow bg-amber-50 dark:bg-amber-950/50 border border-amber-200 dark:border-amber-900 rounded-full uppercase tracking-wider">
                <i class="fa-solid fa-palette text-[9px]"></i> Website Customization
            </span>
            <h1 class="text-xl font-extrabold text-zinc-900 dark:text-white">
                Contact Section & Location Settings
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Customize contact information cards: official email, WhatsApp support number, and office location address.
            </p>
        </div>
        <a href="{{ route('home') }}#contact" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-cream-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white rounded-xl text-xs font-semibold transition-colors shrink-0">
            <i class="fa-solid fa-eye text-xs"></i>
            <span>View Live Section</span>
        </a>
    </div>

    <!-- Customization Form -->
    <form action="{{ route('admin.customization.contact.update') }}" method="POST" class="bg-white dark:bg-brand-cardDark p-6 sm:p-8 rounded-3xl border border-cream-200 dark:border-brand-borderDark shadow-sm space-y-6">
        @csrf

        <!-- Section 1: Visibility & Heading -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Contact Section Status</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Show or hide the contact section on the homepage.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="contact_status" value="1" {{ \App\Models\Setting::get('contact_status', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-zinc-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-yellow"></div>
                </label>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label for="contact_badge" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Section Badge Text
                    </label>
                    <input 
                        type="text" 
                        name="contact_badge" 
                        id="contact_badge" 
                        value="{{ old('contact_badge', \App\Models\Setting::get('contact_badge', 'Get In Touch')) }}"
                        placeholder="Get In Touch"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_title" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Section Heading Title
                    </label>
                    <input 
                        type="text" 
                        name="contact_title" 
                        id="contact_title" 
                        value="{{ old('contact_title', \App\Models\Setting::get('contact_title', 'Contact Us')) }}"
                        placeholder="Contact Us"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                </div>
            </div>

            <div>
                <label for="contact_description" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Section Subtitle / Description
                </label>
                <input 
                    type="text" 
                    name="contact_description" 
                    id="contact_description" 
                    value="{{ old('contact_description', \App\Models\Setting::get('contact_description', 'Have a question or need a custom digital subscription? Reach out to us anytime.')) }}"
                    placeholder="Have a question or need a custom digital subscription? Reach out to us anytime."
                    class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                >
            </div>
        </div>

        <!-- Section 2: Info Card 1 - Email Us -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark space-y-4">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Email Us Card</h3>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Official contact email shown on info card</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="contact_email_title" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Card Title
                    </label>
                    <input 
                        type="text" 
                        name="contact_email_title" 
                        id="contact_email_title" 
                        value="{{ old('contact_email_title', \App\Models\Setting::get('contact_email_title', 'Email Us')) }}"
                        placeholder="Email Us"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_email_subtitle" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Subtitle Text
                    </label>
                    <input 
                        type="text" 
                        name="contact_email_subtitle" 
                        id="contact_email_subtitle" 
                        value="{{ old('contact_email_subtitle', \App\Models\Setting::get('contact_email_subtitle', 'Send us an email for general inquiries.')) }}"
                        placeholder="Send us an email for general inquiries."
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_email" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        name="contact_email" 
                        id="contact_email" 
                        value="{{ old('contact_email', \App\Models\Setting::get('contact_email', 'email@digigo.click')) }}"
                        placeholder="email@digigo.click"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>
            </div>
        </div>

        <!-- Section 3: Info Card 2 - WhatsApp Support -->
        <div class="pb-6 border-b border-cream-200 dark:border-brand-borderDark space-y-4">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-sm">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">WhatsApp Support Card</h3>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Direct WhatsApp support number & link</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="contact_whatsapp_title" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Card Title
                    </label>
                    <input 
                        type="text" 
                        name="contact_whatsapp_title" 
                        id="contact_whatsapp_title" 
                        value="{{ old('contact_whatsapp_title', \App\Models\Setting::get('contact_whatsapp_title', 'WhatsApp Support')) }}"
                        placeholder="WhatsApp Support"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_whatsapp_subtitle" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Subtitle Text
                    </label>
                    <input 
                        type="text" 
                        name="contact_whatsapp_subtitle" 
                        id="contact_whatsapp_subtitle" 
                        value="{{ old('contact_whatsapp_subtitle', \App\Models\Setting::get('contact_whatsapp_subtitle', 'Fastest response for instant order help.')) }}"
                        placeholder="Fastest response for instant order help."
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_whatsapp_number" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Display Number
                    </label>
                    <input 
                        type="text" 
                        name="contact_whatsapp_number" 
                        id="contact_whatsapp_number" 
                        value="{{ old('contact_whatsapp_number', \App\Models\Setting::get('contact_whatsapp_number', '+880 1700-000000')) }}"
                        placeholder="+880 1700-000000"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_whatsapp_url" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        WhatsApp Link URL
                    </label>
                    <input 
                        type="text" 
                        name="contact_whatsapp_url" 
                        id="contact_whatsapp_url" 
                        value="{{ old('contact_whatsapp_url', \App\Models\Setting::get('contact_whatsapp_url', 'https://wa.me/8801700000000')) }}"
                        placeholder="https://wa.me/8801700000000"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>
            </div>
        </div>

        <!-- Section 4: Info Card 3 - Office Location -->
        <div class="pb-2 space-y-4">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Office Location Card</h3>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Physical address or support desk information</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="contact_location_title" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Card Title
                    </label>
                    <input 
                        type="text" 
                        name="contact_location_title" 
                        id="contact_location_title" 
                        value="{{ old('contact_location_title', \App\Models\Setting::get('contact_location_title', 'Office Location')) }}"
                        placeholder="Office Location"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_location_address" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Address Text
                    </label>
                    <input 
                        type="text" 
                        name="contact_location_address" 
                        id="contact_location_address" 
                        value="{{ old('contact_location_address', \App\Models\Setting::get('contact_location_address', 'Gulshan-1, Dhaka, Bangladesh.')) }}"
                        placeholder="Gulshan-1, Dhaka, Bangladesh."
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_location_btn_text" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Button / Link Text
                    </label>
                    <input 
                        type="text" 
                        name="contact_location_btn_text" 
                        id="contact_location_btn_text" 
                        value="{{ old('contact_location_btn_text', \App\Models\Setting::get('contact_location_btn_text', 'Visit Support Desk')) }}"
                        placeholder="Visit Support Desk"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>

                <div>
                    <label for="contact_location_btn_link" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Button Link URL
                    </label>
                    <input 
                        type="text" 
                        name="contact_location_btn_link" 
                        id="contact_location_btn_link" 
                        value="{{ old('contact_location_btn_link', \App\Models\Setting::get('contact_location_btn_link', '#')) }}"
                        placeholder="https://maps.google.com/..."
                        class="w-full bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow transition-colors"
                    >
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 border-t border-cream-200 dark:border-brand-borderDark flex items-center justify-between">
            <p class="text-[11px] text-zinc-400">Updates will reflect immediately on the Contact Us section.</p>
            <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 font-bold rounded-xl text-xs hover:bg-zinc-800 dark:hover:bg-brand-hover transition-colors shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Save Contact Settings</span>
            </button>
        </div>
    </form>
</div>
@endsection

