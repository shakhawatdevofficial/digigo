@extends('admin.layouts.adminpanel')

@section('title', 'Admin Profile - DigiGo')
@section('page_title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Top Navigation Tabs (Profile / Change Password) -->
    <div class="flex items-center gap-2 border-b border-cream-200 dark:border-brand-borderDark pb-3">
        <a href="{{ route('admin.profile') }}" class="px-4 py-2 text-xs font-bold rounded-xl bg-zinc-900 text-white dark:bg-brand-yellow dark:text-zinc-900 transition-colors flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-user-shield"></i>
            <span>Profile Information</span>
        </a>
        <a href="{{ route('admin.password') }}" class="px-4 py-2 text-xs font-semibold rounded-xl text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors flex items-center gap-2">
            <i class="fa-solid fa-key"></i>
            <span>Change Password</span>
        </a>
    </div>

    <!-- Profile Form Card -->
    <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 sm:p-8 shadow-sm">
        <div class="mb-6 pb-6 border-b border-cream-200 dark:border-brand-borderDark flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Admin Account Details</h2>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Update your name, email address, phone number, and avatar photo.</p>
            </div>
            <span class="px-3 py-1 text-xs font-bold rounded-full bg-rose-100 dark:bg-rose-950/60 text-rose-700 dark:text-rose-400 border border-rose-200 dark:border-rose-900 self-start sm:self-center">
                Super Administrator
            </span>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Photo Upload Area -->
            <div class="flex flex-col sm:flex-row items-center gap-6 p-4 rounded-2xl bg-cream-50 dark:bg-zinc-900/50 border border-cream-200 dark:border-brand-borderDark">
                <div class="relative w-20 h-20 rounded-2xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 font-bold text-2xl flex items-center justify-center shadow-md overflow-hidden border-2 border-white dark:border-zinc-800 shrink-0">
                    @if($user->photo)
                        <img id="avatarPreview" src="{{ asset($user->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <span id="avatarPlaceholder">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        <img id="avatarPreview" src="" alt="Avatar" class="w-full h-full object-cover hidden">
                    @endif
                </div>

                <div class="space-y-1 text-center sm:text-left flex-1">
                    <h4 class="text-xs font-bold text-zinc-800 dark:text-zinc-200">Profile Photo</h4>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400">JPG, PNG, WebP format (Max 2MB)</p>
                    <label class="inline-block mt-2 px-4 py-1.5 bg-white dark:bg-brand-cardDark border border-cream-200 dark:border-brand-borderDark text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white rounded-xl text-xs font-semibold cursor-pointer shadow-sm hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors">
                        <i class="fa-solid fa-cloud-arrow-up mr-1 text-amber-500"></i> Choose Photo
                        <input type="file" name="photo" id="photoInput" accept="image/*" class="hidden">
                    </label>
                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Name and Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('name') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('email') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Phone Number -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Phone Number
                    </label>
                    <input 
                        type="text" 
                        name="phone" 
                        id="phone" 
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="+880 1700-000000"
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('phone') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Role Permissions
                    </label>
                    <input 
                        type="text" 
                        value="System Admin (Full Access)"
                        disabled
                        class="w-full bg-cream-100 dark:bg-zinc-800 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-500 dark:text-zinc-400 font-sans cursor-not-allowed select-none"
                    >
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-brand-yellow hover:bg-brand-hover text-zinc-900 font-bold rounded-xl text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Save Changes</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('photoInput');
        const avatarPreview = document.getElementById('avatarPreview');
        const avatarPlaceholder = document.getElementById('avatarPlaceholder');

        if (photoInput) {
            photoInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        avatarPreview.src = event.target.result;
                        avatarPreview.classList.remove('hidden');
                        if (avatarPlaceholder) avatarPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush

