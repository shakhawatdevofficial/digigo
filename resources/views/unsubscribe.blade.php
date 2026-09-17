@extends('layouts.website')

@section('title', 'Unsubscribe - DigiGo')

@section('content')
<section class="min-h-[calc(100vh-200px)] py-12 lg:py-20 flex items-center justify-center relative overflow-hidden">
    <div class="max-w-md w-full mx-auto px-4 sm:px-6 relative z-10" data-aos="fade-up">
        <div class="bg-white dark:bg-brand-cardDark rounded-2xl border border-cream-200 dark:border-brand-borderDark shadow-xl p-6 sm:p-8 text-center transition-colors">
            <div class="w-14 h-14 rounded-2xl bg-amber-100 dark:bg-amber-950/50 text-amber-600 dark:text-brand-yellow flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            
            <h1 class="text-2xl font-extrabold text-zinc-900 dark:text-white">
                Email Preferences
            </h1>
            
            <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 mt-3 leading-relaxed">
                @if(!empty($email))
                    You are managing email preferences for <strong class="text-zinc-800 dark:text-zinc-200">{{ $email }}</strong>.
                @else
                    You can manage or opt-out of marketing emails here.
                @endif
            </p>

            <div class="mt-6 p-4 rounded-xl bg-cream-50 dark:bg-zinc-900 border border-cream-200 dark:border-brand-borderDark text-xs text-zinc-600 dark:text-zinc-400">
                <i class="fa-solid fa-info-circle text-brand-yellow mr-1"></i>
                Your unsubscribe request is recorded. You will no longer receive non-essential promotional updates.
            </div>

            <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('home') }}" class="px-6 py-2.5 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-colors shadow-sm">
                    Return to Home
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

