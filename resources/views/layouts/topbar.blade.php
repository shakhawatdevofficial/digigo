@if(\App\Models\Setting::get('topbar_status', '1') == '1')
<div class="bg-zinc-900 text-zinc-300 text-xs py-2 px-4 border-b border-zinc-800">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
        <div class="flex items-center gap-4">
            @if($email = \App\Models\Setting::get('topbar_email', 'email@digigo.click'))
                <span><i class="fa-solid fa-envelope text-brand-yellow mr-1"></i> {{ $email }}</span>
            @endif
            @if($partner = \App\Models\Setting::get('topbar_partner_text', 'Official Digital Partner'))
                <span><i class="fa-solid fa-shield-halved text-brand-yellow mr-1"></i> {{ $partner }}</span>
            @endif
        </div>
        <div class="flex items-center gap-4">
            @if($delivery = \App\Models\Setting::get('topbar_delivery_text', 'Instant Delivery'))
                <span><i class="fa-solid fa-bolt text-brand-yellow mr-1"></i> {{ $delivery }}</span>
            @endif
            @if($support = \App\Models\Setting::get('topbar_support_text', '24/7 Live Support'))
                <span class="hidden md:inline">|</span>
                <span class="hidden md:inline">{{ $support }}</span>
            @endif
        </div>
    </div>
</div>
@endif
