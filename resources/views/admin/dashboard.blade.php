@extends('admin.layouts.adminpanel')

@section('title', 'Admin Dashboard - DigiGo')
@section('page_title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- 1. Header Banner -->
    <div class="bg-gradient-to-r from-zinc-900 via-brand-dark to-zinc-900 rounded-3xl p-6 sm:p-8 text-white relative overflow-hidden border border-cream-200/20 dark:border-brand-borderDark shadow-lg">
        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-rose-500/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 mb-3 text-[11px] font-bold tracking-wider text-brand-yellow bg-brand-yellow/10 border border-brand-yellow/30 rounded-full">
                    <i class="fa-solid fa-shield-halved text-[10px]"></i> MASTER CONTROL PANEL
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    DigiGo Administration System 🚀
                </h1>
                <p class="text-xs sm:text-sm text-zinc-400 mt-2 max-w-xl">
                    Real-time monitoring for digital orders, automated license distribution, customer management, and system operations.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="{{ route('home') }}#products" target="_blank" class="px-4 py-2.5 bg-cream-50/10 hover:bg-cream-50/20 text-white font-semibold rounded-xl text-xs transition-colors border border-white/20 flex items-center gap-2">
                    <i class="fa-solid fa-eye"></i>
                    <span>Preview Store</span>
                </a>
                <button type="button" class="px-5 py-2.5 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-all shadow-md flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add New Product</span>
                </button>
            </div>
        </div>
    </div>

    <!-- 2. Admin Analytics Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Stat 1: Total Revenue -->
        <div class="bg-white dark:bg-brand-cardDark p-5 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Total Revenue</p>
                <h3 class="text-2xl font-black text-zinc-900 dark:text-white mt-1">৳1,48,250</h3>
                <span class="text-[11px] text-emerald-500 font-medium flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +14.8% this month
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-500 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
        </div>

        <!-- Stat 2: Total Orders -->
        <div class="bg-white dark:bg-brand-cardDark p-5 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Total Sales</p>
                <h3 class="text-2xl font-black text-zinc-900 dark:text-white mt-1">1,248</h3>
                <span class="text-[11px] text-emerald-500 font-medium flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +8% today
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-brand-yellow flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>

        <!-- Stat 3: Registered Users -->
        <div class="bg-white dark:bg-brand-cardDark p-5 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Total Customers</p>
                <h3 class="text-2xl font-black text-zinc-900 dark:text-white mt-1">542</h3>
                <span class="text-[11px] text-blue-500 font-medium flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-user-check text-[10px]"></i> Active accounts
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/40 text-blue-500 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <!-- Stat 4: Keys Remaining -->
        <div class="bg-white dark:bg-brand-cardDark p-5 rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">License Keys Pool</p>
                <h3 class="text-2xl font-black text-zinc-900 dark:text-white mt-1">186 Available</h3>
                <span class="text-[11px] text-amber-500 font-medium flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-circle-check text-[10px]"></i> Auto-delivery ready
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-950/40 text-purple-500 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-key"></i>
            </div>
        </div>
    </div>

    <!-- 3. Recent Orders & Inquiries -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Orders Table (2 Cols) -->
        <div class="lg:col-span-2 bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm p-5 sm:p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-cream-200 dark:border-brand-borderDark">
                <div>
                    <h3 class="font-bold text-sm text-zinc-900 dark:text-white">Recent Customer Orders</h3>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Live order stream and delivery statuses</p>
                </div>
                <button type="button" class="text-xs font-semibold text-amber-600 dark:text-brand-yellow hover:underline">All Orders →</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-zinc-400 border-b border-cream-100 dark:border-zinc-800">
                            <th class="pb-3 font-semibold">Order ID</th>
                            <th class="pb-3 font-semibold">Customer</th>
                            <th class="pb-3 font-semibold">Product</th>
                            <th class="pb-3 font-semibold">Amount</th>
                            <th class="pb-3 font-semibold">Status</th>
                            <th class="pb-3 font-semibold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-100 dark:divide-zinc-800 text-zinc-700 dark:text-zinc-300">
                        <tr>
                            <td class="py-3 font-mono font-bold text-zinc-900 dark:text-white">#DG-8924</td>
                            <td class="py-3">
                                <span class="font-semibold block text-zinc-900 dark:text-white">Sabbir Ahmed</span>
                                <span class="text-[10px] text-zinc-400">sabbir@gmail.com</span>
                            </td>
                            <td class="py-3 font-medium">Office 365 1-Yr</td>
                            <td class="py-3 font-bold text-zinc-900 dark:text-white">৳1,199</td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400">Delivered</span>
                            </td>
                            <td class="py-3 text-right">
                                <button type="button" class="px-2.5 py-1 text-[11px] font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 rounded-lg transition-colors">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono font-bold text-zinc-900 dark:text-white">#DG-8923</td>
                            <td class="py-3">
                                <span class="font-semibold block text-zinc-900 dark:text-white">Farhan Kabir</span>
                                <span class="text-[10px] text-zinc-400">farhan@yahoo.com</span>
                            </td>
                            <td class="py-3 font-medium">YouTube Premium</td>
                            <td class="py-3 font-bold text-zinc-900 dark:text-white">৳299</td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-400">Pending</span>
                            </td>
                            <td class="py-3 text-right">
                                <button type="button" class="px-2.5 py-1 text-[11px] font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 rounded-lg transition-colors">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono font-bold text-zinc-900 dark:text-white">#DG-8922</td>
                            <td class="py-3">
                                <span class="font-semibold block text-zinc-900 dark:text-white">Tasnim Rahman</span>
                                <span class="text-[10px] text-zinc-400">tasnim@outlook.com</span>
                            </td>
                            <td class="py-3 font-medium">Canva Pro Lifetime</td>
                            <td class="py-3 font-bold text-zinc-900 dark:text-white">৳499</td>
                            <td class="py-3">
                                <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-400">Delivered</span>
                            </td>
                            <td class="py-3 text-right">
                                <button type="button" class="px-2.5 py-1 text-[11px] font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 rounded-lg transition-colors">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick System Status (1 Col) -->
        <div class="bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-sm p-5 sm:p-6 flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-sm text-zinc-900 dark:text-white mb-1">System Health</h3>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mb-4">Infrastructure & Service Status</p>
                
                <div class="space-y-3">
                    <div class="p-3 rounded-xl bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Database & Storage</span>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">Healthy</span>
                    </div>

                    <div class="p-3 rounded-xl bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Mail Queue Worker</span>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">Active</span>
                    </div>

                    <div class="p-3 rounded-xl bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Payment Gateway</span>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">Online</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-cream-100 dark:border-zinc-800">
                <a href="{{ route('home') }}" target="_blank" class="w-full py-2.5 text-center block text-xs font-bold text-zinc-900 bg-brand-yellow hover:bg-brand-hover rounded-xl transition-colors shadow-sm">
                    Open Storefront
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

