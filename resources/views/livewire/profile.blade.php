<div class="max-w-5xl mx-auto space-y-8">
    {{-- Success Toast --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.300ms class="fixed top-4 right-4 z-50 max-w-sm bg-white rounded-2xl shadow-lg border border-emerald-100 p-4 flex items-start gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800">Berhasil!</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    {{-- Header --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="relative">
            <div class="h-24 bg-gradient-to-r from-blue-600 to-blue-700"></div>
            <div class="px-8 pb-6">
                <div class="flex flex-col sm:flex-row sm:items-end gap-5 -mt-12">
                    <div class="w-20 h-20 rounded-2xl bg-white border-4 border-white shadow-lg flex items-center justify-center shrink-0">
                        <span class="text-2xl font-bold text-blue-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="pb-1">
                        <h1 class="text-xl font-bold text-slate-800">{{ Auth::user()->name }}</h1>
                        <p class="text-sm text-slate-500 flex items-center gap-2 mt-0.5">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[11px] font-semibold rounded-md bg-blue-50 text-blue-700 border border-blue-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ ucwords(str_replace('_', ' ', Auth::user()->role)) }}
                            </span>
                            <span>·</span>
                            <span>{{ Auth::user()->email }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2-Column Grid: Informasi Akun & Ganti Password --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Profile Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h2 class="text-base font-bold text-slate-800">Informasi Akun</h2>
                </div>
            </div>
            <form wire:submit="updateProfile" class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input wire:model="name" type="text" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Nama lengkap Anda">
                    @error('name') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Username</label>
                    <input wire:model="username" type="text" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Username">
                    @error('username') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input wire:model="email" type="email" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="email@example.com">
                    @error('email') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="pt-2">
                    <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm disabled:opacity-50">
                        <span wire:loading.remove wire:target="updateProfile">Simpan Profil</span>
                        <span wire:loading wire:target="updateProfile" style="display: none;">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h2 class="text-base font-bold text-slate-800">Ganti Password</h2>
                </div>
            </div>
            <form wire:submit="updatePassword" class="px-6 py-5 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password Saat Ini</label>
                    <input wire:model="current_password" type="password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Masukkan password saat ini">
                    @error('current_password') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password Baru</label>
                    <input wire:model="new_password" type="password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Minimal 8 karakter">
                    @error('new_password') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                    <input wire:model="new_password_confirmation" type="password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Ulangi password baru">
                </div>
                <div class="pt-2">
                    <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm disabled:opacity-50">
                        <span wire:loading.remove wire:target="updatePassword">Ganti Password</span>
                        <span wire:loading wire:target="updatePassword" style="display: none;">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>