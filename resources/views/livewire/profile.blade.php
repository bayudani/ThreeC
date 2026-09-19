<div class="max-w-5xl mx-auto space-y-8">
    @php
        $user = Auth::user();
        $isAdmin = $user->role === 'admin_kampus';
        $roleLabel = $isAdmin ? 'Admin Kampus' : 'Admin ' . ($user->ormawa?->nama ?? 'Ormawa');
        $initial = strtoupper(substr($user->name, 0, 1));
    @endphp

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
            <div class="h-28 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700">
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 120%, white 0, transparent 40%), radial-gradient(circle at 80% -40%, white 0, transparent 35%);"></div>
            </div>
            <div class="px-8 pb-6">
                <div class="flex flex-col sm:flex-row sm:items-end gap-5 -mt-12">
                    <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 border-4 border-white shadow-xl flex items-center justify-center shrink-0">
                        <span class="text-3xl font-bold text-white">{{ $initial }}</span>
                    </div>
                    <div class="pb-1.5 flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-3">
                            <h1 class="text-xl font-bold text-slate-800 truncate">{{ $user->name }}</h1>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold rounded-md {{ $isAdmin ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                {{ $roleLabel }}
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1 text-sm text-slate-500">
                            @if($user->email)
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $user->email }}
                                </span>
                            @endif
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $user->username }}
                            </span>
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Terdaftar {{ $user->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2-Column Grid: Informasi Akun & Keamanan --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Profile Information --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-800">Informasi Akun</h2>
                        <p class="text-xs text-slate-400">Kelola data identitas Anda</p>
                    </div>
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
                    <p class="text-xs text-slate-400 mt-1.5">Username digunakan untuk login.</p>
                    @error('username') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input wire:model="email" type="email" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="email@example.com">
                    @error('email') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                <div class="pt-2">
                    <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm disabled:opacity-50">
                        <svg wire:loading wire:target="updateProfile" style="display: none;" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                        <span wire:loading.remove wire:target="updateProfile">Simpan Profil</span>
                        <span wire:loading wire:target="updateProfile" style="display: none;">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Security: Admin can change password / Ormawa sees notice --}}
        @if($isAdmin)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-800">Ganti Password</h2>
                            <p class="text-xs text-slate-400">Minimal 8 karakter untuk keamanan</p>
                        </div>
                    </div>
                </div>
                <form wire:submit="updatePassword" class="px-6 py-5 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password Saat Ini</label>
                        <input wire:model="current_password" type="password" autocomplete="current-password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 transition-all" placeholder="Masukkan password saat ini">
                        @error('current_password') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div x-data="{ show: false }">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password Baru</label>
                        <div class="relative">
                            <input wire:model="new_password" :type="show ? 'text' : 'password'" autocomplete="new-password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 pr-10 transition-all" placeholder="Minimal 8 karakter">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="show" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                        @error('new_password') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div x-data="{ show: false }">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input wire:model="new_password_confirmation" :type="show ? 'text' : 'password'" autocomplete="new-password" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full p-2.5 pr-10 transition-all" placeholder="Ulangi password baru">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="show" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                        @error('new_password_confirmation') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="pt-2">
                        <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-[0.97] text-white text-sm font-semibold rounded-xl transition-all shadow-sm disabled:opacity-50">
                            <svg wire:loading wire:target="updatePassword" style="display: none;" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            <span wire:loading.remove wire:target="updatePassword">Ganti Password</span>
                            <span wire:loading wire:target="updatePassword" style="display: none;">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        @else
            {{-- Ormawa account: password diatur oleh Admin Kampus --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="h-1.5 bg-gradient-to-r from-emerald-400 to-emerald-600"></div>
                <div class="px-6 py-6 text-center">
                    <div class="w-14 h-14 mx-auto bg-emerald-50 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h2 class="text-base font-bold text-slate-800">Keamanan Akun</h2>
                    <p class="text-sm text-slate-500 mt-2 max-w-xs mx-auto leading-relaxed">
                        Password akun <strong>{{ $user->ormawa?->nama ?? 'ormawa' }}</strong> dikelola oleh Admin Kampus.
                    </p>
                    <div class="mt-5 p-4 bg-slate-50 rounded-xl border border-slate-200 text-left">
                        <p class="text-xs text-slate-500 flex items-start gap-2">
                            <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Jika lupa password, hubungi Admin Kampus untuk mendapatkan password baru.
                        </p>
                    </div>
                    <p class="text-xs text-slate-400 mt-4">
                        Login menggunakan username <kbd class="px-1.5 py-0.5 bg-slate-100 rounded text-[10px] font-mono text-slate-600">{{ $user->username }}</kbd>
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>