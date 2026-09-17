@extends('user.layouts.userpanel')

@section('title', 'User Dashboard - DigiGo')
@section('page_title', 'Overview')

@section('content')
<div class="space-y-6">
    <!-- 1. Welcome Banner -->
    <div class="bg-gradient-to-r from-zinc-900 via-brand-dark to-zinc-900 rounded-3xl p-6 sm:p-8 text-white relative overflow-hidden border border-cream-200/20 dark:border-brand-borderDark shadow-lg">
        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-brand-yellow/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 mb-3 text-[11px] font-bold tracking-wider text-brand-yellow bg-brand-yellow/10 border border-brand-yellow/30 rounded-full">
                    <i class="fa-solid fa-sparkles text-[10px]"></i> OFFICIAL PARTNER ACCESS
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Welcome back, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-xs sm:text-sm text-zinc-400 mt-2 max-w-xl">
                    Manage your active subscriptions, view product license keys, and explore exclusive member deals.
                </p>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('home') }}#products" target="_blank" class="px-5 py-2.5 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-all shadow-md flex items-center gap-2">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span>Browse Products</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white dark:bg-brand-cardDark p-5 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Active Services</p>
                <h3 class="text-2xl font-black text-zinc-900 dark:text-white mt-1">3</h3>
                <span class="text-[11px] text-emerald-500 font-medium flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-check-double text-[10px]"></i> 100% Operational
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-brand-yellow flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white dark:bg-brand-cardDark p-5 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Wallet Balance</p>
                <h3 class="text-2xl font-black text-zinc-900 dark:text-white mt-1">৳0.00</h3>
                <span class="text-[11px] text-amber-600 dark:text-brand-yellow font-medium flex items-center gap-1 mt-1 cursor-pointer hover:underline">
                    <i class="fa-solid fa-plus-circle text-[10px]"></i> Top-up balance
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/40 text-blue-500 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white dark:bg-brand-cardDark p-5 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Total Orders</p>
                <h3 class="text-2xl font-black text-zinc-900 dark:text-white mt-1">4</h3>
                <span class="text-[11px] text-zinc-400 font-medium flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-clock-rotate-left text-[10px]"></i> Lifetime purchases
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-950/40 text-purple-500 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-bag-shopping"></i>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white dark:bg-brand-cardDark p-5 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Support Desk</p>
                <h3 class="text-2xl font-black text-zinc-900 dark:text-white mt-1">0 Open</h3>
                <span class="text-[11px] text-emerald-500 font-medium flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-circle text-[8px]"></i> 24/7 Agent Online
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-500 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-headset"></i>
            </div>
        </div>
    </div>

    <!-- 3. Active Subscriptions & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Subscriptions Table (2 Cols) -->
        <div class="lg:col-span-2 bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm p-5 sm:p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-cream-200 dark:border-brand-borderDark">
                <div>
                    <h3 class="font-bold text-sm text-zinc-900 dark:text-white">Active Digital Licenses</h3>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Official digital product subscriptions assigned to you</p>
                </div>
                <button type="button" class="text-xs font-semibold text-amber-600 dark:text-brand-yellow hover:underline">View All</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-zinc-400 border-b border-cream-100 dark:border-zinc-800">
                            <th class="pb-3 font-semibold">Product</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold">Renewal</th>
                            <th class="pb-3 font-semibold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-100 dark:divide-zinc-800 text-zinc-700 dark:text-zinc-300">
                        <tr>
                            <td class="py-3 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-950 text-blue-600 dark:text-blue-400 flex items-center justify-center text-sm font-bold">
                                    <i class="fa-brands fa-microsoft"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-zinc-900 dark:text-white block">Office 365 Personal</span>
                                    <span class="text-[10px] text-zinc-400">1 TB Cloud Storage</span>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400">Active</span>
                            </td>
                            <td class="py-3 text-[11px]">Dec 31, 2026</td>
                            <td class="py-3 text-right">
                                <button type="button" class="px-3 py-1 text-[11px] font-semibold text-zinc-900 bg-brand-yellow hover:bg-brand-hover rounded-lg transition-colors">
                                    View Key
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-950 text-red-600 dark:text-red-400 flex items-center justify-center text-sm font-bold">
                                    <i class="fa-brands fa-youtube"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-zinc-900 dark:text-white block">YouTube Premium</span>
                                    <span class="text-[10px] text-zinc-400">Family Slot Plan</span>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400">Active</span>
                            </td>
                            <td class="py-3 text-[11px]">Nov 15, 2026</td>
                            <td class="py-3 text-right">
                                <button type="button" class="px-3 py-1 text-[11px] font-semibold text-zinc-900 bg-brand-yellow hover:bg-brand-hover rounded-lg transition-colors">
                                    Manage
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Help & Account Summary (1 Col) -->
        <div class="bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm p-5 sm:p-6 flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-sm text-zinc-900 dark:text-white mb-1">Instant Support</h3>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mb-4">Have an issue with your license activation? We are here 24/7.</p>
                
                <div class="space-y-3">
                    <div class="p-3 rounded-xl bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-sm">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <span class="text-[11px] text-zinc-400 block">WhatsApp Desk</span>
                            <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200">+880 1700-000000</span>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-950 text-amber-600 dark:text-brand-yellow flex items-center justify-center text-sm">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <span class="text-[11px] text-zinc-400 block">Official Email</span>
                            <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200">email@digigo.click</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-cream-100 dark:border-zinc-800">
                <a href="{{ route('home') }}#contact" target="_blank" class="w-full py-2.5 text-center block text-xs font-bold text-zinc-900 bg-brand-yellow hover:bg-brand-hover rounded-xl transition-colors shadow-sm">
                    Open Support Ticket
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

