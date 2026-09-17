@extends('admin.layouts.adminpanel')

@section('title', 'Change Password - DigiGo Admin')
@section('page_title', 'Change Password')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Top Navigation Tabs (Profile / Change Password) -->
    <div class="flex items-center gap-2 border-b border-cream-200 dark:border-brand-borderDark pb-3">
        <a href="{{ route('admin.profile') }}" class="px-4 py-2 text-xs font-semibold rounded-xl text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors flex items-center gap-2">
            <i class="fa-solid fa-user-shield"></i>
            <span>Profile Information</span>
        </a>
        <a href="{{ route('admin.password') }}" class="px-4 py-2 text-xs font-bold rounded-xl bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 transition-colors flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-key"></i>
            <span>Change Password</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Password Form Card (2 Cols) -->
        <div class="lg:col-span-2 bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 sm:p-8 shadow-sm">
            <div class="mb-6 pb-6 border-b border-cream-200 dark:border-brand-borderDark">
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Update Password</h2>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Ensure your admin account is using a long, random password to stay secure.</p>
            </div>

            <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Current Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                            <i class="fa-solid fa-lock-open text-xs"></i>
                        </div>
                        <input 
                            type="password" 
                            name="current_password" 
                            id="current_password" 
                            required
                            placeholder="Enter current password"
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('current_password') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl pl-10 pr-10 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                        <button 
                            type="button" 
                            onclick="togglePass('current_password', 'currentPassIcon')" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 cursor-pointer focus:outline-none"
                        >
                            <i class="fa-solid fa-eye text-xs" id="currentPassIcon"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        New Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required
                            placeholder="Minimum 8 characters"
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('password') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl pl-10 pr-10 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                        <button 
                            type="button" 
                            onclick="togglePass('password', 'newPassIcon')" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 cursor-pointer focus:outline-none"
                        >
                            <i class="fa-solid fa-eye text-xs" id="newPassIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Confirm New Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                            <i class="fa-solid fa-shield-halved text-xs"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            required
                            placeholder="Re-type new password"
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('password_confirmation') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl pl-10 pr-10 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                        <button 
                            type="button" 
                            onclick="togglePass('password_confirmation', 'confirmPassIcon')" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 cursor-pointer focus:outline-none"
                        >
                            <i class="fa-solid fa-eye text-xs" id="confirmPassIcon"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-key"></i>
                        <span>Update Password</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Guide Card (1 Col) -->
        <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-brand-yellow flex items-center justify-center text-lg mb-3">
                    <i class="fa-solid fa-shield-virus"></i>
                </div>
                <h3 class="font-bold text-sm text-zinc-900 dark:text-white">Security Checklist</h3>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 mb-4">To ensure maximum security of your DigiGo administrative account:</p>

                <ul class="space-y-3 text-xs text-zinc-600 dark:text-zinc-300">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-xs shrink-0"></i>
                        <span>Use at least 8 characters with numbers & symbols.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-xs shrink-0"></i>
                        <span>Avoid using personal names or common dates.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-500 mt-0.5 text-xs shrink-0"></i>
                        <span>Do not share admin credentials with unauthorized users.</span>
                    </li>
                </ul>
            </div>

            <div class="mt-6 pt-4 border-t border-cream-100 dark:border-zinc-800 text-[11px] text-zinc-400">
                <i class="fa-solid fa-lock text-brand-yellow mr-1"></i>
                Session is protected with 256-Bit SSL encryption.
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function togglePass(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input && icon) {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !isPassword);
            icon.classList.toggle('fa-eye-slash', isPassword);
        }
    }
</script>
@endpush

