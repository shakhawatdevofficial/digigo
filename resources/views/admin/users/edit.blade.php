@extends('admin.layouts.adminpanel')

@section('title', 'Edit User: ' . $user->name . ' - DigiGo Admin')
@section('page_title', 'Edit User')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Top Bar Navigation -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.users.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-900 dark:hover:text-white flex items-center gap-1.5 transition-colors">
                <i class="fa-solid fa-arrow-left text-[11px]"></i>
                <span>Back to Users List</span>
            </a>
            <h1 class="text-xl font-bold text-zinc-900 dark:text-white mt-2">Edit User Account: {{ $user->name }}</h1>
        </div>
    </div>

    <!-- Edit User Form Card -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white dark:bg-brand-cardDark rounded-3xl border border-cream-200 dark:border-brand-borderDark p-6 sm:p-8 shadow-sm space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-cream-200 dark:border-brand-borderDark">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-brand-yellow flex items-center justify-center font-bold text-base">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-zinc-900 dark:text-white">Account Information</h2>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Update account credentials, contact info, role and status.</p>
                    </div>
                </div>

                @if(Auth::id() === $user->id)
                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-brand-yellow border border-amber-200 dark:border-amber-900">
                        <i class="fa-solid fa-circle-user mr-1"></i> Your Profile
                    </span>
                @endif
            </div>

            <!-- Profile Photo Upload & Preview Row -->
            <div>
                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2">
                    Profile Avatar / Photo <span class="text-zinc-400 text-[10px] font-normal">(Optional, JPG/PNG/WEBP max 2MB)</span>
                </label>
                <div class="flex items-center gap-4">
                    <div id="photoPreviewContainer" class="w-16 h-16 rounded-2xl bg-cream-100 dark:bg-zinc-800 border-2 border-cream-200 dark:border-zinc-700 flex items-center justify-center text-zinc-400 overflow-hidden shrink-0 shadow-inner">
                        @if($user->photo)
                            <img id="photoPreview" src="{{ asset($user->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            <i id="photoPlaceholderIcon" class="fa-solid fa-user text-xl hidden"></i>
                        @else
                            <i id="photoPlaceholderIcon" class="fa-solid fa-user text-xl"></i>
                            <img id="photoPreview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                        @endif
                    </div>
                    <div class="flex-1">
                        <input 
                            type="file" 
                            name="photo" 
                            id="userPhotoInput" 
                            accept="image/*"
                            onchange="previewUserPhoto(event)"
                            class="block w-full text-xs text-zinc-500 dark:text-zinc-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cream-100 dark:file:bg-zinc-800 file:text-zinc-800 dark:file:text-zinc-200 hover:file:bg-cream-200 cursor-pointer"
                        >
                        @error('photo')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
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
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
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
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Phone Number <span class="text-zinc-400 text-[10px] font-normal">(Optional)</span>
                    </label>
                    <input 
                        type="text" 
                        name="phone" 
                        id="phone" 
                        value="{{ old('phone', $user->phone) }}" 
                        placeholder="017XXXXXXXX" 
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('phone') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        User Role / Permission <span class="text-red-500">*</span>
                    </label>
                    @if(Auth::id() === $user->id)
                        <input type="hidden" name="role" value="admin">
                        <input 
                            type="text" 
                            value="Administrator (Superadmin - Cannot Demote Self)" 
                            disabled 
                            class="w-full bg-cream-100 dark:bg-zinc-800 border border-cream-200 dark:border-brand-borderDark rounded-xl px-3.5 py-2.5 text-xs text-zinc-500 dark:text-zinc-400 font-sans cursor-not-allowed"
                        >
                    @else
                        <select 
                            name="role" 
                            id="role" 
                            required
                            class="w-full bg-cream-50 dark:bg-zinc-900 border @error('role') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                        >
                            <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Customer (Regular User)</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator (Full Access)</option>
                        </select>
                    @endif
                    @error('role')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password (Optional) -->
                <div>
                    <label for="password" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5">
                        New Password <span class="text-zinc-400 text-[10px] font-normal">(Leave blank to keep existing password)</span>
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Enter new password (min 6 chars)" 
                        class="w-full bg-cream-50 dark:bg-zinc-900 border @error('password') border-red-500 @else border-cream-200 dark:border-brand-borderDark @enderror rounded-xl px-3.5 py-2.5 text-xs text-zinc-900 dark:text-zinc-100 outline-none focus:border-brand-yellow font-sans transition-colors"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Checkbox -->
                <div class="flex items-end">
                    @if(Auth::id() === $user->id)
                        <div class="w-full p-3 rounded-2xl bg-cream-100 dark:bg-zinc-800/60 border border-cream-200 dark:border-brand-borderDark">
                            <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200 block">Account Status: Active</span>
                            <span class="text-[10px] text-zinc-400 block">Current logged-in account cannot be deactivated.</span>
                        </div>
                    @else
                        <label class="flex items-center justify-between w-full p-3 rounded-2xl bg-cream-50 dark:bg-zinc-900/60 border border-cream-200 dark:border-brand-borderDark cursor-pointer select-none">
                            <div>
                                <span class="text-xs font-bold text-zinc-800 dark:text-zinc-200 block">Account Active Status</span>
                                <span class="text-[10px] text-zinc-400 block">Allow user to log in and make orders</span>
                            </div>
                            <input 
                                type="checkbox" 
                                name="status" 
                                value="1" 
                                {{ old('status', $user->status) ? 'checked' : '' }} 
                                class="w-4 h-4 text-brand-yellow bg-white dark:bg-zinc-800 border-zinc-300 dark:border-zinc-700 rounded focus:ring-brand-yellow"
                            >
                        </label>
                    @endif
                </div>
            </div>

            <!-- Submit Button Bar -->
            <div class="pt-4 border-t border-cream-200 dark:border-brand-borderDark flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl border border-cream-200 dark:border-brand-borderDark text-xs font-semibold text-zinc-600 dark:text-zinc-300 hover:bg-cream-100 dark:hover:bg-zinc-800 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-zinc-900 dark:bg-brand-yellow text-brand-yellow dark:text-zinc-900 text-xs font-bold shadow hover:opacity-95 transition-all inline-flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Save Changes</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function previewUserPhoto(event) {
        const input = event.target;
        const preview = document.getElementById('photoPreview');
        const icon = document.getElementById('photoPlaceholderIcon');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (icon) {
                    icon.classList.add('hidden');
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

